<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProfilPegawai;
use Brian2694\Toastr\Facades\Toastr;
use DB;

class ProfilePegawaiController extends Controller
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
            'jenis_dokumen'         => 'required|string|max:255',
            'no_dokumen'            => 'required|string|max:255',
            'kelurahan'             => 'required|string|max:255',
            'kecamatan'             => 'required|string|max:255',
            'kota'                  => 'required|string|max:255',
            'provinsi'              => 'required|string|max:255',
            'kode_pos'              => 'required|string|max:255',
            'no_hp'                 => 'required|string|max:255',
            'no_telp'               => 'required|string|max:255',
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
            
            $user_information = ProfilPegawai::firstOrNew(
                ['user_id' =>  $request->user_id],
            );
            $user_information->user_id              = $request->user_id;
            $user_information->nip                  = $request->nip;
            $user_information->nama                 = $request->nama;
            $user_information->gelar_depan          = $request->gelar_depan;
            $user_information->gelar_belakang       = $request->gelar_belakang;
            $user_information->tempat_lahir         = $request->tempat_lahir;
            $user_information->tanggal_lahir        = $request->tanggal_lahir;
            $user_information->jenis_kelamin        = $request->jenis_kelamin;
            $user_information->agama                = $request->agama;
            $user_information->jenis_dokumen        = $request->jenis_dokumen;
            $user_information->no_dokumen           = $request->no_dokumen;
            $user_information->kelurahan            = $request->kelurahan;
            $user_information->kecamatan            = $request->kecamatan;
            $user_information->kota                 = $request->kota;
            $user_information->provinsi             = $request->provinsi;
            $user_information->kode_pos             = $request->kode_pos;
            $user_information->no_hp                = $request->no_hp;
            $user_information->no_telp              = $request->no_telp;
            $user_information->jenis_pegawai        = $request->jenis_pegawai;
            $user_information->kedudukan_pns        = $request->kedudukan_pns;
            $user_information->status_pegawai       = $request->status_pegawai;
            $user_information->tmt_pns              = $request->tmt_pns;
            $user_information->no_seri_karpeg       = $request->no_seri_karpeg;
            $user_information->tmt_cpns             = $request->tmt_cpns;
            $user_information->tingkat_pendidikan   = $request->tingkat_pendidikan;
            $user_information->pendidikan_terakhir  = $request->pendidikan_terakhir;
            $user_information->save();

            DB::commit();
            Toastr::success('Data profil pegawai telah ditambah :)','Success');
            return redirect()->back();
        } catch(\Exception $e) {
            DB::rollback();
            Toastr::error('Data profil pegawai gagal ditambah :)','Error');
            return redirect()->back();
        }
    }
}
