<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\LayananCuti;
use App\Models\Notification;
use App\Models\PosisiJabatan;
use App\Models\KenaikanGajiBerkala;
use App\Models\KontrakKerja;
use App\Models\perjanjianKinerja;
use App\Models\PerjanjianKontrak;
use App\Models\SuratTandaRegistrasi;
use App\Models\User;
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
            ->whereIn('id', function ($query) {
                $query->select(DB::raw('MAX(id)'))
                    ->from('cuti')
                    ->whereColumn('cuti.user_id', 'cuti.user_id')
                    ->groupBy('cuti.user_id');
            })
            ->get();

        // $totalLamaCuti = LayananCuti::sum('lama_cuti');
        // $sisaCuti = 18 - $totalLamaCuti;
        //     if ($totalLamaCuti >= 18) {
        //         $sisaCuti = 0;
        //     }

        $currentYear = date('Y');
        $previousYear = $currentYear - 1;
        $twoYearsAgo = $currentYear - 2;

        $totalLamaCutiThisYear = LayananCuti::whereYear('created_at', $currentYear)->sum('lama_cuti');
        $totalLamaCutiLastYear = LayananCuti::whereYear('created_at', $previousYear)->sum('lama_cuti');
        $totalLamaCutiTwoYearsAgo = LayananCuti::whereYear('created_at', $twoYearsAgo)->sum('lama_cuti');

        $sisaCutiThisYear = 18 - $totalLamaCutiThisYear;
        $sisaCutiLastYear = 18 - $totalLamaCutiLastYear;
        $sisaCutiTwoYearsAgo = 18 - $totalLamaCutiTwoYearsAgo;

        if ($totalLamaCutiThisYear >= 18) {
            $sisaCutiThisYear = 0;
        }

        if ($totalLamaCutiLastYear >= 18) {
            $sisaCutiLastYear = 0;
        }

        if ($totalLamaCutiTwoYearsAgo >= 18) {
            $sisaCutiTwoYearsAgo = 0;
        }

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

        return view('layanan.layanan-cuti', compact(
            'data_cuti',
            'data_profilcuti',
            'data_cuti_pdf',
            'unreadNotifications',
            'readNotifications',
            'sisaCutiThisYear',
            'sisaCutiLastYear',
            'sisaCutiTwoYearsAgo'
        ));
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

        $data_cuti_pdf_kelengkapan = DB::table('cuti')
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
            ->whereIn('id', function ($query) {
                $query->select(DB::raw('MAX(id)'))
                    ->from('cuti')
                    ->whereColumn('cuti.user_id', 'cuti.user_id')
                    ->groupBy('cuti.user_id');
            })
            ->get();

        $data_cuti_pdf_rekomendasi = DB::table('cuti')
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
            ->whereIn('id', function ($query) {
                $query->select(DB::raw('MAX(id)'))
                    ->from('cuti')
                    ->whereColumn('cuti.user_id', 'cuti.user_id')
                    ->groupBy('cuti.user_id');
            })
            ->get();

        $userList = DB::table('profil_pegawai')
            ->join('users', 'profil_pegawai.user_id', 'users.user_id')
            ->select('users.*', 'users.role_name', 'profil_pegawai.nip')
            ->where('role_name', '=', 'User')
            ->get();

        // $totalLamaCuti = LayananCuti::sum('lama_cuti');
        // $sisaCuti = 18 - $totalLamaCuti;
        //     if ($totalLamaCuti >= 18) {
        //         $sisaCuti = 0;
        //     }

        $currentYear = date('Y');
        $previousYear = $currentYear - 1;
        $twoYearsAgo = $currentYear - 2;

        $totalLamaCutiThisYear = LayananCuti::whereYear('created_at', $currentYear)->sum('lama_cuti');
        $totalLamaCutiLastYear = LayananCuti::whereYear('created_at', $previousYear)->sum('lama_cuti');
        $totalLamaCutiTwoYearsAgo = LayananCuti::whereYear('created_at', $twoYearsAgo)->sum('lama_cuti');

        $sisaCutiThisYear = 18 - $totalLamaCutiThisYear;
        $sisaCutiLastYear = 18 - $totalLamaCutiLastYear;
        $sisaCutiTwoYearsAgo = 18 - $totalLamaCutiTwoYearsAgo;

        if ($totalLamaCutiThisYear >= 18) {
            $sisaCutiThisYear = 0;
        }

        if ($totalLamaCutiLastYear >= 18) {
            $sisaCutiLastYear = 0;
        }

        if ($totalLamaCutiTwoYearsAgo >= 18) {
            $sisaCutiTwoYearsAgo = 0;
        }

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

        return view('layanan.layanan-cuti-admin', compact(
            'data_cuti',
            'data_cuti_pdf_kelengkapan',
            'data_cuti_pdf_rekomendasi',
            'userList',
            'unreadNotifications',
            'readNotifications',
            'sisaCutiThisYear',
            'sisaCutiLastYear',
            'sisaCutiTwoYearsAgo'
        ));
    }
    /** /Daftar Layanan Cuti Admin */

    /** Daftar Layanan Cuti Eselon 3 */
    public function tampilanCutiPegawaiEselon3()
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
        
        $user_id = auth()->user()->user_id;
        $data_cuti_pribadi = DB::table('cuti')
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

        $data_profilcuti_pribadi = DB::table('profil_pegawai')
            ->select('profil_pegawai.*', 'profil_pegawai.name', 'profil_pegawai.nip')
            ->where('profil_pegawai.user_id', $user_id)
            ->get();

        $data_cuti_pdf_kelengkapan = DB::table('cuti')
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
            ->whereIn('id', function ($query) {
                $query->select(DB::raw('MAX(id)'))
                    ->from('cuti')
                    ->whereColumn('cuti.user_id', 'cuti.user_id')
                    ->groupBy('cuti.user_id');
            })
            ->get();

        $userList = DB::table('profil_pegawai')
        ->join('users', 'profil_pegawai.user_id', 'users.user_id')
        ->select('users.*', 'users.role_name', 'profil_pegawai.nip')
        ->where('role_name', '=', 'User')
        ->get();

        // $totalLamaCuti = LayananCuti::sum('lama_cuti');
        // $sisaCuti = 18 - $totalLamaCuti;
        //     if ($totalLamaCuti >= 18) {
        //         $sisaCuti = 0;
        //     }

        $currentYear = date('Y');
        $previousYear = $currentYear - 1;
        $twoYearsAgo = $currentYear - 2;

        $totalLamaCutiThisYear = LayananCuti::whereYear('created_at', $currentYear)->sum('lama_cuti');
        $totalLamaCutiLastYear = LayananCuti::whereYear('created_at', $previousYear)->sum('lama_cuti');
        $totalLamaCutiTwoYearsAgo = LayananCuti::whereYear('created_at', $twoYearsAgo)->sum('lama_cuti');

        $sisaCutiThisYear = 18 - $totalLamaCutiThisYear;
        $sisaCutiLastYear = 18 - $totalLamaCutiLastYear;
        $sisaCutiTwoYearsAgo = 18 - $totalLamaCutiTwoYearsAgo;

        if ($totalLamaCutiThisYear >= 18) {
            $sisaCutiThisYear = 0;
        }

        if ($totalLamaCutiLastYear >= 18) {
            $sisaCutiLastYear = 0;
        }

        if ($totalLamaCutiTwoYearsAgo >= 18) {
            $sisaCutiTwoYearsAgo = 0;
        }

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

        return view('layanan.layanan-cuti-eselon3', compact(
            'data_cuti',
            'data_cuti_pribadi',
            'data_profilcuti_pribadi',
            'data_cuti_pdf_kelengkapan',
            'userList',
            'unreadNotifications',
            'readNotifications',
            'sisaCutiThisYear',
            'sisaCutiLastYear',
            'sisaCutiTwoYearsAgo'
        ));
    }
    /** /Daftar Layanan Cuti Eselon 3 */

    /** Daftar Layanan Cuti Eselon 4 */
    public function tampilanCutiPegawaiEselon4()
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
        
        $user_id = auth()->user()->user_id;
        $data_cuti_pribadi = DB::table('cuti')
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

        $data_profilcuti_pribadi = DB::table('profil_pegawai')
            ->select('profil_pegawai.*', 'profil_pegawai.name', 'profil_pegawai.nip')
            ->where('profil_pegawai.user_id', $user_id)
            ->get();

        $data_cuti_pdf_kelengkapan = DB::table('cuti')
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
            ->whereIn('id', function ($query) {
                $query->select(DB::raw('MAX(id)'))
                    ->from('cuti')
                    ->whereColumn('cuti.user_id', 'cuti.user_id')
                    ->groupBy('cuti.user_id');
            })
            ->get();

        $userList = DB::table('profil_pegawai')
        ->join('users', 'profil_pegawai.user_id', 'users.user_id')
        ->select('users.*', 'users.role_name', 'profil_pegawai.nip')
        ->where('role_name', '=', 'User')
        ->get();

        // $totalLamaCuti = LayananCuti::sum('lama_cuti');
        // $sisaCuti = 18 - $totalLamaCuti;
        //     if ($totalLamaCuti >= 18) {
        //         $sisaCuti = 0;
        //     }

        $currentYear = date('Y');
        $previousYear = $currentYear - 1;
        $twoYearsAgo = $currentYear - 2;

        $totalLamaCutiThisYear = LayananCuti::whereYear('created_at', $currentYear)->sum('lama_cuti');
        $totalLamaCutiLastYear = LayananCuti::whereYear('created_at', $previousYear)->sum('lama_cuti');
        $totalLamaCutiTwoYearsAgo = LayananCuti::whereYear('created_at', $twoYearsAgo)->sum('lama_cuti');

        $sisaCutiThisYear = 18 - $totalLamaCutiThisYear;
        $sisaCutiLastYear = 18 - $totalLamaCutiLastYear;
        $sisaCutiTwoYearsAgo = 18 - $totalLamaCutiTwoYearsAgo;

        if ($totalLamaCutiThisYear >= 18) {
            $sisaCutiThisYear = 0;
        }

        if ($totalLamaCutiLastYear >= 18) {
            $sisaCutiLastYear = 0;
        }

        if ($totalLamaCutiTwoYearsAgo >= 18) {
            $sisaCutiTwoYearsAgo = 0;
        }

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

        return view('layanan.layanan-cuti-eselon4', compact(
            'data_cuti',
            'data_cuti_pribadi',
            'data_profilcuti_pribadi',
            'data_cuti_pdf_kelengkapan',
            'userList',
            'unreadNotifications',
            'readNotifications',
            'sisaCutiThisYear',
            'sisaCutiLastYear',
            'sisaCutiTwoYearsAgo'
        ));
    }
    /** /Daftar Layanan Cuti Eselon 4 */

    /** Daftar Layanan Cuti Super Admin */
    public function tampilanCutiPegawaiKepalaRuangan()
    {
        $user = auth()->user();
        $ruangan = $user->ruangan;
        $data_cuti = User::where('role_name', 'User')
            ->join('cuti', 'users.user_id', 'cuti.user_id')
            ->where('ruangan', $ruangan)
            ->get();

        $userList = DB::table('profil_pegawai')
            ->join('users', 'profil_pegawai.user_id', 'users.user_id')
            ->select('users.*', 'users.role_name', 'profil_pegawai.nip')
            ->where('role_name', '=', 'User')
            ->get();

        // $totalLamaCuti = LayananCuti::sum('lama_cuti');
        // $sisaCuti = 18 - $totalLamaCuti;
        //     if ($totalLamaCuti >= 18) {
        //         $sisaCuti = 0;
        //     }

        $currentYear = date('Y');
        $previousYear = $currentYear - 1;
        $twoYearsAgo = $currentYear - 2;

        $totalLamaCutiThisYear = LayananCuti::whereYear('created_at', $currentYear)->sum('lama_cuti');
        $totalLamaCutiLastYear = LayananCuti::whereYear('created_at', $previousYear)->sum('lama_cuti');
        $totalLamaCutiTwoYearsAgo = LayananCuti::whereYear('created_at', $twoYearsAgo)->sum('lama_cuti');

        $sisaCutiThisYear = 18 - $totalLamaCutiThisYear;
        $sisaCutiLastYear = 18 - $totalLamaCutiLastYear;
        $sisaCutiTwoYearsAgo = 18 - $totalLamaCutiTwoYearsAgo;

        if ($totalLamaCutiThisYear >= 18) {
            $sisaCutiThisYear = 0;
        }

        if ($totalLamaCutiLastYear >= 18) {
            $sisaCutiLastYear = 0;
        }

        if ($totalLamaCutiTwoYearsAgo >= 18) {
            $sisaCutiTwoYearsAgo = 0;
        }

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

        return view('layanan.layanan-cuti-kepala-ruangan', compact('data_cuti', 'userList', 'unreadNotifications',
            'readNotifications', 'sisaCutiThisYear', 'sisaCutiLastYear', 'sisaCutiTwoYearsAgo'));
    }
    /** /Daftar Layanan Cuti Super Admin */

    /** Tambah Data Cuti Pegawai */
    public function tambahDataCuti(Request $request)
    {
        $request->validate([
            'user_id'                   => 'required|string|max:255',
            'name'                      => 'required|string|max:255',
            'nip'                       => 'required|string|max:255',
            'jenis_cuti'                => 'required|string|max:255',
            'lama_cuti'                 => 'required|string|max:255',
            'tanggal_mulai_cuti'        => 'required|string|max:255',
            'tanggal_selesai_cuti'      => 'required|string|max:255',
            'status_pengajuan'          => 'required|string|max:255',
            'persetujuan_administrasi'  => 'required|string|max:255',
            'persetujuan_eselon3'       => 'required|string|max:255',
            'persetujuan_eselon4'       => 'required|string|max:255',
            'persetujuan_kepalaruangan' => 'required|string|max:255',
        ]);

        // $totalLamaCuti = LayananCuti::where('user_id', $request->user_id)->sum('lama_cuti');
        // if (($totalLamaCuti + (int)$request->lama_cuti) > 18) {
        //     Toastr::error('Pengajuan cuti gagal karena sisa cuti habis atau melebihi 18 hari :(', 'Error');
        //     return redirect()->back();
        // }

        $currentYear = date('Y');
        $totalLamaCutiTahunIni = LayananCuti::where('user_id', $request->user_id)
            ->whereYear('created_at', $currentYear)
            ->sum('lama_cuti');
        $batasanCutiPerTahun = 18;
        if (($totalLamaCutiTahunIni + (int)$request->lama_cuti) > $batasanCutiPerTahun) {
            Toastr::error('Pengajuan cuti gagal karena sisa cuti habis atau melebihi batasan per tahun :(', 'Error');
            return redirect()->back();
        }

        DB::beginTransaction();

        try {
            $layananCutiPegawai = new LayananCuti;
            $layananCutiPegawai->user_id                    = $request->user_id;
            $layananCutiPegawai->name                       = $request->name;
            $layananCutiPegawai->nip                        = $request->nip;
            $layananCutiPegawai->jenis_cuti                 = $request->jenis_cuti;
            $layananCutiPegawai->lama_cuti                  = $request->lama_cuti;
            $layananCutiPegawai->tanggal_mulai_cuti         = $request->tanggal_mulai_cuti;
            $layananCutiPegawai->tanggal_selesai_cuti       = $request->tanggal_selesai_cuti;
            $layananCutiPegawai->status_pengajuan           = $request->status_pengajuan;
            $layananCutiPegawai->persetujuan_administrasi   = $request->persetujuan_administrasi;
            $layananCutiPegawai->persetujuan_eselon3        = $request->persetujuan_eselon3;
            $layananCutiPegawai->persetujuan_eselon4        = $request->persetujuan_eselon4;
            $layananCutiPegawai->persetujuan_kepalaruangan  = $request->persetujuan_kepalaruangan;
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

            // $totalLamaCuti = LayananCuti::where('user_id', $request->user_id)->sum('lama_cuti');
            // if (($totalLamaCuti + (int)$request->lama_cuti) > 18) {
            //     Toastr::error('Pengajuan cuti gagal karena sisa cuti habis atau melebihi 18 hari :(', 'Error');
            //     return redirect()->back();
            // }

            $currentYear = date('Y');
            $totalLamaCutiTahunIni = LayananCuti::where('user_id', $request->user_id)
                ->whereYear('created_at', $currentYear)
                ->sum('lama_cuti');
            $batasanCutiPerTahun = 18;
            if (($totalLamaCutiTahunIni + (int)$request->lama_cuti) > $batasanCutiPerTahun) {
                Toastr::error('Pengajuan cuti gagal karena sisa cuti habis atau melebihi batasan per tahun :(', 'Error');
                return redirect()->back();
            }

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

        // $totalLamaCuti = LayananCuti::sum('lama_cuti');
        // $sisaCuti = 18 - $totalLamaCuti;
        //     if ($totalLamaCuti >= 18) {
        //         $sisaCuti = 0;
        //     }

        $currentYear = date('Y');
        $previousYear = $currentYear - 1;
        $twoYearsAgo = $currentYear - 2;

        $totalLamaCutiThisYear = LayananCuti::whereYear('created_at', $currentYear)->sum('lama_cuti');
        $totalLamaCutiLastYear = LayananCuti::whereYear('created_at', $previousYear)->sum('lama_cuti');
        $totalLamaCutiTwoYearsAgo = LayananCuti::whereYear('created_at', $twoYearsAgo)->sum('lama_cuti');

        $sisaCutiThisYear = 18 - $totalLamaCutiThisYear;
        $sisaCutiLastYear = 18 - $totalLamaCutiLastYear;
        $sisaCutiTwoYearsAgo = 18 - $totalLamaCutiTwoYearsAgo;

        if ($totalLamaCutiThisYear >= 18) {
            $sisaCutiThisYear = 0;
        }

        if ($totalLamaCutiLastYear >= 18) {
            $sisaCutiLastYear = 0;
        }

        if ($totalLamaCutiTwoYearsAgo >= 18) {
            $sisaCutiTwoYearsAgo = 0;
        }

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

        return view('layanan.layanan-cuti', compact(
            'pencarianDataCuti',
            'data_cuti',
            'data_profilcuti',
            'unreadNotifications',
            'readNotifications',
            'sisaCutiThisYear',
            'sisaCutiLastYear',
            'sisaCutiTwoYearsAgo'
        ));
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
            ->whereIn('id', function ($query) {
                $query->select(DB::raw('MAX(id)'))
                    ->from('cuti')
                    ->whereColumn('cuti.user_id', 'cuti.user_id')
                    ->groupBy('cuti.user_id');
            })
            ->get();

        $userList = DB::table('profil_pegawai')->get();

        // $totalLamaCuti = LayananCuti::sum('lama_cuti');
        // $sisaCuti = 18 - $totalLamaCuti;
        //     if ($totalLamaCuti >= 18) {
        //         $sisaCuti = 0;
        //     }

        $currentYear = date('Y');
        $previousYear = $currentYear - 1;
        $twoYearsAgo = $currentYear - 2;

        $totalLamaCutiThisYear = LayananCuti::whereYear('created_at', $currentYear)->sum('lama_cuti');
        $totalLamaCutiLastYear = LayananCuti::whereYear('created_at', $previousYear)->sum('lama_cuti');
        $totalLamaCutiTwoYearsAgo = LayananCuti::whereYear('created_at', $twoYearsAgo)->sum('lama_cuti');

        $sisaCutiThisYear = 18 - $totalLamaCutiThisYear;
        $sisaCutiLastYear = 18 - $totalLamaCutiLastYear;
        $sisaCutiTwoYearsAgo = 18 - $totalLamaCutiTwoYearsAgo;

        if ($totalLamaCutiThisYear >= 18) {
            $sisaCutiThisYear = 0;
        }

        if ($totalLamaCutiLastYear >= 18) {
            $sisaCutiLastYear = 0;
        }

        if ($totalLamaCutiTwoYearsAgo >= 18) {
            $sisaCutiTwoYearsAgo = 0;
        }

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

        return view('layanan.layanan-cuti-admin', compact(
            'data_cuti',
            'userList',
            'data_cuti_pdf',
            'unreadNotifications',
            'readNotifications',
            'sisaCutiThisYear',
            'sisaCutiLastYear',
            'sisaCutiTwoYearsAgo'
        ));
    }
    /** /Search Layanan Cuti Admin */

    /** Search Layanan Cuti Eselon 3 */
    public function pencarianLayananCutiEselon3(Request $request)
    {
        $name = $request->input('name');
        $jenis_cuti = $request->input('jenis_cuti');
        $persetujuan_eselon3 = $request->input('persetujuan_eselon3');

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
                'cuti.persetujuan_eselon3'
            )
            ->where('cuti.name', 'like', '%' . $name . '%')
            ->where('cuti.jenis_cuti', 'like', '%' . $jenis_cuti . '%')
            ->where('cuti.persetujuan_eselon3', 'like', '%' . $persetujuan_eselon3 . '%')
            ->get();
        
        $user_id = auth()->user()->user_id;
        $data_cuti_pribadi = DB::table('cuti')
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
                'cuti.persetujuan_eselon3'
            )
            ->where('cuti.user_id', $user_id)
            ->get();

        $data_profilcuti_pribadi = DB::table('profil_pegawai')
            ->select('profil_pegawai.*', 'profil_pegawai.name', 'profil_pegawai.nip')
            ->where('profil_pegawai.user_id', $user_id)
            ->get();

        $data_cuti_pdf_kelengkapan = DB::table('cuti')
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
            ->whereIn('id', function ($query) {
                $query->select(DB::raw('MAX(id)'))
                    ->from('cuti')
                    ->whereColumn('cuti.user_id', 'cuti.user_id')
                    ->groupBy('cuti.user_id');
            })
            ->get();

        $userList = DB::table('profil_pegawai')->get();

        // $totalLamaCuti = LayananCuti::sum('lama_cuti');
        // $sisaCuti = 18 - $totalLamaCuti;
        //     if ($totalLamaCuti >= 18) {
        //         $sisaCuti = 0;
        //     }

        $currentYear = date('Y');
        $previousYear = $currentYear - 1;
        $twoYearsAgo = $currentYear - 2;

        $totalLamaCutiThisYear = LayananCuti::whereYear('created_at', $currentYear)->sum('lama_cuti');
        $totalLamaCutiLastYear = LayananCuti::whereYear('created_at', $previousYear)->sum('lama_cuti');
        $totalLamaCutiTwoYearsAgo = LayananCuti::whereYear('created_at', $twoYearsAgo)->sum('lama_cuti');

        $sisaCutiThisYear = 18 - $totalLamaCutiThisYear;
        $sisaCutiLastYear = 18 - $totalLamaCutiLastYear;
        $sisaCutiTwoYearsAgo = 18 - $totalLamaCutiTwoYearsAgo;

        if ($totalLamaCutiThisYear >= 18) {
            $sisaCutiThisYear = 0;
        }

        if ($totalLamaCutiLastYear >= 18) {
            $sisaCutiLastYear = 0;
        }

        if ($totalLamaCutiTwoYearsAgo >= 18) {
            $sisaCutiTwoYearsAgo = 0;
        }

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

        return view('layanan.layanan-cuti-eselon3', compact(
            'data_cuti',
            'data_cuti_pribadi',
            'data_profilcuti_pribadi',
            'userList',
            'data_cuti_pdf_kelengkapan',
            'unreadNotifications',
            'readNotifications',
            'sisaCutiThisYear',
            'sisaCutiLastYear',
            'sisaCutiTwoYearsAgo'
        ));
    }
    /** /Search Layanan Cuti Eselon 3 */

    /** Search Layanan Cuti Eselon 4 */
    public function pencarianLayananCutiEselon4(Request $request)
    {
        $name = $request->input('name');
        $jenis_cuti = $request->input('jenis_cuti');
        $persetujuan_eselon3 = $request->input('persetujuan_eselon3');

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
                'cuti.persetujuan_eselon3'
            )
            ->where('cuti.name', 'like', '%' . $name . '%')
            ->where('cuti.jenis_cuti', 'like', '%' . $jenis_cuti . '%')
            ->where('cuti.persetujuan_eselon3', 'like', '%' . $persetujuan_eselon3 . '%')
            ->get();
        
        $user_id = auth()->user()->user_id;
        $data_cuti_pribadi = DB::table('cuti')
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
                'cuti.persetujuan_eselon3'
            )
            ->where('cuti.user_id', $user_id)
            ->get();

        $data_profilcuti_pribadi = DB::table('profil_pegawai')
            ->select('profil_pegawai.*', 'profil_pegawai.name', 'profil_pegawai.nip')
            ->where('profil_pegawai.user_id', $user_id)
            ->get();

        $data_cuti_pdf_kelengkapan = DB::table('cuti')
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
            ->whereIn('id', function ($query) {
                $query->select(DB::raw('MAX(id)'))
                    ->from('cuti')
                    ->whereColumn('cuti.user_id', 'cuti.user_id')
                    ->groupBy('cuti.user_id');
            })
            ->get();

        $userList = DB::table('profil_pegawai')->get();

        // $totalLamaCuti = LayananCuti::sum('lama_cuti');
        // $sisaCuti = 18 - $totalLamaCuti;
        //     if ($totalLamaCuti >= 18) {
        //         $sisaCuti = 0;
        //     }

        $currentYear = date('Y');
        $previousYear = $currentYear - 1;
        $twoYearsAgo = $currentYear - 2;

        $totalLamaCutiThisYear = LayananCuti::whereYear('created_at', $currentYear)->sum('lama_cuti');
        $totalLamaCutiLastYear = LayananCuti::whereYear('created_at', $previousYear)->sum('lama_cuti');
        $totalLamaCutiTwoYearsAgo = LayananCuti::whereYear('created_at', $twoYearsAgo)->sum('lama_cuti');

        $sisaCutiThisYear = 18 - $totalLamaCutiThisYear;
        $sisaCutiLastYear = 18 - $totalLamaCutiLastYear;
        $sisaCutiTwoYearsAgo = 18 - $totalLamaCutiTwoYearsAgo;

        if ($totalLamaCutiThisYear >= 18) {
            $sisaCutiThisYear = 0;
        }

        if ($totalLamaCutiLastYear >= 18) {
            $sisaCutiLastYear = 0;
        }

        if ($totalLamaCutiTwoYearsAgo >= 18) {
            $sisaCutiTwoYearsAgo = 0;
        }

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

        return view('layanan.layanan-cuti-eselon4', compact(
            'data_cuti',
            'data_cuti_pribadi',
            'data_profilcuti_pribadi',
            'userList',
            'data_cuti_pdf_kelengkapan',
            'unreadNotifications',
            'readNotifications',
            'sisaCutiThisYear',
            'sisaCutiLastYear',
            'sisaCutiTwoYearsAgo'
        ));
    }
    /** /Search Layanan Cuti Eselon 4 */

    /** Search Layanan Cuti Super Admin */
    public function pencarianLayananCutiKepalaRuangan(Request $request)
    {
        $name = $request->input('name');
        $jenis_cuti = $request->input('jenis_cuti');
        $persetujuan_kepalaruangan = $request->input('persetujuan_kepalaruangan');

        $user = auth()->user();
        $ruangan = $user->ruangan;
        $data_cuti = User::where('role_name', 'User')
            ->join('cuti', 'users.user_id', 'cuti.user_id')
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
                'cuti.persetujuan_kepalaruangan'
            )
            ->where('cuti.name', 'like', '%' . $name . '%')
            ->where('cuti.jenis_cuti', 'like', '%' . $jenis_cuti . '%')
            ->where('cuti.persetujuan_kepalaruangan', 'like', '%' . $persetujuan_kepalaruangan . '%')
            ->where('ruangan', $ruangan)
            ->get();

        $data_cuti_pdf = DB::table('cuti')
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
            ->whereIn('id', function ($query) {
                $query->select(DB::raw('MAX(id)'))
                    ->from('cuti')
                    ->whereColumn('cuti.user_id', 'cuti.user_id')
                    ->groupBy('cuti.user_id');
            })
            ->get();

        $userList = DB::table('profil_pegawai')->get();

        // $totalLamaCuti = LayananCuti::sum('lama_cuti');
        // $sisaCuti = 18 - $totalLamaCuti;
        //     if ($totalLamaCuti >= 18) {
        //         $sisaCuti = 0;
        //     }

        $currentYear = date('Y');
        $previousYear = $currentYear - 1;
        $twoYearsAgo = $currentYear - 2;

        $totalLamaCutiThisYear = LayananCuti::whereYear('created_at', $currentYear)->sum('lama_cuti');
        $totalLamaCutiLastYear = LayananCuti::whereYear('created_at', $previousYear)->sum('lama_cuti');
        $totalLamaCutiTwoYearsAgo = LayananCuti::whereYear('created_at', $twoYearsAgo)->sum('lama_cuti');

        $sisaCutiThisYear = 18 - $totalLamaCutiThisYear;
        $sisaCutiLastYear = 18 - $totalLamaCutiLastYear;
        $sisaCutiTwoYearsAgo = 18 - $totalLamaCutiTwoYearsAgo;

        if ($totalLamaCutiThisYear >= 18) {
            $sisaCutiThisYear = 0;
        }

        if ($totalLamaCutiLastYear >= 18) {
            $sisaCutiLastYear = 0;
        }

        if ($totalLamaCutiTwoYearsAgo >= 18) {
            $sisaCutiTwoYearsAgo = 0;
        }

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

        return view('layanan.layanan-cuti-kepala-ruangan', compact(
            'data_cuti',
            'userList',
            'data_cuti_pdf',
            'unreadNotifications',
            'readNotifications',
            'sisaCutiThisYear',
            'sisaCutiLastYear',
            'sisaCutiTwoYearsAgo'
        ));
    }
    /** /Search Layanan Cuti Super Admin */

    /** Tampilan Update Status Perhomonan */
    public function updateStatus(Request $request, $id)
    {
        $resource = LayananCuti::find($id);

        if ($request->has('status_pengajuan')) {
            $resource->status_pengajuan = $request->input('status_pengajuan');
        }

        if ($request->has('persetujuan_administrasi')) {
            $resource->persetujuan_administrasi = $request->input('persetujuan_administrasi');
        }

        if ($request->has('persetujuan_eselon3')) {
            $resource->persetujuan_eselon3 = $request->input('persetujuan_eselon3');
        }

        if ($request->has('persetujuan_eselon4')) {
            $resource->persetujuan_eselon4 = $request->input('persetujuan_eselon4');
        }

        if ($request->has('persetujuan_kepalaruangan')) {
            $resource->persetujuan_kepalaruangan = $request->input('persetujuan_kepalaruangan');
        }

        $resource->save();
        Toastr::success('Data status pengajuan berhasil diperbaharui :)', 'Success');
        return redirect()->back();
    }
    /** /Tampilan Update Status Perhomonan */

    /** Tampilan Cetak Dokumen Rekomendasi */
    public function cetakDokumenRekomendasi($id)
    {
        // Ambil semua ID yang ingin Anda cetak
        // $lastLayananCutiId = LayananCuti::latest('id')->first()->id;
        // $cuti = LayananCuti::find($lastLayananCutiId);
        $cuti = LayananCuti::find($id);
        $profilPegawai = $cuti->profil_pegawai;
        $nip = $profilPegawai ? $profilPegawai->nip : "Tidak Ada NIP";
        $name = $profilPegawai ? $profilPegawai->name : "Tidak Ada Nama";
        $jenis_cuti = $profilPegawai ? $profilPegawai->jenis_cuti : "Tidak Ada Jenis Cuti";

        // Ambil semua ID yang ingin Anda cetak
        // $lastPosisiJabatanId = PosisiJabatan::latest('id')->first()->id;
        // $posisi = PosisiJabatan::find($lastPosisiJabatanId);
        $posisi = PosisiJabatan::find($id);
        $posisiJabatan = $posisi->posisi_jabatan;
        $jabatan = $posisiJabatan ? $posisiJabatan->jabatan : "Tidak Ada Jabatan";
        $gol_ruang_awal = $posisiJabatan ? $posisiJabatan->gol_ruang_awal : "Tidak Ada Golongan";

        $pdf = PDF::loadView('pdf.surat-cuti', [
            'cuti' => $cuti,
            'posisi' => $posisi,
            'nip' => $nip,
            'name' => $name,
            'jabatan' => $jabatan,
            'gol_ruang_awal' => $gol_ruang_awal,
            'jenis_cuti' => $jenis_cuti
        ]);

        return $pdf->stream('surat-cuti-' . $cuti->name . '.pdf');
        // $nama_file = 'surat-cuti-' . $name . '.pdf';

        // // Simpan atau tampilkan (stream) PDF, tergantung pada kebutuhan Anda
        // // $pdf->save(public_path('pdf/' . $nama_file));
        // $pdf->stream($nama_file);
        // }
    }
    /** /Tampilan Cetak Dokumen Rekomendasi */

    /** Tampilan Cetak Dokumen Rekomendasi 2 */
    public function cetakDokumenRekomendasi2($id)
    {
        $cuti = LayananCuti::find($id);
        $profilPegawai = $cuti->profil_pegawai;
        $nip = $profilPegawai ? $profilPegawai->nip : "Tidak Ada NIP";
        $name = $profilPegawai ? $profilPegawai->name : "Tidak Ada Nama";
        $jenis_cuti = $profilPegawai ? $profilPegawai->jenis_cuti : "Tidak Ada Jenis Cuti";

        $posisi = PosisiJabatan::find($id);
        $posisiJabatan = $posisi->posisi_jabatan;
        $jabatan = $posisiJabatan ? $posisiJabatan->jabatan : "Tidak Ada Jabatan";
        $gol_ruang_awal = $posisiJabatan ? $posisiJabatan->gol_ruang_awal : "Tidak Ada Golongan";

        $pdf = PDF::loadView('pdf.surat-cuti', [
            'cuti' => $cuti,
            'posisi' => $posisi,
            'nip' => $nip,
            'name' => $name,
            'jabatan' => $jabatan,
            'gol_ruang_awal' => $gol_ruang_awal,
            'jenis_cuti' => $jenis_cuti
        ]);

        return $pdf->stream('surat-cuti-' . $cuti->name . '.pdf');
    }
    /** /Tampilan Cetak Dokumen Rekomendasi 2 */

    /** Tampilan Cetak Dokumen Kelengkapan */
    public function cetakDokumenKelengkapan($id)
    {
        $currentYear = date('Y');
        $previousYear = $currentYear - 1;
        $twoYearsAgo = $currentYear - 2;

        $totalLamaCutiThisYear = LayananCuti::whereYear('created_at', $currentYear)->sum('lama_cuti');
        $totalLamaCutiLastYear = LayananCuti::whereYear('created_at', $previousYear)->sum('lama_cuti');
        $totalLamaCutiTwoYearsAgo = LayananCuti::whereYear('created_at', $twoYearsAgo)->sum('lama_cuti');

        $sisaCutiThisYear = 18 - $totalLamaCutiThisYear;
        $sisaCutiLastYear = 18 - $totalLamaCutiLastYear;
        $sisaCutiTwoYearsAgo = 18 - $totalLamaCutiTwoYearsAgo;

        if ($totalLamaCutiThisYear >= 18) {
            $sisaCutiThisYear = 0;
        }

        if ($totalLamaCutiLastYear >= 18) {
            $sisaCutiLastYear = 0;
        }

        if ($totalLamaCutiTwoYearsAgo >= 18) {
            $sisaCutiTwoYearsAgo = 0;
        }

        // Ambil semua ID yang ingin Anda cetak
        // $lastLayananCutiId = LayananCuti::latest('id')->first()->id;
        // $cuti = LayananCuti::find($lastLayananCutiId);
        $cuti = LayananCuti::find($id);
        $profilPegawai = $cuti->profil_pegawai;
        $nip = $profilPegawai ? $profilPegawai->nip : "Tidak Ada NIP";
        $name = $profilPegawai ? $profilPegawai->name : "Tidak Ada Nama";

        // Ambil semua ID yang ingin Anda cetak
        // $lastPosisiJabatanId = PosisiJabatan::latest('id')->first()->id;
        // $posisi = PosisiJabatan::find($lastPosisiJabatanId);
        $posisi = PosisiJabatan::find($id);
        $posisiJabatan = $posisi->posisi_jabatan;
        $jabatan = $posisiJabatan ? $posisiJabatan->jabatan : "Tidak Ada Jabatan";
        $gol_ruang_awal = $posisiJabatan ? $posisiJabatan->gol_ruang_awal : "Tidak Ada Golongan";

        $pdf = PDF::loadView('pdf.kelengkapan-cuti', [
            'cuti' => $cuti,
            'posisi' => $posisi,
            'nip' => $nip,
            'name' => $name,
            'jabatan' => $jabatan,
            'gol_ruang_awal' => $gol_ruang_awal,
            'sisaCutiThisYear' => $sisaCutiThisYear,
            'sisaCutiLastYear' => $sisaCutiLastYear,
            'sisaCutiTwoYearsAgo' => $sisaCutiTwoYearsAgo
        ]);

        return $pdf->stream('kelengkapan-cuti-' . $cuti->name . '.pdf');
        // $nama_file = 'surat-cuti-' . $name . '.pdf';

        // // Simpan atau tampilkan (stream) PDF, tergantung pada kebutuhan Anda
        // // $pdf->save(public_path('pdf/' . $nama_file));
        // $pdf->stream($nama_file);
        // }
    }
    /** /Tampilan Cetak Dokumen Kelengkapan */

    /** Tampilan Cetak Dokumen Kelengkapan 2 */
    public function cetakDokumenKelengkapan2($id)
    {
        $currentYear = date('Y');
        $previousYear = $currentYear - 1;
        $twoYearsAgo = $currentYear - 2;

        $totalLamaCutiThisYear = LayananCuti::whereYear('created_at', $currentYear)->sum('lama_cuti');
        $totalLamaCutiLastYear = LayananCuti::whereYear('created_at', $previousYear)->sum('lama_cuti');
        $totalLamaCutiTwoYearsAgo = LayananCuti::whereYear('created_at', $twoYearsAgo)->sum('lama_cuti');

        $sisaCutiThisYear = 18 - $totalLamaCutiThisYear;
        $sisaCutiLastYear = 18 - $totalLamaCutiLastYear;
        $sisaCutiTwoYearsAgo = 18 - $totalLamaCutiTwoYearsAgo;

        if ($totalLamaCutiThisYear >= 18) {
            $sisaCutiThisYear = 0;
        }

        if ($totalLamaCutiLastYear >= 18) {
            $sisaCutiLastYear = 0;
        }

        if ($totalLamaCutiTwoYearsAgo >= 18) {
            $sisaCutiTwoYearsAgo = 0;
        }

        // Ambil semua ID yang ingin Anda cetak
        $cuti = LayananCuti::find($id);
        $profilPegawai = $cuti->profil_pegawai;
        $nip = $profilPegawai ? $profilPegawai->nip : "Tidak Ada NIP";
        $name = $profilPegawai ? $profilPegawai->name : "Tidak Ada Nama";

        // Ambil semua ID yang ingin Anda cetak
        $posisi = PosisiJabatan::find($id);
        $posisiJabatan = $posisi->posisi_jabatan;
        $jabatan = $posisiJabatan ? $posisiJabatan->jabatan : "Tidak Ada Jabatan";
        $gol_ruang_awal = $posisiJabatan ? $posisiJabatan->gol_ruang_awal : "Tidak Ada Golongan";

        $pdf = PDF::loadView('pdf.kelengkapan-cuti', [
            'cuti' => $cuti,
            'posisi' => $posisi,
            'nip' => $nip,
            'name' => $name,
            'jabatan' => $jabatan,
            'gol_ruang_awal' => $gol_ruang_awal,
            'sisaCutiThisYear' => $sisaCutiThisYear,
            'sisaCutiLastYear' => $sisaCutiLastYear,
            'sisaCutiTwoYearsAgo' => $sisaCutiTwoYearsAgo
        ]);

        return $pdf->stream('kelengkapan-cuti-' . $cuti->name . '.pdf');
    }
    /** /Tampilan Cetak Dokumen Kelengkapan 2 */

    /** Tampilan Cetak Dokumen Kelengkapan Kepala Ruang */
    public function cetakDokumenKelengkapanKepalaRuangan($id)
    {
        $currentYear = date('Y');
        $previousYear = $currentYear - 1;
        $twoYearsAgo = $currentYear - 2;

        $totalLamaCutiThisYear = LayananCuti::whereYear('created_at', $currentYear)->sum('lama_cuti');
        $totalLamaCutiLastYear = LayananCuti::whereYear('created_at', $previousYear)->sum('lama_cuti');
        $totalLamaCutiTwoYearsAgo = LayananCuti::whereYear('created_at', $twoYearsAgo)->sum('lama_cuti');

        $sisaCutiThisYear = 18 - $totalLamaCutiThisYear;
        $sisaCutiLastYear = 18 - $totalLamaCutiLastYear;
        $sisaCutiTwoYearsAgo = 18 - $totalLamaCutiTwoYearsAgo;

        if ($totalLamaCutiThisYear >= 18) {
            $sisaCutiThisYear = 0;
        }

        if ($totalLamaCutiLastYear >= 18) {
            $sisaCutiLastYear = 0;
        }

        if ($totalLamaCutiTwoYearsAgo >= 18) {
            $sisaCutiTwoYearsAgo = 0;
        }

        // Ambil semua ID yang ingin Anda cetak
        // $lastLayananCutiId = LayananCuti::latest('id')->first()->id;
        // $cuti = LayananCuti::find($lastLayananCutiId);
        $cuti = LayananCuti::find($id);
        $profilPegawai = $cuti->profil_pegawai;
        $nip = $profilPegawai ? $profilPegawai->nip : "Tidak Ada NIP";
        $name = $profilPegawai ? $profilPegawai->name : "Tidak Ada Nama";

        // Ambil semua ID yang ingin Anda cetak
        // $lastPosisiJabatanId = PosisiJabatan::latest('id')->first()->id;
        // $posisi = PosisiJabatan::find($lastPosisiJabatanId);
        $posisi = PosisiJabatan::find($id);
        $posisiJabatan = $posisi->posisi_jabatan;
        $jabatan = $posisiJabatan ? $posisiJabatan->jabatan : "Tidak Ada Jabatan";
        $gol_ruang_awal = $posisiJabatan ? $posisiJabatan->gol_ruang_awal : "Tidak Ada Golongan";

        $pdf = PDF::loadView('pdf.kelengkapan-cuti', [
            'cuti' => $cuti,
            'posisi' => $posisi,
            'nip' => $nip,
            'name' => $name,
            'jabatan' => $jabatan,
            'gol_ruang_awal' => $gol_ruang_awal,
            'sisaCutiThisYear' => $sisaCutiThisYear,
            'sisaCutiLastYear' => $sisaCutiLastYear,
            'sisaCutiTwoYearsAgo' => $sisaCutiTwoYearsAgo
        ]);

        return $pdf->stream('kelengkapan-cuti-' . $cuti->name . '.pdf');
        // $nama_file = 'surat-cuti-' . $name . '.pdf';

        // // Simpan atau tampilkan (stream) PDF, tergantung pada kebutuhan Anda
        // // $pdf->save(public_path('pdf/' . $nama_file));
        // $pdf->stream($nama_file);
        // }
    }
    /** /Tampilan Cetak Dokumen Kelengkapan Kepala Ruang */

    public function tampilanKGBAdmin()
    {
        $data_kgb = DB::table('kenaikan_gaji_berkala')
            ->select(
                'kenaikan_gaji_berkala.*',
                'kenaikan_gaji_berkala.user_id',
                'kenaikan_gaji_berkala.name',
                'kenaikan_gaji_berkala.nip',
                'kenaikan_gaji_berkala.golongan_awal',
                'kenaikan_gaji_berkala.golongan_akhir',
                'kenaikan_gaji_berkala.gapok_lama',
                'kenaikan_gaji_berkala.gapok_baru',
                'kenaikan_gaji_berkala.tgl_sk_kgb',
                'kenaikan_gaji_berkala.no_sk_kgb',
                'kenaikan_gaji_berkala.tgl_berlaku',
                'kenaikan_gaji_berkala.masa_kerja_golongan',
                'kenaikan_gaji_berkala.masa_kerja',
                'kenaikan_gaji_berkala.tmt_kgb'
            )
            ->get();

        $data_kgb_pdf = DB::table('kenaikan_gaji_berkala')
            ->select(
                'kenaikan_gaji_berkala.*',
                'kenaikan_gaji_berkala.user_id',
                'kenaikan_gaji_berkala.name',
                'kenaikan_gaji_berkala.nip',
                'kenaikan_gaji_berkala.golongan_awal',
                'kenaikan_gaji_berkala.golongan_akhir',
                'kenaikan_gaji_berkala.gapok_lama',
                'kenaikan_gaji_berkala.gapok_baru',
                'kenaikan_gaji_berkala.tgl_sk_kgb',
                'kenaikan_gaji_berkala.no_sk_kgb',
                'kenaikan_gaji_berkala.tgl_berlaku',
                'kenaikan_gaji_berkala.masa_kerja_golongan',
                'kenaikan_gaji_berkala.masa_kerja',
                'kenaikan_gaji_berkala.tmt_kgb'
            )
            ->whereIn('id', function ($query) {
                $query->select(DB::raw('MAX(id)'))
                    ->from('kenaikan_gaji_berkala')
                    ->whereColumn('kenaikan_gaji_berkala.user_id', 'kenaikan_gaji_berkala.user_id')
                    ->groupBy('kenaikan_gaji_berkala.user_id');
            })
            ->get();

        $userList = DB::table('profil_pegawai')
            ->join('users', 'profil_pegawai.user_id', 'users.user_id')
            ->select('users.*', 'users.role_name', 'profil_pegawai.nip')
            ->where('role_name', '=', 'User')
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

        $golonganOptions = DB::table('golongan_id')->pluck('nama_golongan', 'nama_golongan');

        return view('layanan.kenaikan-gaji-berkala-admin', compact(
            'golonganOptions',
            'data_kgb',
            'userList',
            'unreadNotifications',
            'readNotifications',
            'data_kgb_pdf'
        ));
    }
    /** /Tampilan Kenaikan Gaji Berkala */

    /** Tampilan Pencarian KGB Admin */
    public function filterKGBAdmin(Request $request)
    {
        $name = $request->input('name');
        $nip = $request->input('nip');

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
            ->where('kenaikan_gaji_berkala.name', 'like', '%' . $name . '%')
            ->where('kenaikan_gaji_berkala.nip', 'like', '%' . $nip . '%')
            ->get();

        $data_kgb_pdf = DB::table('kenaikan_gaji_berkala')
        ->select(
            'kenaikan_gaji_berkala.*',
            'kenaikan_gaji_berkala.user_id',
            'kenaikan_gaji_berkala.name',
            'kenaikan_gaji_berkala.nip',
            'kenaikan_gaji_berkala.golongan_awal',
            'kenaikan_gaji_berkala.golongan_akhir',
            'kenaikan_gaji_berkala.gapok_lama',
            'kenaikan_gaji_berkala.gapok_baru',
            'kenaikan_gaji_berkala.tgl_sk_kgb',
            'kenaikan_gaji_berkala.no_sk_kgb',
            'kenaikan_gaji_berkala.tgl_berlaku',
            'kenaikan_gaji_berkala.masa_kerja_golongan',
            'kenaikan_gaji_berkala.masa_kerja',
            'kenaikan_gaji_berkala.tmt_kgb'
        )
            ->whereIn('id', function ($query) {
                $query->select(DB::raw('MAX(id)'))
                ->from('kenaikan_gaji_berkala')
                ->whereColumn('kenaikan_gaji_berkala.user_id', 'kenaikan_gaji_berkala.user_id')
                ->groupBy('kenaikan_gaji_berkala.user_id');
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

        return view('layanan.kenaikan-gaji-berkala-admin', compact('data_kgb', 'data_kgb_pdf', 'userList', 'readNotifications', 'unreadNotifications'));
    }
    /** /Tampilan Pencarian KGB Admin */

    /** Tampilan Kenaikan Gaji Berkala */
    public function tampilanKGB()
    {
        $user_id = auth()->user()->user_id;
        $data_kgb = DB::table('kenaikan_gaji_berkala')
            ->select(
                'kenaikan_gaji_berkala.*',
                'kenaikan_gaji_berkala.user_id',
                'kenaikan_gaji_berkala.name',
                'kenaikan_gaji_berkala.nip',
                'kenaikan_gaji_berkala.golongan_awal',
                'kenaikan_gaji_berkala.golongan_akhir',
                'kenaikan_gaji_berkala.gapok_lama',
                'kenaikan_gaji_berkala.gapok_baru',
                'kenaikan_gaji_berkala.tgl_sk_kgb',
                'kenaikan_gaji_berkala.no_sk_kgb',
                'kenaikan_gaji_berkala.tgl_berlaku',
                'kenaikan_gaji_berkala.masa_kerja_golongan',
                'kenaikan_gaji_berkala.masa_kerja',
                'kenaikan_gaji_berkala.tmt_kgb'
            )
            ->where('kenaikan_gaji_berkala.user_id', $user_id)
            ->get();

        $data_kgb_result = DB::table('profil_pegawai')
            ->select('profil_pegawai.*', 'profil_pegawai.name', 'profil_pegawai.nip')
            ->where('profil_pegawai.user_id', $user_id)
            ->get();

        $userList = DB::table('profil_pegawai')
            ->join('users', 'profil_pegawai.user_id', 'users.user_id')
            ->select('users.*', 'users.role_name', 'profil_pegawai.nip')
            ->where('role_name', '=', 'User')
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

        $golonganOptions = DB::table('golongan_id')->pluck('nama_golongan', 'nama_golongan');

        return view('layanan.kenaikan-gaji-berkala', compact('unreadNotifications', 'readNotifications', 'data_kgb',
            'userList', 'golonganOptions', 'data_kgb_result'));
    }

    /** Tambah Data Kenaikan Gaji Berkala Pegawai */
    public function tambahDataKGB(Request $request)
    {
        $request->validate([
            'user_id'               => 'required|string|max:255',
            'name'                  => 'required|string|max:255',
            'nip'                   => 'required|string|max:255',
            'golongan_awal'         => 'required|string|max:255',
            'golongan_akhir'        => 'required|string|max:255',
            'gapok_lama'            => 'required|string|max:255',
            'gapok_baru'            => 'required|string|max:255',
            'tgl_sk_kgb'            => 'required|string|max:255',
            'no_sk_kgb'             => 'required|string|max:255',
            'tgl_berlaku'           => 'required|string|max:255',
            'masa_kerja_golongan'   => 'required|string|max:255',
            'masa_kerja'            => 'required|string|max:255',
            'tmt_kgb'               => 'required|string|max:255',
        ]);
        DB::beginTransaction();

        try {
            $kgb = new KenaikanGajiBerkala();
            $kgb->user_id               = $request->user_id;
            $kgb->name                  = $request->name;
            $kgb->nip                   = $request->nip;
            $kgb->golongan_awal         = $request->golongan_awal;
            $kgb->golongan_akhir        = $request->golongan_akhir;
            $kgb->gapok_lama            = $request->gapok_lama;
            $kgb->gapok_baru            = $request->gapok_baru;
            $kgb->tgl_sk_kgb            = $request->tgl_sk_kgb;
            $kgb->no_sk_kgb             = $request->no_sk_kgb;
            $kgb->tgl_berlaku           = $request->tgl_berlaku;
            $kgb->masa_kerja_golongan   = $request->masa_kerja_golongan;
            $kgb->masa_kerja            = $request->masa_kerja;
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

            if ($request->hasFile('dokumen_kgb')) {
                $dokumen_kgb = time() . '.' . $request->file('dokumen_kgb')->getClientOriginalExtension();
                $request->file('dokumen_kgb')->move(public_path('assets/DokumenKGB'), $dokumen_kgb);
                $update['dokumen_kgb'] = $dokumen_kgb;
            }
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

    /** Hapus Data Kenaikan Gaji Berkala Pegawai */
    public function hapusKenaikanGajiBerkala(Request $request)
    {
        DB::beginTransaction();

        try {
            KenaikanGajiBerkala::where('id', $request->id)->delete();
            DB::commit();
            Toastr::success('Data kenaikan gaji berkala berhasil dihapus :)', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Data kenaikan gaji berkala gagal dihapus :)', 'Error');
            return redirect()->back();
        }
    }
    /** /End Hapus Data Kenaikan Gaji Berkala Pegawai */

    /** Cetak Kenaikan Gaji Berkala Admin PDF */
    public function cetakKGB($id)
    {
        $kgb = KenaikanGajiBerkala::find($id);
        $KGB = $kgb->kenaikan_gaji;
        $nip = $KGB ? $KGB->nip : "Tidak Ada NIP";
        $name = $KGB ? $KGB->name : "Tidak Ada Nama";
        $golongan_awal = $KGB ? $KGB->golongan_awal : "Tidak Ada Golongan Awal";
        $golongan_akhir = $KGB ? $KGB->golongan_akhir : "Tidak Ada Golongan Akhir";
        $gapok_lama = $KGB ? $KGB->gapok_lama : "Tidak Ada Gaji Pokok Lama";
        $gapok_baru = $KGB ? $KGB->gapok_baru : "Tidak Ada Gaji Pokok Baru";
        $tgl_sk_kgb = $KGB ? $KGB->tgl_sk_kgb : "Tidak Ada Tanggal SK";
        $no_sk_kgb = $KGB ? $KGB->no_sk_kgb : "Tidak Ada No SK";
        $tgl_berlaku = $KGB ? $KGB->tgl_berlaku : "Tidak Ada Tanggal Berlaku";
        $masa_kerja_golongan = $KGB ? $KGB->masa_kerja_golongan : "Tidak Ada Masa Kerja Golongan";
        $masa_kerja = $KGB ? $KGB->masa_kerja : "Tidak Ada Masa Kerja";
        $tmt_kgb = $KGB ? $KGB->tmt_kgb : "Tidak Ada TMT KGB";

        $pdf = PDF::loadView('pdf.cetak-kgb', [
            'kgb'                   => $kgb,
            'nip'                   => $nip,
            'name'                  => $name,
            'golongan_awal'         => $golongan_awal,
            'golongan_akhir'        => $golongan_akhir,
            'gapok_lama'            => $gapok_lama,
            'gapok_baru'            => $gapok_baru,
            'tgl_sk_kgb'            => $tgl_sk_kgb,
            'no_sk_kgb'             => $no_sk_kgb,
            'tgl_berlaku'           => $tgl_berlaku,
            'masa_kerja_golongan'   => $masa_kerja_golongan,
            'masa_kerja'            => $masa_kerja,
            'tmt_kgb'               => $tmt_kgb,
        ]);

        return $pdf->stream('cetak-kgb-' . $kgb->name . '.pdf');
    }
    /** /Cetak Kenaikan Gaji Berkala Admin PDF */

    /** Cetak Kenaikan Gaji Berkala User PDF */
    public function cetakKGB2($id)
    {
        $kgb = KenaikanGajiBerkala::find($id);
        $KGB = $kgb->kenaikan_gaji;
        $nip = $KGB ? $KGB->nip : "Tidak Ada NIP";
        $name = $KGB ? $KGB->name : "Tidak Ada Nama";
        $golongan_awal = $KGB ? $KGB->golongan_awal : "Tidak Ada Golongan Awal";
        $golongan_akhir = $KGB ? $KGB->golongan_akhir : "Tidak Ada Golongan Akhir";
        $gapok_lama = $KGB ? $KGB->gapok_lama : "Tidak Ada Gaji Pokok Lama";
        $gapok_baru = $KGB ? $KGB->gapok_baru : "Tidak Ada Gaji Pokok Baru";
        $tgl_sk_kgb = $KGB ? $KGB->tgl_sk_kgb : "Tidak Ada Tanggal SK";
        $no_sk_kgb = $KGB ? $KGB->no_sk_kgb : "Tidak Ada No SK";
        $tgl_berlaku = $KGB ? $KGB->tgl_berlaku : "Tidak Ada Tanggal Berlaku";
        $masa_kerja_golongan = $KGB ? $KGB->masa_kerja_golongan : "Tidak Ada Masa Kerja Golongan";
        $masa_kerja = $KGB ? $KGB->masa_kerja : "Tidak Ada Masa Kerja";
        $tmt_kgb = $KGB ? $KGB->tmt_kgb : "Tidak Ada TMT KGB";

        $pdf = PDF::loadView('pdf.cetak-kgb', [
            'kgb'                   => $kgb,
            'nip'                   => $nip,
            'name'                  => $name,
            'golongan_awal'         => $golongan_awal,
            'golongan_akhir'        => $golongan_akhir,
            'gapok_lama'            => $gapok_lama,
            'gapok_baru'            => $gapok_baru,
            'tgl_sk_kgb'            => $tgl_sk_kgb,
            'no_sk_kgb'             => $no_sk_kgb,
            'tgl_berlaku'           => $tgl_berlaku,
            'masa_kerja_golongan'   => $masa_kerja_golongan,
            'masa_kerja'            => $masa_kerja,
            'tmt_kgb'               => $tmt_kgb,
        ]);

        return $pdf->stream('cetak-kgb-' . $kgb->name . '.pdf');
    }
    /** /Cetak Kenaikan Gaji Berkala User PDF */

    /** Tampilan Perpanjangan Kontrak */
    public function tampilanPerpanjangKontrak()
    {
        $user_id = auth()->user()->user_id;
        $data_perpanjang_kontrak = DB::table('kontrak_kerja')
            ->select(
                'kontrak_kerja.*',
                'kontrak_kerja.user_id',
                'kontrak_kerja.name',
                'kontrak_kerja.nip',
                'kontrak_kerja.tempat_lahir',
                'kontrak_kerja.tanggal_lahir',
                'kontrak_kerja.nik_blud',
                'kontrak_kerja.pendidikan',
                'kontrak_kerja.tahun_lulus',
                'kontrak_kerja.jabatan',
                'kontrak_kerja.mulai_kontrak',
                'kontrak_kerja.akhir_kontrak',
            )
            ->where('kontrak_kerja.user_id', $user_id)
            ->get();

        $data_perpanjang_pdf = DB::table('kontrak_kerja')
        ->select(
            'kontrak_kerja.*',
            'kontrak_kerja.user_id',
            'kontrak_kerja.name',
            'kontrak_kerja.nip',
            'kontrak_kerja.tempat_lahir',
            'kontrak_kerja.tanggal_lahir',
            'kontrak_kerja.nik_blud',
            'kontrak_kerja.pendidikan',
            'kontrak_kerja.tahun_lulus',
            'kontrak_kerja.jabatan',
            'kontrak_kerja.mulai_kontrak',
            'kontrak_kerja.akhir_kontrak',
        )
            ->whereIn('id', function ($query) {
                $query->select(DB::raw('MAX(id)'))
                    ->from('kontrak_kerja')
                    ->whereColumn('kontrak_kerja.user_id', 'kontrak_kerja.user_id')
                    ->groupBy('kontrak_kerja.user_id');
            })
            ->get();

        $user_id = auth()->user()->user_id;
        $data_profilpegawai = DB::table('profil_pegawai')
            ->select(
                'profil_pegawai.*',
                'profil_pegawai.tempat_lahir',
                'profil_pegawai.tanggal_lahir',
                'profil_pegawai.tingkat_pendidikan',
                'profil_pegawai.name',
                'profil_pegawai.nip'
            )
            ->where('profil_pegawai.user_id', $user_id)
            ->get();

        $user_id = auth()->user()->user_id;
        $data_posisijabatan = DB::table('posisi_jabatan')
            ->select('posisi_jabatan.*', 'posisi_jabatan.jabatan')
            ->where('posisi_jabatan.user_id', $user_id)
            ->get();

        $userList = DB::table('profil_pegawai')
        ->join('users', 'profil_pegawai.user_id', 'users.user_id')
        ->join('posisi_jabatan', 'profil_pegawai.user_id', 'posisi_jabatan.user_id')
        ->select(
            'users.*',
            'users.role_name',
            'profil_pegawai.nip',
            'profil_pegawai.tempat_lahir',
            'profil_pegawai.tanggal_lahir',
            'profil_pegawai.tingkat_pendidikan',
            'posisi_jabatan.jabatan'
        )
            ->where('role_name', '=', 'User')
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

        return view('layanan.perpanjang-kontrak', compact('data_perpanjang_kontrak', 'userList', 'unreadNotifications', 'readNotifications', 'data_profilpegawai', 'data_posisijabatan', 'data_perpanjang_pdf'));
    }
    /** /Tampilan Perpanjangan Kontrak */

    /** Tampilan Perpanjangan Kontrak */
    public function tampilanPerpanjangKontrakAdmin()
    {
        $data_perpanjang_kontrak = DB::table('kontrak_kerja')
            ->select(
                'kontrak_kerja.*',
                'kontrak_kerja.user_id',
                'kontrak_kerja.name',
                'kontrak_kerja.nip',
                'kontrak_kerja.tempat_lahir',
                'kontrak_kerja.tanggal_lahir',
                'kontrak_kerja.nik_blud',
                'kontrak_kerja.pendidikan',
                'kontrak_kerja.tahun_lulus',
                'kontrak_kerja.jabatan',
                'kontrak_kerja.mulai_kontrak',
                'kontrak_kerja.akhir_kontrak',
            )
            ->get();

        $data_perpanjang_pdf = DB::table('kontrak_kerja')
            ->select(
                'kontrak_kerja.*',
                'kontrak_kerja.user_id',
                'kontrak_kerja.name',
                'kontrak_kerja.nip',
                'kontrak_kerja.tempat_lahir',
                'kontrak_kerja.tanggal_lahir',
                'kontrak_kerja.nik_blud',
                'kontrak_kerja.pendidikan',
                'kontrak_kerja.tahun_lulus',
                'kontrak_kerja.jabatan',
                'kontrak_kerja.mulai_kontrak',
                'kontrak_kerja.akhir_kontrak',
            )
            ->whereIn('id', function ($query) {
                $query->select(DB::raw('MAX(id)'))
                    ->from('kontrak_kerja')
                    ->whereColumn('kontrak_kerja.user_id', 'kontrak_kerja.user_id')
                    ->groupBy('kontrak_kerja.user_id');
            })
            ->get();

        $user_id = auth()->user()->user_id;
        $data_profilpegawai = DB::table('profil_pegawai')
            ->select(
                'profil_pegawai.*',
                'profil_pegawai.tempat_lahir',
                'profil_pegawai.tanggal_lahir',
                'profil_pegawai.tingkat_pendidikan',
                'profil_pegawai.name',
                'profil_pegawai.nip'
            )
            ->where('profil_pegawai.user_id', $user_id)
            ->get();

        $user_id = auth()->user()->user_id;
        $data_posisijabatan = DB::table('posisi_jabatan')
            ->select('posisi_jabatan.*', 'posisi_jabatan.jabatan')
            ->where('posisi_jabatan.user_id', $user_id)
            ->get();

        $userList = DB::table('profil_pegawai')
            ->join('users', 'profil_pegawai.user_id', 'users.user_id')
            ->join('posisi_jabatan', 'profil_pegawai.user_id', 'posisi_jabatan.user_id')
            ->select(
                'users.*',
                'users.role_name',
                'profil_pegawai.nip',
                'profil_pegawai.tempat_lahir',
                'profil_pegawai.tanggal_lahir',
                'profil_pegawai.tingkat_pendidikan',
                'posisi_jabatan.jabatan'
            )
            ->where('role_name', '=', 'User')
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

        return view('layanan.perpanjang-kontrak-admin', compact(
            'unreadNotifications',
            'readNotifications',
            'data_perpanjang_kontrak',
            'userList',
            'data_profilpegawai',
            'data_posisijabatan',
            'data_perpanjang_pdf'
        ));
    }

    /** Tampilan Pencarian Perpanjangan Kontrak Admin */
    public function filterPerpanjangKontrakAdmin(Request $request)
    {
        $name = $request->input('name');
        $nip = $request->input('nip');

        $data_perpanjang_kontrak = DB::table('kontrak_kerja')
        ->select(
            'kontrak_kerja.*',
            'kontrak_kerja.user_id',
            'kontrak_kerja.name',
            'kontrak_kerja.nip',
            'kontrak_kerja.tempat_lahir',
            'kontrak_kerja.tanggal_lahir',
            'kontrak_kerja.nik_blud',
            'kontrak_kerja.pendidikan',
            'kontrak_kerja.tahun_lulus',
            'kontrak_kerja.jabatan',
            'kontrak_kerja.mulai_kontrak',
            'kontrak_kerja.akhir_kontrak',
        )
            ->where('kontrak_kerja.name', 'like', '%' . $name . '%')
            ->where('kontrak_kerja.nip', 'like', '%' . $nip . '%')
            ->get();

        $data_perpanjang_pdf = DB::table('kontrak_kerja')
        ->select(
            'kontrak_kerja.*',
            'kontrak_kerja.user_id',
            'kontrak_kerja.name',
            'kontrak_kerja.nip',
            'kontrak_kerja.tempat_lahir',
            'kontrak_kerja.tanggal_lahir',
            'kontrak_kerja.nik_blud',
            'kontrak_kerja.pendidikan',
            'kontrak_kerja.tahun_lulus',
            'kontrak_kerja.jabatan',
            'kontrak_kerja.mulai_kontrak',
            'kontrak_kerja.akhir_kontrak',
        )
            ->whereIn('id', function ($query) {
                $query->select(DB::raw('MAX(id)'))
                ->from('kontrak_kerja')
                ->whereColumn('kontrak_kerja.user_id', 'kontrak_kerja.user_id')
                ->groupBy('kontrak_kerja.user_id');
            })
            ->get();

        $user_id = auth()->user()->user_id;
        $data_profilpegawai = DB::table('profil_pegawai')
        ->select(
            'profil_pegawai.*',
            'profil_pegawai.tempat_lahir',
            'profil_pegawai.tanggal_lahir',
            'profil_pegawai.tingkat_pendidikan',
            'profil_pegawai.name',
            'profil_pegawai.nip'
        )
            ->where('profil_pegawai.user_id', $user_id)
            ->get();

        $user_id = auth()->user()->user_id;
        $data_posisijabatan = DB::table('posisi_jabatan')
        ->select('posisi_jabatan.*', 'posisi_jabatan.jabatan')
        ->where('posisi_jabatan.user_id', $user_id)
            ->get();

        $userList = DB::table('profil_pegawai')
        ->join('users', 'profil_pegawai.user_id', 'users.user_id')
        ->join('posisi_jabatan', 'profil_pegawai.user_id', 'posisi_jabatan.user_id')
        ->select(
            'users.*',
            'users.role_name',
            'profil_pegawai.nip',
            'profil_pegawai.tempat_lahir',
            'profil_pegawai.tanggal_lahir',
            'profil_pegawai.tingkat_pendidikan',
            'posisi_jabatan.jabatan'
        )
            ->where('role_name', '=', 'User')
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

        return view('layanan.perpanjang-kontrak-admin', compact(
            'unreadNotifications',
            'readNotifications',
            'data_perpanjang_kontrak',
            'userList',
            'data_profilpegawai',
            'data_posisijabatan',
            'data_perpanjang_pdf'
        ));
    }
    /** /Tampilan Pencarian Perpanjangan Kontrak Admin */

    /** Tambah Data Perpanjangan Kontrak Pegawai */
    public function tambahDataKontrak(Request $request)
    {
        $request->validate([
            'user_id'               => 'required|string|max:255',
            'name'                  => 'required|string|max:255',
            'nip'                   => 'required|string|max:255',
            'tempat_lahir'          => 'required|string|max:255',
            'tanggal_lahir'         => 'required|string|max:255',
            'nik_blud'              => 'required|string|max:255',
            'pendidikan'            => 'required|string|max:255',
            'tahun_lulus'           => 'required|string|max:255',
            'jabatan'               => 'required|string|max:255',
            'mulai_kontrak'         => 'required|string|max:255',
            'akhir_kontrak'         => 'required|string|max:255',
        ]);
        DB::beginTransaction();

        try {
            $kontrak = new KontrakKerja();
            $kontrak->user_id               = $request->user_id;
            $kontrak->name                  = $request->name;
            $kontrak->nip                   = $request->nip;
            $kontrak->tempat_lahir          = $request->tempat_lahir;
            $kontrak->tanggal_lahir         = $request->tanggal_lahir;
            $kontrak->nik_blud              = $request->nik_blud;
            $kontrak->pendidikan            = $request->pendidikan;
            $kontrak->tahun_lulus           = $request->tahun_lulus;
            $kontrak->jabatan               = $request->jabatan;
            $kontrak->mulai_kontrak         = $request->mulai_kontrak;
            $kontrak->akhir_kontrak         = $request->akhir_kontrak;
            $kontrak->save();

            DB::commit();
            Toastr::success('Data perpanjang kontrak kerja berhasil ditambah :)', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Data perpanjang kontrak kerja gagal ditambah :(', 'Error');
            return redirect()->back();
        }
    }
    /** /Tambah Data Perpanjangan Kontrak Pegawai */

    /** Edit Data Perpanjangan Kontrak Pegawai */
    public function editDataKontrak(Request $request)
    {
        DB::beginTransaction();
        try {
            $update = [
                'nik_blud' => $request->nik_blud,
                'tahun_lulus' => $request->tahun_lulus,
                'mulai_kontrak' => $request->mulai_kontrak,
                'akhir_kontrak' => $request->akhir_kontrak,
            ];

            KontrakKerja::where('id', $request->id)->update($update);

            DB::commit();
            Toastr::success('Data perpanjang kontrak kerja berhasil diperbaharui :)', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Data perpanjang kontrak kerja gagal diperbaharui :(', 'Error');
            return redirect()->back();
        }
    }
    /** /Edit Data Perpanjangan Kontrak Pegawai */

    /** Hapus Data Perpanjangan Kontrak Pegawai */
    public function hapusPerpanjanganKontrak(Request $request)
    {
        DB::beginTransaction();

        try {
            KontrakKerja::where('id', $request->id)->delete();
            DB::commit();
            Toastr::success('Data perpanjangan kontrak berhasil dihapus :)', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Data perpanjangan kontrak gagal dihapus :)', 'Error');
            return redirect()->back();
        }
    }

    /** Tampilan Cetak Perpanjangan Kontrak Admin */
    public function cetakPerpanjanganKontrak($id)
    {
        $perpanjangan = KontrakKerja::find($id);
        $perpanjanganKontrak = $perpanjangan->perpanjangan_kontrak;
        $name = $perpanjanganKontrak ? $perpanjanganKontrak->name : "Tidak Ada Nama";
        $tempat_lahir = $perpanjanganKontrak ? $perpanjanganKontrak->tempat_lahir : "Tidak Ada Tempat Lahir";
        $tanggal_lahir = $perpanjanganKontrak ? $perpanjanganKontrak->tanggal_lahir : "Tidak Ada Tanggal Lahir";
        $nik_blud = $perpanjanganKontrak ? $perpanjanganKontrak->nik_blud : "Tidak Ada NIK Blud";
        $pendidikan = $perpanjanganKontrak ? $perpanjanganKontrak->pendidikan : "Tidak Ada Pendidikan";
        $tahun_lulus = $perpanjanganKontrak ? $perpanjanganKontrak->tahun_lulus : "Tidak Ada Tahun Lulus";
        $jabatan = $perpanjanganKontrak ? $perpanjanganKontrak->jabatan : "Tidak Ada Jabatan";
        $mulai_kontrak = $perpanjanganKontrak ? $perpanjanganKontrak->mulai_kontrak : "Tidak Ada Mulai Kontrak";
        $akhir_kontrak = $perpanjanganKontrak ? $perpanjanganKontrak->akhir_kontrak : "Tidak Ada Akhir Kontrak";

        $pdf = PDF::loadView('pdf.cetak-perpanjangan-kontrak', [
            'perpanjangan' => $perpanjangan,
            'name' => $name,
            'tempat_lahir' => $tempat_lahir,
            'tanggal_lahir' => $tanggal_lahir,
            'nik_blud' => $nik_blud,
            'pendidikan' => $pendidikan,
            'tahun_lulus' => $tahun_lulus,
            'jabatan' => $jabatan,
            'mulai_kontrak' => $mulai_kontrak,
            'akhir_kontrak' => $akhir_kontrak,
        ]);

        return $pdf->stream('cetak-perpanjangan-kontrak-' . $name . '.pdf');
    }
    /** /Tampilan Cetak Perpanjangan Kontrak Admin*/

    /** Tampilan Cetak Perpanjangan Kontrak User */
    public function cetakPerpanjanganKontrak2($id)
    {
        $perpanjangan = KontrakKerja::find($id);
        $perpanjanganKontrak = $perpanjangan->perpanjangan_kontrak;
        $name = $perpanjanganKontrak ? $perpanjanganKontrak->name : "Tidak Ada Nama";
        $tempat_lahir = $perpanjanganKontrak ? $perpanjanganKontrak->tempat_lahir : "Tidak Ada Tempat Lahir";
        $tanggal_lahir = $perpanjanganKontrak ? $perpanjanganKontrak->tanggal_lahir : "Tidak Ada Tanggal Lahir";
        $nik_blud = $perpanjanganKontrak ? $perpanjanganKontrak->nik_blud : "Tidak Ada NIK Blud";
        $pendidikan = $perpanjanganKontrak ? $perpanjanganKontrak->pendidikan : "Tidak Ada Pendidikan";
        $tahun_lulus = $perpanjanganKontrak ? $perpanjanganKontrak->tahun_lulus : "Tidak Ada Tahun Lulus";
        $jabatan = $perpanjanganKontrak ? $perpanjanganKontrak->jabatan : "Tidak Ada Jabatan";
        $mulai_kontrak = $perpanjanganKontrak ? $perpanjanganKontrak->mulai_kontrak : "Tidak Ada Mulai Kontrak";
        $akhir_kontrak = $perpanjanganKontrak ? $perpanjanganKontrak->akhir_kontrak : "Tidak Ada Akhir Kontrak";

        $pdf = PDF::loadView('pdf.cetak-perpanjangan-kontrak', [
            'perpanjangan' => $perpanjangan,
            'name' => $name,
            'tempat_lahir' => $tempat_lahir,
            'tanggal_lahir' => $tanggal_lahir,
            'nik_blud' => $nik_blud,
            'pendidikan' => $pendidikan,
            'tahun_lulus' => $tahun_lulus,
            'jabatan' => $jabatan,
            'mulai_kontrak' => $mulai_kontrak,
            'akhir_kontrak' => $akhir_kontrak,
        ]);

        return $pdf->stream('cetak-perpanjangan-kontrak-' . $name . '.pdf');
    }
    /** /Tampilan Cetak Perpanjangan Kontrak User */

    /** Tampilan Perjanjian Kontrak Admin */
    public function tampilanPerjanjianKontrakAdmin()
    {
        $data_perjanjian_kontrak = DB::table('perjanjian_kontrak')
            ->select(
                'perjanjian_kontrak.*',
                'perjanjian_kontrak.user_id',
                'perjanjian_kontrak.name',
                'perjanjian_kontrak.nip',
                'perjanjian_kontrak.tempat_lahir',
                'perjanjian_kontrak.tanggal_lahir',
                'perjanjian_kontrak.nik_blud',
                'perjanjian_kontrak.pendidikan',
                'perjanjian_kontrak.tahun_lulus',
                'perjanjian_kontrak.jabatan',
                'perjanjian_kontrak.mulai_kontrak',
                'perjanjian_kontrak.akhir_kontrak',
            )
            ->get();

        $data_perjanjian_pdf = DB::table('perjanjian_kontrak')
        ->select(
            'perjanjian_kontrak.*',
            'perjanjian_kontrak.user_id',
            'perjanjian_kontrak.name',
            'perjanjian_kontrak.nip',
            'perjanjian_kontrak.tempat_lahir',
            'perjanjian_kontrak.tanggal_lahir',
            'perjanjian_kontrak.nik_blud',
            'perjanjian_kontrak.pendidikan',
            'perjanjian_kontrak.tahun_lulus',
            'perjanjian_kontrak.jabatan',
            'perjanjian_kontrak.mulai_kontrak',
            'perjanjian_kontrak.akhir_kontrak',
        )
            ->whereIn('id', function ($query) {
                $query->select(DB::raw('MAX(id)'))
                    ->from('perjanjian_kontrak')
                    ->whereColumn('perjanjian_kontrak.user_id', 'perjanjian_kontrak.user_id')
                    ->groupBy('perjanjian_kontrak.user_id');
            })
            ->get();

        $user_id = auth()->user()->user_id;
        $data_profilpegawai = DB::table('profil_pegawai')
            ->select(
                'profil_pegawai.*',
                'profil_pegawai.tempat_lahir',
                'profil_pegawai.tanggal_lahir',
                'profil_pegawai.tingkat_pendidikan',
                'profil_pegawai.name',
                'profil_pegawai.nip'
            )
            ->where('profil_pegawai.user_id', $user_id)
            ->get();

        $user_id = auth()->user()->user_id;
        $data_posisijabatan = DB::table('posisi_jabatan')
            ->select('posisi_jabatan.*', 'posisi_jabatan.jabatan')
            ->where('posisi_jabatan.user_id', $user_id)
            ->get();

        $userList = DB::table('profil_pegawai')
            ->join('users', 'profil_pegawai.user_id', 'users.user_id')
            ->join('posisi_jabatan', 'profil_pegawai.user_id', 'posisi_jabatan.user_id')
            ->select(
                'users.*',
                'users.role_name',
                'profil_pegawai.nip',
                'profil_pegawai.tempat_lahir',
                'profil_pegawai.tanggal_lahir',
                'profil_pegawai.tingkat_pendidikan',
                'posisi_jabatan.jabatan'
            )
            ->where('role_name', '=', 'User')
            ->get();

        $perjanjian = perjanjianKinerja::find(1);

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

        return view('layanan.perjanjian-kontrak-admin', compact(
            'unreadNotifications',
            'readNotifications',
            'data_perjanjian_kontrak',
            'userList',
            'data_profilpegawai',
            'data_posisijabatan', 'data_perjanjian_pdf',
            'perjanjian'
        ));
    }
    /** /Tampilan Perjanjian Kontrak Admin */

    /** Tampilan Pencarian Perjanjian Kontrak Admin */
    public function filterPerjanjianKontrakAdmin(Request $request)
    {
        $name = $request->input('name');
        $nip = $request->input('nip');

        $data_perjanjian_kontrak = DB::table('perjanjian_kontrak')
        ->select(
            'perjanjian_kontrak.*',
            'perjanjian_kontrak.user_id',
            'perjanjian_kontrak.name',
            'perjanjian_kontrak.nip',
            'perjanjian_kontrak.tempat_lahir',
            'perjanjian_kontrak.tanggal_lahir',
            'perjanjian_kontrak.nik_blud',
            'perjanjian_kontrak.pendidikan',
            'perjanjian_kontrak.tahun_lulus',
            'perjanjian_kontrak.jabatan',
            'perjanjian_kontrak.mulai_kontrak',
            'perjanjian_kontrak.akhir_kontrak',
        )
            ->where('perjanjian_kontrak.name', 'like', '%' . $name . '%')
            ->where('perjanjian_kontrak.nip', 'like', '%' . $nip . '%')
        ->get();

        $data_perjanjian_pdf = DB::table('perjanjian_kontrak')
        ->select(
            'perjanjian_kontrak.*',
            'perjanjian_kontrak.user_id',
            'perjanjian_kontrak.name',
            'perjanjian_kontrak.nip',
            'perjanjian_kontrak.tempat_lahir',
            'perjanjian_kontrak.tanggal_lahir',
            'perjanjian_kontrak.nik_blud',
            'perjanjian_kontrak.pendidikan',
            'perjanjian_kontrak.tahun_lulus',
            'perjanjian_kontrak.jabatan',
            'perjanjian_kontrak.mulai_kontrak',
            'perjanjian_kontrak.akhir_kontrak',
        )
        ->whereIn('id', function ($query) {
            $query->select(DB::raw('MAX(id)'))
            ->from('perjanjian_kontrak')
            ->whereColumn('perjanjian_kontrak.user_id', 'perjanjian_kontrak.user_id')
            ->groupBy('perjanjian_kontrak.user_id');
        })
        ->get();

        $user_id = auth()->user()->user_id;
        $data_profilpegawai = DB::table('profil_pegawai')
        ->select(
            'profil_pegawai.*',
            'profil_pegawai.tempat_lahir',
            'profil_pegawai.tanggal_lahir',
            'profil_pegawai.tingkat_pendidikan',
            'profil_pegawai.name',
            'profil_pegawai.nip'
        )
        ->where('profil_pegawai.user_id', $user_id)
        ->get();

        $user_id = auth()->user()->user_id;
        $data_posisijabatan = DB::table('posisi_jabatan')
        ->select('posisi_jabatan.*', 'posisi_jabatan.jabatan')
        ->where('posisi_jabatan.user_id', $user_id)
        ->get();

        $userList = DB::table('profil_pegawai')
        ->join('users', 'profil_pegawai.user_id', 'users.user_id')
        ->join('posisi_jabatan', 'profil_pegawai.user_id', 'posisi_jabatan.user_id')
        ->select(
            'users.*',
            'users.role_name',
            'profil_pegawai.nip',
            'profil_pegawai.tempat_lahir',
            'profil_pegawai.tanggal_lahir',
            'profil_pegawai.tingkat_pendidikan',
            'posisi_jabatan.jabatan'
        )
        ->where('role_name', '=',
            'User'
        )
        ->get();

        $perjanjian = perjanjianKinerja::find(1);

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

        return view('layanan.perjanjian-kontrak-admin', compact(
            'unreadNotifications',
            'readNotifications',
            'data_perjanjian_kontrak',
            'userList',
            'data_profilpegawai',
            'data_posisijabatan',
            'data_perjanjian_pdf',
            'perjanjian'
        ));
    }
    /** /Tampilan Pencarian Perjanjian Kontrak Admin */

    /** Tampilan Perjanjian Kontrak */
    public function tampilanPerjanjianKontrak()
    {
        $user_id = auth()->user()->user_id;
        $data_perjanjian_kontrak = DB::table('perjanjian_kontrak')
            ->select(
                'perjanjian_kontrak.*',
                'perjanjian_kontrak.user_id',
                'perjanjian_kontrak.name',
                'perjanjian_kontrak.nip',
                'perjanjian_kontrak.tempat_lahir',
                'perjanjian_kontrak.tanggal_lahir',
                'perjanjian_kontrak.nik_blud',
                'perjanjian_kontrak.pendidikan',
                'perjanjian_kontrak.tahun_lulus',
                'perjanjian_kontrak.jabatan',
                'perjanjian_kontrak.mulai_kontrak',
                'perjanjian_kontrak.akhir_kontrak',
            )
            ->where('perjanjian_kontrak.user_id', $user_id)
            ->get();

        $user_id = auth()->user()->user_id;
        $data_profilpegawai = DB::table('profil_pegawai')
            ->select(
                'profil_pegawai.*',
                'profil_pegawai.tempat_lahir',
                'profil_pegawai.tanggal_lahir',
                'profil_pegawai.tingkat_pendidikan',
                'profil_pegawai.name',
                'profil_pegawai.nip'
            )
            ->where('profil_pegawai.user_id', $user_id)
            ->get();

        $user_id = auth()->user()->user_id;
        $data_posisijabatan = DB::table('posisi_jabatan')
            ->select('posisi_jabatan.*', 'posisi_jabatan.jabatan')
            ->where('posisi_jabatan.user_id', $user_id)
            ->get();

        $userList = DB::table('profil_pegawai')
            ->join('users', 'profil_pegawai.user_id', 'users.user_id')
            ->select('users.*', 'users.role_name', 'profil_pegawai.nip')
            ->where('role_name', '=', 'User')
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

        return view('layanan.perjanjian-kontrak', compact(
            'unreadNotifications',
            'readNotifications',
            'data_perjanjian_kontrak',
            'userList',
            'data_profilpegawai',
            'data_posisijabatan'
        ));
    }

    /** Tambah Data Perjanjian Kontrak Pegawai */
    public function tambahDataPerjanjianKontrak(Request $request)
    {
        $request->validate([
            'user_id' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'nip' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|string|max:255',
            'nik_blud' => 'required|string|max:255',
            'pendidikan' => 'required|string|max:255',
            'tahun_lulus' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'mulai_kontrak' => 'required|string|max:255',
            'akhir_kontrak' => 'required|string|max:255',
        ]);
        DB::beginTransaction();

        try {
            $perjanjiankontrak = new PerjanjianKontrak();
            $perjanjiankontrak->user_id = $request->user_id;
            $perjanjiankontrak->name = $request->name;
            $perjanjiankontrak->nip = $request->nip;
            $perjanjiankontrak->tempat_lahir = $request->tempat_lahir;
            $perjanjiankontrak->tanggal_lahir = $request->tanggal_lahir;
            $perjanjiankontrak->nik_blud = $request->nik_blud;
            $perjanjiankontrak->pendidikan = $request->pendidikan;
            $perjanjiankontrak->tahun_lulus = $request->tahun_lulus;
            $perjanjiankontrak->jabatan = $request->jabatan;
            $perjanjiankontrak->mulai_kontrak = $request->mulai_kontrak;
            $perjanjiankontrak->akhir_kontrak = $request->akhir_kontrak;
            $perjanjiankontrak->save();

            DB::commit();
            Toastr::success('Data perjanjian kontrak kerja berhasil ditambah :)', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Data perjanjian kontrak kerja gagal ditambah :(', 'Error');
            return redirect()->back();
        }
    }
    /** /Tambah Data Perjanjian Kontrak Pegawai */

    /** Edit Data Perjanjian Kontrak Pegawai */
    public function editDataPerjanjianKontrak(Request $request)
    {
        DB::beginTransaction();
        try {
            $update = [
                'nik_blud' => $request->nik_blud,
                'tahun_lulus' => $request->tahun_lulus,
                'mulai_kontrak' => $request->mulai_kontrak,
                'akhir_kontrak' => $request->akhir_kontrak,
            ];

            PerjanjianKontrak::where('id', $request->id)->update($update);

            DB::commit();
            Toastr::success('Data perjanjian kontrak kerja berhasil diperbaharui :)', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Data perjanjian kontrak kerja gagal diperbaharui :(', 'Error');
            return redirect()->back();
        }
    }
    /** /Edit Data Perjanjian Kontrak Pegawai */

    /** Hapus Data Perjanjian Kontrak Pegawai */
    public function hapusPerjanjianKontrak(Request $request)
    {
        DB::beginTransaction();

        try {
            PerjanjianKontrak::where('id', $request->id)->delete();
            DB::commit();
            Toastr::success('Data perjanjian kontrak berhasil dihapus :)', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Data perjanjian kontrak gagal dihapus :)', 'Error');
            return redirect()->back();
        }
    }

    /** Tampilan Cetak Dokumen Perjanjian Kontrak Admin */
    public function cetakPerjanjianKontrak($id)
    {
        $perjanjian = PerjanjianKontrak::find($id);
        $perjanjianKontrak = $perjanjian->perjanjian_kontrak;
        $name = $perjanjianKontrak ? $perjanjianKontrak->name : "Tidak Ada Nama";
        $tempat_lahir = $perjanjianKontrak ? $perjanjianKontrak->tempat_lahir : "Tidak Ada Tempat Lahir";
        $tanggal_lahir = $perjanjianKontrak ? $perjanjianKontrak->tanggal_lahir : "Tidak Ada Tanggal Lahir";
        $nik_blud = $perjanjianKontrak ? $perjanjianKontrak->nik_blud : "Tidak Ada NIK Blud";
        $pendidikan = $perjanjianKontrak ? $perjanjianKontrak->pendidikan : "Tidak Ada Pendidikan";
        $tahun_lulus = $perjanjianKontrak ? $perjanjianKontrak->tahun_lulus : "Tidak Ada Tahun Lulus";
        $jabatan = $perjanjianKontrak ? $perjanjianKontrak->jabatan : "Tidak Ada Jabatan";

        $pdf = PDF::loadView('pdf.cetak-perjanjian-kontrak', [
            'perjanjian' => $perjanjian,
            'name' => $name,
            'tempat_lahir' => $tempat_lahir,
            'tanggal_lahir' => $tanggal_lahir,
            'nik_blud' => $nik_blud,
            'pendidikan' => $pendidikan,
            'tahun_lulus' => $tahun_lulus,
            'jabatan' => $jabatan,
        ]);

        return $pdf->stream('cetak-perjanjian-kontrak-' . $name . '.pdf');
    }
    /** /Tampilan Cetak Dokumen Perjanjian Kontrak Admin */

    /** Tampilan Cetak Dokumen Perjanjian Kontrak User */
    public function cetakPerjanjianKontrak2($id)
    {
        $perjanjian = PerjanjianKontrak::find($id);
        $perjanjianKontrak = $perjanjian->perjanjian_kontrak;
        $name = $perjanjianKontrak ? $perjanjianKontrak->name : "Tidak Ada Nama";
        $tempat_lahir = $perjanjianKontrak ? $perjanjianKontrak->tempat_lahir : "Tidak Ada Tempat Lahir";
        $tanggal_lahir = $perjanjianKontrak ? $perjanjianKontrak->tanggal_lahir : "Tidak Ada Tanggal Lahir";
        $nik_blud = $perjanjianKontrak ? $perjanjianKontrak->nik_blud : "Tidak Ada NIK Blud";
        $pendidikan = $perjanjianKontrak ? $perjanjianKontrak->pendidikan : "Tidak Ada Pendidikan";
        $tahun_lulus = $perjanjianKontrak ? $perjanjianKontrak->tahun_lulus : "Tidak Ada Tahun Lulus";
        $jabatan = $perjanjianKontrak ? $perjanjianKontrak->jabatan : "Tidak Ada Jabatan";

        $pdf = PDF::loadView('pdf.cetak-perjanjian-kontrak', [
            'perjanjian' => $perjanjian,
            'name' => $name,
            'tempat_lahir' => $tempat_lahir,
            'tanggal_lahir' => $tanggal_lahir,
            'nik_blud' => $nik_blud,
            'pendidikan' => $pendidikan,
            'tahun_lulus' => $tahun_lulus,
            'jabatan' => $jabatan,
        ]);

        return $pdf->stream('cetak-perjanjian-kontrak-' . $name . '.pdf');
    }
    /** /Tampilan Cetak Dokumen Perjanjian Kontrak User */

    public function tampilanPetaJabatan()
    {
        $peta_jabatan_pdf = DB::table('peta_jabatan')
            ->select('peta_jabatan.*', 'peta_jabatan.id', 'peta_jabatan.pdf_peta')
            ->get();

        $peta_jabatan_animasi = DB::table('profil_pegawai')
            ->join('users', 'profil_pegawai.user_id', 'users.user_id')
            ->join('posisi_jabatan', 'profil_pegawai.user_id', 'posisi_jabatan.user_id')
            ->select('profil_pegawai.*', 'profil_pegawai.name', 'posisi_jabatan.jabatan', 'users.avatar')
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

        return view('layanan.peta-jabatan', compact('peta_jabatan_pdf', 'peta_jabatan_animasi', 'unreadNotifications', 'readNotifications'));
    }

    /** Daftar Layanan STR Admin */
    public function tampilanSTRAdmin()
    {
        $data_str = DB::table('surat_tanda_registrasi')
            ->select(
                'surat_tanda_registrasi.*',
                'surat_tanda_registrasi.user_id',
                'surat_tanda_registrasi.name',
                'surat_tanda_registrasi.nip',
                'surat_tanda_registrasi.nomor_reg',
                'surat_tanda_registrasi.tempat_lahir',
                'surat_tanda_registrasi.tanggal_lahir',
                'surat_tanda_registrasi.jenis_kelamin',
                'surat_tanda_registrasi.nomor_ijazah',
                'surat_tanda_registrasi.tanggal_lulus',
                'surat_tanda_registrasi.pendidikan_terakhir',
                'surat_tanda_registrasi.kompetensi',
                'surat_tanda_registrasi.no_sertifikat_kompetensi',
                'surat_tanda_registrasi.tgl_berlaku_str',
                'surat_tanda_registrasi.dokumen_str'
            )
            ->get();

        $userList = DB::table('profil_pegawai')
            ->join('users', 'profil_pegawai.user_id', 'users.user_id')
            ->join('posisi_jabatan', 'profil_pegawai.user_id', 'posisi_jabatan.user_id')
            ->select(
                'users.*',
                'users.role_name',
                'profil_pegawai.nip',
                'profil_pegawai.tempat_lahir',
                'profil_pegawai.tanggal_lahir',
                'profil_pegawai.jenis_kelamin',
                'profil_pegawai.tingkat_pendidikan',
                'profil_pegawai.pendidikan_terakhir',
                'posisi_jabatan.jabatan'
            )
            ->where('role_name', '=', 'User')
            ->get();

        $user_id = auth()->user()->user_id;
        $data_profil_str = DB::table('profil_pegawai')
            ->select('profil_pegawai.*', 'profil_pegawai.name', 'profil_pegawai.tempat_lahir', 'profil_pegawai.tanggal_lahir', 'profil_pegawai.jenis_kelamin', 'profil_pegawai.tingkat_pendidikan', 'profil_pegawai.pendidikan_terakhir')
            ->where('profil_pegawai.user_id', $user_id)
            ->get();

        $user_id = auth()->user()->user_id;
        $data_posisijabatan = DB::table('posisi_jabatan')
            ->select('posisi_jabatan.*', 'posisi_jabatan.jabatan')
            ->where('posisi_jabatan.user_id', $user_id)
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

        return view('layanan.surat-tanda-registrasi-admin', compact(
            'data_str',
            'data_profil_str',
            'data_posisijabatan',
            'unreadNotifications',
            'readNotifications',
            'userList'
        ));
    }
    /** /Daftar Layanan STR Admin */

    /** Tampilan Pencarian Layanan STR Admin */
    public function filterSTRAdmin(Request $request)
    {
        $name = $request->input('name');
        $nip = $request->input('nip');

        $data_str = DB::table('surat_tanda_registrasi')
        ->select(
            'surat_tanda_registrasi.*',
            'surat_tanda_registrasi.user_id',
            'surat_tanda_registrasi.name',
            'surat_tanda_registrasi.nip',
            'surat_tanda_registrasi.nomor_reg',
            'surat_tanda_registrasi.tempat_lahir',
            'surat_tanda_registrasi.tanggal_lahir',
            'surat_tanda_registrasi.jenis_kelamin',
            'surat_tanda_registrasi.nomor_ijazah',
            'surat_tanda_registrasi.tanggal_lulus',
            'surat_tanda_registrasi.pendidikan_terakhir',
            'surat_tanda_registrasi.kompetensi',
            'surat_tanda_registrasi.no_sertifikat_kompetensi',
            'surat_tanda_registrasi.tgl_berlaku_str',
            'surat_tanda_registrasi.dokumen_str'
        )
            ->where('surat_tanda_registrasi.name', 'like', '%' . $name . '%')
            ->where('surat_tanda_registrasi.nip', 'like', '%' . $nip . '%')
            ->get();

        $userList = DB::table('profil_pegawai')
        ->join('users', 'profil_pegawai.user_id', 'users.user_id')
        ->join('posisi_jabatan', 'profil_pegawai.user_id', 'posisi_jabatan.user_id')
        ->select(
            'users.*',
            'users.role_name',
            'profil_pegawai.nip',
            'profil_pegawai.tempat_lahir',
            'profil_pegawai.tanggal_lahir',
            'profil_pegawai.jenis_kelamin',
            'profil_pegawai.tingkat_pendidikan',
            'profil_pegawai.pendidikan_terakhir',
            'posisi_jabatan.jabatan'
        )
            ->where('role_name', '=', 'User')
            ->get();

        $user_id = auth()->user()->user_id;
        $data_profil_str = DB::table('profil_pegawai')
        ->select('profil_pegawai.*', 'profil_pegawai.name', 'profil_pegawai.tempat_lahir', 'profil_pegawai.tanggal_lahir', 'profil_pegawai.jenis_kelamin', 'profil_pegawai.tingkat_pendidikan', 'profil_pegawai.pendidikan_terakhir')
        ->where('profil_pegawai.user_id', $user_id)
            ->get();

        $user_id = auth()->user()->user_id;
        $data_posisijabatan = DB::table('posisi_jabatan')
        ->select('posisi_jabatan.*', 'posisi_jabatan.jabatan')
        ->where('posisi_jabatan.user_id', $user_id)
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

        return view('layanan.surat-tanda-registrasi-admin', compact(
            'data_str',
            'data_profil_str',
            'data_posisijabatan',
            'unreadNotifications',
            'readNotifications',
            'userList'
        ));
    }
    /** /Tampilan Pencarian Layanan STR Admin */

    /** Daftar Layanan STR */
    public function tampilanSTR()
    {
        $user_id = auth()->user()->user_id;
        $data_str = DB::table('surat_tanda_registrasi')
        ->select(
            'surat_tanda_registrasi.*',
            'surat_tanda_registrasi.user_id',
            'surat_tanda_registrasi.name',
            'surat_tanda_registrasi.nip',
            'surat_tanda_registrasi.nomor_reg',
            'surat_tanda_registrasi.tempat_lahir',
            'surat_tanda_registrasi.tanggal_lahir',
            'surat_tanda_registrasi.jenis_kelamin',
            'surat_tanda_registrasi.nomor_ijazah',
            'surat_tanda_registrasi.tanggal_lulus',
            'surat_tanda_registrasi.pendidikan_terakhir',
            'surat_tanda_registrasi.kompetensi',
            'surat_tanda_registrasi.no_sertifikat_kompetensi',
            'surat_tanda_registrasi.tgl_berlaku_str',
            'surat_tanda_registrasi.dokumen_str'
        )
            ->where('surat_tanda_registrasi.user_id', $user_id)
            ->get();

        $userList = DB::table('profil_pegawai')
        ->join('users', 'profil_pegawai.user_id', 'users.user_id')
        ->join('posisi_jabatan', 'profil_pegawai.user_id', 'posisi_jabatan.user_id')
        ->select(
            'users.*',
            'users.role_name',
            'profil_pegawai.nip',
            'profil_pegawai.tempat_lahir',
            'profil_pegawai.tanggal_lahir',
            'profil_pegawai.jenis_kelamin',
            'profil_pegawai.tingkat_pendidikan',
            'profil_pegawai.pendidikan_terakhir',
        )
            ->where('role_name', '=', 'User')
            ->get();

        $user_id = auth()->user()->user_id;
        $data_profil_str = DB::table('profil_pegawai')
        ->select('profil_pegawai.*', 'profil_pegawai.name', 'profil_pegawai.tempat_lahir', 'profil_pegawai.tanggal_lahir', 'profil_pegawai.jenis_kelamin', 'profil_pegawai.tingkat_pendidikan', 'profil_pegawai.pendidikan_terakhir')
        ->where('profil_pegawai.user_id', $user_id)
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

        return view('layanan.surat-tanda-registrasi', compact(
            'data_str',
            'data_profil_str',
            'unreadNotifications',
            'readNotifications',
            'userList'
        ));
    }
    /** /Daftar Layanan STR */

    /** Tambah Data STR Pegawai */
    public function tambahDataSTR(Request $request)
    {
        $request->validate([
            'name'                      => 'required|string|max:255',
            'nip'                       => 'required|string|max:255',
            'user_id'                   => 'required|string|max:255',
            'tempat_lahir'              => 'required|string|max:255',
            'tanggal_lahir'             => 'required|date',
            'jenis_kelamin'             => 'required|string|max:255',
            'pendidikan_terakhir'       => 'required|string|max:255',
            'nomor_reg'                 => 'required|string|max:255',
            'nomor_ijazah'              => 'required|string|max:255',
            'tanggal_lulus'             => 'required|date',
            'kompetensi'                => 'required|string|max:255',
            'no_sertifikat_kompetensi'  => 'required|string|max:255',
            'tgl_berlaku_str'           => 'required|date',
            'dokumen_str'               => 'required|mimes:pdf|max:5120',
        ]);

        DB::beginTransaction();
        try {
            $dokumen_str = time() . '.' . $request->dokumen_str->extension();
            $request->dokumen_str->move(public_path('assets/DokumenSTR'), $dokumen_str);

            $suratregistrasi = new SuratTandaRegistrasi();
            $suratregistrasi->name                      = $request->name;
            $suratregistrasi->nip                       = $request->nip;
            $suratregistrasi->user_id                   = $request->user_id;
            $suratregistrasi->tempat_lahir              = $request->tempat_lahir;
            $suratregistrasi->tanggal_lahir             = $request->tanggal_lahir;
            $suratregistrasi->jenis_kelamin             = $request->jenis_kelamin;
            $suratregistrasi->pendidikan_terakhir       = $request->pendidikan_terakhir;
            $suratregistrasi->nomor_reg                 = $request->nomor_reg;
            $suratregistrasi->nomor_ijazah              = $request->nomor_ijazah;
            $suratregistrasi->tanggal_lulus             = $request->tanggal_lulus;
            $suratregistrasi->kompetensi                = $request->kompetensi;
            $suratregistrasi->no_sertifikat_kompetensi  = $request->no_sertifikat_kompetensi;
            $suratregistrasi->tgl_berlaku_str           = $request->tgl_berlaku_str;
            $suratregistrasi->dokumen_str               = $dokumen_str;
            $suratregistrasi->save();

            DB::commit();
            Toastr::success('Data surat tanda registrasi berhasil ditambah :)', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Data surat tanda registrasi gagal ditambah: ' . $e->getMessage(), 'Error');
            return redirect()->back();
        }
    }

    /** /Tambah Data STR Pegawai */

    /** Edit Data STR Pegawai */
    public function editDataSTR(Request $request)
    {
        DB::beginTransaction();
        try {
            $dokumen_str = $request->hidden_dokumen_str;
            $dokumen_strs = $request->file('dokumen_str');

            if ($dokumen_strs != '') {
                $request->validate([
                    'dokumen_str' => 'mimes:pdf|max:5120',
                ]);

                if ($dokumen_str && file_exists(public_path('assets/DokumenSTR/' . $dokumen_str))) {
                    unlink(public_path('assets/DokumenSTR/' . $dokumen_str));
                }

                $dokumen_str = time() . '.' . $dokumen_strs->getClientOriginalExtension();
                $dokumen_strs->move(public_path('assets/DokumenSTR'), $dokumen_str);
            } else {
                $dokumen_str;
            }

            $update = [
                'nomor_reg' => $request->nomor_reg,
                'tanggal_lulus' => $request->tanggal_lulus,
                'kompetensi' => $request->kompetensi,
                'no_sertifikat_kompetensi' => $request->no_sertifikat_kompetensi,
                'nomor_ijazah' => $request->nomor_ijazah,
                'tgl_berlaku_str' => $request->tgl_berlaku_str,
                'dokumen_str' => $dokumen_str,
            ];

            SuratTandaRegistrasi::where('id', $request->id)->update($update);

            DB::commit();
            Toastr::success('Data surat tanda registrasi berhasil diperbaharui :)', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Data surat tanda registrasi gagal diperbaharui: ' . $e->getMessage(), 'Error');
            return redirect()->back();
        }
    }
    /** /Edit Data STR Pegawai */

    /** Delete Data STR */
    public function hapusDataSTR(Request $request)
    {
        DB::beginTransaction();
        try {
            SuratTandaRegistrasi::destroy($request->id);
            DB::commit();
            Toastr::success('Data surat tanda registrasi berhasil dihapus :)', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Data surat tanda registrasi gagal dihapus :(', 'Error');
            return redirect()->back();
        }
    }
    /** End Delete Data STR */

    //Tampilan Perjanjian Kinerja Admin
    public function TampilanPerjanjianKinerjaAdmin()
    {
        $data_perjanjian_kinerja = DB::table('perjanjian_kinerja')
        ->select(
            'perjanjian_kinerja.*',
            'perjanjian_kinerja.user_id',
            'perjanjian_kinerja.name',
            'perjanjian_kinerja.nip',
            'perjanjian_kinerja.jabatan',
            'perjanjian_kinerja.bentuk_perjanjian',
        )
        ->get();

        $data_kinerja_pdf = DB::table('perjanjian_kinerja')
        ->select(
            'perjanjian_kinerja.*',
            'perjanjian_kinerja.user_id',
            'perjanjian_kinerja.name',
            'perjanjian_kinerja.nip',
            'perjanjian_kinerja.jabatan',
            'perjanjian_kinerja.bentuk_perjanjian',
        )
            ->whereIn('id', function ($query) {
                $query->select(DB::raw('MAX(id)'))
                ->from('perjanjian_kinerja')
                ->whereColumn('perjanjian_kinerja.user_id', 'perjanjian_kinerja.user_id')
                ->groupBy('perjanjian_kinerja.user_id');
            })
            ->get();

        $user_id = auth()->user()->user_id;
        $data_profilpegawai = DB::table('profil_pegawai')
        ->select(
            'profil_pegawai.*',
            'profil_pegawai.name',
            'profil_pegawai.nip'
        )
            ->where('profil_pegawai.user_id', $user_id)
            ->get();

        $user_id = auth()->user()->user_id;
        $data_posisijabatan = DB::table('posisi_jabatan')
        ->select('posisi_jabatan.*','posisi_jabatan.jabatan')
        ->where('posisi_jabatan.user_id', $user_id)
        ->get();

        $userList = DB::table('profil_pegawai')
        ->join('users', 'profil_pegawai.user_id', 'users.user_id')
        ->join('posisi_jabatan', 'profil_pegawai.user_id', 'posisi_jabatan.user_id')
        ->select(
            'users.*',
            'users.role_name',
            'profil_pegawai.nip',
            'posisi_jabatan.jabatan'
        )
        ->where('role_name', '=', 'User')
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

        return view('layanan.perjanjian-kinerja-admin', compact(
            'unreadNotifications',
            'readNotifications',
            'data_perjanjian_kinerja',
            'userList',
            'data_profilpegawai',
            'data_posisijabatan',
            'data_kinerja_pdf'
        ));
    }

    /** Tampilan Pencarian Perjanjian Kinerja Admin */
    public function filterPerjanjianKinerjaAdmin(Request $request)
    {
        $name = $request->input('name');
        $nip = $request->input('nip');

        $data_perjanjian_kinerja = DB::table('perjanjian_kinerja')
        ->select(
            'perjanjian_kinerja.*',
            'perjanjian_kinerja.user_id',
            'perjanjian_kinerja.name',
            'perjanjian_kinerja.nip',
            'perjanjian_kinerja.jabatan',
            'perjanjian_kinerja.bentuk_perjanjian',
        )
            ->where('perjanjian_kinerja.name', 'like', '%' . $name . '%')
            ->where('perjanjian_kinerja.nip', 'like', '%' . $nip . '%')
        ->get();

        $data_kinerja_pdf = DB::table('perjanjian_kinerja')
        ->select(
            'perjanjian_kinerja.*',
            'perjanjian_kinerja.user_id',
            'perjanjian_kinerja.name',
            'perjanjian_kinerja.nip',
            'perjanjian_kinerja.jabatan',
            'perjanjian_kinerja.bentuk_perjanjian',
        )
        ->whereIn('id', function ($query) {
            $query->select(DB::raw('MAX(id)'))
            ->from('perjanjian_kinerja')
            ->whereColumn('perjanjian_kinerja.user_id', 'perjanjian_kinerja.user_id')
            ->groupBy('perjanjian_kinerja.user_id');
        })
        ->get();

        $user_id = auth()->user()->user_id;
        $data_profilpegawai = DB::table('profil_pegawai')
        ->select(
            'profil_pegawai.*',
            'profil_pegawai.name',
            'profil_pegawai.nip'
        )
        ->where('profil_pegawai.user_id', $user_id)
        ->get();

        $user_id = auth()->user()->user_id;
        $data_posisijabatan = DB::table('posisi_jabatan')
        ->select('posisi_jabatan.*', 'posisi_jabatan.jabatan')
        ->where('posisi_jabatan.user_id', $user_id)
        ->get();

        $userList = DB::table('profil_pegawai')
        ->join('users', 'profil_pegawai.user_id', 'users.user_id')
        ->join('posisi_jabatan', 'profil_pegawai.user_id', 'posisi_jabatan.user_id')
        ->select(
            'users.*',
            'users.role_name',
            'profil_pegawai.nip',
            'posisi_jabatan.jabatan'
        )
        ->where('role_name', '=', 'User')
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

        return view('layanan.perjanjian-kinerja-admin', compact(
            'unreadNotifications',
            'readNotifications',
            'data_perjanjian_kinerja',
            'userList',
            'data_profilpegawai',
            'data_posisijabatan',
            'data_kinerja_pdf'
        ));
    }
    /** /Tampilan Pencarian Perjanjian Kinerja Admin */

    //Tampilan Perjanjian Kinerja
    public function TampilanPerjanjianKinerja()
    {
        $user_id = auth()->user()->user_id;
        $data_perjanjian_kinerja = DB::table('perjanjian_kinerja')
        ->select(
            'perjanjian_kinerja.*',
            'perjanjian_kinerja.user_id',
            'perjanjian_kinerja.name',
            'perjanjian_kinerja.nip',
            'perjanjian_kinerja.jabatan',
            'perjanjian_kinerja.bentuk_perjanjian',
        )
            ->where('perjanjian_kinerja.user_id', $user_id)
            ->get();

        $data_kinerja_pdf = DB::table('perjanjian_kinerja')
        ->select(
            'perjanjian_kinerja.*',
            'perjanjian_kinerja.user_id',
            'perjanjian_kinerja.name',
            'perjanjian_kinerja.nip',
            'perjanjian_kinerja.jabatan',
            'perjanjian_kinerja.bentuk_perjanjian',
        )
            ->whereIn('id', function ($query) {
                $query->select(DB::raw('MAX(id)'))
                ->from('perjanjian_kinerja')
                ->whereColumn('perjanjian_kinerja.user_id', 'perjanjian_kinerja.user_id')
                ->groupBy('perjanjian_kinerja.user_id');
            })
            ->get();

        $user_id = auth()->user()->user_id;
        $data_profilpegawai = DB::table('profil_pegawai')
        ->select(
            'profil_pegawai.*',
            'profil_pegawai.name',
            'profil_pegawai.nip'
        )
            ->where('profil_pegawai.user_id', $user_id)
            ->get();

        $user_id = auth()->user()->user_id;
        $data_posisijabatan = DB::table('posisi_jabatan')
        ->select('posisi_jabatan.*', 'posisi_jabatan.jabatan')
        ->where('posisi_jabatan.user_id', $user_id)
            ->get();

        $userList = DB::table('profil_pegawai')
        ->join('users', 'profil_pegawai.user_id', 'users.user_id')
        ->join('posisi_jabatan', 'profil_pegawai.user_id', 'posisi_jabatan.user_id')
        ->select(
            'users.*',
            'users.role_name',
            'profil_pegawai.nip',
            'posisi_jabatan.jabatan'
        )
            ->where('role_name', '=', 'User')
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

        return view('layanan.perjanjian-kinerja', compact(
            'unreadNotifications',
            'readNotifications',
            'data_perjanjian_kinerja',
            'userList',
            'data_profilpegawai',
            'data_posisijabatan',
            'data_kinerja_pdf'
        ));
    }

    /** Tambah Data Perjanjian Kiinerja */
    public function tambahDataPerjanjianKinerja(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'nip' => 'required|string|max:255',
            'user_id' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'bentuk_perjanjian' => 'required|string|max:255',
        ]);

        DB::beginTransaction();
        try {
            $perjanjiankinerja = new perjanjianKinerja();
            $perjanjiankinerja->name                      = $request->name;
            $perjanjiankinerja->nip                       = $request->nip;
            $perjanjiankinerja->user_id                   = $request->user_id;
            $perjanjiankinerja->jabatan                   = $request->jabatan;
            $perjanjiankinerja->bentuk_perjanjian         = $request->bentuk_perjanjian;
            $perjanjiankinerja->save();

            DB::commit();
            Toastr::success('Data perjanjian kinerja berhasil ditambah :)', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Data perjanjian kinerja gagal ditambah: ' . $e->getMessage(), 'Error');
            return redirect()->back();
        }
    }

    /** Edit Data PerjanjianKinerja Pegawai */
    public function editDataPerjanjianKinerja(Request $request)
    {
        DB::beginTransaction();
        try {
            $update = [
                'bentuk_perjanjian' => $request->bentuk_perjanjian,
            ];

            perjanjianKinerja::where('id', $request->id)->update($update);

            DB::commit();
            Toastr::success('Data perjanjian kinerja berhasil diperbaharui :)', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Data perjanjian kinerja gagal diperbaharui :(', 'Error');
            return redirect()->back();
        }
    }

    /** Delete Perjanjian Kinerja STR */
    public function hapusDataPerjanjianKinerja(Request $request)
    {
        DB::beginTransaction();
        try {
            perjanjianKinerja::destroy($request->id);
            DB::commit();
            Toastr::success('Data perjanjian kinerja berhasil dihapus :)', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Data perjanjian kinerja gagal dihapus :(', 'Error');
            return redirect()->back();
        }
    }

    /** Cetak Perjanjian Kinerja Admin */
    public function cetakPerjanjianKinerja($id)
    {
        $kinerja = PerjanjianKinerja::find($id);
        $perjanjianKinerja = $kinerja->perjanjian_kinerja;
        $name = $perjanjianKinerja ? $perjanjianKinerja->name : "Tidak Ada Nama";
        $nip = $perjanjianKinerja ? $perjanjianKinerja->nip : "Tidak Ada NIP";
        $jabatan = $perjanjianKinerja ? $perjanjianKinerja->jabatan : "Tidak Ada Jabatan";
        $bentuk_perjanjian = $perjanjianKinerja ? $perjanjianKinerja->bentuk_perjanjian : "Tidak Ada Bentuk Perjanjian";

        $pdf = PDF::loadView('pdf.cetak-perjanjian-kinerja', [
            'kinerja' => $kinerja,
            'name' => $name,
            'nip' => $nip,
            'jabatan' => $jabatan,
            'bentuk_perjanjian' => $bentuk_perjanjian
        ]);

        return $pdf->stream('cetak-perjanjian-kinerja-' . $kinerja->name . '.pdf');
    }
    /** End Cetak Perjanjian Kinerja Admin */

    /** Cetak Perjanjian Kinerja User */
    public function cetakPerjanjianKinerja2($id)
    {
        $kinerja = PerjanjianKinerja::find($id);
        $perjanjianKinerja = $kinerja->perjanjian_kinerja;
        $name = $perjanjianKinerja ? $perjanjianKinerja->name : "Tidak Ada Nama";
        $nip = $perjanjianKinerja ? $perjanjianKinerja->nip : "Tidak Ada NIP";
        $jabatan = $perjanjianKinerja ? $perjanjianKinerja->jabatan : "Tidak Ada Jabatan";
        $bentuk_perjanjian = $perjanjianKinerja ? $perjanjianKinerja->bentuk_perjanjian : "Tidak Ada Bentuk Perjanjian";

        $pdf = PDF::loadView('pdf.cetak-perjanjian-kinerja', [
            'kinerja' => $kinerja,
            'name' => $name,
            'nip' => $nip,
            'jabatan' => $jabatan,
            'bentuk_perjanjian' => $bentuk_perjanjian
        ]);

        return $pdf->stream('cetak-perjanjian-kinerja-' . $kinerja->name . '.pdf');
    }
    /** End Cetak Perjanjian Kinerja User */

    /** Search Pegawai List Kepala Ruangan */
    public function pencarianPegawaiKepalaRuanganList(Request $request)
{
    $name = $request->input('name');
    $nip = $request->input('nip');

    $data_ruangan = User::where('role_name', 'User')
        ->join('profil_pegawai', 'users.user_id', '=', 'profil_pegawai.user_id')
        ->join('posisi_jabatan', 'users.user_id', '=', 'posisi_jabatan.user_id')
        ->where('users.ruangan', auth()->user()->ruangan)
        ->where(function ($query) use ($name, $nip) {
            $query->where('profil_pegawai.name', 'like', '%' . $name . '%')
                  ->where('profil_pegawai.nip', 'like', '%' . $nip . '%');
        })
        ->get();

    $unreadNotifications = Notification::where('notifiable_id', auth()->user()->id)
        ->where('notifiable_type', get_class(auth()->user()))
        ->whereNull('read_at')
        ->get();

    $readNotifications = Notification::where('notifiable_id', auth()->user()->id)
        ->where('notifiable_type', get_class(auth()->user()))
        ->whereNotNull('read_at')
        ->get();

    return view('employees.dataruanganlist', compact(
        'data_ruangan',
        'unreadNotifications',
        'readNotifications',
    ));
}
    /** /Search Pegawai List Kepala Ruangan */

    /** Search Pegawai Card Kepala Ruangan */
    public function pencarianPegawaiKepalaRuanganCard(Request $request)
    {
        $name = $request->input('name');
        $nip = $request->input('nip');

        $data_ruangan = User::where('role_name', 'User')
        ->join('profil_pegawai', 'users.user_id', '=', 'profil_pegawai.user_id')
        ->join('posisi_jabatan', 'users.user_id', '=', 'posisi_jabatan.user_id')
        ->where('users.ruangan', auth()->user()->ruangan)
            ->where(function ($query) use ($name, $nip) {
                $query->where('profil_pegawai.name', 'like', '%' . $name . '%')
                    ->where('profil_pegawai.nip', 'like', '%' . $nip . '%');
            })
            ->get();

        $unreadNotifications = Notification::where('notifiable_id', auth()->user()->id)
            ->where('notifiable_type', get_class(auth()->user()))
            ->whereNull('read_at')
            ->get();

        $readNotifications = Notification::where('notifiable_id', auth()->user()->id)
            ->where('notifiable_type', get_class(auth()->user()))
            ->whereNotNull('read_at')
            ->get();

        return view('employees.dataruangancard', compact(
            'data_ruangan',
            'unreadNotifications',
            'readNotifications',
        ));
    }
    /** /Search Pegawai Card Kepala Ruangan */
}
