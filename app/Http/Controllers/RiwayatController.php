<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\RiwayatDiklat;
use App\Models\RiwayatGolongan;
use App\Models\RiwayatJabatan;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use DB;
use App\Models\RiwayatPendidikan;
use Carbon\Carbon;
use Session;
use App\Models\Notification;
use App\Models\RiwayatAngkaKredit;
use App\Models\RiwayatHukumanDisiplin;
use App\Models\RiwayatOrganisasi;
use App\Models\RiwayatPenghargaan;
use App\Models\RiwayatPMK;
use App\Notifications\UlangTahunNotification;

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

     /** Contoh function tampilan */
     /** $riwayatDiklat = RiwayatDiklat::all(); */
     /** return view('riwayat.riwayat-diklat', compact('riwayatDiklat')); */

    /** --------------------------------- Riwayat Pendidikan --------------------------------- */
    /** Tampilan Riwayat Pendidikan */
    public function pendidikan()
    {

        $user = auth()->user();
        $role = $user->role_name;

        $unreadNotifications = Notification::where('notifiable_id', $user->id)
            ->where('notifiable_type', get_class($user))
            ->whereNull('read_at')
            ->get();

        $readNotifications = Notification::where('notifiable_id', $user->id)
            ->where('notifiable_type', get_class($user))
            ->whereNotNull('read_at')
            ->get();


        $datapendidikan = Session::get('user_id');
        $riwayatPendidikan = RiwayatPendidikan::where('user_id', $datapendidikan)->get();

        $tingkatpendidikanOptions = DB::table('tingkat_pendidikan_id')->pluck('tingkat_pendidikan', 'tingkat_pendidikan');

        return view('riwayat.riwayat-pendidikan', compact('riwayatPendidikan', 'tingkatpendidikanOptions','unreadNotifications', 'readNotifications'));
    }
    /** End Tampilan Riwayat Pendidikan */

    /** Tambah Data Riwayat Pendidikan */
    public function tambahRiwayatPendidikan(Request $request)
    {
        $request->validate([
            'user_id'               => 'required|string|max:255',
            'ting_ped'              => 'required|string|max:255',
            'pendidikan'            => 'required|string|max:255|',
            'tahun_lulus'           => 'required|min:11|numeric',
            'no_ijazah'             => 'required|string|max:255',
            'nama_sekolah'          => 'required|string|max:255',
            'gelar_depan_pend'      => 'required|string|max:255',
            'gelar_belakang_pend'   => 'required|string|max:255',
            'jenis_pendidikan'      => 'required|string|max:255',
            'dokumen_transkrip'     => 'required|mimes:pdf|max:5120',
            'dokumen_ijazah'        => 'required|mimes:pdf|max:5120',
            'dokumen_gelar'         => 'required|mimes:pdf|max:5120',
        ]);
        DB::beginTransaction();
        try {
            $dokumen_transkrip = time() . '.' . $request->dokumen_transkrip->extension();
            $request->dokumen_transkrip->move(public_path('assets/DokumenTranskrip'), $dokumen_transkrip);

            $dokumen_ijazah = time() . '.' . $request->dokumen_ijazah->extension();
            $request->dokumen_ijazah->move(public_path('assets/DokumenIjazah'), $dokumen_ijazah);

            $dokumen_gelar = time() . '.' . $request->dokumen_gelar->extension();
            $request->dokumen_gelar->move(public_path('assets/DokumenGelar'), $dokumen_gelar);

            $riw_pend = new RiwayatPendidikan;
            $riw_pend->user_id              = $request->user_id;
            $riw_pend->ting_ped             = $request->ting_ped;
            $riw_pend->pendidikan           = $request->pendidikan;
            $riw_pend->tahun_lulus          = $request->tahun_lulus;
            $riw_pend->no_ijazah            = $request->no_ijazah;
            $riw_pend->nama_sekolah         = $request->nama_sekolah;
            $riw_pend->gelar_depan_pend     = $request->gelar_depan_pend;
            $riw_pend->gelar_belakang_pend  = $request->gelar_belakang_pend;
            $riw_pend->jenis_pendidikan     = $request->jenis_pendidikan;
            $riw_pend->dokumen_transkrip    = $dokumen_transkrip;
            $riw_pend->dokumen_ijazah       = $dokumen_ijazah;
            $riw_pend->dokumen_gelar        = $dokumen_gelar;
            $riw_pend->save();

            DB::commit();
            Toastr::success('Data riwayat pendidikan telah ditambah :)', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Data riwayat pendidikan gagal ditambah :(', 'Error');
            return redirect()->back();
        }
    }
    /** End Tambah Data Riwayat Pendidikan */

    /** Edit Data Riwayat Pendidikan */
    public function editRiwayatPendidikan(Request $request)
    {
        DB::beginTransaction();
        try {
            $dokumen_transkrip = $request->hidden_dokumen_transkrip;
            $dokumen_transkrips  = $request->file('dokumen_transkrip');
            if ($dokumen_transkrips != '') {
                unlink('assets/DokumenTranskrip/' . $dokumen_transkrip);
                $dokumen_transkrip = time() . '.' . $dokumen_transkrips->getClientOriginalExtension();
                $dokumen_transkrips->move(public_path('assets/DokumenTranskrip'), $dokumen_transkrip);
            } else {
                $dokumen_transkrip;
            }

            $dokumen_ijazah = $request->hidden_dokumen_ijazah;
            $dokumen_ijazahs  = $request->file('dokumen_ijazah');
            if ($dokumen_ijazahs != '') {
                unlink('assets/DokumenIjazah/' . $dokumen_ijazah);
                $dokumen_ijazah = time() . '.' . $dokumen_ijazahs->getClientOriginalExtension();
                $dokumen_ijazahs->move(public_path('assets/DokumenIjazah'), $dokumen_ijazah);
            } else {
                $dokumen_ijazah;
            }

            $dokumen_gelar = $request->hidden_dokumen_gelar;
            $dokumen_gelars  = $request->file('dokumen_gelar');
            if ($dokumen_gelars != '') {
                unlink('assets/DokumenGelar/' . $dokumen_gelar);
                $dokumen_gelar = time() . '.' . $dokumen_gelars->getClientOriginalExtension();
                $dokumen_gelars->move(public_path('assets/DokumenGelar'), $dokumen_gelar);
            } else {
                $dokumen_gelar;
            }

            $update = [
                'id_pend'               => $request->id_pend,
                'ting_ped'              => $request->ting_ped,
                'pendidikan'            => $request->pendidikan,
                'tahun_lulus'           => $request->tahun_lulus,
                'no_ijazah'             => $request->no_ijazah,
                'nama_sekolah'          => $request->nama_sekolah,
                'gelar_depan_pend'      => $request->gelar_depan_pend,
                'gelar_belakang_pend'   => $request->gelar_belakang_pend,
                'jenis_pendidikan'      => $request->jenis_pendidikan,
                'dokumen_transkrip'     => $dokumen_transkrip,
                'dokumen_ijazah'        => $dokumen_ijazah,
                'dokumen_gelar'         => $dokumen_gelar,
            ];

            RiwayatPendidikan::where('id_pend', $request->id_pend)->update($update);
            DB::commit();
            Toastr::success('Data riwayat pendidikan berhasil diperbaharui :)', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Data riwayat pendidikan gagal diperbaharui :(', 'Error');
            return redirect()->back();
        }
    }
    /** End Edit Data Riwayat Pendidikan */

    /** Delete Riwayat Pendidikan */
    public function hapusRiwayatPendidikan(Request $request)
    {
        DB::beginTransaction();
        try {
            RiwayatPendidikan::destroy($request->id);
            DB::commit();
            Toastr::success('Data riwayat pendidikan berhasil dihapus :)', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Data riwayat pendidikan gagal dihapus :(', 'Error');
            return redirect()->back();
        }
    }
    /** End Delete Riwayat Pendidikan */

    /** --------------------------------- Riwayat Golongan --------------------------------- */
    /** Tampilan Riwayat Golongan */
    public function golongan()
    {
        $user = auth()->user();
        $role = $user->role_name;

        $unreadNotifications = Notification::where('notifiable_id', $user->id)
            ->where('notifiable_type', get_class($user))
            ->whereNull('read_at')
            ->get();

        $readNotifications = Notification::where('notifiable_id', $user->id)
            ->where('notifiable_type', get_class($user))
            ->whereNotNull('read_at')
            ->get();
        
        $datagolongan = Session::get('user_id');
        $riwayatGolongan = RiwayatGolongan::where('user_id', $datagolongan)->get();
        return view('riwayat.riwayat-golongan', compact('riwayatGolongan', 'unreadNotifications', 'readNotifications'));
    }
    /** End Tampilan Riwayat Golongan */

    /** Tambah Data Riwayat Golongan */
    public function tambahRiwayatGolongan(Request $request)
    {
        $request->validate([
            'user_id'                   => 'required|string|max:255',
            'golongan'                  => 'required|string|max:255',
            'jenis_kenaikan_pangkat'    => 'required|string|max:255',
            'masa_kerja_golongan_tahun' => 'required|string|max:255',
            'masa_kerja_golongan_bulan' => 'required|string|max:255',
            'tmt_golongan_riwayat'      => 'required|string|max:255',
            'no_teknis_bkn'             => 'required|string|max:255',
            'tanggal_teknis_bkn'        => 'required|string|max:255',
            'no_sk_golongan'            => 'required|string|max:255',
            'tanggal_sk_golongan'       => 'required|string|max:255',
            'dokumen_skkp'              => 'required|mimes:pdf|max:5120',
            'dokumen_teknis_kp'         => 'required|mimes:pdf|max:5120',
        ]);
        DB::beginTransaction();
        try {
            $dokumen_skkp = time() . '.' . $request->dokumen_skkp->extension();
            $request->dokumen_skkp->move(public_path('assets/DokumenSKKP'), $dokumen_skkp);

            $dokumen_teknis_kp = time() . '.' . $request->dokumen_teknis_kp->extension();
            $request->dokumen_teknis_kp->move(public_path('assets/DokumenTeknisKP'), $dokumen_teknis_kp);

            $riw_golongan = new RiwayatGolongan();
            $riw_golongan->user_id                    = $request->user_id;
            $riw_golongan->golongan                   = $request->golongan;
            $riw_golongan->jenis_kenaikan_pangkat     = $request->jenis_kenaikan_pangkat;
            $riw_golongan->masa_kerja_golongan_tahun  = $request->masa_kerja_golongan_tahun;
            $riw_golongan->masa_kerja_golongan_bulan  = $request->masa_kerja_golongan_bulan;
            $riw_golongan->tmt_golongan_riwayat       = $request->tmt_golongan_riwayat;
            $riw_golongan->no_teknis_bkn              = $request->no_teknis_bkn;
            $riw_golongan->tanggal_teknis_bkn         = $request->tanggal_teknis_bkn;
            $riw_golongan->no_sk_golongan             = $request->no_sk_golongan;
            $riw_golongan->tanggal_sk_golongan        = $request->tanggal_sk_golongan;
            $riw_golongan->dokumen_skkp               = $dokumen_skkp;
            $riw_golongan->dokumen_teknis_kp          = $dokumen_teknis_kp;
            $riw_golongan->save();

            DB::commit();
            Toastr::success('Data riwayat golongan telah ditambah :)', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Data riwayat golongan gagal ditambah :(', 'Error');
            return redirect()->back();
        }
    }
    /** End Tambah Data Riwayat Golongan */

    /** Edit Data Riwayat Golongan */
    public function editRiwayatGolongan(Request $request)
    {
        DB::beginTransaction();
        try {
            $dokumen_skkp = $request->hidden_dokumen_skkp;
            $dokumen_skkps  = $request->file('dokumen_skkp');
            if ($dokumen_skkps != '') {
                unlink('assets/DokumenSKKP/' . $dokumen_skkp);
                $dokumen_skkp = time() . '.' . $dokumen_skkps->getClientOriginalExtension();
                $dokumen_skkps->move(public_path('assets/DokumenSKKP'), $dokumen_skkp);
            } else {
                $dokumen_skkp;
            }

            $dokumen_teknis_kp = $request->hidden_dokumen_teknis_kp;
            $dokumen_teknis_kps  = $request->file('dokumen_teknis_kp');
            if ($dokumen_teknis_kps != '') {
                unlink('assets/DokumenTeknisKP/' . $dokumen_teknis_kp);
                $dokumen_teknis_kp = time() . '.' . $dokumen_teknis_kps->getClientOriginalExtension();
                $dokumen_teknis_kps->move(public_path('assets/DokumenTeknisKP'), $dokumen_teknis_kp);
            } else {
                $dokumen_teknis_kp;
            }

            $update = [
                'id_gol'                    => $request->id_gol,
                'golongan'                  => $request->golongan,
                'jenis_kenaikan_pangkat'    => $request->jenis_kenaikan_pangkat,
                'masa_kerja_golongan_tahun' => $request->masa_kerja_golongan_tahun,
                'masa_kerja_golongan_bulan' => $request->masa_kerja_golongan_bulan,
                'tmt_golongan_riwayat'      => $request->tmt_golongan_riwayat,
                'no_teknis_bkn'             => $request->no_teknis_bkn,
                'tanggal_teknis_bkn'        => $request->tanggal_teknis_bkn,
                'no_sk_golongan'            => $request->no_sk_golongan,
                'tanggal_sk_golongan'       => $request->tanggal_sk_golongan,
                'dokumen_skkp'              => $dokumen_skkp,
                'dokumen_teknis_kp'         => $dokumen_teknis_kp,
            ];

            RiwayatGolongan::where('id_gol', $request->id_gol)->update($update);
            DB::commit();
            Toastr::success('Data riwayat golongan berhasil diperbaharui :)', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Data riwayat golongan gagal diperbaharui :(', 'Error');
            return redirect()->back();
        }
    }
    /** End Edit Data Riwayat Golongan */

    /** Delete Riwayat Golongan */
    public function hapusRiwayatGolongan(Request $request)
    {
        DB::beginTransaction();
        try {
            RiwayatGolongan::destroy($request->id);
            DB::commit();
            Toastr::success('Data riwayat golongan berhasil dihapus :)', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Data riwayat golongan gagal dihapus :(', 'Error');
            return redirect()->back();
        }
    }
    /** End Delete Riwayat Golongan */

    /** --------------------------------- Riwayat Jabatan --------------------------------- */
    /** Tampilan riwayat jabatan */
    public function jabatan()
    {
        $user = auth()->user();
        $role = $user->role_name;

        $unreadNotifications = Notification::where('notifiable_id', $user->id)
            ->where('notifiable_type', get_class($user))
            ->whereNull('read_at')
            ->get();

        $readNotifications = Notification::where('notifiable_id', $user->id)
            ->where('notifiable_type', get_class($user))
            ->whereNotNull('read_at')
            ->get();
        
        $datajabatan = Session::get('user_id');
        $riwayatJabatan = RiwayatJabatan::where('user_id', $datajabatan)->get();

        $jenisjabatanOptions = DB::table('jenis_jabatan_id')->pluck('nama', 'nama');
        return view('riwayat.riwayat-jabatan', compact('riwayatJabatan', 'jenisjabatanOptions', 'unreadNotifications', 'readNotifications'));
    }
    /** End Tampilan Riwayat Jabatan */

    /** Tambah Data Riwayat Jabatan */
    public function tambahRiwayatJabatan(Request $request)
    {
        $request->validate([
            'user_id'                   => 'required|string|max:255',
            'jenis_jabatan_riwayat'     => 'required|string|max:255',
            'satuan_kerja'              => 'required|string|max:255',
            'satuan_kerja_induk'        => 'required|string|max:255',
            'unit_organisasi_riwayat'   => 'required|string|max:255',
            'no_sk'                     => 'required|string|max:255',
            'tanggal_sk'                => 'required|string|max:255',
            'tmt_jabatan'               => 'required|string|max:255',
            'tmt_pelantikan'            => 'required|string|max:255',
            'dokumen_sk_jabatan'        => 'required|mimes:pdf|max:5120',
            'dokumen_pelantikan'        => 'required|mimes:pdf|max:5120',
        ]);
        DB::beginTransaction();
        try {
            $dokumen_sk_jabatan = time() . '.' . $request->dokumen_sk_jabatan->extension();
            $request->dokumen_sk_jabatan->move(public_path('assets/DokumenSKJabatan'), $dokumen_sk_jabatan);

            $dokumen_pelantikan = time() . '.' . $request->dokumen_pelantikan->extension();
            $request->dokumen_pelantikan->move(public_path('assets/DokumenPelantikan'), $dokumen_pelantikan);

            $riw_jabatan = new RiwayatJabatan();
            $riw_jabatan->user_id                   = $request->user_id;
            $riw_jabatan->jenis_jabatan_riwayat     = $request->jenis_jabatan_riwayat;
            $riw_jabatan->satuan_kerja              = $request->satuan_kerja;
            $riw_jabatan->satuan_kerja_induk        = $request->satuan_kerja_induk;
            $riw_jabatan->unit_organisasi_riwayat   = $request->unit_organisasi_riwayat;
            $riw_jabatan->no_sk                     = $request->no_sk;
            $riw_jabatan->tanggal_sk                = $request->tanggal_sk;
            $riw_jabatan->tmt_jabatan               = $request->tmt_jabatan;
            $riw_jabatan->tmt_pelantikan            = $request->tmt_pelantikan;
            $riw_jabatan->dokumen_sk_jabatan        = $dokumen_sk_jabatan;
            $riw_jabatan->dokumen_pelantikan        = $dokumen_pelantikan;
            $riw_jabatan->save();

            DB::commit();
            Toastr::success('Data riwayat jabatan telah ditambah :)', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Data riwayat jabatan gagal ditambah :(', 'Error');
            return redirect()->back();
        }
    }
    /** End Tambah Data Riwayat Jabatan */

    /** Edit Data Riwayat Jabatan */
    public function editRiwayatJabatan(Request $request)
    {
        DB::beginTransaction();
        try {
            $dokumen_sk_jabatan = $request->hidden_dokumen_sk_jabatan;
            $dokumen_sk_jabatans  = $request->file('dokumen_sk_jabatan');
            if ($dokumen_sk_jabatans != '') {
                unlink('assets/DokumenSKJabatan/' . $dokumen_sk_jabatan);
                $dokumen_sk_jabatan = time() . '.' . $dokumen_sk_jabatans->getClientOriginalExtension();
                $dokumen_sk_jabatans->move(public_path('assets/DokumenSKJabatan'), $dokumen_sk_jabatan);
            } else {
                $dokumen_sk_jabatan;
            }

            $dokumen_pelantikan = $request->hidden_dokumen_pelantikan;
            $dokumen_pelantikans  = $request->file('dokumen_pelantikan');
            if ($dokumen_pelantikans != '') {
                unlink('assets/DokumenPelantikan/' . $dokumen_pelantikan);
                $dokumen_pelantikan = time() . '.' . $dokumen_pelantikans->getClientOriginalExtension();
                $dokumen_pelantikans->move(public_path('assets/DokumenPelantikan'), $dokumen_pelantikan);
            } else {
                $dokumen_pelantikan;
            }

            $update = [
                'id_jab'                    => $request->id_jab,
                'jenis_jabatan_riwayat'     => $request->jenis_jabatan_riwayat,
                'satuan_kerja'              => $request->satuan_kerja,
                'satuan_kerja_induk'        => $request->satuan_kerja_induk,
                'unit_organisasi_riwayat'   => $request->unit_organisasi_riwayat,
                'no_sk'                     => $request->no_sk,
                'tanggal_sk'                => $request->tanggal_sk,
                'tmt_jabatan'               => $request->tmt_jabatan,
                'tmt_pelantikan'            => $request->tmt_pelantikan,
                'dokumen_sk_jabatan'        => $dokumen_sk_jabatan,
                'dokumen_pelantikan'        => $dokumen_pelantikan,
            ];

            RiwayatJabatan::where('id_jab', $request->id_jab)->update($update);
            DB::commit();
            Toastr::success('Data riwayat jabatan berhasil diperbaharui :)', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Data riwayat jabatan gagal diperbaharui :(', 'Error');
            return redirect()->back();
        }
    }
    /** End Edit Data Riwayat Golongan */

    /** Delete Riwayat Jabatan */
    public function hapusRiwayatJabatan(Request $request)
    {
        DB::beginTransaction();
        try {
            RiwayatJabatan::destroy($request->id);
            DB::commit();
            Toastr::success('Data riwayat jabatan berhasil dihapus :)', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Data riwayat jabatan gagal dihapus :(', 'Error');
            return redirect()->back();
        }
    }
    /** End Delete Riwayat Jabatan */

    /** --------------------------------- Riwayat Diklat --------------------------------- */
    /** Tampilan Riwayat Diklat */
    public function diklat()
    {
        $user = auth()->user();
        $role = $user->role_name;

        $unreadNotifications = Notification::where('notifiable_id', $user->id)
            ->where('notifiable_type', get_class($user))
            ->whereNull('read_at')
            ->get();

        $readNotifications = Notification::where('notifiable_id', $user->id)
            ->where('notifiable_type', get_class($user))
            ->whereNotNull('read_at')
            ->get();
        
        
        $datadiklat = Session::get('user_id');
        $riwayatDiklat = RiwayatDiklat::where('user_id', $datadiklat)->get();

        $jenisdiklatOptions = DB::table('jenis_diklat_id')->pluck('jenis_diklat', 'jenis_diklat');
        return view('riwayat.riwayat-diklat', compact('riwayatDiklat', 'jenisdiklatOptions', 'unreadNotifications', 'readNotifications'));
    }
    /** End Tampilan Riwayat Diklat */

    /** Tambah Data Riwayat Diklat */
    public function tambahRiwayatDiklat(Request $request)
    {
        $request->validate([
            'user_id'                   => 'required|string|max:255',
            'jenis_diklat'              => 'required|string|max:255',
            'nama_diklat'               => 'required|string|max:255',
            'institusi_penyelenggara'   => 'required|string|max:255',
            'no_sertifikat'             => 'required|string|max:255',
            'tanggal_mulai'             => 'required|string|max:255',
            'tanggal_selesai'           => 'required|string|max:255',
            'tahun_diklat'              => 'required|string|max:255',
            'durasi_jam'                => 'required|string|max:255',
            'dokumen_diklat'            => 'required|mimes:pdf|max:5120',
        ]);
        DB::beginTransaction();
        try {
            $dokumen_diklat = time() . '.' . $request->dokumen_diklat->extension();
            $request->dokumen_diklat->move(public_path('assets/DokumenDiklat'), $dokumen_diklat);

            $riw_diklat = new RiwayatDiklat();
            $riw_diklat->user_id                  = $request->user_id;
            $riw_diklat->jenis_diklat             = $request->jenis_diklat;
            $riw_diklat->nama_diklat              = $request->nama_diklat;
            $riw_diklat->institusi_penyelenggara  = $request->institusi_penyelenggara;
            $riw_diklat->no_sertifikat            = $request->no_sertifikat;
            $riw_diklat->tanggal_mulai            = $request->tanggal_mulai;
            $riw_diklat->tanggal_selesai          = $request->tanggal_selesai;
            $riw_diklat->tahun_diklat             = $request->tahun_diklat;
            $riw_diklat->durasi_jam               = $request->durasi_jam;
            $riw_diklat->dokumen_diklat           = $dokumen_diklat;
            $riw_diklat->save();

            DB::commit();
            Toastr::success('Data riwayat diklat telah ditambah :)', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Data riwayat diklat gagal ditambah :(', 'Error');
            return redirect()->back();
        }
    }
    /** End Tambah Data Riwayat Diklat */

    /** Edit Data Riwayat Diklat */
    public function editRiwayatDiklat(Request $request)
    {
        DB::beginTransaction();
        try {
            $dokumen_diklat = $request->hidden_dokumen_diklat;
            $dokumen_diklats  = $request->file('dokumen_diklat');
            if ($dokumen_diklats != '') {
                unlink('assets/DokumenDiklat/' . $dokumen_diklat);
                $dokumen_diklat = time() . '.' . $dokumen_diklats->getClientOriginalExtension();
                $dokumen_diklats->move(public_path('assets/DokumenDiklat'), $dokumen_diklat);
            } else {
                $dokumen_diklat;
            }

            $update = [
                'id_dik'                    => $request->id_dik,
                'jenis_diklat'              => $request->jenis_diklat,
                'nama_diklat'               => $request->nama_diklat,
                'institusi_penyelenggara'   => $request->institusi_penyelenggara,
                'no_sertifikat'             => $request->no_sertifikat,
                'tanggal_mulai'             => $request->tanggal_mulai,
                'tanggal_selesai'           => $request->tanggal_selesai,
                'tahun_diklat'              => $request->tahun_diklat,
                'durasi_jam'                => $request->durasi_jam,
                'dokumen_diklat'            => $dokumen_diklat,
            ];

            RiwayatDiklat::where('id_dik', $request->id_dik)->update($update);
            DB::commit();
            Toastr::success('Data riwayat diklat berhasil diperbaharui :)', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Data riwayat diklat gagal diperbaharui :(', 'Error');
            return redirect()->back();
        }
    }
    /** End Edit Data Riwayat Diklat */

    /** Delete Riwayat Diklat */
    public function hapusRiwayatDiklat(Request $request)
    {
        DB::beginTransaction();
        try {
            RiwayatDiklat::destroy($request->id);
            DB::commit();
            Toastr::success('Data riwayat diklat berhasil dihapus :)', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Data riwayat diklat gagal dihapus :(', 'Error');
            return redirect()->back();
        }
    }
    /** End Delete Riwayat Diklat */

    /** SEARCH RIWAYAT */
    public function searchRiwayatPendidikan(Request $request)
    {
        $ting_ped = $request->input('ting_ped');
        $tahun_lulus = $request->input('tahun_lulus');
        $nama_sekolah = $request->input('nama_sekolah');
        $user_id = auth()->user()->user_id; // mendapatkan id user yang sedang login

        $riwayatPendidikan = DB::table('riwayat_pendidikan')
        ->join('users', 'users.user_id', '=', 'riwayat_pendidikan.user_id')
            ->where('users.user_id', $user_id) // menambahkan kriteria pencarian user_id
            ->where('riwayat_pendidikan.ting_ped', 'like', '%' . $ting_ped . '%')
            ->where('riwayat_pendidikan.tahun_lulus', 'like', '%' . $tahun_lulus . '%')
            ->where('riwayat_pendidikan.nama_sekolah', 'like', '%' . $nama_sekolah . '%')
            ->get();

        $tingkatpendidikanOptions = DB::table('tingkat_pendidikan_id')->pluck('tingkat_pendidikan', 'tingkat_pendidikan');

        $user = auth()->user();
        $role = $user->role_name;
        $unreadNotifications = Notification::where('notifiable_id', $user->id)
            ->where('notifiable_type', get_class($user))
            ->whereNull('read_at')
            ->get();

        $readNotifications = Notification::where('notifiable_id', $user->id)
            ->where('notifiable_type', get_class($user))
            ->whereNotNull('read_at')
            ->get();

        return view('riwayat/riwayat-pendidikan', compact('riwayatPendidikan', 'unreadNotifications', 'readNotifications', 'tingkatpendidikanOptions'));
    }

    //Riwayat Golongan
    public function searchRiwayatGolongan(Request $request)
    {
        $user_id = auth()->user()->user_id; // mendapatkan id user yang sedang login
        $golongan = $request->input('golongan');
        $jenis_kenaikan_pangkat = $request->input('jenis_kenaikan_pangkat');
        $no_sk_golongan = $request->input('no_sk_golongan');

        $riwayatGolongan = DB::table('riwayat_golongan')
        ->join('users', 'users.user_id', '=', 'riwayat_golongan.user_id')
            ->where('users.user_id', $user_id) // menambahkan kriteria pencarian user_id
            ->where('golongan', 'like', '%' . $golongan . '%')
            ->where('jenis_kenaikan_pangkat', 'like', '%' . $jenis_kenaikan_pangkat . '%')
            ->where('no_sk_golongan', 'like', '%' . $no_sk_golongan . '%')
            ->get();

        $user = auth()->user();
        $role = $user->role_name;
        $unreadNotifications = Notification::where('notifiable_id', $user->id)
            ->where('notifiable_type', get_class($user))
            ->whereNull('read_at')
            ->get();

        $readNotifications = Notification::where('notifiable_id', $user->id)
            ->where('notifiable_type', get_class($user))
            ->whereNotNull('read_at')
            ->get();

        return view('riwayat/riwayat-golongan', compact('riwayatGolongan', 'unreadNotifications', 'readNotifications'));
    }

    //Riwayat Jabatan
    public function searchRiwayatJabatan(Request $request)
    {
        $user_id = auth()->user()->user_id; // mendapatkan id user yang sedang login
        $jenis_jabatan_riwayat = $request->input('jenis_jabatan_riwayat');
        $satuan_kerja = $request->input('satuan_kerja');
        $unit_organisasi_riwayat = $request->input('unit_organisasi_riwayat');

        $riwayatJabatan = DB::table('riwayat_jabatan')
        ->join('users', 'users.user_id', '=', 'riwayat_jabatan.user_id')
            ->where('users.user_id', $user_id) // menambahkan kriteria pencarian user_id
            ->where('jenis_jabatan_riwayat', 'like', '%' . $jenis_jabatan_riwayat . '%')
            ->where('satuan_kerja', 'like', '%' . $satuan_kerja . '%')
            ->where('unit_organisasi_riwayat', 'like', '%' . $unit_organisasi_riwayat . '%')
            ->get();

        $jenisjabatanOptions = DB::table('jenis_jabatan_id')->pluck('nama', 'nama');

        $user = auth()->user();
        $role = $user->role_name;

        $unreadNotifications = Notification::where('notifiable_id', $user->id)
            ->where('notifiable_type', get_class($user))
            ->whereNull('read_at')
            ->get();

        $readNotifications = Notification::where('notifiable_id', $user->id)
            ->where('notifiable_type', get_class($user))
            ->whereNotNull('read_at')
            ->get();

        return view('riwayat/riwayat-jabatan', compact('riwayatJabatan', 'jenisjabatanOptions', 'unreadNotifications', 'readNotifications'));
    }

    //Riwayat Diklat
    public function searchRiwayatDiklat(Request $request)
    {
        $user_id = auth()->user()->user_id; // mendapatkan id user yang sedang login
        $jenis_diklat = $request->input('jenis_diklat');
        $nama_diklat = $request->input('nama_diklat');
        $institusi_penyelenggara = $request->input('institusi_penyelenggara');

        $riwayatDiklat = DB::table('riwayat_diklat')
        ->join('users', 'users.user_id', '=', 'riwayat_diklat.user_id')
            ->where('users.user_id', $user_id) // menambahkan kriteria pencarian user_id
            ->where('jenis_diklat', 'like', '%' . $jenis_diklat . '%')
            ->where('nama_diklat', 'like', '%' . $nama_diklat . '%')
            ->where('institusi_penyelenggara', 'like', '%' . $institusi_penyelenggara . '%')
            ->get();

        $jenisdiklatOptions = DB::table('jenis_diklat_id')->pluck('jenis_diklat', 'jenis_diklat');

        $user = auth()->user();
        $role = $user->role_name;

        $unreadNotifications = Notification::where('notifiable_id', $user->id)
            ->where('notifiable_type', get_class($user))
            ->whereNull('read_at')
            ->get();

        $readNotifications = Notification::where('notifiable_id', $user->id)
            ->where('notifiable_type', get_class($user))
            ->whereNotNull('read_at')
            ->get();

        return view('riwayat/riwayat-diklat', compact('riwayatDiklat', 'jenisdiklatOptions', 'unreadNotifications', 'readNotifications'));
    }

    /** --------------------------------- Riwayat PMK --------------------------------- */
    /** Tampilan Riwayat PMK */
    public function pmk()
    {
        $user = auth()->user();
        $role = $user->role_name;

        $unreadNotifications = Notification::where('notifiable_id', $user->id)
            ->where('notifiable_type', get_class($user))
            ->whereNull('read_at')
            ->get();

        $readNotifications = Notification::where('notifiable_id', $user->id)
            ->where('notifiable_type', get_class($user))
            ->whereNotNull('read_at')
            ->get();


        $datapmk = Session::get('user_id');
        $riwayatPMK = RiwayatPMK::where('user_id', $datapmk)->get();

        return view('riwayat.riwayat-pmk', compact('riwayatPMK', 'unreadNotifications', 'readNotifications'));
    }
    /** End Tampilan Riwayat PMK */

    /** Tambah Data Riwayat PMK */
    public function tambahRiwayatPMK(Request $request)
    {
        $request->validate([
            'user_id'          => 'required|string|max:255',
            'jenis_pmk'        => 'required|string|max:255',
            'instansi'         => 'required|string|max:255',
            'tanggal_awal'     => 'required|string|max:255',
            'tanggal_akhir'    => 'required|string|max:255',
            'no_sk'            => 'required|string|max:255',
            'tanggal_sk'       => 'required|string|max:255',
            'no_bkn'           => 'required|string|max:255',
            'tanggal_bkn'      => 'required|string|max:255',
            'masa_tahun'       => 'required|string|max:255',
            'masa_bulan'       => 'required|string|max:255',
            'dokumen_pmk'      => 'required|mimes:pdf|max:5120',
        ]);

        DB::beginTransaction();
        try {
            $dokumen_pmk = time() . '.' . $request->dokumen_pmk->extension();
            $request->dokumen_pmk->move(public_path('assets/DokumenPMK'), $dokumen_pmk);

            $riw_pmk = new RiwayatPMK();
            $riw_pmk->user_id          = $request->user_id;
            $riw_pmk->jenis_pmk        = $request->jenis_pmk;
            $riw_pmk->instansi         = $request->instansi;
            $riw_pmk->tanggal_awal     = $request->tanggal_awal;
            $riw_pmk->tanggal_akhir    = $request->tanggal_akhir;
            $riw_pmk->no_sk            = $request->no_sk;
            $riw_pmk->tanggal_sk       = $request->tanggal_sk;
            $riw_pmk->no_bkn           = $request->no_bkn;
            $riw_pmk->tanggal_bkn      = $request->tanggal_bkn;
            $riw_pmk->masa_tahun       = $request->masa_tahun;
            $riw_pmk->masa_bulan       = $request->masa_bulan;
            $riw_pmk->dokumen_pmk      = $dokumen_pmk;
            $riw_pmk->save();

            DB::commit();
            Toastr::success('Data riwayat PMK telah ditambah :)', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Data riwayat PMK gagal ditambah :(', 'Error');
            return redirect()->back();
        }
    }
    /** End Tambah Data Riwayat PMK */

    /** Edit Data Riwayat PMK */
    public function editRiwayatPMK(Request $request)
    {
        DB::beginTransaction();
        try {
            $dokumen_pmk = $request->hidden_dokumen_pmk;
            $dokumen_pmks  = $request->file('dokumen_pmk');
            if ($dokumen_pmks != '') {
                unlink('assets/DokumenPMK/' . $dokumen_pmk);
                $dokumen_pmk = time() . '.' . $dokumen_pmks->getClientOriginalExtension();
                $dokumen_pmks->move(public_path('assets/DokumenPMK'), $dokumen_pmk);
            } else {
                $dokumen_pmk;
            }

            $update = [
                'id'                        => $request->id,
                'jenis_pmk'                 => $request->jenis_pmk,
                'instansi'                  => $request->instansi,
                'tanggal_awal'              => $request->tanggal_awal,
                'tanggal_akhir'             => $request->tanggal_akhir,
                'no_sk'                     => $request->no_sk,
                'tanggal_sk'                => $request->tanggal_sk,
                'no_bkn'                    => $request->no_bkn,
                'tanggal_bkn'               => $request->tanggal_bkn,
                'masa_tahun'                => $request->masa_tahun,
                'masa_bulan'                => $request->masa_bulan,
                'dokumen_pmk'               => $dokumen_pmk,
            ];

            RiwayatPMK::where('id', $request->id)->update($update);
            DB::commit();
            Toastr::success('Data riwayat PMK berhasil diperbaharui :)', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Data riwayat PMK gagal diperbaharui :(', 'Error');
            return redirect()->back();
        }
    }
    /** End Edit Data Riwayat PMK */

    /** Delete Riwayat PMK */
    public function hapusRiwayatPMK(Request $request)
    {
        DB::beginTransaction();
        try {
            RiwayatPMK::destroy($request->id);
            DB::commit();
            Toastr::success('Data riwayat PMK berhasil dihapus :)', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Data riwayat PMK gagal dihapus :(', 'Error');
            return redirect()->back();
        }
    }
    /** End Delete Riwayat PMK */

    /** Pagination Riwayat PMK */
    public function getPMKData(Request $request)
    {
        $columns = array(
            0 => 'id',
            1 => 'jenis_pmk',
            2 => 'instansi',
            3 => 'tanggal_awal',
            4 => 'tanggal_akhir',
            5 => 'no_sk',
            6 => 'tanggal_sk',
            7 => 'no_bkn',
            8 => 'tanggal_bkn',
            9 => 'masa_tahun',
            10 => 'masa_bulan',
            11 => 'dokumen_pmk',
        );

        $totalData = RiwayatPMK::count();

        $totalFiltered = $totalData;

        $limit = $request->length;
        $start = $request->start;
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        $search = $request->input('search.value');

        if (empty($search)) {
            $jenis_pmk = RiwayatPMK::offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
        } else {
            $jenis_pmk =  RiwayatPMK::where('jenis_pmk', 'like', "%{$search}%")
            ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();

            $totalFiltered = RiwayatPMK::where('jenis_pmk', 'like', "%{$search}%")
            ->count();
        }

        $data = array();
        if (!empty($jenis_pmk)) {
            foreach ($jenis_pmk as $key => $value) {
                $nestedData['id'] = $value->id;
                $nestedData['jenis_pmk'] = $value->jenis_pmk;
                $nestedData['instansi'] = $value->instansi;
                $nestedData['tanggal_awal'] = $value->tanggal_awal;
                $nestedData['tanggal_akhir'] = $value->tanggal_akhir;
                $nestedData['no_sk'] = $value->no_sk;
                $nestedData['tanggal_sk'] = $value->tanggal_sk;
                $nestedData['no_bkn'] = $value->no_bkn;
                $nestedData['tanggal_bkn'] = $value->tanggal_bkn;
                $nestedData['masa_tahun'] = $value->masa_tahun;
                $nestedData['masa_bulan'] = $value->masa_bulan;
                $nestedData['dokumen_pmk'] = $value->dokumen_pmk;
                $nestedData['action'] = "<div class='dropdown dropdown-action'>
                                            <a class='action-icon dropdown-toggle' data-toggle='dropdown' aria-expanded='false'><i class='material-icons'>more_vert</i></a>
                                        <div class='dropdown-menu dropdown-menu-right'>
                                            <a class='dropdown-item edit_riwayat_pmk' href='#' data-toggle='modal' data-target='#edit_riwayat_pmk' data-id='" . $value->id . "' data-jenis_pmk='" . $value->jenis_pmk . "' data-instansi='" . $value->instansi . "' data-tanggal_awal='" . $value->tanggal_awal . "' data-tanggal_akhir='" . $value->tanggal_akhir . "' data-no_sk='" . $value->no_sk . "' data-tanggal_sk='" . $value->tanggal_sk . "' data-no_bkn='" . $value->no_bkn . "' data-tanggal_bkn='" . $value->tanggal_bkn . "' data-masa_tahun='" . $value->masa_tahun . "' data-masa_bulan='" . $value->masa_bulan . "' data-dokumen_pmk='" . $value->dokumen_pmk . "'><i class='fa fa-pencil m-r-5'></i> Edit</a>
                                            <a class='dropdown-item delete_riwayat_pmk' data-toggle='modal' data-target='#delete_riwayat_pmk' data-id='" . $value->id . "' href='#'><i class='fa fa-trash-o m-r-5'></i> Delete</a>
                                        </div>
                                     </div>";
                $data[] = $nestedData;
            }
        }

        $json_data = array(
            "draw"            => intval($request->input('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );

        return response()->json($json_data);
    }

    /** --------------------------------- Riwayat Angka Kredit --------------------------------- */
    /** Tampilan Riwayat Angka Kredit */
    public function angkakredit()
    {
        $user = auth()->user();
        $role = $user->role_name;

        $unreadNotifications = Notification::where('notifiable_id', $user->id)
            ->where('notifiable_type', get_class($user))
            ->whereNull('read_at')
            ->get();

        $readNotifications = Notification::where('notifiable_id', $user->id)
            ->where('notifiable_type', get_class($user))
            ->whereNotNull('read_at')
            ->get();


        $dataAK = Session::get('user_id');
        $riwayatAK = RiwayatAngkaKredit::where('user_id', $dataAK)->get();
        $jenisjabatanOptions = DB::table('jenis_jabatan_id')->pluck('nama', 'nama');

        return view('riwayat.riwayat-angka-kredit', compact('riwayatAK', 'jenisjabatanOptions', 'unreadNotifications', 'readNotifications'));
    }
    /** End Tampilan Riwayat Angka Kredit */

    /** Tambah Data Riwayat Angka Kredit */
    public function tambahRiwayatAngkaKredit(Request $request)
    {
        $request->validate([
            'user_id'                   => 'required|string|max:255',
            'nama_jabatan'              => 'required|string|max:255',
            'nomor_sk'                  => 'required|string|max:255',
            'tanggal_sk'                => 'required|date|max:255',
            'angka_kredit_pertama'      => 'nullable|string|max:255',
            'integrasi'                 => 'nullable|string|max:255',
            'konversi'                  => 'nullable|string|max:255',
            'bulan_mulai'               => 'required|string|max:255',
            'tahun_mulai'               => 'required|string|max:255',
            'bulan_selesai'             => 'required|string|max:255',
            'tahun_selesai'             => 'required|string|max:255',
            'angka_kredit_utama'        => 'nullable|string|max:255',
            'angka_kredit_penunjang'    => 'nullable|string|max:255',
            'total_angka_kredit'        => 'required|string|max:255',
        ]);

        DB::beginTransaction();
        try {
            $riw_ak = new RiwayatAngkaKredit();
            $riw_ak->user_id                = $request->user_id;
            $riw_ak->nama_jabatan           = $request->nama_jabatan;
            $riw_ak->nomor_sk               = $request->nomor_sk;
            $riw_ak->tanggal_sk             = $request->tanggal_sk;
            $riw_ak->angka_kredit_pertama   = $request->angka_kredit_pertama;
            $riw_ak->integrasi              = $request->integrasi;
            $riw_ak->konversi               = $request->konversi;
            $riw_ak->bulan_mulai            = $request->bulan_mulai;
            $riw_ak->tahun_mulai            = $request->tahun_mulai;
            $riw_ak->bulan_selesai          = $request->bulan_selesai;
            $riw_ak->tahun_selesai          = $request->tahun_selesai;
            $riw_ak->angka_kredit_utama     = $request->angka_kredit_utama;
            $riw_ak->angka_kredit_penunjang = $request->angka_kredit_penunjang;
            $riw_ak->total_angka_kredit     = $request->total_angka_kredit;
            $riw_ak->save();

            DB::commit();
            Toastr::success('Data riwayat Angka Kredit telah ditambah :)', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Data riwayat Angka Kredit gagal ditambah :(', 'Error');
            return redirect()->back();
        }
    }
    /** End Tambah Data Riwayat Angka Kredit */

    /** Edit Data Riwayat Angka Kredit */
    public function editRiwayatAngkaKredit(Request $request)
    {
        DB::beginTransaction();
        try {
            $update = [
                'id'                    => $request->id,
                'nama_jabatan'          => $request->nama_jabatan,
                'nomor_sk'              => $request->nomor_sk,
                'tanggal_sk'            => $request->tanggal_sk,
                'angka_kredit_pertama'  => $request->angka_kredit_pertama,
                'integrasi'             => $request->integrasi,
                'konversi'              => $request->konversi,
                'bulan_mulai'           => $request->bulan_mulai,
                'tahun_mulai'           => $request->tahun_mulai,
                'bulan_selesai'         => $request->bulan_selesai,
                'tahun_selesai'         => $request->tahun_selesai,
                'angka_kredit_utama'    => $request->angka_kredit_utama,
                'angka_kredit_penunjang'=> $request->angka_kredit_penunjang,
                'total_angka_kredit'    => $request->total_angka_kredit,
            ];

            RiwayatAngkaKredit::where('id', $request->id)->update($update);
            DB::commit();
            Toastr::success('Data riwayat Angka Kredit berhasil diperbaharui :)', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Data riwayat Angka Kredit gagal diperbaharui :(', 'Error');
            return redirect()->back();
        }
    }
    /** End Edit Data Riwayat Angka Kredit */

    /** Delete Riwayat Angka Kredit */
    public function hapusRiwayatAngkaKredit(Request $request)
    {
        DB::beginTransaction();
        try {
            RiwayatAngkaKredit::destroy($request->id);
            DB::commit();
            Toastr::success('Data riwayat Angka Kredit berhasil dihapus :)', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Data riwayat Angka Kredit gagal dihapus :(', 'Error');
            return redirect()->back();
        }
    }
    /** End Delete Riwayat Angka Kredit */

    /** Pagination Riwayat Angka Kredit */
    // public function getAngkaKreditData(Request $request)
    // {
    //     $columns = array(
    //         0 => 'id',
    //         1 => 'nama_jabatan',
    //         2 => 'nomor_sk',
    //         3 => 'tanggal_sk',
    //         4 => 'angka_kredit_pertama',
    //         5 => 'integrasi',
    //         6 => 'konversi',
    //         7 => 'bulan_mulai',
    //         8 => 'tahun_mulai',
    //         9 => 'bulan_selesai',
    //         10 => 'tahun_selesai',
    //         11 => 'angka_kredit_utama',
    //         12 => 'angka_kredit_penunjang',
    //         13 => 'total_angka_kredit'
    //     );

    //     $totalData = RiwayatAngkaKredit::count();

    //     $totalFiltered = $totalData;

    //     $limit = $request->length;
    //     $start = $request->start;
    //     $order = $columns[$request->input('order.0.column')];
    //     $dir = $request->input('order.0.dir');

    //     $search = $request->input('search.value');

    //     if (empty($search)) {
    //         $jenis_ak = RiwayatAngkaKredit::offset($start)
    //             ->limit($limit)
    //             ->orderBy($order, $dir)
    //             ->get();
    //     } else {
    //         $jenis_ak =  RiwayatAngkaKredit::where('nama_jabatan', 'like', "%{$search}%")
    //         ->offset($start)
    //             ->limit($limit)
    //             ->orderBy($order, $dir)
    //             ->get();

    //         $totalFiltered = RiwayatAngkaKredit::where('nama_jabatan', 'like', "%{$search}%")
    //         ->count();
    //     }

    //     $data = array();
    //     if (!empty($jenis_ak)) {
    //         foreach ($jenis_ak as $key => $value) {
    //             $nestedData['id'] = $value->id;
    //             $nestedData['nama_jabatan'] = $value->nama_jabatan;
    //             $nestedData['nomor_sk'] = $value->nomor_sk;
    //             $nestedData['tanggal_sk'] = date('d/m/Y', strtotime($value->tanggal_sk));
    //             $nestedData['angka_kredit_pertama'] = $value->angka_kredit_pertama;
    //             $nestedData['integrasi'] = $value->integrasi;
    //             $nestedData['konversi'] = $value->konversi;
    //             $nestedData['bulan_mulai'] = $value->bulan_mulai;
    //             $nestedData['tahun_mulai'] = $value->tahun_mulai;
    //             $nestedData['bulan_selesai'] = $value->bulan_selesai;
    //             $nestedData['tahun_selesai'] = $value->tahun_selesai;
    //             $nestedData['angka_kredit_utama'] = $value->angka_kredit_utama;
    //             $nestedData['angka_kredit_penunjang'] = $value->angka_kredit_penunjang;
    //             $nestedData['total_angka_kredit'] = $value->total_angka_kredit;
    //             $nestedData['action'] = "<div class='dropdown dropdown-action'>
    //                                         <a class='action-icon dropdown-toggle' data-toggle='dropdown' aria-expanded='false'><i class='material-icons'>more_vert</i></a>
    //                                     <div class='dropdown-menu dropdown-menu-right'>
    //                                         <a class='dropdown-item edit_riwayat_angka_kredit' href='#' data-toggle='modal' data-target='#edit_riwayat_angka_kredit' data-id='" . $value->id . "' data-nama_jabatan='" . $value->nama_jabatan . "' data-nomor_sk='" . $value->nomor_sk . "' data-tanggal_sk='" . $value->tanggal_sk . "' data-angka_kredit_pertama='" . $value->angka_kredit_pertama . "' data-integrasi='" . $value->integrasi . "' data-konversi='" . $value->konversi . "' data-bulan_mulai='" . $value->bulan_mulai . "' data-tahun_mulai='" . $value->tahun_mulai . "' data-bulan_selesai='" . $value->bulan_selesai . "' data-tahun_selesai='" . $value->tahun_selesai . "' data-angka_kredit_utama='" . $value->angka_kredit_utama . "'' data-angka_kredit_penunjang='" . $value->angka_kredit_penunjang . "'' data-total_angka_kredit='" . $value->total_angka_kredit . "'><i class='fa fa-pencil m-r-5'></i> Edit</a>
    //                                         <a class='dropdown-item delete_riwayat_angka_kredit' data-toggle='modal' data-target='#delete_riwayat_angka_kredit' data-id='" . $value->id . "' href='#'><i class='fa fa-trash-o m-r-5'></i> Delete</a>
    //                                     </div>
    //                                  </div>";
    //             $data[] = $nestedData;
    //         }
    //     }

    //     $json_data = array(
    //         "draw"            => intval($request->input('draw')),
    //         "recordsTotal"    => intval($totalData),
    //         "recordsFiltered" => intval($totalFiltered),
    //         "data"            => $data
    //     );

    //     return response()->json($json_data);
    // }

    /** --------------------------------- Riwayat Hukuman Disiplin --------------------------------- */
    /** Tampilan Riwayat Hukuman Disiplin */
    public function hukumandisiplin()
    {
        $user = auth()->user();
        $role = $user->role_name;

        $unreadNotifications = Notification::where('notifiable_id', $user->id)
            ->where('notifiable_type', get_class($user))
            ->whereNull('read_at')
            ->get();

        $readNotifications = Notification::where('notifiable_id', $user->id)
            ->where('notifiable_type', get_class($user))
            ->whereNotNull('read_at')
            ->get();


        $dataHD = Session::get('user_id');
        $riwayatHD = RiwayatHukumanDisiplin::where('user_id', $dataHD)->get();

        return view('riwayat.riwayat-hukuman-disiplin', compact('riwayatHD', 'unreadNotifications', 'readNotifications'));
    }
    /** End Tampilan Riwayat Hukuman Disiplin */

    /** Tambah Data Riwayat Hukuman Disiplin */
    public function tambahRiwayatHukumanDisiplin(Request $request)
    {
        $request->validate([
            'user_id'                   => 'required|string|max:255',
            'kategori_hukuman'          => 'required|string|max:255',
            'tingkat_hukuman'           => 'required|string|max:255',
            'jenis_hukuman'             => 'required|string|max:255',
            'no_sk_hukuman'             => 'required|string|max:255',
            'no_peraturan'              => 'required|string|max:255',
            'alasan'                    => 'required|string|max:255',
            'tanggal_sk_hukuman'        => 'required|string|max:255',
            'masa_hukuman_tahun'        => 'required|string|max:255',
            'tmt_hukuman'               => 'required|string|max:255',
            'masa_hukuman_bulan'        => 'required|string|max:255',
            'keterangan'                => 'required|string|max:255',
            'dokumen_sk_hukuman'        => 'required|mimes:pdf|max:5120',
            'dokumen_sk_pengaktifan'    => 'required|mimes:pdf|max:5120',
        ]);

        DB::beginTransaction();

        try {
            $dokumen_sk_hukuman = time() . '.' . $request->dokumen_sk_hukuman->extension();
            $request->dokumen_sk_hukuman->move(public_path('assets/DokumenSKHukuman'), $dokumen_sk_hukuman);

            $dokumen_sk_pengaktifan = time() . '.' . $request->dokumen_sk_pengaktifan->extension();
            $request->dokumen_sk_pengaktifan->move(public_path('assets/DokumenSKPengaktifan'), $dokumen_sk_pengaktifan);
            
            $riwayatHukuman = new RiwayatHukumanDisiplin;
            $riwayatHukuman->user_id = $request->user_id;
            $riwayatHukuman->kategori_hukuman = $request->kategori_hukuman;
            $riwayatHukuman->tingkat_hukuman = $request->tingkat_hukuman;
            $riwayatHukuman->jenis_hukuman = $request->jenis_hukuman;
            $riwayatHukuman->no_sk_hukuman = $request->no_sk_hukuman;
            $riwayatHukuman->no_peraturan = $request->no_peraturan;
            $riwayatHukuman->alasan = $request->alasan;
            $riwayatHukuman->tanggal_sk_hukuman = $request->tanggal_sk_hukuman;
            $riwayatHukuman->masa_hukuman_tahun = $request->masa_hukuman_tahun;
            $riwayatHukuman->tmt_hukuman = $request->tmt_hukuman;
            $riwayatHukuman->masa_hukuman_bulan = $request->masa_hukuman_bulan;
            $riwayatHukuman->keterangan = $request->keterangan;
            $riwayatHukuman->dokumen_sk_hukuman = $dokumen_sk_hukuman;
            $riwayatHukuman->dokumen_sk_pengaktifan = $dokumen_sk_pengaktifan;

            $riwayatHukuman->save();

            DB::commit();

            Toastr::success('Data riwayat Hukuman Disiplin telah ditambah :)', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollBack();

            Toastr::error('Data riwayat Hukuman Disiplin gagal ditambah :(', 'Error');
            return redirect()->back();
        }
    }
    /** End Tambah Data Riwayat Hukuman Disiplin */

    /** Edit Data Riwayat Hukuman Disiplin */
    public function editRiwayatHukumanDisiplin(Request $request)
    {
        DB::beginTransaction();

        try {
            $dokumen_sk_hukuman = $request->hidden_dokumen_sk_hukuman;
            $dokumen_sk_hukumans  = $request->file('dokumen_sk_hukuman');
            if ($dokumen_sk_hukumans != '') {
                unlink('assets/DokumenSKHukuman/' . $dokumen_sk_hukuman);
                $dokumen_sk_hukuman = time() . '.' . $dokumen_sk_hukumans->getClientOriginalExtension();
                $dokumen_sk_hukumans->move(public_path('assets/DokumenSKHukuman'), $dokumen_sk_hukuman);
            } else {
                $dokumen_sk_hukuman;
            }

            $dokumen_sk_pengaktifan = $request->hidden_dokumen_sk_pengaktifan;
            $dokumen_sk_pengaktifans  = $request->file('dokumen_sk_pengaktifan');
            if ($dokumen_sk_pengaktifans != '') {
                unlink('assets/DokumenSKPengaktifan/' . $dokumen_sk_pengaktifan);
                $dokumen_sk_pengaktifan = time() . '.' . $dokumen_sk_pengaktifans->getClientOriginalExtension();
                $dokumen_sk_pengaktifans->move(public_path('assets/DokumenSKPengaktifan'), $dokumen_sk_pengaktifan);
            } else {
                $dokumen_sk_pengaktifan;
            }

            $update = [
                'id'                        => $request->id,
                'kategori_hukuman'          => $request->kategori_hukuman,
                'tingkat_hukuman'           => $request->tingkat_hukuman,
                'jenis_hukuman'             => $request->jenis_hukuman,
                'no_sk_hukuman'             => $request->no_sk_hukuman,
                'no_peraturan'              => $request->no_peraturan,
                'alasan'                    => $request->alasan,
                'tanggal_sk_hukuman'        => $request->tanggal_sk_hukuman,
                'masa_hukuman_tahun'        => $request->masa_hukuman_tahun,
                'tmt_hukuman'               => $request->tmt_hukuman,
                'masa_hukuman_bulan'        => $request->masa_hukuman_bulan,
                'keterangan'                => $request->keterangan,
                'dokumen_sk_hukuman'        => $dokumen_sk_hukuman,
                'dokumen_sk_pengaktifan'    => $dokumen_sk_pengaktifan,
            ];

            RiwayatHukumanDisiplin::where('id', $request->id)->update($update);

            DB::commit();

            Toastr::success('Data riwayat Hukuman Disiplin berhasil diperbaharui :)', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();

            Toastr::error('Data riwayat Hukuman Disiplin gagal diperbaharui :(', 'Error');
            return redirect()->back();
        }
    }
    /** End Edit Data Riwayat Hukuman Disiplin */

    /** Delete Riwayat Hukuman Disiplin */
    public function hapusRiwayatHukumanDisiplin(Request $request)
    {
        DB::beginTransaction();
        try {
            RiwayatHukumanDisiplin::destroy($request->id);
            DB::commit();
            Toastr::success('Data riwayat Hukuman Disiplin berhasil dihapus :)', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Data riwayat Hukuman Disiplin gagal dihapus :(', 'Error');
            return redirect()->back();
        }
    }
    /** End Delete Riwayat Hukuman Disiplin */

    /** --------------------------------- Riwayat Penghargaan --------------------------------- */
    /** Tampilan Riwayat Penghargaan */
    public function penghargaan()
    {
        $user = auth()->user();
        $role = $user->role_name;

        $unreadNotifications = Notification::where('notifiable_id', $user->id)
            ->where('notifiable_type', get_class($user))
            ->whereNull('read_at')
            ->get();

        $readNotifications = Notification::where('notifiable_id', $user->id)
            ->where('notifiable_type', get_class($user))
            ->whereNotNull('read_at')
            ->get();


        $dataPenghargaan = Session::get('user_id');
        $riwayatPenghargaan = RiwayatPenghargaan::where('user_id', $dataPenghargaan)->get();

        return view('riwayat.riwayat-penghargaan', compact('riwayatPenghargaan', 'unreadNotifications', 'readNotifications'));
    }
    /** End Tampilan Riwayat Penghargaan */

    /** Tambah Data Riwayat Penghargaan */
    public function tambahRiwayatPenghargaan(Request $request)
    {
        $request->validate([
            'user_id'                   => 'required|string|max:255',
            'jenis_penghargaan'         => 'required|string|max:255',
            'tahun_perolehan'           => 'required|string|max:255',
            'no_surat'                  => 'required|string|max:255',
            'tanggal_keputusan'         => 'required|string|max:255',
            'dokumen_penghargaan'       => 'required|mimes:pdf|max:5120',
        ]);

        DB::beginTransaction();

        try {
            $dokumen_penghargaan = time() . '.' . $request->dokumen_penghargaan->extension();
            $request->dokumen_penghargaan->move(public_path('assets/DokumenPenghargaan'), $dokumen_penghargaan);

            $riwayatPenghargaan = new RiwayatPenghargaan();
            $riwayatPenghargaan->user_id = $request->user_id;
            $riwayatPenghargaan->jenis_penghargaan = $request->jenis_penghargaan;
            $riwayatPenghargaan->tahun_perolehan = $request->tahun_perolehan;
            $riwayatPenghargaan->no_surat = $request->no_surat;
            $riwayatPenghargaan->tanggal_keputusan = $request->tanggal_keputusan;
            $riwayatPenghargaan->dokumen_penghargaan = $dokumen_penghargaan;
            $riwayatPenghargaan->save();

            DB::commit();

            Toastr::success('Data riwayat Penghargaan telah ditambah :)', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollBack();

            Toastr::error('Data riwayat Penghargaan gagal ditambah :(', 'Error');
            return redirect()->back();
        }
    }
    /** End Tambah Data Riwayat Penghargaan */

    /** Edit Data Riwayat Penghargaan */
    public function editRiwayatPenghargaan(Request $request)
    {
        DB::beginTransaction();

        try {
            $dokumen_penghargaan = $request->hidden_dokumen_penghargaan;
            $dokumen_penghargaans  = $request->file('dokumen_penghargaan');
            if ($dokumen_penghargaans != '') {
                unlink('assets/DokumenPenghargaan/' . $dokumen_penghargaan);
                $dokumen_penghargaan = time() . '.' . $dokumen_penghargaans->getClientOriginalExtension();
                $dokumen_penghargaans->move(public_path('assets/DokumenPenghargaan'), $dokumen_penghargaan);
            } else {
                $dokumen_penghargaan;
            }

            $update = [
                'id'                        => $request->id,
                'jenis_penghargaan'         => $request->jenis_penghargaan,
                'tahun_perolehan'           => $request->tahun_perolehan,
                'no_surat'                  => $request->no_surat,
                'tanggal_keputusan'         => $request->tanggal_keputusan,
                'dokumen_penghargaan'       => $dokumen_penghargaan,
            ];

            RiwayatPenghargaan::where('id', $request->id)->update($update);

            DB::commit();

            Toastr::success('Data riwayat Penghargaan berhasil diperbaharui :)', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();

            Toastr::error('Data riwayat Penghargaan gagal diperbaharui :(', 'Error');
            return redirect()->back();
        }
    }
    /** End Edit Data Riwayat Penghargaan */

    /** Delete Riwayat Penghargaan */
    public function hapusRiwayatPenghargaan(Request $request)
    {
        DB::beginTransaction();
        try {
            RiwayatPenghargaan::destroy($request->id);
            DB::commit();
            Toastr::success('Data riwayat Penghargaan berhasil dihapus :)', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Data riwayat Penghargaan gagal dihapus :(', 'Error');
            return redirect()->back();
        }
    }

    /** --------------------------------- Riwayat Hukuman Organisasi --------------------------------- */
    /** Tampilan Riwayat Organisasi */
    public function organisasi()
    {
        $user = auth()->user();
        $role = $user->role_name;

        $unreadNotifications = Notification::where('notifiable_id', $user->id)
            ->where('notifiable_type', get_class($user))
            ->whereNull('read_at')
            ->get();

        $readNotifications = Notification::where('notifiable_id', $user->id)
            ->where('notifiable_type', get_class($user))
            ->whereNotNull('read_at')
            ->get();


        $dataOrganisasi = Session::get('user_id');
        $riwayatOrganisasi = RiwayatOrganisasi::where('user_id', $dataOrganisasi)->get();

        return view('riwayat.riwayat-organisasi', compact('riwayatOrganisasi', 'unreadNotifications', 'readNotifications'));
    }
    /** End Tampilan Riwayat Organisasi */

    /** Tambah Data Riwayat Organisasi */
    public function tambahRiwayatOrganisasi(Request $request)
    {
        $request->validate([
            'user_id'                   => 'required|string|max:255',
            'nama_organisasi'           => 'required|string|max:255',
            'jabatan_organisasi'        => 'required|string|max:255',
            'tanggal_gabung'            => 'required|string|max:255',
            'tanggal_selesai'           => 'required|string|max:255',
            'no_anggota'                => 'required|string|max:255',
            'dokumen_organisasi'        => 'required|mimes:pdf|max:5120',
        ]);

        DB::beginTransaction();

        try {
            $dokumen_organisasi = time() . '.' . $request->dokumen_organisasi->extension();
            $request->dokumen_organisasi->move(public_path('assets/DokumenOrganisasi'), $dokumen_organisasi);

            $riwayatOrganisasi = new RiwayatOrganisasi();
            $riwayatOrganisasi->user_id = $request->user_id;
            $riwayatOrganisasi->nama_organisasi = $request->nama_organisasi;
            $riwayatOrganisasi->jabatan_organisasi = $request->jabatan_organisasi;
            $riwayatOrganisasi->tanggal_gabung = $request->tanggal_gabung;
            $riwayatOrganisasi->tanggal_selesai = $request->tanggal_selesai;
            $riwayatOrganisasi->no_anggota = $request->no_anggota;
            $riwayatOrganisasi->dokumen_organisasi = $dokumen_organisasi;
            $riwayatOrganisasi->save();

            DB::commit();

            Toastr::success('Data riwayat Organisasi telah ditambah :)', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollBack();

            Toastr::error('Data riwayat Organisasi gagal ditambah :(', 'Error');
            return redirect()->back();
        }
    }
    /** End Tambah Data Riwayat Organisasi */

    /** Edit Data Riwayat Organisasi */
    public function editRiwayatOrganisasi(Request $request)
    {
        DB::beginTransaction();

        try {
            $dokumen_organisasi = $request->hidden_dokumen_organisasi;
            $dokumen_organisasis  = $request->file('dokumen_organisasi');
            if ($dokumen_organisasis != '') {
                unlink('assets/DokumenOrganisasi/' . $dokumen_organisasi);
                $dokumen_organisasi = time() . '.' . $dokumen_organisasis->getClientOriginalExtension();
                $dokumen_organisasis->move(public_path('assets/DokumenOrganisasi'), $dokumen_organisasi);
            } else {
                $dokumen_organisasi;
            }

            $update = [
                'id'                        => $request->id,
                'nama_organisasi'           => $request->nama_organisasi,
                'jabatan_organisasi'        => $request->jabatan_organisasi,
                'tanggal_gabung'            => $request->tanggal_gabung,
                'tanggal_selesai'           => $request->tanggal_selesai,
                'no_anggota'                => $request->no_anggota,
                'dokumen_organisasi'        => $dokumen_organisasi,
            ];

            RiwayatOrganisasi::where('id', $request->id)->update($update);

            DB::commit();

            Toastr::success('Data riwayat Organisasi berhasil diperbaharui :)', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();

            Toastr::error('Data riwayat Organisasi gagal diperbaharui :(', 'Error');
            return redirect()->back();
        }
    }
    /** End Edit Data Riwayat Organisasi */

    /** Delete Riwayat Organisasi */
    public function hapusRiwayatOrganisasi(Request $request)
    {
        DB::beginTransaction();
        try {
            RiwayatOrganisasi::destroy($request->id);
            DB::commit();
            Toastr::success('Data riwayat Organisasi berhasil dihapus :)', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Data riwayat Organisasi gagal dihapus :(', 'Error');
            return redirect()->back();
        }
    }

}
