<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\User;
use App\Models\Employee;
use App\Models\Form;
use App\Models\ProfileInformation;
use App\Models\RiwayatDiklat;
use App\Models\RiwayatGolongan;
use App\Models\RiwayatJabatan;
use App\Models\RiwayatPendidikan;
use App\Models\ProfilPegawai;
use App\Models\PosisiJabatan;
use App\Models\PersonalInformation;
use App\Rules\MatchOldPassword;
use App\Models\UserEmergencyContact;
use App\Models\Notification;
use App\Models\Province;
use App\Models\Regency;
use App\Models\District;
use App\Models\RiwayatAnak;
use App\Models\RiwayatAngkaKredit;
use App\Models\RiwayatHukumanDisiplin;
use App\Models\RiwayatOrangTua;
use App\Models\RiwayatOrganisasi;
use App\Models\RiwayatPasangan;
use App\Models\RiwayatPenghargaan;
use App\Models\RiwayatPMK;
use App\Models\Village;
use App\Notifications\UlangTahunNotification;
use Carbon\Carbon;
use Session;
use Auth;
use Hash;
use DB;

class UserManagementController extends Controller
{
    /** index page */
    public function index()
    {
        if (Session::get('role_name') == 'Admin') {
            $result      = DB::table('users')->get();
            $role_name   = DB::table('role_type_users')->get();
            $status_user = DB::table('user_types')->get();

            $user_id = auth()->user()->user_id;
            $result_tema = DB::table('users')
                ->select('users.*', 'users.tema_aplikasi')
                ->where('users.user_id', $user_id)
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

            return view('usermanagement.user_control', compact('result', 'role_name', 'status_user',
                'unreadNotifications', 'readNotifications', 'result_tema'));

        } else if (Session::get('role_name') == 'Super Admin') {
            $result      = DB::table('users')->get();
            $role_name   = DB::table('role_type_users')->get();
            $status_user = DB::table('user_types')->get();

            $user_id = auth()->user()->user_id;
            $result_tema = DB::table('users')
                ->select('users.*', 'users.tema_aplikasi')
                ->where('users.user_id', $user_id)
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

            return view('usermanagement.user_control', compact('result', 'role_name', 'status_user',
                'unreadNotifications', 'readNotifications', 'result_tema'));
        } else {
            return redirect()->route('home');
        }
    }

    /** get list data and search */
    public function getUsersData(Request $request)
    {
        $draw            = $request->get('draw');
        $start           = $request->get("start");
        $rowPerPage      = $request->get("length"); // total number of rows per page
        $columnIndex_arr = $request->get('order');
        $columnName_arr  = $request->get('columns');
        $order_arr       = $request->get('order');
        $search_arr      = $request->get('search');

        $columnIndex     = $columnIndex_arr[0]['column']; // Column index
        $columnName      = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc
        $searchValue     = $search_arr['value']; // Search value

        $users =  DB::table('users');
        $totalRecords = $users->count();

        $user_name   = $request->user_name;
        $type_role   = $request->type_role;
        $type_status = $request->type_status;

        /** search for name */
        if (!empty($user_name)) {
            $users->when($user_name,function ($query) use ($user_name) {
                $query->where('name','LIKE','%'.$user_name.'%');
            });
        }

        /** search for type_role */
        if (!empty($type_role)) {
            $users->when($type_role, function ($query) use ($type_role) {
                $query->where('role_name',$type_role);
            });
        }

        /** search for status */
        if (!empty($type_status)) {
            $users->when($type_status, function ($query) use ($type_status) {
                $query->where('status',$type_status);
            });
        }

        $totalRecordsWithFilter = $users->where(function ($query) use ($searchValue) {
            $query->where('name', 'like', '%' . $searchValue . '%');
            $query->orWhere('user_id', 'like', '%' . $searchValue . '%');
            $query->orWhere('email', 'like', '%' . $searchValue . '%');
            $query->orWhere('nip', 'like', '%' . $searchValue . '%');
            $query->orWhere('no_dokumen', 'like', '%' . $searchValue . '%');
            $query->orWhere('join_date', 'like', '%' . $searchValue . '%');
            $query->orWhere('role_name', 'like', '%' . $searchValue . '%');
            $query->orWhere('status', 'like', '%' . $searchValue . '%');
        })->count();

        if ($columnName == 'user_id') {
            $columnName = 'user_id';
        }
        $records = $users->orderBy($columnName, $columnSortOrder)
            ->where(function ($query) use ($searchValue) {
                $query->where('name', 'like', '%' . $searchValue . '%');
                $query->orWhere('user_id', 'like', '%' . $searchValue . '%');
                $query->orWhere('email', 'like', '%' . $searchValue . '%');
                $query->orWhere('nip', 'like', '%' . $searchValue . '%');
                $query->orWhere('no_dokumen', 'like', '%' . $searchValue . '%');
                $query->orWhere('join_date', 'like', '%' . $searchValue . '%');
                $query->orWhere('role_name', 'like', '%' . $searchValue . '%');
                $query->orWhere('status', 'like', '%' . $searchValue . '%');
            })
            ->skip($start)
            ->take($rowPerPage)
            ->get();
        $data_arr = [];
        foreach ($records as $key => $record) {
            $record->name = '<h2 class="table-avatar"><a href="'.url('user/profile/' . $record->user_id).'" class="name">'.'<img class="avatar" data-avatar='.$record->avatar.' src="'.url('/assets/images/'.$record->avatar).'">' .$record->name.'</a></h2>';
            if ($record->role_name == 'Admin') { /** color role name */
                $role_name = '<span class="badge bg-inverse-danger role_name">'.$record->role_name.'</span>';
            } elseif ($record->role_name == 'Super Admin') {
                $role_name = '<span class="badge bg-inverse-warning role_name">'.$record->role_name.'</span>';
            } elseif ($record->role_name == 'User') {
                $role_name = '<span class="badge bg-inverse-info role_name">'.$record->role_name.'</span>';
            } elseif ($record->role_name == 'Kepala Ruang') {
                $role_name = '<span class="badge bg-inverse-success role_name">'.$record->role_name.'</span>'; 
            } else {
                $role_name = 'NULL'; /** null role name */
            }
            
            /** status */
            $full_status = '
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item"><i class="fa fa-dot-circle-o text-success" style="color: #55ce63 !important;"></i> Active </a>
                    <a class="dropdown-item"><i class="fa fa-dot-circle-o text-warning" style="color: #ffbc34 !important;"></i> Inactive </a>
                    <a class="dropdown-item"><i class="fa fa-dot-circle-o text-danger" style="color: #f62d51 !important;"></i> Disable </a>
                </div>
            ';

            if ($record->status == 'Active') {
                $status = '
                    <a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-dot-circle-o text-success" style="color: #55ce63 !important;"></i>
                        <span class="status_s">'.$record->status.'</span>
                    </a>
                    '.$full_status.'
                ';
            } elseif ($record->status == 'Inactive') {
                $status = '
                    <a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-dot-circle-o text-info" style="color: #ffbc34 !important;"></i>
                        <span class="status_s">'.$record->status.'</span>
                    </a>
                    '.$full_status.'
                ';
            } elseif ($record->status == 'Disable') {
                $status = '
                    <a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-dot-circle-o text-danger" style="color: #f62d51 !important;"></i>
                        <span class="status_s">'.$record->status.'</span>
                    </a>
                    '.$full_status.'
                ';
            } else {
                $status = '
                    <a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-dot-circle-o text-dark"></i>
                        <span class="statuss">'.$record->status.'</span>
                    </a>
                    '.$full_status.'
                ';
            }

            $joinDate = Carbon::parse($record->join_date)->translatedFormat('l, j F Y || h:i A');
            $data_arr [] = [
                "no"           => '<span class="id" data-id = '.$record->id.'>'.$start + ($key + 1).'</span>',
                "name"         => $record->name,
                "user_id"      => '<span class="user_id">'.$record->user_id.'</span>',
                "email"        => '<a href="mailto:' . $record->email . '"><span class="email">' . $record->email . '</span></a>',
                "nip"     => '<span class="nip">'.$record->nip.'</span>',
                "no_dokumen" => '<span class="no_dokumen">'.$record->no_dokumen.'</span>',
                "join_date"    => $joinDate,
                "role_name"    => $role_name,
                "status"       => $status,
                "action"       =>
                '
                <td>
                    <div class="dropdown dropdown-action">
                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            <i class="material-icons">more_vert</i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a href="#" class="dropdown-item userUpdate" data-toggle="modal" data-id="'.$record->id.'" data-target="#edit_user">
                                <i class="fa fa-pencil m-r-5"></i> Edit
                            </a>
                        </div>
                    </div>
                </td>
                ',
            ];
        }
        $response = [
            "draw"                 => intval($draw),
            "iTotalRecords"        => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordsWithFilter,
            "aaData"               => $data_arr
        ];
        return response()->json($response);
    }

