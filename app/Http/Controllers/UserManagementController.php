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
            $position    = DB::table('position_types')->get();
            $department  = DB::table('departments')->get();
            $status_user = DB::table('user_types')->get();
            return view('usermanagement.user_control', compact('result', 'role_name', 'position', 'department', 'status_user'));
        } else if (Session::get('role_name') == 'Super Admin') {
            $result      = DB::table('users')->get();
            $role_name   = DB::table('role_type_users')->get();
            $position    = DB::table('position_types')->get();
            $department  = DB::table('departments')->get();
            $status_user = DB::table('user_types')->get();
            return view('usermanagement.user_control', compact('result', 'role_name', 'position', 'department', 'status_user'));
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
            $users->when($user_name, function ($query) use ($user_name) {
                $query->where('name', 'LIKE', '%' . $user_name . '%');
            });
        }

        /** search for type_role */
        if (!empty($type_role)) {
            $users->when($type_role, function ($query) use ($type_role) {
                $query->where('role_name', $type_role);
            });
        }

        /** search for status */
        if (!empty($type_status)) {
            $users->when($type_status, function ($query) use ($type_status) {
                $query->where('status', $type_status);
            });
        }

        $totalRecordsWithFilter = $users->where(function ($query) use ($searchValue) {
            $query->where('name', 'like', '%' . $searchValue . '%');
            $query->orWhere('user_id', 'like', '%' . $searchValue . '%');
            $query->orWhere('email', 'like', '%' . $searchValue . '%');
            $query->orWhere('position', 'like', '%' . $searchValue . '%');
            $query->orWhere('phone_number', 'like', '%' . $searchValue . '%');
            $query->orWhere('join_date', 'like', '%' . $searchValue . '%');
            $query->orWhere('role_name', 'like', '%' . $searchValue . '%');
            $query->orWhere('status', 'like', '%' . $searchValue . '%');
            $query->orWhere('department', 'like', '%' . $searchValue . '%');
        })->count();

        if ($columnName == 'user_id') {
            $columnName = 'user_id';
        }
        $records = $users->orderBy($columnName, $columnSortOrder)
            ->where(function ($query) use ($searchValue) {
                $query->where('name', 'like', '%' . $searchValue . '%');
                $query->orWhere('user_id', 'like', '%' . $searchValue . '%');
                $query->orWhere('email', 'like', '%' . $searchValue . '%');
                $query->orWhere('position', 'like', '%' . $searchValue . '%');
                $query->orWhere('phone_number', 'like', '%' . $searchValue . '%');
                $query->orWhere('join_date', 'like', '%' . $searchValue . '%');
                $query->orWhere('role_name', 'like', '%' . $searchValue . '%');
                $query->orWhere('status', 'like', '%' . $searchValue . '%');
                $query->orWhere('department', 'like', '%' . $searchValue . '%');
            })
            ->skip($start)
            ->take($rowPerPage)
            ->get();
        $data_arr = [];
        foreach ($records as $key => $record) {
            $record->name = '<h2 class="table-avatar"><a href="' . url('user/profile/' . $record->user_id) . '" class="name">' . '<img class="avatar" data-avatar=' . $record->avatar . ' src="' . url('/assets/images/' . $record->avatar) . '">' . $record->name . '</a></h2>';
            if ($record->role_name == 'Admin') {
                /** color role name */
                $role_name = '<span class="badge bg-inverse-danger role_name">' . $record->role_name . '</span>';
            } elseif ($record->role_name == 'Super Admin') {
                $role_name = '<span class="badge bg-inverse-warning role_name">' . $record->role_name . '</span>';
            } elseif ($record->role_name == 'User') {
                $role_name = '<span class="badge bg-inverse-info role_name">' . $record->role_name . '</span>';
            } else {
                $role_name = 'NULL';
                /** null role name */
            }

            /** status */
            $full_status = '
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item"><i class="fa fa-dot-circle-o text-success"></i> Active </a>
                    <a class="dropdown-item"><i class="fa fa-dot-circle-o text-warning"></i> Inactive </a>
                    <a class="dropdown-item"><i class="fa fa-dot-circle-o text-danger"></i> Disable </a>
                </div>
            ';

            if ($record->status == 'Active') {
                $status = '
                    <a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-dot-circle-o text-success"></i>
                        <span class="status_s">' . $record->status . '</span>
                    </a>
                    ' . $full_status . '
                ';
            } elseif ($record->status == 'Inactive') {
                $status = '
                    <a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-dot-circle-o text-info"></i>
                        <span class="status_s">' . $record->status . '</span>
                    </a>
                    ' . $full_status . '
                ';
            } elseif ($record->status == 'Disable') {
                $status = '
                    <a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-dot-circle-o text-danger"></i>
                        <span class="status_s">' . $record->status . '</span>
                    </a>
                    ' . $full_status . '
                ';
            } else {
                $status = '
                    <a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-dot-circle-o text-dark"></i>
                        <span class="statuss">' . $record->status . '</span>
                    </a>
                    ' . $full_status . '
                ';
            }

            $data_arr[] = [
                "no"           => '<span class="id" data-id = ' . $record->id . '>' . $start + ($key + 1) . '</span>',
                "name"         => $record->name,
                "user_id"      => '<span class="user_id">' . $record->user_id . '</span>',
                "email"        => '<span class="email">' . $record->email . '</span>',
                "position"     => '<span class="position">' . $record->position . '</span>',
                "phone_number" => '<span class="phone_number">' . $record->phone_number . '</span>',
                "join_date"    => $record->join_date,
                "role_name"    => $role_name,
                "status"       => $status,
                "department"   => '<span class="department">' . $record->department . '</span>',
                "action"       =>
                '
                <td>
                    <div class="dropdown dropdown-action">
                        <a class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            <i class="material-icons">more_vert</i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item userUpdate" data-toggle="modal" data-id="' . $record->id . '" data-target="#edit_user">
                                <i class="fa fa-pencil m-r-5"></i> Edit
                            </a>
                            <a class="dropdown-item userDelete" data-toggle="modal" data-id="' . $record->id . '" data-target="#delete_user">
                                <i class="fa fa-trash-o m-r-5"></i> Delete
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

    public function profileEmployee($user_id)
    {
        $user = DB::table('users')
            ->leftJoin('personal_information as pi', 'pi.user_id', 'users.user_id')
            ->leftJoin('profile_information as pr', 'pr.user_id', 'users.user_id')
            ->leftJoin('user_emergency_contacts as ue', 'ue.user_id', 'users.user_id')
            ->select(
                'users.*',
                'pi.passport_no',
                'pi.passport_expiry_date',
                'pi.tel',
                'pi.nationality',
                'pi.religion',
                'pi.marital_status',
                'pi.employment_of_spouse',
                'pi.children',
                'pr.tgl_lahir',
                'pr.jk',
                'pr.alamat',
                'ue.name_primary',
                'ue.relationship_primary',
                'ue.phone_primary',
                'ue.phone_2_primary',
                'ue.name_secondary',
                'ue.relationship_secondary',
                'ue.phone_secondary',
                'ue.phone_2_secondary'
            )
            ->where('users.user_id', $user_id)->get();
        $users = DB::table('users')
            ->leftJoin('personal_information as pi', 'pi.user_id', 'users.user_id')
            ->leftJoin('profile_information as pr', 'pr.user_id', 'users.user_id')
            ->leftJoin('user_emergency_contacts as ue', 'ue.user_id', 'users.user_id')
            ->select(
                'users.*',
                'pi.passport_no',
                'pi.passport_expiry_date',
                'pi.tel',
                'pi.nationality',
                'pi.religion',
                'pi.marital_status',
                'pi.employment_of_spouse',
                'pi.children',
                'pr.tgl_lahir',
                'pr.jk',
                'pr.alamat',
                'ue.name_primary',
                'ue.relationship_primary',
                'ue.phone_primary',
                'ue.phone_2_primary',
                'ue.name_secondary',
                'ue.relationship_secondary',
                'ue.phone_secondary',
                'ue.phone_2_secondary'
            )
            ->where('users.user_id', $user_id)->first();

        return view('usermanagement.employeeprofile', compact('user', 'users'));
    }



    /** use activity log */
    public function activityLog()
    {
        $activityLog = DB::table('user_activity_logs')->get();
        return view('usermanagement.user_activity_log', compact('activityLog'));
    }

    /** activity log */
    public function activityLogInLogOut()
    {
        $activityLog = DB::table('activity_logs')->get();
        return view('usermanagement.activity_log', compact('activityLog'));
    }

    /** profile admin */
    public function admin_profile()
    {
        $profile = Session::get('user_id'); // get user_id session
        $user = DB::table('users')->get();
        $employees = DB::table('profile_information')->where('user_id', $profile)->first();

        $datapendidikan = Session::get('user_id');
        $riwayatPendidikan = RiwayatPendidikan::where('user_id', $datapendidikan)->get();

        $datadiklat = Session::get('user_id');
        $riwayatDiklat = RiwayatDiklat::where('user_id', $datadiklat)->get();

        $datagolongan = Session::get('user_id');
        $riwayatGolongan = RiwayatGolongan::where('user_id', $datagolongan)->get();

        $datajabatan = Session::get('user_id');
        $riwayatJabatan = RiwayatJabatan::where('user_id', $datajabatan)->get();

        $dataprofilpegawai = Session::get('user_id');
        $profilPegawai = ProfilPegawai::where('user_id', $dataprofilpegawai)->get();
        
        $dataposisijabatan = Session::get('user_id');
        $posisiJabatan = PosisiJabatan::where('user_id', $dataposisijabatan)->get();

        if (empty($employees)) {
            $information = DB::table('profile_information')->where('user_id', $profile)->first();
            return view('usermanagement.profile_user', compact('information', 'user', 'riwayatPendidikan', 'riwayatGolongan', 'riwayatJabatan', 'riwayatDiklat', 'profilPegawai', 'posisiJabatan'));
        } else {
            $user_id = $employees->user_id;
            if ($user_id == $profile) {
                $information = DB::table('profile_information')->where('user_id', $profile)->first();
                return view('usermanagement.profile_user', compact('information', 'user', 'riwayatPendidikan', 'riwayatGolongan', 'riwayatJabatan', 'riwayatDiklat', 'profilPegawai', 'posisiJabatan'));
            } else {
                $information = ProfileInformation::all();
                return view('usermanagement.profile_user', compact('information', 'user', 'riwayatPendidikan', 'riwayatGolongan', 'riwayatJabatan', 'riwayatDiklat', 'profilPegawai', 'posisiJabatan'));
            }
        }
    }

    /** profile super admin */
    public function superadmin_profile()
    {
        $profile = Session::get('user_id');
        $user = DB::table('users')->get();
        $employees = DB::table('profile_information')->where('user_id', $profile)->first();

        if (empty($employees)) {
            $information = DB::table('profile_information')->where('user_id', $profile)->first();
            return view('usermanagement.profile_user', compact('information', 'user'));
        } else {
            $user_id = $employees->user_id;
            if ($user_id == $profile) {
                $information = DB::table('profile_information')->where('user_id', $profile)->first();
                return view('usermanagement.profile_user', compact('information', 'user'));
            } else {
                $information = ProfileInformation::all();
                return view('usermanagement.profile_user', compact('information', 'user'));
            }
        }
    }

    /** profile user */
    public function user_profile()
    {
        $profile = Session::get('user_id');
        $user = DB::table('users')->get();
        $employees = DB::table('profile_information')->where('user_id', $profile)->first();

        $datapendidikan = Session::get('user_id');
        $riwayatPendidikan = RiwayatPendidikan::where('user_id', $datapendidikan)->get();

        $datadiklat = Session::get('user_id');
        $riwayatDiklat = RiwayatDiklat::where('user_id', $datadiklat)->get();

        $datagolongan = Session::get('user_id');
        $riwayatGolongan = RiwayatGolongan::where('user_id', $datagolongan)->get();

        $datajabatan = Session::get('user_id');
        $riwayatJabatan = RiwayatJabatan::where('user_id', $datajabatan)->get();

        $dataprofilpegawai = Session::get('user_id');
        $profilPegawai = ProfilPegawai::where('user_id', $dataprofilpegawai)->get();

        $dataposisijabatan = Session::get('user_id');
        $posisiJabatan = PosisiJabatan::where('user_id', $dataposisijabatan)->get();

        if (empty($employees)) {
            $information = DB::table('profile_information')->where('user_id', $profile)->first();
            return view('usermanagement.profile-user', compact('information', 'user', 'riwayatPendidikan', 'riwayatGolongan', 'riwayatJabatan', 'riwayatDiklat', 'profilPegawai', 'posisiJabatan'));
        } else {
            $user_id = $employees->user_id;
            if ($user_id == $profile) {
                $information = DB::table('profile_information')->where('user_id', $profile)->first();
                return view('usermanagement.profile-user', compact('information', 'user', 'riwayatPendidikan', 'riwayatGolongan', 'riwayatJabatan', 'riwayatDiklat', 'profilPegawai', 'posisiJabatan'));
            } else {
                $information = ProfileInformation::all();
                return view('usermanagement.profile-user', compact('information', 'user', 'riwayatPendidikan', 'riwayatGolongan', 'riwayatJabatan', 'riwayatDiklat', 'profilPegawai', 'posisiJabatan'));
            }
        }
    }
    //*************PENDIDIKAN*****************//
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

    //**************GOLONGAN*************** *//
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
                'tmt_golongan'              => $request->tmt_golongan,
                'no_teknis_bkn'             => $request->no_teknis_bkn,
                'tanggal_teknis_bkn'        => $request->tanggal_teknis_bkn,
                'no_sk'                     => $request->no_sk,
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

    //*****************JABATAN*****************//
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
                'jenis_jabatan'         => $request->jenis_jabatan,
                'satuan_kerja'          => $request->satuan_kerja,
                'satuan_kerja_induk'    => $request->satuan_kerja_induk,
                'unit_organisasi'       => $request->unit_organisasi,
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

    //************DIKLAT*********** */
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

    /** Edit Data Riwayat Pendidikan */
    public function editUserRiwayatPendidikan(Request $request)
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
    public function hapusUserRiwayatPendidikan(Request $request)
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

    /** Edit Data Riwayat Golongan */
    public function editUserRiwayatGolongan(Request $request)
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
                'tmt_golongan'              => $request->tmt_golongan,
                'no_teknis_bkn'             => $request->no_teknis_bkn,
                'tanggal_teknis_bkn'        => $request->tanggal_teknis_bkn,
                'no_sk'                     => $request->no_sk,
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
    public function hapusUserRiwayatGolongan(Request $request)
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

    /** Edit Data Riwayat Jabatan */
    public function editUserRiwayatJabatan(Request $request)
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
                'jenis_jabatan'         => $request->jenis_jabatan,
                'satuan_kerja'          => $request->satuan_kerja,
                'satuan_kerja_induk'    => $request->satuan_kerja_induk,
                'unit_organisasi'       => $request->unit_organisasi,
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
    public function hapusUserRiwayatJabatan(Request $request)
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

    /** Edit Data Riwayat Diklat */
    public function editUserRiwayatDiklat(Request $request)
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
    public function hapusUserRiwayatDiklat(Request $request)
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

    /** save profile information */
    public function profileInformation(Request $request)
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
                    'user_id' => $request->user_id,
                    'name'   => $request->name,
                    'avatar' => $image_name,
                ];
                User::where('user_id', $request->user_id)->update($update);
            }

            $information = ProfileInformation::updateOrCreate(['user_id' => $request->user_id]);
            $information->name         = $request->name;
            $information->user_id      = $request->user_id;
            $information->email        = $request->email;
            $information->tgl_lahir    = $request->birthDate;
            $information->jk           = $request->jk;
            $information->alamat       = $request->alamat;
            $information->save();

            DB::commit();
            Toastr::success('Edit Profil Informasi berhasil :)', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Menambahkan Profil Informasi gagal :)', 'Error');
            return redirect()->back();
        }
    }

    /** save new user */
    public function addNewUserSave(Request $request)
    {
        $request->validate([
            'name'      => 'required|string|max:255',
            'email'     => 'required|string|email|max:255|unique:users',
            'phone'     => 'required|min:11|numeric',
            'role_name' => 'required|string|max:255',
            'position'  => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'status'    => 'required|string|max:255',
            'image'     => 'required|image',
            'password'  => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required',
        ]);
        DB::beginTransaction();
        try {
            $dt       = Carbon::now();
            $todayDate = $dt->toDayDateTimeString();

            $image = time() . '.' . $request->image->extension();
            $request->image->move(public_path('assets/images'), $image);

            $user = new User;
            $user->name         = $request->name;
            $user->email        = $request->email;
            $user->join_date    = $todayDate;
            $user->phone_number = $request->phone;
            $user->role_name    = $request->role_name;
            $user->position     = $request->position;
            $user->department   = $request->department;
            $user->status       = $request->status;
            $user->avatar       = $image;
            $user->password     = Hash::make($request->password);
            $user->save();
            DB::commit();
            Toastr::success('Berhasil membuat akun baru :)', 'Success');
            return redirect()->route('manajemen-pengguna');
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Gagal membuat akun baru :)', 'Error');
            return redirect()->back();
        }
    }

    /** update record */
    public function update(Request $request)
    {
        DB::beginTransaction();
        try {
            $user_id       = $request->user_id;
            $name         = $request->name;
            $email        = $request->email;
            $role_name    = $request->role_name;
            $position     = $request->position;
            $phone        = $request->phone;
            $department   = $request->department;
            $status       = $request->status;

            $dt       = Carbon::now();
            $todayDate = $dt->toDayDateTimeString();
            $image_name = $request->hidden_image;
            $image = $request->file('images');
            if ($image_name == 'photo_defaults.jpg') {
                if (empty($image)) {
                    $image_name = $image_name;
                } else {
                    $image_name = rand() . '.' . $image->getClientOriginalExtension();
                    $image->move(public_path('/assets/images/'), $image_name);
                }
            } else {
                if (!empty($image)) {
                    unlink('assets/images/' . $image_name);
                    $image_name = rand() . '.' . $image->getClientOriginalExtension();
                    $image->move(public_path('/assets/images/'), $image_name);
                }
            }

            $update = [

                'user_id'       => $user_id,
                'name'         => $name,
                'role_name'    => $role_name,
                'email'        => $email,
                'position'     => $position,
                'phone_number' => $phone,
                'department'   => $department,
                'status'       => $status,
                'avatar'       => $image_name,
            ];

            $activityLog = [
                'user_name'    => $name,
                'email'        => $email,
                'phone_number' => $phone,
                'status'       => $status,
                'role_name'    => $role_name,
                'modify_user'  => 'Update',
                'date_time'    => $todayDate,
            ];

            DB::table('user_activity_logs')->insert($activityLog);
            User::where('user_id', $request->user_id)->update($update);
            DB::commit();
            Toastr::success('Berhasil update user :)', 'Success');
            return redirect()->route('manajemen-pengguna');
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Gagal update user :)', 'Error');
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
                'phone_number' => Session::get('phone_number'),
                'status'       => Session::get('status'),
                'role_name'    => Session::get('role_name'),
                'modify_user'  => 'Delete',
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
            Toastr::success('Berhasil hapus user :)', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Gagal hapus user :)', 'Error');
            return redirect()->back();
        }
    }

    /** view change password */
    public function changePasswordView()
    {
        return view('settings.changepassword');
    }

    /** change password in db */
    public function changePasswordDB(Request $request)
    {
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);

        User::find(auth()->user()->id)->update(['password' => Hash::make($request->new_password)]);
        DB::commit();
        Toastr::success('Berhasil update user :)', 'Success');
        return redirect()->intended('home');
    }

    /** user profile Emergency Contact */
    public function emergencyContactSaveOrUpdate(Request $request)
    {
        /** validate form */
        $request->validate([
            'name_primary' => 'required',
            'relationship_primary'   => 'required',
            'phone_primary'          => 'required',
            'phone_2_primary'        => 'required',
            'name_secondary'         => 'required',
            'relationship_secondary' => 'required',
            'phone_secondary'        => 'required',
            'phone_2_secondary'      => 'required',
        ]);

        try {

            /** save or update to databases user_emergency_contacts table */
            $saveRecord = UserEmergencyContact::updateOrCreate(['user_id' => $request->user_id]);
            $saveRecord->name_primary           = $request->name_primary;
            $saveRecord->relationship_primary   = $request->relationship_primary;
            $saveRecord->phone_primary          = $request->phone_primary;
            $saveRecord->phone_2_primary        = $request->phone_2_primary;
            $saveRecord->name_secondary         = $request->name_secondary;
            $saveRecord->relationship_secondary = $request->relationship_secondary;
            $saveRecord->phone_secondary        = $request->phone_secondary;
            $saveRecord->phone_2_secondary      = $request->phone_2_secondary;
            $saveRecord->save();

            DB::commit();
            Toastr::success('Add Emergency Contact successfully :)', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Add Emergency Contact fail :)', 'Error');
            return redirect()->back();
        }
    }
}
