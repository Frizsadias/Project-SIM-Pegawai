<?php

namespace App\Http\Controllers;

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

            $dokumen_transkrip = time() . '.' . $request->dokumen_transkrip->extension();
            $request->dokumen_transkrip->move(public_path('assets/DokumenTranskrip'), $dokumen_transkrip);

            $dokumen_ijazah = time() . '.' . $request->dokumen_ijazah->extension();
            $request->dokumen_ijazah->move(public_path('assets/DokumenIjazah'), $dokumen_ijazah);

            $dokumen_gelar = time() . '.' . $request->dokumen_gelar->extension();
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
            Toastr::success('Berhasil membuat data baru :)', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Gagal membuat data baru :)', 'Error');
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
            $transkrip  = $request->file('dokumen_transkrip');
            if ($transkrip != '') {
                unlink('assets/DokumenTranskrip' . $dokumen_transkrip);
                $dokumen_transkrip = time() . '.' . $transkrip->getClientOriginalExtension();
                $transkrip->move(public_path('assets/DokumenTranskrip'), $dokumen_transkrip);
            } else {
                $dokumen_transkrip;
            }

            $dokumen_ijazah = $request->hidden_dokumen_ijazah;
            $ijazah  = $request->file('dokumen_Ijazah');
            if ($ijazah != '') {
                unlink('assets/DokumenIjazah' . $dokumen_ijazah);
                $dokumen_ijazah = time() . '.' . $ijazah->getClientOriginalExtension();
                $ijazah->move(public_path('assets/DokumenIjazah'), $dokumen_ijazah);
            } else {
                $dokumen_ijazah;
            }

            $dokumen_gelar = $request->hidden_dokumen_gelar;
            $gelar  = $request->file('dokumen_gelar');
            if ($gelar != '') {
                unlink('assets/DokumenGelar' . $dokumen_gelar);
                $dokumen_gelar = time() . '.' . $gelar->getClientOriginalExtension();
                $gelar->move(public_path('assets/DokumenGelar'), $dokumen_gelar);
            } else {
                $dokumen_gelar;
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
                'dokumen_transkrip'     => $dokumen_transkrip,
                'dokumen_ijazah'        => $dokumen_ijazah,
                'dokumen_gelar'         => $dokumen_gelar,
            ];

            RiwayatPendidikan::where('id', $request->id)->update($update);
            DB::commit();
            Toastr::success('Berhasil edit data :)', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Gagal edit data :)', 'Error');
            return redirect()->back();
        }
    }

    /** View Riwayat Golongan */
    public function golongan()
    {
        $riwayatGolongan = RiwayatGolongan::all();
        return view('riwayat.riwayat-golongan', compact('riwayatGolongan'));
    }

    /** Tambah Data Riwayat Golongan */
    public function tambahRiwayatGolongan(Request $request)
    {
        $request->validate([
            'golongan'    => 'required|string|max:255',
            'jenis_kenaikan_pangkat'    => 'required|string|max:255|',
            'masa_kerja_golongan_tahun' => 'required|string|max:255|',
            'masa_kerja_golongan_bulan' => 'required|string|max:255|',
            'tmt_golongan'              => 'required|string|max:255|',
            'no_teknis_bkn'             => 'required|string|max:255|',
            'tanggal_teknis_bkn'        => 'required|string|max:255|',
            'no_sk'                     => 'required|string|max:255|',
            'tanggal_sk'                => 'required|string|max:255|',
            'dokumen_skkp'              => 'required|mimes:pdf|max:5120',
            'dokumen_teknis_kp'         => 'required|mimes:pdf|max:5120',
        ]);
        DB::beginTransaction();
        try {

            $dokumen_skkp = time() . '.' . $request->dokumen_skkp->extension();
            $request->dokumen_skkp->move(public_path('assets/DokumenSKKP'), $dokumen_skkp);

            $dokumen_teknis_kp = time() . '.' . $request->dokumen_teknis_kp->extension();
            $request->dokumen_teknis_kp->move(public_path('assets/DokumenTeknisKP'), $dokumen_teknis_kp);

            $riw_diklat = new RiwayatGolongan();
            $riw_diklat->golongan = $request->golongan;
            $riw_diklat->jenis_kenaikan_pangkat         = $request->jenis_kenaikan_pangkat;
            $riw_diklat->masa_kerja_golongan_tahun      = $request->masa_kerja_golongan_tahun;
            $riw_diklat->masa_kerja_golongan_bulan      = $request->masa_kerja_golongan_bulan;
            $riw_diklat->tmt_golongan                   = $request->tmt_golongan;
            $riw_diklat->no_teknis_bkn                  = $request->no_teknis_bkn;
            $riw_diklat->tanggal_teknis_bkn             = $request->tanggal_teknis_bkn;
            $riw_diklat->no_sk                          = $request->no_sk;
            $riw_diklat->tanggal_sk                     = $request->tanggal_sk;
            $riw_diklat->dokumen_skkp                   = $dokumen_skkp;
            $riw_diklat->dokumen_teknis_kp              = $dokumen_teknis_kp;
            $riw_diklat->save();

            DB::commit();
            Toastr::success('Berhasil membuat data baru :)', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Gagal membuat data baru :)', 'Error');
            return redirect()->back();
        }
    }
    /** End Tambah Data Riwayat Golongan */

    /** view riwayat jabatan page */
    public function jabatan()
    {
        $riwayatJabatan = RiwayatJabatan::all();
        return view('riwayat.riwayat-jabatan', compact('riwayatJabatan'));
    }

    /** Tambah Data Riwayat Jabatan */
    public function tambahRiwayatJabatan(Request $request)
    {
        $request->validate([
            'jenis_jabatan'         => 'required|string|max:255',
            'satuan_kerja'          => 'required|string|max:255|',
            'satuan_kerja_induk'    => 'required|string|max:255|',
            'unit_organisasi'       => 'required|string|max:255|',
            'no_sk'                 => 'required|string|max:255|',
            'tanggal_sk'            => 'required|string|max:255|',
            'tmt_jabatan'           => 'required|string|max:255|',
            'tmt_pelantikan'        => 'required|string|max:255|',
            'dokumen_sk_jabatan'    => 'required|mimes:pdf|max:5120',
            'dokumen_pelantikan'    => 'required|mimes:pdf|max:5120',

        ]);
        DB::beginTransaction();
        try {

            $dokumen_sk_jabatan = time() . '.' . $request->dokumen_sk_jabatan->extension();
            $request->dokumen_sk_jabatan->move(public_path('assets/DokumenSKJabatan'), $dokumen_sk_jabatan);

            $dokumen_pelantikan = time() . '.' . $request->dokumen_pelantikan->extension();
            $request->dokumen_pelantikan->move(public_path('assets/DokumenPelantikan'), $dokumen_pelantikan);

            $riw_diklat = new RiwayatJabatan();
            $riw_diklat->jenis_jabatan = $request->jenis_jabatan;
            $riw_diklat->satuan_kerja = $request->satuan_kerja;
            $riw_diklat->satuan_kerja_induk = $request->satuan_kerja_induk;
            $riw_diklat->unit_organisasi = $request->unit_organisasi;
            $riw_diklat->no_sk = $request->no_sk;
            $riw_diklat->tanggal_sk = $request->tanggal_sk;
            $riw_diklat->tmt_jabatan = $request->tmt_jabatan;
            $riw_diklat->tmt_pelantikan = $request->tmt_pelantikan;
            $riw_diklat->dokumen_sk_jabatan = $dokumen_sk_jabatan;
            $riw_diklat->dokumen_pelantikan = $dokumen_pelantikan;
            $riw_diklat->save();

            DB::commit();
            Toastr::success('Berhasil membuat data baru :)', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Gagal membuat data baru :)', 'Error');
            return redirect()->back();
        }
    }
    /** End Tambah Data Riwayat Jabatan */

    /** view riwayat diklat page */
    public function diklat()
    {
        $riwayatDiklat = RiwayatDiklat::all();
        return view('riwayat.riwayat-diklat', compact('riwayatDiklat'));
    }

    /** Tambah Data Riwayat Diklat */
    public function tambahRiwayatDiklat(Request $request)
    {
        $request->validate([
            'jenis_diklat'              => 'required|string|max:255',
            'nama_diklat'               => 'required|string|max:255|',
            'institusi_penyelenggara'   => 'required|string|max:255|',
            'no_sertifikat'             => 'required|string|max:255|',
            'tanggal_mulai'             => 'required|string|max:255|',
            'tanggal_selesai'           => 'required|string|max:255|',
            'tahun_diklat'              => 'required|string|max:255|',
            'durasi_jam'                => 'required|string|max:255|',
            'dokumen_diklat'            => 'required|mimes:pdf|max:5120',

        ]);
        DB::beginTransaction();
        try {

            $dokumen_diklat = time() . '.' . $request->dokumen_diklat->extension();
            $request->dokumen_diklat->move(public_path('assets/DokumenPelantikan'), $dokumen_diklat);

            $riw_diklat = new RiwayatDiklat();
            $riw_diklat->jenis_diklat = $request->jenis_diklat;
            $riw_diklat->nama_diklat = $request->nama_diklat;
            $riw_diklat->institusi_penyelenggara = $request->institusi_penyelenggara;
            $riw_diklat->no_sertifikat = $request->no_sertifikat;
            $riw_diklat->tanggal_mulai = $request->tanggal_mulai;
            $riw_diklat->tanggal_selesai = $request->tanggal_selesai;
            $riw_diklat->tahun_diklat = $request->tahun_diklat;
            $riw_diklat->durasi_jam = $request->durasi_jam;
            $riw_diklat->dokumen_diklat = $dokumen_diklat;
            $riw_diklat->save();

            DB::commit();
            Toastr::success('Berhasil membuat data baru :)', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Gagal membuat data baru :)', 'Error');
            return redirect()->back();
        }
    }
    /** End Tambah Data Riwayat Diklat */
}
