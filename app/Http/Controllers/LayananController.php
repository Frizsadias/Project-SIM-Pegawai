<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\LayananCuti;
use App\Models\Notification;
use App\Models\PosisiJabatan;
use App\Models\KenaikanGajiBerkala;
use Barryvdh\DomPDF\Facade\PDF;
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

    /** Daftar Layanan Cuti User */
    public function tampilanCutiPegawai()
    {
        $user_id = auth()->user()->user_id;
        $data_cuti = DB::table('cuti')
            ->select(
                'cuti.*',
                'cuti.user_id',
                'cuti.name',
                'cuti.nip',
                'cuti.jenis_cuti',
                'cuti.lama_cuti',
                'cuti.tanggal_mulai_cuti',
                'cuti.tanggal_selesai_cuti',
                'cuti.dokumen_kelengkapan',
                'cuti.status_pengajuan'
            )
            ->where('cuti.user_id', $user_id)
            ->get();

        $data_profilcuti = DB::table('profil_pegawai')
            ->select('profil_pegawai.*', 'profil_pegawai.name', 'profil_pegawai.nip')
            ->where('profil_pegawai.user_id', $user_id)
            ->get();

        $data_cuti_pdf = DB::table('cuti')
            ->select('cuti.*', 'cuti.user_id', 'cuti.name', 'cuti.nip', 'cuti.jenis_cuti',
                'cuti.lama_cuti', 'cuti.tanggal_mulai_cuti', 'cuti.tanggal_selesai_cuti',
                'cuti.dokumen_kelengkapan', 'cuti.status_pengajuan')
            ->whereIn('id', function ($query)
            {
                $query->select(DB::raw('MAX(id)'))
                    ->from('cuti')
                    ->whereColumn('cuti.user_id', 'cuti.user_id')
                    ->groupBy('cuti.user_id');
            })
            ->get();

        // $currentYear = date('Y');
        // $annualLeave = [
        //     $currentYear - 2 => 12,
        //     $currentYear - 1 => 12,
        //     $currentYear => 12,
        // ];
        // $previousYears = array_filter(array_keys($annualLeave), function ($year) use ($currentYear) {
        //     return $year < $currentYear;
        // });
        // $sisaCuti = 0;
        // foreach ($previousYears as $year) {
        //     $sisaCuti += ($annualLeave[$year] >= 6) ? 6 : $annualLeave[$year];
        // }
        // $sisaCuti += $annualLeave[$currentYear];
        // , 'cutiTahun2023'

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
            
        return view('layanan.layanan-cuti', compact('data_cuti', 'data_profilcuti', 'data_cuti_pdf',
            'unreadNotifications', 'readNotifications'));
    }
    /** /Daftar Layanan Cuti User */

    /** Daftar Layanan Cuti Admin */
    public function tampilanCutiPegawaiAdmin()
    {
        $data_cuti = DB::table('cuti')
            ->select(
                'cuti.*',
                'cuti.user_id',
                'cuti.name',
                'cuti.nip',
                'cuti.jenis_cuti',
                'cuti.lama_cuti',
                'cuti.tanggal_mulai_cuti',
                'cuti.tanggal_selesai_cuti',
                'cuti.dokumen_kelengkapan',
                'cuti.status_pengajuan'
            )
            ->get();

        $data_cuti_pdf = DB::table('cuti')
            ->select('cuti.*', 'cuti.user_id', 'cuti.name', 'cuti.nip', 'cuti.jenis_cuti',
                'cuti.lama_cuti', 'cuti.tanggal_mulai_cuti', 'cuti.tanggal_selesai_cuti',
                'cuti.dokumen_kelengkapan', 'cuti.status_pengajuan')
            ->whereIn('id', function ($query)
            {
                $query->select(DB::raw('MAX(id)'))
                    ->from('cuti')
                    ->whereColumn('cuti.user_id', 'cuti.user_id')
                    ->groupBy('cuti.user_id');
            })
            ->get();

        $userList = DB::table('profil_pegawai')->get();

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

        return view('layanan.layanan-cuti-admin', compact('data_cuti', 'data_cuti_pdf', 'userList',
            'unreadNotifications','readNotifications'));
    }
    /** /Daftar Layanan Cuti Admin */

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
        ]);
        DB::beginTransaction();

        try {
            $layananCutiPegawai = new LayananCuti;
            $layananCutiPegawai->user_id               = $request->user_id;
            $layananCutiPegawai->name                  = $request->name;
            $layananCutiPegawai->nip                   = $request->nip;
            $layananCutiPegawai->jenis_cuti            = $request->jenis_cuti;
            $layananCutiPegawai->lama_cuti             = $request->lama_cuti;
            $layananCutiPegawai->tanggal_mulai_cuti    = $request->tanggal_mulai_cuti;
            $layananCutiPegawai->tanggal_selesai_cuti  = $request->tanggal_selesai_cuti;
            $layananCutiPegawai->status_pengajuan      = $request->status_pengajuan;
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
            $update = [
                'jenis_cuti'            => $request->jenis_cuti,
                'lama_cuti'             => $request->lama_cuti,
                'tanggal_mulai_cuti'    => $request->tanggal_mulai_cuti,
                'tanggal_selesai_cuti'  => $request->tanggal_selesai_cuti,
            ];

            if ($request->hasFile('dokumen_kelengkapan')) {
                $dokumen_kelengkapan = time() . '.' . $request->file('dokumen_kelengkapan')->getClientOriginalExtension();
                $request->file('dokumen_kelengkapan')->move(public_path('assets/DokumenKelengkapan'), $dokumen_kelengkapan);
                $update['dokumen_kelengkapan'] = $dokumen_kelengkapan;
            }
            
            if ($request->hasFile('dokumen_rekomendasi')) {
                $dokumen_rekomendasi = time() . '.' . $request->file('dokumen_rekomendasi')->getClientOriginalExtension();
                $request->file('dokumen_rekomendasi')->move(public_path('assets/DokumenRekomendasi'), $dokumen_rekomendasi);
                $update['dokumen_rekomendasi'] = $dokumen_rekomendasi;
            }

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
        ->select(
            'cuti.*',
            'cuti.user_id',
            'cuti.name',
            'cuti.nip',
            'cuti.jenis_cuti',
            'cuti.lama_cuti',
            'cuti.tanggal_mulai_cuti',
            'cuti.tanggal_selesai_cuti',
            'cuti.dokumen_kelengkapan',
            'cuti.status_pengajuan'
        )
        ->where('cuti.user_id', '=', $user_id)
        ->where('cuti.name', 'like', '%' . $name . '%')
        ->where('cuti.jenis_cuti', 'like', '%' . $jenis_cuti . '%')
        ->where('cuti.status_pengajuan', 'like', '%' . $status_pengajuan . '%')
        ->get();


        $data_profilcuti = DB::table('profil_pegawai')
            ->select('profil_pegawai.*', 'profil_pegawai.name', 'profil_pegawai.nip')
            ->where('profil_pegawai.user_id', $user_id)
            ->get();

        $pencarianDataCuti = DB::table('cuti')
            ->join('users', 'users.user_id', '=', 'cuti.user_id')
            ->where('users.user_id', $user_id)
            ->where('cuti.name', 'like', '%' . $name . '%')
            ->where('cuti.jenis_cuti', 'like', '%' . $jenis_cuti . '%')
            ->where('cuti.status_pengajuan', 'like', '%' . $status_pengajuan . '%')
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

        return view('layanan.layanan-cuti', compact('pencarianDataCuti', 'data_cuti', 'data_profilcuti',
            'unreadNotifications', 'readNotifications'));
    }
    /** /Search Layanan Cuti */

    /** Search Layanan Cuti Admin */
    public function pencarianLayananCutiAdmin(Request $request)
    {
        $name = $request->input('name');
        $jenis_cuti = $request->input('jenis_cuti');
        $status_pengajuan = $request->input('status_pengajuan');

        $data_cuti = DB::table('cuti')
            ->select(
                'cuti.*',
                'cuti.user_id',
                'cuti.name',
                'cuti.nip',
                'cuti.jenis_cuti',
                'cuti.lama_cuti',
                'cuti.tanggal_mulai_cuti',
                'cuti.tanggal_selesai_cuti',
                'cuti.dokumen_kelengkapan',
                'cuti.status_pengajuan'
            )
            ->where('cuti.name', 'like', '%' . $name . '%')
            ->where('cuti.jenis_cuti', 'like', '%' . $jenis_cuti . '%')
            ->where('cuti.status_pengajuan', 'like', '%' . $status_pengajuan . '%')
            ->get();

        $data_cuti_pdf = DB::table('cuti')
            ->select('cuti.*', 'cuti.user_id', 'cuti.name', 'cuti.nip', 'cuti.jenis_cuti',
                'cuti.lama_cuti', 'cuti.tanggal_mulai_cuti', 'cuti.tanggal_selesai_cuti',
                'cuti.dokumen_kelengkapan', 'cuti.status_pengajuan')
            ->whereIn('id', function ($query)
            {
                $query->select(DB::raw('MAX(id)'))
                    ->from('cuti')
                    ->whereColumn('cuti.user_id', 'cuti.user_id')
                    ->groupBy('cuti.user_id');
            })
            ->get();

        $userList = DB::table('profil_pegawai')->get();

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
        
        return view('layanan.layanan-cuti-admin', compact('data_cuti', 'userList', 'data_cuti_pdf',
            'unreadNotifications', 'readNotifications'));
    }
    /** /Search Layanan Cuti Admin */

    /** Tampilan Update Status Perhomonan */
    public function updateStatus(Request $request, $id)
    {
        $status_pengajuan = $request->input('status_pengajuan');
        $resource = LayananCuti::find($id);
        $resource->status_pengajuan = $status_pengajuan;
        $resource->save();
        Toastr::success('Data status pengajuan berhasil diperbaharui :)', 'Success');
        return redirect()->back();
    }
    /** /Tampilan Update Status Perhomonan */

    /** Tampilan Cetak Dokumen Rekomendasi */
    public function cetakDokumenRekomendasi()
    {
        // Ambil semua ID yang ingin Anda cetak
        $semua_id = LayananCuti::pluck('id');
        foreach ($semua_id as $id)
        {
            $cuti = LayananCuti::find($id);
            if (!$cuti)
            {
                // Handle jika ID tidak ditemukan
                continue;
            }
            $profilPegawai = $cuti->profil_pegawai;
            $nip = $profilPegawai ? $profilPegawai->nip : "Tidak Ada NIP";
            $name = $profilPegawai ? $profilPegawai->name : "Tidak Ada Nama";

        $posisi = PosisiJabatan::find($id);
        if (!$posisi)
        {
            // Handle jika ID tidak ditemukan
            continue;
        }
            $posisiJabatan = $posisi->posisi_jabatan;
            $jabatan = $posisiJabatan ? $posisiJabatan->jabatan : "Tidak Ada Jabatan";
            $gol_ruang_awal = $posisiJabatan ? $posisiJabatan->gol_ruang_awal : "Tidak Ada Golongan";

        $pdf = PDF::loadView('pdf.surat-cuti', [
            'cuti' => $cuti,
            'posisi' => $posisi,
            'nip' => $nip,
            'name' => $name,
            'jabatan' => $jabatan,
            'gol_ruang_awal' => $gol_ruang_awal
        ]);

        $nama_file = 'surat-cuti-' . $name . '.pdf';

        // Simpan atau tampilkan (stream) PDF, tergantung pada kebutuhan Anda
        // $pdf->save(public_path('pdf/' . $nama_file));
        $pdf->stream($nama_file);
    }

        return "Semua Surat Cuti Telah Dicetak.";
    }
    /** /Tampilan Cetak Dokumen Rekomendasi */

    /** Tampilan Cetak Dokumen Kelengkapan */
    public function cetakDokumenKelengkapan()
    {
        // Ambil semua ID yang ingin Anda cetak
        $semua_id = LayananCuti::pluck('id');
        foreach ($semua_id as $id)
        {
            $cuti = LayananCuti::find($id);
            if (!$cuti)
            {
                // Handle jika ID tidak ditemukan
                continue;
            }
            $profilPegawai = $cuti->profil_pegawai;
            $nip = $profilPegawai ? $profilPegawai->nip : "Tidak Ada NIP";
            $name = $profilPegawai ? $profilPegawai->name : "Tidak Ada Nama";

        $posisi = PosisiJabatan::find($id);
        if (!$posisi)
        {
            // Handle jika ID tidak ditemukan
            continue;
        }
            $posisiJabatan = $posisi->posisi_jabatan;
            $jabatan = $posisiJabatan ? $posisiJabatan->jabatan : "Tidak Ada Jabatan";
            $gol_ruang_awal = $posisiJabatan ? $posisiJabatan->gol_ruang_awal : "Tidak Ada Golongan";

        $pdf = PDF::loadView('pdf.surat-cuti', [
            'cuti' => $cuti,
            'posisi' => $posisi,
            'nip' => $nip,
            'name' => $name,
            'jabatan' => $jabatan,
            'gol_ruang_awal' => $gol_ruang_awal
        ]);

        $nama_file = 'surat-cuti-' . $name . '.pdf';

        // Simpan atau tampilkan (stream) PDF, tergantung pada kebutuhan Anda
        // $pdf->save(public_path('pdf/' . $nama_file));
        $pdf->stream($nama_file);
    }

        return "Semua Surat Cuti Telah Dicetak.";
    }
    /** /Tampilan Cetak Dokumen Kelengkapan */

    /** Tampilan Kenaikan Gaji Berkala */
    public function tampilanKGB()
    {
        $data_kgb = DB::table('kenaikan_gaji_berkala')
            ->select(
                'kenaikan_gaji_berkala.*',
                'kenaikan_gaji_berkala.user_id',
                'kenaikan_gaji_berkala.name',
                'kenaikan_gaji_berkala.nip',
                'kenaikan_gaji_berkala.golongan_awal',
                'kenaikan_gaji_berkala.gapok_lama',
                'kenaikan_gaji_berkala.tgl_sk_kgb',
                'kenaikan_gaji_berkala.no_sk_kgb',
                'kenaikan_gaji_berkala.tgl_berlaku',
                'kenaikan_gaji_berkala.masa_kerja_golongan',
                'kenaikan_gaji_berkala.gapok_baru',
                'kenaikan_gaji_berkala.masa_kerja',
                'kenaikan_gaji_berkala.golongan_akhir',
                'kenaikan_gaji_berkala.tmt_kgb'
            )
            ->get();

        $userList = DB::table('profil_pegawai')->get();

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

        return view('layanan.kenaikan-gaji-berkala', compact('unreadNotifications', 'readNotifications', 'data_kgb', 'userList'));
    }
    /** /Tampilan Kenaikan Gaji Berkala */

    /** Tambah Data Kenaikan Gaji Berkala Pegawai */
    public function tambahDataKGB(Request $request)
    {
        $request->validate([
            'user_id'               => 'required|string|max:255',
            'name'                  => 'required|string|max:255',
            'nip'                   => 'required|string|max:255',
            'golongan_awal'         => 'required|string|max:255',
            'gapok_lama'            => 'required|string|max:255',
            'tgl_sk_kgb'            => 'required|string|max:255',
            'tgl_berlaku'           => 'required|string|max:255',
            'no_sk_kgb'             => 'required|string|max:255',
            'masa_kerja_golongan'   => 'required|string|max:255',
            'gapok_baru'            => 'required|string|max:255',
            'masa_kerja'            => 'required|string|max:255',
            'golongan_akhir'        => 'required|string|max:255',
            'tmt_kgb'               => 'required|string|max:255',
        ]);
        DB::beginTransaction();

        try {
            $kgb = new KenaikanGajiBerkala();
            $kgb->user_id               = $request->user_id;
            $kgb->name                  = $request->name;
            $kgb->nip                   = $request->nip;
            $kgb->golongan_awal         = $request->golongan_awal;
            $kgb->gapok_lama            = $request->gapok_lama;
            $kgb->tgl_sk_kgb            = $request->tgl_sk_kgb;
            $kgb->no_sk_kgb             = $request->no_sk_kgb;
            $kgb->tgl_berlaku           = $request->tgl_berlaku;
            $kgb->masa_kerja_golongan   = $request->masa_kerja_golongan;
            $kgb->gapok_baru            = $request->gapok_baru;
            $kgb->masa_kerja            = $request->masa_kerja;
            $kgb->golongan_akhir        = $request->golongan_akhir;
            $kgb->tmt_kgb               = $request->tmt_kgb;
            $kgb->save();

            DB::commit();
            Toastr::success('Data kenaikan gaji berkala berhasil ditambah :)', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Data kenaikan gaji berkala gagal ditambah :(', 'Error');
            return redirect()->back();
        }
    }
    /** /Tambah Data Kenaikan Gaji Berkala Pegawai */

    /** Edit Data Kenaikan Gaji Berkala Pegawai */
    public function editDataKGB(Request $request)
    {
        DB::beginTransaction();
        try {
            $update = [
                'golongan_awal'          => $request->golongan_awal,
                'golongan_akhir'         => $request->golongan_akhir,
                'gapok_lama'             => $request->gapok_lama,
                'gapok_baru'             => $request->gapok_baru,
                'tgl_sk_kgb'             => $request->tgl_sk_kgb,
                'no_sk_kgb'              => $request->no_sk_kgb,
                'tgl_berlaku'            => $request->tgl_berlaku,
                'masa_kerja_golongan'    => $request->masa_kerja_golongan,
                'masa_kerja'             => $request->masa_kerja,
                'tmt_kgb'                => $request->tmt_kgb,
            ];
            KenaikanGajiBerkala::where('id', $request->id)->update($update);

            DB::commit();
            Toastr::success('Data Kenaikan Gaji Berkala berhasil diperbaharui :)', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Data Kenaikan Gaji Berkala gagal diperbaharui :(', 'Error');
            return redirect()->back();
        }
    }
    /** /Edit Data Kenaikan Gaji Berkala Pegawai */

    /** Tampilan Perpanjangan Kontrak */
    public function tampilanPerpanjangKontrak()
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

        return view('layanan.perpanjang-kontrak', compact('unreadNotifications', 'readNotifications'));
    }
    /** /Tampilan Perpanjangan Kontrak */

    /** Cetak Kenaikan Gaji Berkala PDF */
    public function cetakKGB($id)
    {
        $kgb = KenaikanGajiBerkala::find($id);
        if (!$kgb) {
            return abort(404);
        }
        $KenaikanGaji = $kgb->KenaikanGaji;

        if ($KenaikanGaji) {
            $nip = $KenaikanGaji->nip;
            $name = $KenaikanGaji->name;
            $golongan_awal = $KenaikanGaji->golongan_awal;
            $golongan_akhir = $KenaikanGaji->golongan_akhir;
            $gapok_lama = $KenaikanGaji->gapok_lama;
            $gapok_baru = $KenaikanGaji->gapok_baru;
            $tgl_sk_kgb = $KenaikanGaji->tgl_sk_kgb;
            $no_sk_kgb = $KenaikanGaji->no_sk_kgb;
            $tgl_berlaku = $KenaikanGaji->tgl_berlaku;
            $masa_kerja_golongan = $KenaikanGaji->masa_kerja_golongan;
            $masa_kerja = $KenaikanGaji->masa_kerja;
            $tmt_kgb = $KenaikanGaji->tmt_kgb;
        } else {
            $nip = "Tidak Ada NIP";
            $name = "Tidak Ada Nama";
            $golongan_awal = "Tidak Ada Golongan Awal";
            $golongan_akhir = "Tidak Ada Golongan Akhir";
            $gapok_lama = "Tidak Ada Gaji Pokok Lama";
            $gapok_baru = "Tidak Ada Gaji Pokok Baru";
            $tgl_sk_kgb = "Tidak Ada Tanggal SK KGB";
            $no_sk_kgb = "Tidak Ada Nomor SK KGB";
            $tgl_berlaku = "Tidak Ada Tanggal Berlaku";
            $masa_kerja_golongan = "Tidak Ada Masa Kerja Golongan";
            $masa_kerja = "Tidak Ada Masa Kerja";
            $tmt_kgb = "Tidak Ada TMT KGB";
        }

        $pdf = PDF::loadView('pdf.cetak-kgb', [
            'kgb' => $kgb,
            'nip' => $nip,
            'name' => $name,
            'golongan_awal'          => $golongan_awal,
            'golongan_akhir'         => $golongan_akhir,
            'gapok_lama'             => $gapok_lama,
            'gapok_baru'             => $gapok_baru,
            'tgl_sk_kgb'             => $tgl_sk_kgb,
            'no_sk_kgb'              => $no_sk_kgb,
            'tgl_berlaku'            => $tgl_berlaku,
            'masa_kerja_golongan'    => $masa_kerja_golongan,
            'masa_kerja'             => $masa_kerja,
            'tmt_kgb'                => $tmt_kgb,
        ]);

        return $pdf->stream('Kenaikan-Gaji-Berkala-' . $kgb->name . '.pdf');
    }
    /** /Cetak Kenaikan Gaji Berkala PDF */
}