    // Function untuk hapus data pengguna
    // <a class="dropdown-item userDelete" data-toggle="modal" data-id="' . $record->id . '" data-target="#delete_user"><i class="fa fa-trash-o m-r-5"></i> Delete</a>

    /** use activity log */
    public function activityLog()
    {
        $user_id = auth()->user()->user_id;
        $result_tema = DB::table('users')
            ->select('users.*', 'users.tema_aplikasi')
            ->where('users.user_id', $user_id)
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
        
        $activityLog = DB::table('user_activity_logs')->get();
        return view('usermanagement.user_activity_log', compact('activityLog', 'unreadNotifications', 'readNotifications', 'result_tema'));
    }

    /** activity log */
    public function activityLogInLogOut()
    {
        $user_id = auth()->user()->user_id;
        $result_tema = DB::table('users')
            ->select('users.*', 'users.tema_aplikasi')
            ->where('users.user_id', $user_id)
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

        $activityLog = DB::table('activity_logs')->get();
        return view('usermanagement.activity_log', compact('activityLog', 'unreadNotifications', 'readNotifications', 'result_tema'));
    }

    /** profile admin */
    public function admin_profile()
    {
        $profile = Session::get('user_id');
        $user = DB::table('users')->get();
        $employees = DB::table('profile_information')->where('user_id', $profile)->first();
        $pendidikanterakhirOptions = DB::table('pendidikan_id')->pluck('pendidikan', 'pendidikan');
        $agamaOptions = DB::table('agama_id')->pluck('agama', 'agama');
        $ruanganOptions = DB::table('ruangan_id')->pluck('ruangan', 'ruangan');

        $user_id = auth()->user()->user_id;
        $result_tema = DB::table('users')
            ->select('users.*', 'users.tema_aplikasi')
            ->where('users.user_id', $user_id)
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

        if (empty($employees)) {
            $information = DB::table('profile_information')->where('user_id', $profile)->first();
            $propeg = DB::table('profil_pegawai')->where('user_id', $profile)->first();
            $posjab = DB::table('posisi_jabatan')->where('user_id', $profile)->first();
            return view('usermanagement.profile_user', compact('information', 'user', 'propeg', 'posjab', 'agamaOptions',
                'pendidikanterakhirOptions', 'unreadNotifications', 'readNotifications', 'ruanganOptions', 'result_tema'));
        } else {
            $user_id = $employees->user_id;
            if ($user_id == $profile) {
                $information = DB::table('profile_information')->where('user_id', $profile)->first();
                $propeg = DB::table('profil_pegawai')->where('user_id', $profile)->first();
                $posjab = DB::table('posisi_jabatan')->where('user_id', $profile)->first();
                return view('usermanagement.profile_user', compact('information', 'user', 'propeg', 'posjab', 'agamaOptions',
                    'pendidikanterakhirOptions', 'unreadNotifications', 'readNotifications', 'ruanganOptions', 'result_tema'));
            } else {
                $information = ProfileInformation::all();
                $propeg = ProfilPegawai::all();
                $posjab = PosisiJabatan::all();
                return view('usermanagement.profile_user', compact('information', 'user', 'propeg', 'posjab', 'agamaOptions',
                    'pendidikanterakhirOptions', 'unreadNotifications', 'readNotifications', 'ruanganOptions', 'result_tema'));
            }
        }
    }

