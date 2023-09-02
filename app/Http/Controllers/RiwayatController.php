<?php

namespace App\Http\Controllers;

use App\Models\Pendidikan;
use Illuminate\Http\Request;
use App\Riwayat;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\DB;

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
    /** view riwayat pendidikan page */
    public function index()
    {
        return view('riwayat.riwayat-pendidikan');
    }

    /** pendidikan page index */
    public function pendidikan()
    {
        /** get data show data on table page pendidikan */
        $data = Pendidikan::all();
        return view('riwayat.riwayat-pendidikan', compact('data'));
    }

    /** save record pendidikan*/
    public function saveRecord(Request $request)
    {
        $request->validate([
            'tingkat_pendidikan'    => 'required|string|max:255',
            'pendidikan'            => 'required|string|max:255',
            'tahun_lulus'           => 'required|string|max:255',
            'no_ijazah'             => 'required|string|max:255',
            'nama_sekolah'          => 'required|string|max:255',
            'gelar_depan'           => 'required|string|max:255',
            'gelar_belakang'        => 'required|string|max:255',
            'jenis_pendidikan'      => 'required|string|max:255',
            'dokumen'               => 'required',
        ]);

        DB::beginTransaction();
        try {

            $dokumen = time() . '.' . $request->dokumen->extension();
            $request->dokumen->move(public_path('assets/images'), $dokumen);

            $pendidikan = new Pendidikan();
            $pendidikan->tingkat_pendidikan     = $request->tingkat_pendidikan;
            $pendidikan->pendidikan     = $request->pendidikan;
            $pendidikan->tahun_lulus    = $request->tahun_lulus;
            $pendidikan->no_ijazah      = $request->no_ijazah;
            $pendidikan->nama_sekolah   = $request->nama_sekolah;
            $pendidikan->gelar_depan    = $request->gelar_depan;
            $pendidikan->gelar_belakang     = $request->gelar_belakang;
            $pendidikan->jenis_pendidikan   = $request->jenis_pendidikan;
            $pendidikan->dokumen    = $dokumen;
            $pendidikan->save();

            DB::commit();
            Toastr::success('Menambah riwayat pendidikan berhasil :)', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Menambah riwayat pendidikan gagal :)', 'Error');
            return redirect()->back();
        }
    }

    /** update record */
    public function updateRecord(Request $request)
    {
        DB::beginTransaction();
        try {

            $dokumens = $request->hidden_dokumens;
            $dokumen  = $request->file('dokumens');
            if ($dokumen != '') {
                unlink('assets/images/' . $dokumens);
                $dokumens = time() . '.' . $dokumen->getClientOriginalExtension();
                $dokumen->move(public_path('assets/images'), $dokumens);
            } else {
                $dokumens;
            }

            $update = [

                'id'                    => $request->id,
                'tingkat_pendidikan'    => $request->tingkat_pendidikan,
                'pendidikan'            => $request->pendidikan,
                'tahun_lulus'           => $request->tahun_lulus,
                'no_ijazah'             => $request->no_ijazah,
                'nama_sekolah'          => $request->nama_sekolah,
                'gelar_depan'           => $request->gelar_depan,
                'gelar_belakang'        => $request->gelar_belakang,
                'jenis_pendidikan'      => $request->jenis_pendidikan,
                'dokumens'              => $dokumens,
            ];

            Pendidikan::where('id', $request->id)->update($update);
            DB::commit();
            Toastr::success('Riwayat pendidikan update berhadil :)', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Riwayat pendidikan update gagal :)', 'Error');
            return redirect()->back();
        }
    }

    /** view riwayat golongan page */
    public function r_golongan()
    {
        return view('riwayat.riwayat-golongan');
    }

    /** view riwayat jabatan page */
    public function r_jabatan()
    {
        return view('riwayat.riwayat-jabatan');
    }

    /** view riwayat diklat page */
    public function r_diklat()
    {
        return view('riwayat.riwayat-diklat');
    }
}
