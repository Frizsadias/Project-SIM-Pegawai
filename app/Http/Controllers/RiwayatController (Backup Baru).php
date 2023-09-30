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
        $datapendidikan = Session::get('user_id');
        $riwayatPendidikan = RiwayatPendidikan::where('user_id', $datapendidikan)->get();
        return view('riwayat.riwayat-pendidikan', compact('riwayatPendidikan'));
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
            'gelar_depan'           => 'required|string|max:255',
            'gelar_belakang'        => 'required|string|max:255',
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
            $riw_pend->user_id            = $request->user_id;
            $riw_pend->ting_ped           = $request->ting_ped;
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
                'id'                    => $request->id,
                'ting_ped'              => $request->ting_ped,
                'pendidikan'            => $request->pendidikan,
                'tahun_lulus'           => $request->tahun_lulus,
                'no_ijazah'             => $request->no_ijazah,
                'nama_sekolah'          => $request->nama_sekolah,
                'gelar_depan'           => $request->gelar_depan,
                'gelar_belakang'        => $request->gelar_belakang,
                'jenis_pendidikan'      => $request->jenis_pendidikan,
                'dokumen_transkrip'     => $dokumen_transkrip,
                'dokumen_ijazah'        => $dokumen_ijazah,
                'dokumen_gelar'         => $dokumen_gelar,
            ];

            RiwayatPendidikan::where('id', $request->id)->update($update);
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
        $datagolongan = Session::get('user_id');
        $riwayatGolongan = RiwayatGolongan::where('user_id', $datagolongan)->get();
        return view('riwayat.riwayat-golongan', compact('riwayatGolongan'));
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
            'tanggal_sk'                => 'required|string|max:255',
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
            $riw_golongan->tanggal_sk                 = $request->tanggal_sk;
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
                'id'                        => $request->id,
                'golongan'                  => $request->golongan,
                'jenis_kenaikan_pangkat'    => $request->jenis_kenaikan_pangkat,
                'masa_kerja_golongan_tahun' => $request->masa_kerja_golongan_tahun,
                'masa_kerja_golongan_bulan' => $request->masa_kerja_golongan_bulan,
                'tmt_golongan_riwayat'      => $request->tmt_golongan_riwayat,
                'no_teknis_bkn'             => $request->no_teknis_bkn,
                'tanggal_teknis_bkn'        => $request->tanggal_teknis_bkn,
                'no_sk_golongan'            => $request->no_sk_golongan,
                'tanggal_sk'                => $request->tanggal_sk,
                'dokumen_skkp'              => $dokumen_skkp,
                'dokumen_teknis_kp'         => $dokumen_teknis_kp,
            ];

            RiwayatGolongan::where('id', $request->id)->update($update);
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
        $datajabatan = Session::get('user_id');
        $riwayatJabatan = RiwayatJabatan::where('user_id', $datajabatan)->get();
        return view('riwayat.riwayat-jabatan', compact('riwayatJabatan'));
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
                'id'                    => $request->id,
                'jenis_jabatan_riwayat' => $request->jenis_jabatan_riwayat,
                'satuan_kerja'          => $request->satuan_kerja,
                'satuan_kerja_induk'    => $request->satuan_kerja_induk,
                'unit_organisasi_riwayat'       => $request->unit_organisasi_riwayat,
                'no_sk'                 => $request->no_sk,
                'tanggal_sk'            => $request->tanggal_sk,
                'tmt_jabatan'           => $request->tmt_jabatan,
                'tmt_pelantikan'        => $request->tmt_pelantikan,
                'dokumen_sk_jabatan'    => $dokumen_sk_jabatan,
                'dokumen_pelantikan'    => $dokumen_pelantikan,
            ];

            RiwayatJabatan::where('id', $request->id)->update($update);
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
        $datadiklat = Session::get('user_id');
        $riwayatDiklat = RiwayatDiklat::where('user_id', $datadiklat)->get();
        return view('riwayat.riwayat-diklat', compact('riwayatDiklat'));
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
                'id'                        => $request->id,
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

            RiwayatDiklat::where('id', $request->id)->update($update);
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
}