    /** profile super admin */
    public function superadmin_profile()
    {
        $profile = Session::get('user_id');
        $user = DB::table('users')->get();
        $employees = DB::table('profile_information')->where('user_id', $profile)->first();
        $pendidikanterakhirOptions = DB::table('pendidikan_id')->pluck('pendidikan', 'pendidikan');
        $agamaOptions = DB::table('agama_id')->pluck('agama', 'agama');
        $ruanganOptions = DB::table('ruangan_id')->pluck('ruangan', 'ruangan');

        $user_id = auth()->user()->user_id;
        $result_tema = DB::table('users')
            ->select('users.*', 'users.tema_aplikasi')
            ->where('users.user_id', $user_id)
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

        if (empty($employees)) {
            $information = DB::table('profile_information')->where('user_id', $profile)->first();
            $propeg = DB::table('profil_pegawai')->where('user_id', $profile)->first();
            $posjab = DB::table('posisi_jabatan')->where('user_id', $profile)->first();
            return view('usermanagement.profile_user', compact('information', 'user', 'propeg', 'posjab', 'agamaOptions',
                'pendidikanterakhirOptions', 'unreadNotifications', 'readNotifications', 'ruanganOptions', 'result_tema'));
        } else {
            $user_id = $employees->user_id;
            if ($user_id == $profile) {
                $information = DB::table('profile_information')->where('user_id', $profile)->first();
                $propeg = DB::table('profil_pegawai')->where('user_id', $profile)->first();
                $posjab = DB::table('posisi_jabatan')->where('user_id', $profile)->first();
                return view('usermanagement.profile_user', compact('information', 'user', 'propeg', 'posjab', 'agamaOptions',
                    'pendidikanterakhirOptions', 'unreadNotifications', 'readNotifications', 'ruanganOptions', 'result_tema'));
            } else {
                $information = ProfileInformation::all();
                $propeg = ProfilPegawai::all();
                $posjab = PosisiJabatan::all();
                return view('usermanagement.profile_user', compact('information', 'user', 'propeg', 'posjab', 'agamaOptions',
                    'pendidikanterakhirOptions', 'unreadNotifications', 'readNotifications', 'ruanganOptions', 'result_tema'));
            }
        }
    }

    public function kepalaruangan_profile()
    {
        $profile = Session::get('user_id');
        $user = DB::table('users')->get();
        $employees = DB::table('profile_information')->where('user_id', $profile)->first();
        $pendidikanterakhirOptions = DB::table('pendidikan_id')->pluck('pendidikan', 'pendidikan');
        $agamaOptions = DB::table('agama_id')->pluck('agama', 'agama');
        $ruanganOptions = DB::table('ruangan_id')->pluck('ruangan', 'ruangan');

        $user_id = auth()->user()->user_id;
        $result_tema = DB::table('users')
            ->select('users.*', 'users.tema_aplikasi')
            ->where('users.user_id', $user_id)
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

        if (empty($employees)) {
            $information = DB::table('profile_information')->where('user_id', $profile)->first();
            $propeg = DB::table('profil_pegawai')->where('user_id', $profile)->first();
            $posjab = DB::table('posisi_jabatan')->where('user_id', $profile)->first();
            return view('usermanagement.profile_user', compact('information', 'user', 'propeg', 'posjab', 'agamaOptions',
                'pendidikanterakhirOptions', 'unreadNotifications', 'readNotifications', 'ruanganOptions', 'result_tema'));
        } else {
            $user_id = $employees->user_id;
            if ($user_id == $profile) {
                $information = DB::table('profile_information')->where('user_id', $profile)->first();
                $propeg = DB::table('profil_pegawai')->where('user_id', $profile)->first();
                $posjab = DB::table('posisi_jabatan')->where('user_id', $profile)->first();
                return view('usermanagement.profile_user', compact('information', 'user', 'propeg', 'posjab', 'agamaOptions',
                    'pendidikanterakhirOptions', 'unreadNotifications', 'readNotifications', 'ruanganOptions', 'result_tema'));
            } else {
                $information = ProfileInformation::all();
                $propeg = ProfilPegawai::all();
                $posjab = PosisiJabatan::all();
                return view('usermanagement.profile_user', compact('information', 'user', 'propeg', 'posjab', 'agamaOptions',
                    'pendidikanterakhirOptions', 'unreadNotifications', 'readNotifications', 'ruanganOptions', 'result_tema'));
            }
        }
    }

