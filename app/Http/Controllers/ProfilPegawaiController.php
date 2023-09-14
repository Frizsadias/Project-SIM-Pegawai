<?php

namespace App\Http\Controllers;

use App\Models\ProfilPegawai;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class ProfilPegawaiController extends Controller
{
    /** save record */
    public function saveRecord(Request $request)
    {
        $request->validate([
            'nip'                   => 'required|string|max:255',
            'nama'                  => 'required|string|max:255',
            'gelar_depan'           => 'required|string|max:255',
            'gelar_belakang'        => 'required|string|max:255',
            'tempat_lahir'          => 'required|string|max:255',
            'tanggal_lahir'         => 'required|string|max:255',
            'jenis_kelamin'         => 'required|string|max:255',
            'agama'                 => 'required|string|max:255',
            'email'                 => 'required|string|max:255',
            'jenis_dokumen'         => 'required|string|max:255',
            'no_dokumen'            => 'required|string|max:255',
            'kelurahan'             => 'required|string|max:255',
            'kecamatan'             => 'required|string|max:255',
            'kota'                  => 'required|string|max:255',
            'provinsi'              => 'required|string|max:255',
            'kode_pos'              => 'required|string|max:255',
            'no_hp'                 => 'required|string|max:255',
            'no_gelar_depanp'       => 'required|string|max:255',
            'jenis_pegawai'         => 'required|string|max:255',
            'kedudukan_pns'         => 'required|string|max:255',
            'status_pegawai'        => 'required|string|max:255',
            'tmt_pns'               => 'required|string|max:255',
            'no_seri_karpeg'        => 'required|string|max:255',
            'tmt_cpns'              => 'required|string|max:255',
            'tingkat_pendidikan'    => 'required|string|max:255',
            'pendidikan_terakhir'   => 'required|string|max:255',
        ]);

        DB::beginTransaction();
        try {

            $profilpegawai = ProfilPegawai::firstOrNew(
                ['user_id' =>  $request->user_id],
            );
            $profilpegawai->user_id             = $request->user_id;
            $profilpegawai->nip                 = $request->nip;
            $profilpegawai->nama                = $request->nama;
            $profilpegawai->gelar_depan         = $request->gelar_depan;
            $profilpegawai->gelar_belakang      = $request->gelar_belakang;
            $profilpegawai->tempat_lahir        = $request->tempat_lahir;
            $profilpegawai->tanggal_lahir       = $request->tanggal_lahir;
            $profilpegawai->jenis_kelamin       = $request->jenis_kelamin;
            $profilpegawai->agama               = $request->agama;
            $profilpegawai->email               = $request->email;
            $profilpegawai->jenis_dokumen       = $request->jenis_dokumen;
            $profilpegawai->no_dokumen          = $request->no_dokumen;
            $profilpegawai->kelurahan           = $request->kelurahan;
            $profilpegawai->kecamatan           = $request->kecamatan;
            $profilpegawai->kota                = $request->kota;
            $profilpegawai->provinsi            = $request->provinsi;
            $profilpegawai->kode_pos            = $request->kode_pos;
            $profilpegawai->no_hp               = $request->no_hp;
            $profilpegawai->no_telp             = $request->no_telp;
            $profilpegawai->jenis_pegawai       = $request->jenis_pegawai;
            $profilpegawai->kedudukan_pns       = $request->kedudukan_pns;
            $profilpegawai->status_pegawai      = $request->status_pegawai;
            $profilpegawai->tmt_pns             = $request->tmt_pns;
            $profilpegawai->no_seri_karpeg      = $request->no_seri_karpeg;
            $profilpegawai->tmt_cpns            = $request->tmt_cpns;
            $profilpegawai->tingkat_pendidikan  = $request->tingkat_pendidikan;
            $profilpegawai->pendidikan_terakhir = $request->pendidikan_terakhir;
            $profilpegawai->save();

            DB::commit();
            Toastr::success('Create profil pegawai successfully :)', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Add profil pegawai fail :)', 'Error');
            return redirect()->back();
        }
    }
}
