<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\LayananCuti;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use DB;

class LayananController extends Controller
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

    /** Tampilan Layanan Cuti User */
    public function tampilanCutiPegawai()
    {
        $user_id = auth()->user()->user_id;
        $data_cuti = DB::table('cuti')
            ->select('cuti.*', 'cuti.user_id', 'cuti.name', 'cuti.nip', 'cuti.jenis_cuti',
            'cuti.lama_cuti', 'cuti.tanggal_mulai_cuti', 'cuti.tanggal_selesai_cuti',
            'cuti.dokumen_kelengkapan', 'cuti.status_pengajuan')
            ->where('cuti.user_id', $user_id)
            ->get();

        $data_profilcuti = DB::table('profil_pegawai')
            ->select('profil_pegawai.*','profil_pegawai.name','profil_pegawai.nip')
            ->where('profil_pegawai.user_id', $user_id)
            ->get();
        return view('layanan.layanan-cuti', compact('data_cuti', 'data_profilcuti'));
    }
    /** /Tampilan Layanan Cuti User */

    /** Daftar Layanan Cuti List */
    public function tampilanCutiPegawaiAdmin()
    {
        $data_cuti = DB::table('cuti')
            ->select('cuti.*', 'cuti.user_id', 'cuti.name', 'cuti.nip', 'cuti.jenis_cuti',
            'cuti.lama_cuti', 'cuti.tanggal_mulai_cuti', 'cuti.tanggal_selesai_cuti',
            'cuti.dokumen_kelengkapan', 'cuti.status_pengajuan')
            ->get();
        $userList = DB::table('profil_pegawai')->get();
        return view('layanan.layanan-cuti-admin', compact('data_cuti', 'userList'));
    }

    /** Tambah Data Cuti Pegawai */
    public function tambahDataCuti(Request $request)
    {
        $request->validate([
            'user_id'               => 'required|string|max:255',
            'name'                  => 'required|string|max:255',
            'nip'                   => 'required|string|max:255',
            'jenis_cuti'            => 'required|string|max:255',
            'lama_cuti'             => 'required|string|max:255',
            'tanggal_mulai_cuti'    => 'required|string|max:255',
            'tanggal_selesai_cuti'  => 'required|string|max:255',
            'status_pengajuan'      => 'required|string|max:255',
            'dokumen_kelengkapan'   => 'required|mimes:pdf|max:5120',
        ]);
        DB::beginTransaction();

        try {
            $dokumen_kelengkapan = time() . '.' . $request->dokumen_kelengkapan->extension();
            $request->dokumen_kelengkapan->move(public_path('assets/DokumenLayananCuti'), $dokumen_kelengkapan);

            $layananCutiPegawai = new LayananCuti;
            $layananCutiPegawai->user_id               = $request->user_id;
            $layananCutiPegawai->name                  = $request->name;
            $layananCutiPegawai->nip                   = $request->nip;
            $layananCutiPegawai->jenis_cuti            = $request->jenis_cuti;
            $layananCutiPegawai->lama_cuti             = $request->lama_cuti;
            $layananCutiPegawai->tanggal_mulai_cuti    = $request->tanggal_mulai_cuti;
            $layananCutiPegawai->tanggal_selesai_cuti  = $request->tanggal_selesai_cuti;
            $layananCutiPegawai->status_pengajuan      = $request->status_pengajuan;
            $layananCutiPegawai->dokumen_kelengkapan   = $dokumen_kelengkapan;
            $layananCutiPegawai->save();

            DB::commit();
            Toastr::success('Data layanan cuti berhasil ditambah :)', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Data layanan cuti gagal ditambah :(', 'Error');
            return redirect()->back();
        }
    }
    /** /Tambah Data Cuti Pegawai */

    /** Edit Data Cuti Pegawai */
    public function editDataCuti(Request $request)
    {
        DB::beginTransaction();
        try {
            $dokumen_kelengkapan = $request->hidden_dokumen_kelengkapan;
            $dokumen_kelengkapans  = $request->file('dokumen_kelengkapan');
            if ($dokumen_kelengkapans != '') {
                unlink('assets/DokumenLayananCuti/' . $dokumen_kelengkapan);
                $dokumen_kelengkapan = time() . '.' . $dokumen_kelengkapans->getClientOriginalExtension();
                $dokumen_kelengkapans->move(public_path('assets/DokumenLayananCuti'), $dokumen_kelengkapan);
            } else {
                $dokumen_kelengkapan;
            }

            $update = [
                'jenis_cuti'            => $request->jenis_cuti,
                'lama_cuti'             => $request->lama_cuti,
                'tanggal_mulai_cuti'    => $request->tanggal_mulai_cuti,
                'tanggal_selesai_cuti'  => $request->tanggal_selesai_cuti,
                'dokumen_kelengkapan'   => $dokumen_kelengkapan,
            ];

            LayananCuti::where('id', $request->id)->update($update);
            DB::commit();
            Toastr::success('Data pengajuan cuti berhasil diperbaharui :)', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Data pengajuan cuti gagal diperbaharui :(', 'Error');
            return redirect()->back();
        }
    }
    /** /Edit Data Cuti Pegawai */

    /** Search Layanan Cuti */
    public function pencarianLayananCuti(Request $request)
    {
        $user_id = auth()->user()->user_id;
        $name = $request->input('name');
        $jenis_cuti = $request->input('jenis_cuti');
        $status_pengajuan = $request->input('status_pengajuan');

        $data_cuti = DB::table('cuti')
            ->select('cuti.*', 'cuti.user_id', 'cuti.name', 'cuti.nip', 'cuti.jenis_cuti',
            'cuti.lama_cuti', 'cuti.tanggal_mulai_cuti', 'cuti.tanggal_selesai_cuti',
            'cuti.dokumen_kelengkapan', 'cuti.status_pengajuan')
            ->where('cuti.user_id', $user_id)
            ->get();

        $data_profilcuti = DB::table('profil_pegawai')
            ->select('profil_pegawai.*','profil_pegawai.name','profil_pegawai.nip')
            ->where('profil_pegawai.user_id', $user_id)
            ->get();

        $pencarianDataCuti = DB::table('cuti')
        ->join('users', 'users.user_id', '=', 'cuti.user_id')
            ->where('users.user_id', $user_id)
            ->where('cuti.name', 'like', '%' . $name . '%')
            ->where('cuti.jenis_cuti', 'like', '%' . $jenis_cuti . '%')
            ->where('cuti.status_pengajuan', 'like', '%' . $status_pengajuan . '%')
            ->get();

        return view('layanan.layanan-cuti', compact('pencarianDataCuti', 'data_cuti', 'data_profilcuti'));
    }
    /** /Search Layanan Cuti */

    /** Search Layanan Cuti */
    public function pencarianLayananCutiAdmin(Request $request)
    {
        $name = $request->input('name');
        $jenis_cuti = $request->input('jenis_cuti');
        $status_pengajuan = $request->input('status_pengajuan');

        $data_cuti = DB::table('cuti')
            ->select('cuti.*', 'cuti.user_id', 'cuti.name', 'cuti.nip', 'cuti.jenis_cuti',
            'cuti.lama_cuti', 'cuti.tanggal_mulai_cuti', 'cuti.tanggal_selesai_cuti',
            'cuti.dokumen_kelengkapan', 'cuti.status_pengajuan')
            ->where('cuti.name', 'like', '%' . $name . '%')
            ->where('cuti.jenis_cuti', 'like', '%' . $jenis_cuti . '%')
            ->where('cuti.status_pengajuan', 'like', '%' . $status_pengajuan . '%')
            ->get();
         $userList = DB::table('profil_pegawai')->get();
        return view('layanan.layanan-cuti-admin', compact('data_cuti', 'userList'));
    }
    /** /Search Layanan Cuti */

}