    /** profile user */
    public function user_profile()
    {
        $provinces = Province::all();
        $profile = Session::get('user_id');
        $user = DB::table('users')->get();
        $employees = DB::table('profile_information')->where('user_id', $profile)->first();
        $result_profilpegawai = ProfilPegawai::where('user_id', $profile)->first();

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

        $datapmk = Session::get('user_id');
        $riwayatPMK = RiwayatPMK::where('user_id', $datapmk)->get();

        $dataAK = Session::get('user_id');
        $riwayatAK = RiwayatAngkaKredit::where('user_id', $dataAK)->get();

        $dataOrtu = Session::get('user_id');
        $riwayatOrtu = RiwayatOrangTua::where('user_id', $dataOrtu)->get();

        $dataAnak = Session::get('user_id');
        $riwayatPasangan = RiwayatPasangan::where('user_id', $dataAnak)->get();

        $dataAnak = Session::get('user_id');
        $riwayatAnak = RiwayatAnak::where('user_id', $dataAnak)->get();

        $dataPenghargaan = Session::get('user_id');
        $riwayatPenghargaan = RiwayatPenghargaan::where('user_id', $dataPenghargaan)->get();

        $dataOrganisasi = Session::get('user_id');
        $riwayatOrganisasi = RiwayatOrganisasi::where('user_id', $dataOrganisasi)->get();

        $dataHD = Session::get('user_id');
        $riwayatHD = RiwayatHukumanDisiplin::where('user_id', $dataHD)->get();

        $user_id = auth()->user()->user_id;
        $result_tema = DB::table('users')
            ->select('users.*', 'users.tema_aplikasi')
            ->where('users.user_id', $user_id)
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

        $result_posisijabatan = PosisiJabatan::where('user_id', Session::get('user_id'))->first();
        $datauser = Session::get('user_id');
        $sqluser = User::where('user_id', $datauser)->get();
        $datapendidikan = Session::get('user_id');
        $riwayatPendidikan = RiwayatPendidikan::where('user_id', $datapendidikan)->get();
        $datagolongan = Session::get('user_id');
        $riwayatGolongan = RiwayatGolongan::where('user_id', $datagolongan)->get();
        $datajabatan = Session::get('user_id');
        $riwayatJabatan = RiwayatJabatan::where('user_id', $datajabatan)->get();
        $datadiklat = Session::get('user_id');
        $riwayatDiklat = RiwayatDiklat::where('user_id', $datadiklat)->get();
        $agamaOptions = DB::table('agama_id')->pluck('agama', 'agama');
        $jenispegawaiOptions = DB::table('jenis_pegawai_id')->pluck('jenis_pegawai', 'jenis_pegawai');
        $kedudukanOptions = DB::table('kedudukan_hukum_id')->pluck('kedudukan', 'kedudukan');
        $tingkatpendidikanOptions = DB::table('tingkat_pendidikan_id')->pluck('tingkat_pendidikan', 'tingkat_pendidikan');
        $ruanganOptions = DB::table('ruangan_id')->pluck('ruangan', 'ruangan');
        $jenisjabatanOptions = DB::table('jenis_jabatan_id')->pluck('nama', 'nama');
        $golonganOptions = DB::table('golongan_id')->pluck('nama_golongan', 'nama_golongan');
        $jenisdiklatOptions = DB::table('jenis_diklat_id')->pluck('jenis_diklat', 'jenis_diklat');
        $pendidikanterakhirOptions = DB::table('pendidikan_id')->pluck('pendidikan', 'pendidikan');

        if (empty($employees)) {
            $information = DB::table('profile_information')->where('user_id', $profile)->first();
            return view('usermanagement.profile-user', compact('information', 'user', 'result_profilpegawai', 'result_posisijabatan', 'riwayatPendidikan',
                'riwayatGolongan', 'riwayatJabatan', 'riwayatDiklat', 'sqluser', 'agamaOptions',
                'jenispegawaiOptions', 'kedudukanOptions', 'tingkatpendidikanOptions', 'ruanganOptions', 'jenisjabatanOptions',
                'golonganOptions', 'jenisdiklatOptions', 'unreadNotifications', 'readNotifications', 'pendidikanterakhirOptions',
                'provinces', 'data_kgb', 'riwayatPMK', 'riwayatAK', 'riwayatOrtu', 'riwayatPasangan', 'riwayatAnak', 'riwayatPenghargaan',
                'riwayatOrganisasi', 'riwayatHD', 'result_tema'));
        } else {
            $user_id = $employees->user_id;
            if ($user_id == $profile) {
                $information = DB::table('profile_information')->where('user_id', $profile)->first();
                return view('usermanagement.profile-user', compact('information', 'user', 'result_profilpegawai', 'result_posisijabatan', 'riwayatPendidikan',
                    'riwayatGolongan', 'riwayatJabatan', 'riwayatDiklat', 'sqluser', 'agamaOptions',
                    'jenispegawaiOptions', 'kedudukanOptions', 'tingkatpendidikanOptions', 'ruanganOptions', 'jenisjabatanOptions',
                    'golonganOptions', 'jenisdiklatOptions', 'unreadNotifications', 'readNotifications', 'pendidikanterakhirOptions',
                    'provinces', 'data_kgb', 'riwayatPMK', 'riwayatAK', 'riwayatOrtu', 'riwayatPasangan', 'riwayatAnak', 'riwayatPenghargaan',
                    'riwayatOrganisasi', 'riwayatHD', 'result_tema'));
            } else {
                $information = ProfileInformation::all();
                return view('usermanagement.profile-user', compact('information', 'user', 'result_profilpegawai', 'result_posisijabatan', 'riwayatPendidikan',
                    'riwayatGolongan', 'riwayatJabatan', 'riwayatDiklat', 'sqluser', 'agamaOptions',
                    'jenispegawaiOptions', 'kedudukanOptions', 'tingkatpendidikanOptions', 'ruanganOptions', 'jenisjabatanOptions',
                    'golonganOptions', 'jenisdiklatOptions', 'unreadNotifications', 'readNotifications', 'pendidikanterakhirOptions',
                    'provinces', 'data_kgb', 'riwayatPMK', 'riwayatAK','riwayatOrtu', 'riwayatPasangan', 'riwayatAnak', 'riwayatPenghargaan',
                    'riwayatOrganisasi', 'riwayatHD', 'result_tema'));
            }
        }
    }

