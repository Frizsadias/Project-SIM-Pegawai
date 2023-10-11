<?php

namespace App\Http\Controllers;

use App\Models\LayananCuti;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LayananController extends Controller
{
    public function listCuti()
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

        $userList = DB::table('users')->get();
        return view('layanan.cuti', compact('data_cuti', 'data_profilcuti', 'userList'));
    }

    /** save new user */
    public function tambahDataCuti(Request $request)
    {
        $request->validate([
            'name'                  => 'required|string|max:255',
            'nip'                   => 'required|string|max:255',
            'jenis_cuti'            => 'required|string|max:255',
            'lama_cuti'             => 'required|string|max:255',
            'tanggal_mulai_cuti'    => 'required|string|max:255',
            'tanggal_selesai_cuti'  => 'required|string|max:255',
            'dokumen_kelengkapan'   => 'required|string|max:255',
            'status_pengajuan'      => 'required|string|max:255',
        ]);
        DB::beginTransaction();
        try {

            $user = new LayananCuti;
            $user->name                     = $request->name;
            $user->nip                      = $request->nip;
            $user->jenis_cuti               = $request->jenis_cuti;
            $user->lama_cuti                = $request->lama_cuti;
            $user->tanggal_mulai_cuti       = $request->tanggal_mulai_cuti;
            $user->tanggal_selesai_cuti     = $request->tanggal_selesai_cuti;
            $user->dokumen_kelengkapan      = $request->dokumen_kelengkapan;
            $user->status_pengajuan         = $request->status_pengajuan;
            $user->save();

            DB::commit();
            Toastr::success('Data layanan cuti berhasil ditambah :)', 'Success');
            return redirect()->route('layanan/cuti');
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Data layanan cuti gagal ditambah :(', 'Error');
            return redirect()->back();
        }
    }
}
