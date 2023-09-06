<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use DB;
use App\Models\RiwayatPendidikan;
use Carbon\Carbon;
use Session;

class RiwayatController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

     /** View Riwayat Pendidikan */
     public function pendidikan()
    {
        $riwayatPendidikan = RiwayatPendidikan::all();
        return view('riwayat.riwayat-pendidikan', compact('riwayatPendidikan'));
    }

    /** Tambah Data Riwayat Pendidikan */
    public function tambahRiwayatPendidikan(Request $request)
    {
        $request->validate([
            'tingkat_pendidikan'    => 'required|string|max:255',
            'pendidikan'            => 'required|string|max:255|',
            'tahun_lulus'           => 'required|min:11|numeric',
            'no_ijazah'             => 'required|min:11|numeric',
            'nama_sekolah'          => 'required|string|max:255',
            'gelar_depan'           => 'required|string|max:255',
            'gelar_belakang'        => 'required|string|max:255',
            'jenis_pendidikan'      => 'required|string|max:255',
            'dokumen_transkrip'     => 'required|mimes:pdf|max:5120',
            'dokumen_ijazah'        => 'required|mimes:pdf|max:5120',
            'dokumen_gelar'         => 'required|mimes:pdf|max:5120',
        ]);
        DB::beginTransaction();
        try {

            $dokumen_transkrip = time().'.'.$request->dokumen_transkrip->extension();  
            $request->dokumen_transkrip->move(public_path('assets/DokumenTranskrip'), $dokumen_transkrip);

            $dokumen_ijazah = time().'.'.$request->dokumen_ijazah->extension();  
            $request->dokumen_ijazah->move(public_path('assets/DokumenIjazah'), $dokumen_ijazah);

            $dokumen_gelar = time().'.'.$request->dokumen_gelar->extension();  
            $request->dokumen_gelar->move(public_path('assets/DokumenGelar'), $dokumen_gelar);

            $riw_pend = new RiwayatPendidikan;
            $riw_pend->tingkat_pendidikan = $request->tingkat_pendidikan;
            $riw_pend->pendidikan         = $request->pendidikan;
            $riw_pend->tahun_lulus        = $request->tahun_lulus;
            $riw_pend->no_ijazah          = $request->no_ijazah;
            $riw_pend->nama_sekolah       = $request->nama_sekolah;
            $riw_pend->gelar_depan        = $request->gelar_depan;
            $riw_pend->gelar_belakang     = $request->gelar_belakang;
            $riw_pend->jenis_pendidikan   = $request->jenis_pendidikan;
            $riw_pend->dokumen_transkrip  = $dokumen_transkrip;
            $riw_pend->dokumen_ijazah     = $dokumen_ijazah;
            $riw_pend->dokumen_gelar      = $dokumen_gelar;
            $riw_pend->save();

            DB::commit();
            Toastr::success('Berhasil membuat data baru :)','Success');
            return redirect()->back();
        } catch(\Exception $e) {
            DB::rollback();
            Toastr::error('Gagal membuat data baru :)','Error');
            return redirect()->back();
        }
    }
    /** End Tambah Data Riwayat Pendidikan */

    /** Pebaharui Data Riwayat Pendidikan */
    public function perbaharuiRiwayatPendidikan( Request $request)
    {
        DB::beginTransaction();
        try{
           
            $attachments = $request->hidden_attachments;
            $attachment  = $request->file('attachments');
            if($attachment != '')
            {
                unlink('assets/images/'.$attachments);
                $attachments = time().'.'.$attachment->getClientOriginalExtension();  
                $attachment->move(public_path('assets/images'), $attachments);
            } else {
                $attachments;
            }
            
            $update = [

                'id'           => $request->id,
                'item_name'    => $request->item_name,
                'purchase_from'=> $request->purchase_from,
                'purchase_date'=> $request->purchase_date,
                'purchased_by' => $request->purchased_by,
                'amount'       => $request->amount,
                'paid_by'      => $request->paid_by,
                'status'       => $request->status,
                'attachments'  => $attachments,
            ];

            Expense::where('id',$request->id)->update($update);
            DB::commit();
            Toastr::success('Expense updated successfully :)','Success');
            return redirect()->back();

        }catch(\Exception $e){
            DB::rollback();
            Toastr::error('Expense update fail :)','Error');
            return redirect()->back();
        }
    }










    /** view riwayat golongan page */
    public function golongan()
    {
        return view('riwayat.riwayat-golongan');
    }

    /** view riwayat jabatan page */
    public function jabatan()
    {
        return view('riwayat.riwayat-jabatan');
    }

    /** view riwayat diklat page */
    public function diklat()
    {
        return view('riwayat.riwayat-diklat');
    }
}