    public function getkotakabupaten(Request $request)
    {
        $nama_provinsi = $request->nama_provinsi;
        $provinsi = Province::where('name', $nama_provinsi)->first();

        if ($provinsi) {
            $id_provinsi = $provinsi->id;
            $kotakabupatens = Regency::where('province_id', $id_provinsi)->get();

            $option = "<option value='' disabled selected>-- Pilih Kota/Kabupaten --</option>";
            foreach ($kotakabupatens as $kotakabupaten) {
                $option .= "<option value='$kotakabupaten->name'>$kotakabupaten->name</option>";
            }
            echo $option;
        } else {
            echo "<option value='' disabled selected>-- Tidak ada data --</option>";
        }
    }

    public function getkecamatan(Request $request)
    {
        $nama_kotakabupaten = $request->nama_kotakabupaten;
        $kotakabupaten = Regency::where('name', $nama_kotakabupaten)->first();

        if ($kotakabupaten) {
            $id_kotakabupaten = $kotakabupaten->id;
            $kecamatans = District::where('regency_id', $id_kotakabupaten)->get();

            $option = "<option value='' disabled selected>-- Pilih Kecamatan --</option>";
            foreach ($kecamatans as $kecamatan) {
                $option .= "<option value='$kecamatan->name'>$kecamatan->name</option>";
            }
            echo $option;
        } else {
            echo "<option value='' disabled selected>-- Tidak ada data --</option>";
        }
    }

    public function getdesakelurahan(Request $request)
    {
        $nama_kecamatan = $request->nama_kecamatan;
        $kecamatan = District::where('name', $nama_kecamatan)->first();

        if ($kecamatan) {
            $id_kecamatan = $kecamatan->id;
            $desakelurahans = Village::where('district_id', $id_kecamatan)->get();

            $option = "<option value='' disabled selected>-- Pilih Desa/Kelurahan --</option>";
            foreach ($desakelurahans as $desakelurahan) {
                $option .= "<option value='$desakelurahan->name'>$desakelurahan->name</option>";
            }
            echo $option;
        } else {
            echo "<option value='' disabled selected>-- Tidak ada data --</option>";
        }
    }

