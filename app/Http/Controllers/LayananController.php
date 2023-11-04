<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\LayananCuti;
use App\Models\Notification;
use App\Models\PosisiJabatan;
use App\Models\KenaikanGajiBerkala;
use App\Models\KontrakKerja;
use App\Models\PerjanjianKontrak;
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
            
        return view('layanan.layanan-cuti', compact('data_cuti', 'data_profilcuti', 'data_cuti_pdf',
            'unreadNotifications', 'readNotifications', 'sisaCutiThisYear', 'sisaCutiLastYear', 'sisaCutiTwoYearsAgo'));
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

        $userList = DB::table('profil_pegawai')
            ->join('users','profil_pegawai.user_id','users.user_id')
            ->select('users.*','users.role_name', 'profil_pegawai.nip')
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

        return view('layanan.layanan-cuti-admin', compact('data_cuti', 'data_cuti_pdf', 'userList',
            'unreadNotifications','readNotifications', 'sisaCutiThisYear', 'sisaCutiLastYear', 'sisaCutiTwoYearsAgo'));
    }
    /** /Daftar Layanan Cuti Admin */

    /** Daftar Layanan Cuti Super Admin */
    public function tampilanCutiPegawaiKepalaRuangan()
    {
        // $data_cuti = DB::table('cuti')
        //     ->select(
        //         'cuti.*',
        //         'cuti.user_id',
        //         'cuti.name',
        //         'cuti.nip',
        //         'cuti.jenis_cuti',
        //         'cuti.lama_cuti',
        //         'cuti.tanggal_mulai_cuti',
        //         'cuti.tanggal_selesai_cuti',
        //         'cuti.dokumen_kelengkapan',
        //         'cuti.status_pengajuan'
        //     )
        //     ->get();

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

        $userList = DB::table('profil_pegawai')
            ->join('users','profil_pegawai.user_id','users.user_id')
            ->select('users.*','users.role_name', 'profil_pegawai.nip')
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

        $superAdmin = User::where('role_name', 'Kepala Ruang Pinus')->first();
        if ($superAdmin) {
            $data_cuti = User::where('role_name', 'User')
                ->join('cuti','users.user_id','cuti.user_id')
                ->where('ruangan', $superAdmin->ruangan)
                ->get();
        
        return view('layanan.layanan-cuti-kepala-ruangan', [
            'data_cuti' => $data_cuti,
            'data_cuti_pdf' => $data_cuti_pdf,
            'userList' => $userList,
            'unreadNotifications' => $unreadNotifications,
            'readNotifications' => $readNotifications,
            'sisaCutiThisYear' => $sisaCutiThisYear,
            'sisaCutiLastYear' => $sisaCutiLastYear,
            'sisaCutiTwoYearsAgo' => $sisaCutiTwoYearsAgo,
            ]);
            
        } else {
            return view('layanan.layanan-cuti-kepala-ruangan', ['data_cuti' => []]);
        }

        // return view('layanan.layanan-cuti-kepala-ruangan', compact('data_cuti', 'data_cuti_pdf', 'userList',
        //     'unreadNotifications','readNotifications', 'sisaCutiThisYear', 'sisaCutiLastYear', 'sisaCutiTwoYearsAgo'));
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

        return view('layanan.layanan-cuti', compact('pencarianDataCuti', 'data_cuti', 'data_profilcuti',
            'unreadNotifications', 'readNotifications', 'sisaCutiThisYear', 'sisaCutiLastYear', 'sisaCutiTwoYearsAgo'));
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
        
        return view('layanan.layanan-cuti-admin', compact('data_cuti', 'userList', 'data_cuti_pdf',
            'unreadNotifications', 'readNotifications', 'sisaCutiThisYear', 'sisaCutiLastYear', 'sisaCutiTwoYearsAgo'));
    }
    /** /Search Layanan Cuti Admin */

    /** Search Layanan Cuti Super Admin */
    public function pencarianLayananCutiKepalaRuangan(Request $request)
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
        
        return view('layanan.layanan-cuti-kepala-ruangan', compact('data_cuti', 'userList', 'data_cuti_pdf',
            'unreadNotifications', 'readNotifications', 'sisaCutiThisYear', 'sisaCutiLastYear', 'sisaCutiTwoYearsAgo'));
    }
    /** /Search Layanan Cuti Super Admin */

    /** Tampilan Update Status Perhomonan */
    public function updateStatus(Request $request, $id)
    {
        $resource = LayananCuti::find($id);

        if($request->has('status_pengajuan')) {
            $resource->status_pengajuan = $request->input('status_pengajuan');
        }

        if($request->has('persetujuan_administrasi')) {
            $resource->persetujuan_administrasi = $request->input('persetujuan_administrasi');
        }

        if($request->has('persetujuan_eselon3')) {
            $resource->persetujuan_eselon3 = $request->input('persetujuan_eselon3');
        }

        if($request->has('persetujuan_eselon4')) {
            $resource->persetujuan_eselon4 = $request->input('persetujuan_eselon4');
        }

        if($request->has('persetujuan_kepalaruangan')) {
            $resource->persetujuan_kepalaruangan = $request->input('persetujuan_kepalaruangan');
        }

        $resource->save();
        Toastr::success('Data status pengajuan berhasil diperbaharui :)', 'Success');
        return redirect()->back();
    }
    /** /Tampilan Update Status Perhomonan */

    /** Tampilan Cetak Dokumen Rekomendasi */
    public function cetakDokumenRekomendasi()
    {
        // Ambil semua ID yang ingin Anda cetak
        $lastLayananCutiId = LayananCuti::latest('id')->first()->id;
            $cuti = LayananCuti::find($lastLayananCutiId);
            $profilPegawai = $cuti->profil_pegawai;
            $nip = $profilPegawai ? $profilPegawai->nip : "Tidak Ada NIP";
            $name = $profilPegawai ? $profilPegawai->name : "Tidak Ada Nama";
            $jenis_cuti = $profilPegawai ? $profilPegawai->jenis_cuti : "Tidak Ada Jenis Cuti";

        $lastPosisiJabatanId = PosisiJabatan::latest('id')->first()->id;
            $posisi = PosisiJabatan::find($lastPosisiJabatanId);
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

    /** Tampilan Cetak Dokumen Kelengkapan */
    public function cetakDokumenKelengkapan()
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
        $lastLayananCutiId = LayananCuti::latest('id')->first()->id;
            $cuti = LayananCuti::find($lastLayananCutiId);
            $profilPegawai = $cuti->profil_pegawai;
            $nip = $profilPegawai ? $profilPegawai->nip : "Tidak Ada NIP";
            $name = $profilPegawai ? $profilPegawai->name : "Tidak Ada Nama";

        $lastPosisiJabatanId = PosisiJabatan::latest('id')->first()->id;
            $posisi = PosisiJabatan::find($lastPosisiJabatanId);
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

    /** Tampilan Cetak Dokumen Kelengkapan Super Admin */
    public function cetakDokumenKelengkapanKepalaRuangan()
    {
        // Ambil semua ID yang ingin Anda cetak
        $lastLayananCutiId = LayananCuti::latest('id')->first()->id;
            $cuti = LayananCuti::find($lastLayananCutiId);
            $profilPegawai = $cuti->profil_pegawai;
            $nip = $profilPegawai ? $profilPegawai->nip : "Tidak Ada NIP";
            $name = $profilPegawai ? $profilPegawai->name : "Tidak Ada Nama";

        $lastPosisiJabatanId = PosisiJabatan::latest('id')->first()->id;
            $posisi = PosisiJabatan::find($lastPosisiJabatanId);
                $posisiJabatan = $posisi->posisi_jabatan;
                $jabatan = $posisiJabatan ? $posisiJabatan->jabatan : "Tidak Ada Jabatan";
                $gol_ruang_awal = $posisiJabatan ? $posisiJabatan->gol_ruang_awal : "Tidak Ada Golongan";

            $pdf = PDF::loadView('pdf.kelengkapan-cuti-super-admin', [
                'cuti' => $cuti,
                'posisi' => $posisi,
                'nip' => $nip,
                'name' => $name,
                'jabatan' => $jabatan,
                'gol_ruang_awal' => $gol_ruang_awal
            ]);

            return $pdf->stream('kelengkapan-cuti-super-admin-' . $cuti->name . '.pdf');
        // $nama_file = 'surat-cuti-' . $name . '.pdf';

        // // Simpan atau tampilkan (stream) PDF, tergantung pada kebutuhan Anda
        // // $pdf->save(public_path('pdf/' . $nama_file));
        // $pdf->stream($nama_file);
        // }
    }
    /** /Tampilan Cetak Dokumen Kelengkapan Super Admin */

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
            ->select('kenaikan_gaji_berkala.*', 'kenaikan_gaji_berkala.user_id', 'kenaikan_gaji_berkala.name',
                'kenaikan_gaji_berkala.nip', 'kenaikan_gaji_berkala.golongan_awal', 'kenaikan_gaji_berkala.golongan_akhir', 'kenaikan_gaji_berkala.gapok_lama',
                'kenaikan_gaji_berkala.gapok_baru', 'kenaikan_gaji_berkala.tgl_sk_kgb', 'kenaikan_gaji_berkala.no_sk_kgb', 'kenaikan_gaji_berkala.tgl_berlaku',
                'kenaikan_gaji_berkala.masa_kerja_golongan', 'kenaikan_gaji_berkala.masa_kerja', 'kenaikan_gaji_berkala.tmt_kgb')
            ->whereIn('id', function ($query)
            {
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

        return view('layanan.kenaikan-gaji-berkala-admin', compact('data_kgb', 'userList', 'unreadNotifications',
            'readNotifications', 'data_kgb_pdf'));
    }
    /** /Tampilan Kenaikan Gaji Berkala */

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
        ->where('kenaikan_gaji_berkala.user_id', $user_id)
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

        return view('layanan.kenaikan-gaji-berkala', compact('unreadNotifications', 'readNotifications', 'data_kgb', 'userList'));
    }

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

    /** Cetak Kenaikan Gaji Berkala PDF */
    public function cetakKGB($id)
    {
        // Ambil semua ID yang ingin Anda cetak
        $lastKGBId = KenaikanGajiBerkala::latest('id')->first()->id;
            $kgb = KenaikanGajiBerkala::find($lastKGBId);
            $kenaikanGaji = $kgb->kenaikan_gaji;
            $nip = $kenaikanGaji ? $kenaikanGaji->nip :"Tidak Ada NIP";
            $name = $kenaikanGaji ? $kenaikanGaji->name : "Tidak Ada Nama";
            $golongan_awal = $kenaikanGaji ? $kenaikanGaji-> golongan_awal : "Tidak Ada Golongan Awal" ;
            $golongan_akhir = $kenaikanGaji ? $kenaikanGaji-> golongan_akhir : "Tidak Ada Golongan Akhir";
            $gapok_lama = $kenaikanGaji ? $kenaikanGaji-> gapok_lama : "Tidak Ada Gaji Pokok Lama";
            $gapok_baru = $kenaikanGaji ? $kenaikanGaji-> gapok_baru : "Tidak Ada Gaji Pokok Baru";
            $tgl_sk_kgb = $kenaikanGaji ? $kenaikanGaji->tgl_sk_kgb : "Tidak Ada Tanggal SK";
            $no_sk_kgb = $kenaikanGaji ? $kenaikanGaji->no_sk_kgb : "Tidak Ada Nomr SK";
            $tgl_berlaku = $kenaikanGaji ? $kenaikanGaji->tgl_berlaku : "Tidak Ada Tanggal Berlaku";
            $masa_kerja_golongan = $kenaikanGaji ? $kenaikanGaji-> masa_kerja_golongan : "Tidak Ada Masa Kerja Golongan";
            $masa_kerja = $kenaikanGaji ? $kenaikanGaji->masa_kerja : "Tidak Ada Masa Kerja";
            $tmt_kgb = $kenaikanGaji ? $kenaikanGaji->tmt_kgb : "Tidak Ada TMT";

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
    /** /Cetak Kenaikan Gaji Berkala PDF */

    /** Tampilan Perpanjangan Kontrak */
    public function tampilanPerpanjangKontrak()
    {
        $user_id = auth()->user()->user_id;
        $data_kontrak = DB::table('kontrak_kerja')
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
        )
        ->where('kontrak_kerja.user_id', $user_id)
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

        return view('layanan.perpanjang-kontrak', compact('data_kontrak', 'userList', 'unreadNotifications', 'readNotifications'));
    }
    /** /Tampilan Perpanjangan Kontrak */

    /** Tampilan Perpanjangan Kontrak */
    public function tampilanPerpanjangKontrakAdmin()
    {
        $data_kontrak = DB::table('kontrak_kerja')
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
        )
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

        return view('layanan.perpanjang-kontrak-admin', compact('data_kontrak', 'userList', 'unreadNotifications', 'readNotifications'));
    }

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
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'nik_blud' => $request->nik_blud,
                'pendidikan' => $request->pendidikan,
                'tahun_lulus' => $request->tahun_lulus,
                'jabatan' => $request->jabatan,
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

    /** Tampilan Cetak Perpanjangan Kontrak */
    public function cetakPerpanjanganKontrak()
    {
        // Ambil semua ID yang ingin Anda cetak
        $lastPerpanjanganId = KontrakKerja::latest('id')->first()->id;
            $perpanjangan = KontrakKerja::find($lastPerpanjanganId);
            $perpanjanganKontrak = $perpanjangan->perpanjangan_kontrak;
            $name = $perpanjanganKontrak ? $perpanjanganKontrak->name : "Tidak Ada Nama";
            $tempat_lahir = $perpanjanganKontrak ? $perpanjanganKontrak->tempat_lahir : "Tidak Ada Tempat Lahir";
            $tanggal_lahir = $perpanjanganKontrak ? $perpanjanganKontrak->tanggal_lahir : "Tidak Ada Tanggal Lahir";
            $nik_blud = $perpanjanganKontrak ? $perpanjanganKontrak->nik_blud : "Tidak Ada NIK";
            $pendidikan = $perpanjanganKontrak ? $perpanjanganKontrak->pendidikan : "Tidak Ada Pendidikan";
            $tahun_lulus = $perpanjanganKontrak ? $perpanjanganKontrak->tahun_lulus : "Tidak Ada Tahun Lulus";
            $jabatan = $perpanjanganKontrak ? $perpanjanganKontrak->jabatan : "Tidak Ada Jabatan";

        $pdf = PDF::loadView('pdf.cetak-perpanjangan-kontrak', [
            'perpanjangan' => $perpanjangan,
            'name' => $name,
            'tempat_lahir' => $tempat_lahir,
            'tanggal_lahir' => $tanggal_lahir,
            'nik_blud' => $nik_blud,
            'pendidikan' => $pendidikan,
            'tahun_lulus' => $tahun_lulus,
            'jabatan' => $jabatan,
        ]);

        return $pdf->stream('cetak-perpanjangan-kontrak-' . $perpanjangan->name . '.pdf');
        // $nama_file = 'surat-cuti-' . $name . '.pdf';

        // // Simpan atau tampilkan (stream) PDF, tergantung pada kebutuhan Anda
        // // $pdf->save(public_path('pdf/' . $nama_file));
        // $pdf->stream($nama_file);
        // }
    }
    /** /Tampilan Cetak Perpanjangan Kontrak */

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
            'perjanjian_kontrak.tgl_kontrak',
        )
        ->get();

        $user_id = auth()->user()->user_id;
        $data_profilpegawai = DB::table('profil_pegawai')
            ->select('profil_pegawai.*', 'profil_pegawai.tempat_lahir', 'profil_pegawai.tanggal_lahir',
                'profil_pegawai.tingkat_pendidikan', 'profil_pegawai.name', 'profil_pegawai.nip')
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
        ->select('users.*', 'users.role_name', 'profil_pegawai.nip', 'profil_pegawai.tempat_lahir',
            'profil_pegawai.tanggal_lahir', 'profil_pegawai.tingkat_pendidikan', 'posisi_jabatan.jabatan')
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

        return view('layanan.perjanjian-kontrak-admin', compact('unreadNotifications', 'readNotifications',
            'data_perjanjian_kontrak', 'userList', 'data_profilpegawai', 'data_posisijabatan'));
    }
    /** /Tampilan Kenaikan Gaji Berkala */

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
            'perjanjian_kontrak.tgl_kontrak',
        )
        ->where('perjanjian_kontrak.user_id', $user_id)
        ->get();

        $user_id = auth()->user()->user_id;
        $data_profilpegawai = DB::table('profil_pegawai')
            ->select('profil_pegawai.*', 'profil_pegawai.tempat_lahir', 'profil_pegawai.tanggal_lahir',
                'profil_pegawai.tingkat_pendidikan', 'profil_pegawai.name', 'profil_pegawai.nip')
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

        return view('layanan.perjanjian-kontrak', compact('unreadNotifications', 'readNotifications',
            'data_perjanjian_kontrak', 'userList', 'data_profilpegawai', 'data_posisijabatan'));
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
            'tgl_kontrak' => 'required|string|max:255',
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
            $perjanjiankontrak->tgl_kontrak = $request->tgl_kontrak;
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
                'tgl_kontrak' => $request->tgl_kontrak,
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

    /** Tampilan Cetak Dokumen Kelengkapan */
    public function cetakPerjanjianKontrak()
    {
        // Ambil semua ID yang ingin Anda cetak
        $lastPerjanjianId = PerjanjianKontrak::latest('id')->first()->id;
            $perjanjian = PerjanjianKontrak::find($lastPerjanjianId);
            $perjanjianKontrak = $perjanjian->perjanjian_kontrak;
            $name = $perjanjianKontrak ? $perjanjianKontrak->name : "Tidak Ada Nama";
            $tempat_lahir = $perjanjianKontrak ? $perjanjianKontrak->tempat_lahir : "Tidak Ada Tempat Lahir";
            $tanggal_lahir = $perjanjianKontrak ? $perjanjianKontrak->tanggal_lahir : "Tidak Ada Tanggal Lahir";
            $nik_blud = $perjanjianKontrak ? $perjanjianKontrak->nik_blud : "Tidak Ada NIK";
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

            return $pdf->stream('cetak-perjanjian-kontrak-' . $perjanjian->name . '.pdf');
        // $nama_file = 'surat-cuti-' . $name . '.pdf';

        // // Simpan atau tampilkan (stream) PDF, tergantung pada kebutuhan Anda
        // // $pdf->save(public_path('pdf/' . $nama_file));
        // $pdf->stream($nama_file);
        // }
    }
    /** /Tampilan Cetak Dokumen Kelengkapan */

    public function tampilanPetaJabatan()
    {
        $result_peta_jabatan = DB::table('peta_jabatan')
            ->select('peta_jabatan.*', 'peta_jabatan.id', 'peta_jabatan.pdf_peta')
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

        return view('layanan.peta-jabatan', compact('unreadNotifications', 'readNotifications', 'result_peta_jabatan'));
    }
}