    /** save profile information */
    public function profileInformation(Request $request)
    {
        try {

            $updateProfil = [
                'pendidikan_terakhir'   => $request->pendidikan_terakhir,
                'agama'                 => $request->agama,
                'jenis_kelamin'         => $request->jk,
                'ruangan'               => $request->ruangan
            ];
            DB::table('profil_pegawai')->where('user_id', $request->user_id)->update($updateProfil);

            $updatePosisi = [
                'jabatan'               => $request->jabatan,
            ];
            DB::table('posisi_jabatan')->where('user_id', $request->user_id)->update($updatePosisi);

            $updateNIPRuangan = [
                'ruangan'               => $request->ruangan,
                'nip'                   => $request->nip,
            ];
            DB::table('users')->where('user_id', $request->user_id)->update($updateNIPRuangan);

            $information = ProfileInformation::updateOrCreate(['user_id' => $request->user_id]);
            $information->name         = $request->name;
            $information->user_id      = $request->user_id;
            $information->email        = $request->email;
            $information->tgl_lahir    = $request->birthDate;
            $information->jk           = $request->jk;
            $information->alamat       = $request->alamat;
            $information->avatar       = $request->avatar;
            $information->tmpt_lahir   = $request->tmpt_lahir;
            $information->save();

            DB::commit();
            Toastr::success('Data profil informasi berhasil diperbaharui ✔', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Data profil informasi gagal diperbaharui ✘', 'Error');
            return redirect()->back();
        }
    }
    /** save profile information */

    /** save profile information */
    public function profileInformation2(Request $request)
    {
        try {

            $updateNIP = [
                'nip'                   => $request->nip,
            ];
            DB::table('users')->where('user_id', $request->user_id)->update($updateNIP);

            $information = ProfileInformation::updateOrCreate(['user_id' => $request->user_id]);
            $information->name         = $request->name;
            $information->user_id      = $request->user_id;
            $information->email        = $request->email;
            $information->tgl_lahir    = $request->birthDate;
            $information->jk           = $request->jk;
            $information->alamat       = $request->alamat;
            $information->avatar       = $request->avatar;
            $information->tmpt_lahir   = $request->tmpt_lahir;
            $information->save();

            DB::commit();
            Toastr::success('Data profil informasi berhasil diperbaharui ✔', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Data profil informasi gagal diperbaharui ✘', 'Error');
            return redirect()->back();
        }
    }
    /** save profile information */

    public function fotoProfile(Request $request)
    {
        try {
            if (!empty($request->images)) {
                $image_name = $request->hidden_image;
                $image      = $request->file('images');
                if ($image_name == 'photo_defaults.jpg') {
                    if ($image != '') {
                        $image_name = rand() . '.' . $image->getClientOriginalExtension();
                        $image->move(public_path('/assets/images/'), $image_name);
                    }
                } else {
                    if ($image != '') {
                        $image_name = rand() . '.' . $image->getClientOriginalExtension();
                        $image->move(public_path('/assets/images/'), $image_name);
                        unlink('assets/images/' . Auth::user()->avatar);
                    }
                }
                $update = [
                    'user_id'   => $request->user_id,
                    'name'      => $request->name,
                    'avatar'    => $image_name,
                ];
                User::where('user_id', $request->user_id)->update($update);
            }

            DB::commit();
            Toastr::success('Foto profil berhasil diperbaharui ✔', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Foto profil gagal diperbaharui ✘', 'Error');
            return redirect()->back();
        }
    }

    /** save new user */
    public function addNewUserSave(Request $request)
    {
        $request->validate([
            'name'          => 'required|string|max:255',
            'nip'           => 'required|string|max:255',
            'no_dokumen'    => 'required|string|max:255',
            'tema_aplikasi' => 'required|string|max:255',
            'email'         => 'required|string|email|max:255|unique:users',
            'role_name'     => 'required|string|max:255',
            'status'        => 'required|string|max:255',
            'image'         => 'required|string|max:255',
            'password'      => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required',
        ]);
        DB::beginTransaction();
        try {
            $dt       = Carbon::now();
            $todayDate = $dt->toDayDateTimeString();

            $user = new User;
            $user->name             = $request->name;
            $user->nip              = $request->nip;
            $user->no_dokumen       = $request->no_dokumen;
            $user->tema_aplikasi    = $request->tema_aplikasi;
            $user->email            = $request->email;
            $user->join_date        = $todayDate;
            $user->role_name        = $request->role_name;
            $user->status           = $request->status;
            $user->avatar           = $request->image;
            $user->password         = Hash::make($request->password);
            $user->save();
            DB::commit();
            Toastr::success('Data pengguna berhasil ditambah ✔', 'Success');
            return redirect()->route('manajemen-pengguna');
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Data pengguna gagal ditambah ✘', 'Error');
            return redirect()->back();
        }
    }

    /** update record */
    public function update(Request $request)
    {
        DB::beginTransaction();
        try {
            $user_id      = $request->user_id;
            $name         = $request->name;
            $nip          = $request->nip;
            $no_dokumen   = $request->no_dokumen;
            $email        = $request->email;
            $role_name    = $request->role_name;
            $status       = $request->status;
            $avatar       = $request->images;

            $dt       = Carbon::now();
            $todayDate = $dt->toDayDateTimeString();

            $update = [

                'user_id'      => $user_id,
                'name'         => $name,
                'nip'          => $nip,
                'no_dokumen'   => $no_dokumen,
                'role_name'    => $role_name,
                'email'        => $email,
                'status'       => $status,
                'avatar'       => $avatar,
            ];

            $activityLog = [
                'user_name'    => $name,
                'email'        => $email,
                'status'       => $status,
                'role_name'    => $role_name,
                'modify_user'  => 'Perbaharui Data',
                'date_time'    => $todayDate,
            ];

            DB::table('user_activity_logs')->insert($activityLog);
            User::where('user_id', $request->user_id)->update($update);
            DB::commit();
            Toastr::success('Data pengguna berhasil diperbaharui ✔', 'Success');
            return redirect()->route('manajemen-pengguna');
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Data pengguna gagal diperbaharui ✘', 'Error');
            return redirect()->back();
        }
    }

    /** delete record */
    public function delete(Request $request)
    {
        DB::beginTransaction();
        try {

            $dt        = Carbon::now();
            $todayDate = $dt->toDayDateTimeString();

            $activityLog = [
                'user_name'    => Session::get('name'),
                'email'        => Session::get('email'),
                'status'       => Session::get('status'),
                'role_name'    => Session::get('role_name'),
                'modify_user'  => 'Hapus Data',
                'date_time'    => $todayDate,
            ];

            DB::table('user_activity_logs')->insert($activityLog);

            if ($request->avatar == 'photo_defaults.jpg') {
                /** remove all information user */
                User::destroy($request->id);
                PersonalInformation::destroy($request->id);
                UserEmergencyContact::destroy($request->id);
            } else {
                User::destroy($request->id);
                unlink('assets/images/' . $request->avatar);
                PersonalInformation::destroy($request->id);
                UserEmergencyContact::destroy($request->id);
            }

            DB::commit();
            Toastr::success('Data pengguna berhasil dihapus ✔', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Data pengguna gagal dihapus ✘', 'Error');
            return redirect()->back();
        }
    }

    /** view change password */
    public function changePasswordView()
    {
        $user_id = auth()->user()->user_id;
        $result_tema = DB::table('users')
            ->select('users.*', 'users.tema_aplikasi')
            ->where('users.user_id', $user_id)
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

        return view('settings.changepassword', compact('unreadNotifications', 'readNotifications', 'result_tema'));
    }

    /** change password in db */
    public function changePasswordDB(Request $request)
    {
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);
        
        DB::beginTransaction();
        try {

        User::find(auth()->user()->id)->update(['password' => Hash::make($request->new_password)]);
            DB::commit();
            Toastr::success('Kata sandi berhasil diperbaharui ✔', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollBack();
            Toastr::error('Kata sandi gagal diperbaharui ✘', 'Error');
            return redirect()->back();
        }
    }

    /** Tambah Data Profil Pegawai */
    public function profilePegawaiAdd(Request $request)
    {
        $request->validate([
            'nip'                   => 'required|string|max:255',
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
            'ruangan'               => 'required|string|max:255',
        ]);

        DB::beginTransaction();
        try {

            $addProfilPegawai = ProfilPegawai::where('user_id', '=', $request->user_id)->first();
            if ($addProfilPegawai === null) {

                $addProfilPegawai = new ProfilPegawai();
                $addProfilPegawai->user_id                 = $request->user_id;
                $addProfilPegawai->nip                     = $request->nip;
                $addProfilPegawai->gelar_depan             = $request->gelar_depan;
                $addProfilPegawai->gelar_belakang          = $request->gelar_belakang;
                $addProfilPegawai->tempat_lahir            = $request->tempat_lahir;
                $addProfilPegawai->tanggal_lahir           = $request->tanggal_lahir;
                $addProfilPegawai->jenis_kelamin           = $request->jenis_kelamin;
                $addProfilPegawai->agama                   = $request->agama;
                $addProfilPegawai->jenis_dokumen           = $request->jenis_dokumen;
                $addProfilPegawai->no_dokumen              = $request->no_dokumen;
                $addProfilPegawai->kelurahan               = $request->kelurahan;
                $addProfilPegawai->kecamatan               = $request->kecamatan;
                $addProfilPegawai->kota                    = $request->kota;
                $addProfilPegawai->provinsi                = $request->provinsi;
                $addProfilPegawai->kode_pos                = $request->kode_pos;
                $addProfilPegawai->no_hp                   = $request->no_hp;
                $addProfilPegawai->no_telp                 = $request->no_telp;
                $addProfilPegawai->jenis_pegawai           = $request->jenis_pegawai;
                $addProfilPegawai->kedudukan_pns           = $request->kedudukan_pns;
                $addProfilPegawai->status_pegawai          = $request->status_pegawai;
                $addProfilPegawai->tmt_pns                 = $request->tmt_pns;
                $addProfilPegawai->no_seri_karpeg          = $request->no_seri_karpeg;
                $addProfilPegawai->tmt_cpns                = $request->tmt_cpns;
                $addProfilPegawai->tingkat_pendidikan      = $request->tingkat_pendidikan;
                $addProfilPegawai->pendidikan_terakhir     = $request->pendidikan_terakhir;
                $addProfilPegawai->ruangan                 = $request->ruangan;
                $addProfilPegawai->save();

                DB::commit();
                Toastr::success('Data profil pegawai berhasil ditambah ✔', 'Success');
                return redirect()->back();
            } else {
                DB::rollback();
                Toastr::error('Data profil pegawai sudah tersedia ✘', 'Error');
                return redirect()->back();
            }
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Data profil pegawai gagal ditambah ✘', 'Error');
            return redirect()->back();
        }
    }
    /** End Tambah Data Profil Pegawai */

    /** Upload Dokumen KTP */
    public function uploadDokumenKTP(Request $request)
    {
        
        DB::beginTransaction();
        try {

            if ($request->hasFile('dokumen_ktp')) {
                $existingFile = DB::table('profil_pegawai')->where('user_id', $request->user_id)->value('dokumen_ktp');
                if ($existingFile) {
                    $existingFilePath = public_path('assets/DokumenKTP') . '/' . $existingFile;
                    if (file_exists($existingFilePath)) {
                        unlink($existingFilePath);
                    }
                }
                $dokumen_ktp = time() . '.' . $request->file('dokumen_ktp')->getClientOriginalExtension();
                $request->file('dokumen_ktp')->move(public_path('assets/DokumenKTP'), $dokumen_ktp);
                $update['dokumen_ktp'] = $dokumen_ktp;
            }
            
            DB::table('profil_pegawai')->where('user_id', $request->user_id)->update($update);

            DB::commit();
            Toastr::success('Unggah dokumen KTP berhasil ✔', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Unggah dokumen KTP gagal ✘', 'Error');
            return redirect()->back();
        }
    }
    /** /Upload Dokumen KTP */

    /** Edit Data Posisi & Jabatan */
    public function profilePegawaiEdit(Request $request)
    {
        $request->validate([
            'nip'                   => 'required|string|max:255',
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
            'ruangan'               => 'required|string|max:255',
        ]);

        DB::beginTransaction();
        try {

            $editProfilPegawai = [
                'nip'                   => $request->nip,
                'gelar_depan'           => $request->gelar_depan,
                'gelar_belakang'        => $request->gelar_belakang,
                'tempat_lahir'          => $request->tempat_lahir,
                'tanggal_lahir'         => $request->tanggal_lahir,
                'jenis_kelamin'         => $request->jenis_kelamin,
                'agama'                 => $request->agama,
                'jenis_dokumen'         => $request->jenis_dokumen,
                'no_dokumen'            => $request->no_dokumen,
                'kelurahan'             => $request->kelurahan,
                'kecamatan'             => $request->kecamatan,
                'kota'                  => $request->kota,
                'provinsi'              => $request->provinsi,
                'kode_pos'              => $request->kode_pos,
                'no_hp'                 => $request->no_hp,
                'no_telp'               => $request->no_telp,
                'jenis_pegawai'         => $request->jenis_pegawai,
                'kedudukan_pns'         => $request->kedudukan_pns,
                'status_pegawai'        => $request->status_pegawai,
                'tmt_pns'               => $request->tmt_pns,
                'no_seri_karpeg'        => $request->no_seri_karpeg,
                'tmt_cpns'              => $request->tmt_cpns,
                'tingkat_pendidikan'    => $request->tingkat_pendidikan,
                'pendidikan_terakhir'   => $request->pendidikan_terakhir,
                'ruangan'               => $request->ruangan,
            ];

            DB::table('profil_pegawai')->where('user_id', $request->user_id)->update($editProfilPegawai);

            DB::commit();
            Toastr::success('Data profil pegawai berhasil diperbaharui ✔', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Data profil pegawai gagal diperbaharui ✘', 'Error');
            return redirect()->back();
        }
    }
    /** End Edit Data Posisi & Jabatan */

    /** Tambah Data Posisi & Jabatan */
    public function posisiJabatanAdd(Request $request)
    {
        $request->validate([
            'unit_organisasi'       => 'required|string|max:255',
            'unit_organisasi_induk' => 'required|string|max:255',
            'jenis_jabatan'         => 'required|string|max:255',
            'eselon'                => 'required|string|max:255',
            'jabatan'               => 'required|string|max:255',
            'tmt'                   => 'required|string|max:255',
            'lokasi_kerja'          => 'required|string|max:255',
            'gol_ruang_awal'        => 'required|string|max:255',
            'gol_ruang_akhir'       => 'required|string|max:255',
            'tmt_golongan'          => 'required|string|max:255',
            'gaji_pokok'            => 'required|string|max:255',
            'masa_kerja_tahun'      => 'required|string|max:255',
            'masa_kerja_bulan'      => 'required|string|max:255',
            'no_spmt'               => 'required|string|max:255',
            'tanggal_spmt'          => 'required|string|max:255',
            'kppn'                  => 'required|string|max:255',
        ]);

        DB::beginTransaction();
        try {

            $addPosisiJabatan = PosisiJabatan::where('user_id', '=', $request->user_id)->first();
            if ($addPosisiJabatan === null) {

                $addPosisiJabatan = new PosisiJabatan();
                $addPosisiJabatan->user_id                = $request->user_id;
                $addPosisiJabatan->unit_organisasi        = $request->unit_organisasi;
                $addPosisiJabatan->unit_organisasi_induk  = $request->unit_organisasi_induk;
                $addPosisiJabatan->jenis_jabatan          = $request->jenis_jabatan;
                $addPosisiJabatan->eselon                 = $request->eselon;
                $addPosisiJabatan->jabatan                = $request->jabatan;
                $addPosisiJabatan->tmt                    = $request->tmt;
                $addPosisiJabatan->lokasi_kerja           = $request->lokasi_kerja;
                $addPosisiJabatan->gol_ruang_awal         = $request->gol_ruang_awal;
                $addPosisiJabatan->gol_ruang_akhir        = $request->gol_ruang_akhir;
                $addPosisiJabatan->tmt_golongan           = $request->tmt_golongan;
                $addPosisiJabatan->gaji_pokok             = $request->gaji_pokok;
                $addPosisiJabatan->masa_kerja_tahun       = $request->masa_kerja_tahun;
                $addPosisiJabatan->masa_kerja_bulan       = $request->masa_kerja_bulan;
                $addPosisiJabatan->no_spmt                = $request->no_spmt;
                $addPosisiJabatan->tanggal_spmt           = $request->tanggal_spmt;
                $addPosisiJabatan->kppn                   = $request->kppn;
                $addPosisiJabatan->save();

                DB::commit();
                Toastr::success('Data posisi & jabatan berhasil ditambah ✔', 'Success');
                return redirect()->back();
            } else {
                DB::rollback();
                Toastr::error('Data posisi & jabatan sudah tersedia ✘', 'Error');
                return redirect()->back();
            }
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Data posisi & jabatan gagal ditambah ✘', 'Error');
            return redirect()->back();
        }
    }
    /** End Tambah Data Posisi & Jabatan */

    /** Edit Data Posisi & Jabatan */
    public function posisiJabatanEdit(Request $request)
    {
        $request->validate([
            'unit_organisasi'       => 'required|string|max:255',
            'unit_organisasi_induk' => 'required|string|max:255',
            'jenis_jabatan'         => 'required|string|max:255',
            'eselon'                => 'required|string|max:255',
            'jabatan'               => 'required|string|max:255',
            'tmt'                   => 'required|string|max:255',
            'lokasi_kerja'          => 'required|string|max:255',
            'gol_ruang_awal'        => 'required|string|max:255',
            'gol_ruang_akhir'       => 'required|string|max:255',
            'tmt_golongan'          => 'required|string|max:255',
            'gaji_pokok'            => 'required|string|max:255',
            'masa_kerja_tahun'      => 'required|string|max:255',
            'masa_kerja_bulan'      => 'required|string|max:255',
            'no_spmt'               => 'required|string|max:255',
            'tanggal_spmt'          => 'required|string|max:255',
            'kppn'                  => 'required|string|max:255',
        ]);

        DB::beginTransaction();
        try {

            $editPosisiJabatan = [
                'unit_organisasi'        => $request->unit_organisasi,
                'unit_organisasi_induk'  => $request->unit_organisasi_induk,
                'jenis_jabatan'          => $request->jenis_jabatan,
                'eselon'                 => $request->eselon,
                'jabatan'                => $request->jabatan,
                'tmt'                    => $request->tmt,
                'lokasi_kerja'           => $request->lokasi_kerja,
                'gol_ruang_awal'         => $request->gol_ruang_awal,
                'gol_ruang_akhir'        => $request->gol_ruang_akhir,
                'tmt_golongan'           => $request->tmt_golongan,
                'gaji_pokok'             => $request->gaji_pokok,
                'masa_kerja_tahun'       => $request->masa_kerja_tahun,
                'masa_kerja_bulan'       => $request->masa_kerja_bulan,
                'no_spmt'                => $request->no_spmt,
                'tanggal_spmt'           => $request->tanggal_spmt,
                'kppn'                   => $request->kppn,
            ];

            $editUsers = [
                'jenis_jabatan'          => $request->jenis_jabatan,
                'eselon'                 => $request->eselon
            ];

            DB::table('posisi_jabatan')->where('user_id', $request->user_id)->update($editPosisiJabatan);
            DB::table('users')->where('user_id', $request->user_id)->update($editUsers);

            DB::commit();
            Toastr::success('Data posisi & jabatan berhasil diperbaharui ✔', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Data posisi & jabatan gagal diperbaharui ✘', 'Error');
            return redirect()->back();
        }
    }
    /** End Edit Data Posisi & Jabatan */
}
