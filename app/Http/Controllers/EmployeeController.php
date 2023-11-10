<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\Employee;
use App\Models\department;
use App\Models\User;
use App\Models\module_permission;
use App\Models\pendidikan;
use App\Models\agama;
use App\Models\jenis_pegawai;
use App\Models\RiwayatDiklat;
use App\Models\RiwayatGolongan;
use App\Models\RiwayatJabatan;
use App\Models\RiwayatPendidikan;
use App\Models\kedudukan;
use App\Models\ruangan;
use App\Models\LayananCuti;
use App\Models\Notification;
use App\Models\ReferensiPangkat;
use App\Models\sipDokter;
use App\Models\Sumpah;
use App\Models\Province;
use App\Models\Regency;
use App\Models\District;
use App\Models\Village;
use Carbon\Carbon;
use Session;

class EmployeeController extends Controller
{
    /** Daftar Pegawai Card */
    public function cardAllEmployee(Request $request)
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

        $users = DB::table('users')
            ->leftjoin('profil_pegawai', 'users.user_id', 'profil_pegawai.user_id')
            ->leftjoin('posisi_jabatan', 'users.user_id', 'posisi_jabatan.user_id')
            ->select('users.*','profil_pegawai.name','profil_pegawai.email','profil_pegawai.nip','profil_pegawai.gelar_depan','profil_pegawai.gelar_belakang','profil_pegawai.tempat_lahir',
                'profil_pegawai.tanggal_lahir','profil_pegawai.jenis_kelamin','profil_pegawai.agama','profil_pegawai.jenis_dokumen','profil_pegawai.no_dokumen',
                'profil_pegawai.kelurahan','profil_pegawai.kecamatan','profil_pegawai.kota','profil_pegawai.provinsi','profil_pegawai.kode_pos',
                'profil_pegawai.no_hp','profil_pegawai.no_telp','profil_pegawai.jenis_pegawai','profil_pegawai.kedudukan_pns','profil_pegawai.status_pegawai',
                'profil_pegawai.tmt_pns','profil_pegawai.no_seri_karpeg','profil_pegawai.tmt_cpns','profil_pegawai.tingkat_pendidikan','profil_pegawai.pendidikan_terakhir',
                'profil_pegawai.ruangan','users.name','posisi_jabatan.jabatan')
            ->get();
        $userList = DB::table('users')->get();
        $permission_lists = DB::table('permission_lists')->get();
        return view('employees.allemployeecard', compact('users', 'userList', 'permission_lists', 'unreadNotifications', 'readNotifications'));
    }

    /** Daftar Pegawai List */
    public function listAllEmployee()
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

        $users = DB::table('users')
            ->leftjoin('profil_pegawai', 'users.user_id', 'profil_pegawai.user_id')
            ->leftjoin('posisi_jabatan', 'users.user_id', 'posisi_jabatan.user_id')
            ->select('users.*','profil_pegawai.name','profil_pegawai.email','profil_pegawai.nip','profil_pegawai.gelar_depan','profil_pegawai.gelar_belakang','profil_pegawai.tempat_lahir',
                'profil_pegawai.tanggal_lahir','profil_pegawai.jenis_kelamin','profil_pegawai.agama','profil_pegawai.jenis_dokumen','profil_pegawai.no_dokumen',
                'profil_pegawai.kelurahan','profil_pegawai.kecamatan','profil_pegawai.kota','profil_pegawai.provinsi','profil_pegawai.kode_pos',
                'profil_pegawai.no_hp','profil_pegawai.no_telp','profil_pegawai.jenis_pegawai','profil_pegawai.kedudukan_pns','profil_pegawai.status_pegawai',
                'profil_pegawai.tmt_pns','profil_pegawai.no_seri_karpeg','profil_pegawai.tmt_cpns','profil_pegawai.tingkat_pendidikan','profil_pegawai.pendidikan_terakhir',
                'profil_pegawai.ruangan','users.name','posisi_jabatan.jabatan')
            ->get();
        $userList = DB::table('users')->get();
        $permission_lists = DB::table('permission_lists')->get();
        return view('employees.employeelist', compact('users', 'userList', 'permission_lists', 'unreadNotifications', 'readNotifications'));
    }

    /** Daftar Pegawai Pensiun Card */
    public function cardPensiun(Request $request)
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

        $users = DB::table('users')
            ->leftjoin('profil_pegawai', 'users.user_id', 'profil_pegawai.user_id')
            ->leftjoin('posisi_jabatan', 'users.user_id', 'posisi_jabatan.user_id')
            ->select('users.*','profil_pegawai.name','profil_pegawai.email','profil_pegawai.nip','profil_pegawai.gelar_depan','profil_pegawai.gelar_belakang','profil_pegawai.tempat_lahir',
                'profil_pegawai.tanggal_lahir','profil_pegawai.jenis_kelamin','profil_pegawai.agama','profil_pegawai.jenis_dokumen','profil_pegawai.no_dokumen',
                'profil_pegawai.kelurahan','profil_pegawai.kecamatan','profil_pegawai.kota','profil_pegawai.provinsi','profil_pegawai.kode_pos',
                'profil_pegawai.no_hp','profil_pegawai.no_telp','profil_pegawai.jenis_pegawai','profil_pegawai.kedudukan_pns','profil_pegawai.status_pegawai',
                'profil_pegawai.tmt_pns','profil_pegawai.no_seri_karpeg','profil_pegawai.tmt_cpns','profil_pegawai.tingkat_pendidikan','profil_pegawai.pendidikan_terakhir',
                'profil_pegawai.ruangan','users.name','posisi_jabatan.jabatan')
            ->get();
        $userList = DB::table('users')->get();
        $permission_lists = DB::table('permission_lists')->get();
        return view('employees.datapensiuncard', compact('users', 'userList', 'permission_lists', 'unreadNotifications', 'readNotifications'));
    }

    /** Daftar Pegawai Pensiun List */
    public function listPensiun()
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

        $users = DB::table('users')
            ->leftjoin('profil_pegawai', 'users.user_id', 'profil_pegawai.user_id')
            ->leftjoin('posisi_jabatan', 'users.user_id', 'posisi_jabatan.user_id')
            ->select('users.*','profil_pegawai.name','profil_pegawai.email','profil_pegawai.nip','profil_pegawai.gelar_depan','profil_pegawai.gelar_belakang','profil_pegawai.tempat_lahir',
                'profil_pegawai.tanggal_lahir','profil_pegawai.jenis_kelamin','profil_pegawai.agama','profil_pegawai.jenis_dokumen','profil_pegawai.no_dokumen',
                'profil_pegawai.kelurahan','profil_pegawai.kecamatan','profil_pegawai.kota','profil_pegawai.provinsi','profil_pegawai.kode_pos',
                'profil_pegawai.no_hp','profil_pegawai.no_telp','profil_pegawai.jenis_pegawai','profil_pegawai.kedudukan_pns','profil_pegawai.status_pegawai',
                'profil_pegawai.tmt_pns','profil_pegawai.no_seri_karpeg','profil_pegawai.tmt_cpns','profil_pegawai.tingkat_pendidikan','profil_pegawai.pendidikan_terakhir',
                'profil_pegawai.ruangan','users.name','posisi_jabatan.jabatan')
            ->get();
        $userList = DB::table('users')->get();
        $permission_lists = DB::table('permission_lists')->get();
        return view('employees.datapensiunlist', compact('users', 'userList', 'permission_lists', 'unreadNotifications', 'readNotifications'));
    }

    public function cardRuangan(Request $request)
    {

        $users = DB::table('users')
            ->leftjoin('profil_pegawai', 'users.user_id', 'profil_pegawai.user_id')
            ->leftjoin('posisi_jabatan', 'users.user_id', 'posisi_jabatan.user_id')
            ->select('users.*','profil_pegawai.name','profil_pegawai.email','profil_pegawai.nip','profil_pegawai.gelar_depan','profil_pegawai.gelar_belakang','profil_pegawai.tempat_lahir',
                'profil_pegawai.tanggal_lahir','profil_pegawai.jenis_kelamin','profil_pegawai.agama','profil_pegawai.jenis_dokumen','profil_pegawai.no_dokumen',
                'profil_pegawai.kelurahan','profil_pegawai.kecamatan','profil_pegawai.kota','profil_pegawai.provinsi','profil_pegawai.kode_pos',
                'profil_pegawai.no_hp','profil_pegawai.no_telp','profil_pegawai.jenis_pegawai','profil_pegawai.kedudukan_pns','profil_pegawai.status_pegawai',
                'profil_pegawai.tmt_pns','profil_pegawai.no_seri_karpeg','profil_pegawai.tmt_cpns','profil_pegawai.tingkat_pendidikan','profil_pegawai.pendidikan_terakhir',
                'profil_pegawai.ruangan','users.name','posisi_jabatan.jabatan')
            ->get();
        
        $userList = DB::table('users')->get();
        $permission_lists = DB::table('permission_lists')->get();

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

        $superAdmin = User::where('role_name', 'Kepala Ruangan')->first();
        if ($superAdmin) {
            $kepalaRuang = User::where('role_name', 'User')
                ->join('cuti', 'users.user_id', 'cuti.user_id')
                ->where('ruangan', $superAdmin->ruangan)
                ->get();
                
        return view('employees.dataruangancard', [
            'users' => $users,
            'userList' => $userList,
            'permission_lists' => $permission_lists,
            'unreadNotifications' => $unreadNotifications,
            'readNotifications' => $readNotifications,
            'kepalaRuang' => $kepalaRuang
                ]);
        } else {
            return view('employees.dataruangancard', ['kepalaRuang' => []]);
        }
    }

    /** Daftar Ruangan List */
    public function listRuangan()
    {

        $users = DB::table('users')
            ->leftjoin('profil_pegawai', 'users.user_id', 'profil_pegawai.user_id')
            ->leftjoin('posisi_jabatan', 'users.user_id', 'posisi_jabatan.user_id')
            ->select('users.*','profil_pegawai.name','profil_pegawai.email','profil_pegawai.nip','profil_pegawai.gelar_depan','profil_pegawai.gelar_belakang','profil_pegawai.tempat_lahir',
                'profil_pegawai.tanggal_lahir','profil_pegawai.jenis_kelamin','profil_pegawai.agama','profil_pegawai.jenis_dokumen','profil_pegawai.no_dokumen',
                'profil_pegawai.kelurahan','profil_pegawai.kecamatan','profil_pegawai.kota','profil_pegawai.provinsi','profil_pegawai.kode_pos',
                'profil_pegawai.no_hp','profil_pegawai.no_telp','profil_pegawai.jenis_pegawai','profil_pegawai.kedudukan_pns','profil_pegawai.status_pegawai',
                'profil_pegawai.tmt_pns','profil_pegawai.no_seri_karpeg','profil_pegawai.tmt_cpns','profil_pegawai.tingkat_pendidikan','profil_pegawai.pendidikan_terakhir',
                'profil_pegawai.ruangan','users.name','posisi_jabatan.jabatan')
            ->get();
        $userList = DB::table('users')->get();
        $permission_lists = DB::table('permission_lists')->get();

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

        $superAdmin = User::where('role_name', 'Kepala Ruangan')->first();
        if ($superAdmin) {
            $kepalaRuang = User::where('role_name', 'User')
                ->join('cuti', 'users.user_id', 'cuti.user_id')
                ->where('ruangan', $superAdmin->ruangan)
                ->get();
                    
        return view('employees.dataruanganlist', [
            'users' => $users,
            'userList' => $userList,
            'permission_lists' => $permission_lists,
            'unreadNotifications' => $unreadNotifications,
            'readNotifications' => $readNotifications,
            'kepalaRuang' => $kepalaRuang
            ]);
        } else {
            return view('employees.dataruanganlist', ['kepalaRuang' => []]);
        }
    }

    /** save data employee */
    public function saveRecord(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'email'       => 'required|string|email',
            'employee_id' => 'required|string|max:255',
        ]);

        DB::beginTransaction();
        try {

            $employees = Employee::where('email', '=', $request->email)->first();
            if ($employees === null) {
                $employee               = new Employee;
                $employee->name         = $request->name;
                $employee->email        = $request->email;
                $employee->employee_id  = $request->employee_id;
                $employee->save();

                DB::commit();
                Toastr::success('Berhasil menambahkan pegawai baru :)', 'Success');
                return redirect()->route('daftar/pegawai/card');
            } else {
                DB::rollback();
                Toastr::error('Data tersebuut sudah tersedia :(', 'Error');
                return redirect()->back();
            }
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Gagal menambahkan pegawai baru :(', 'Error');
            return redirect()->back();
        }
    }

    /** view edit record */
    public function viewRecord($employee_id)
    {
        $employees = DB::table('employees')->where('employee_id', $employee_id)->get();
        return view('employees.edit.editemployee', compact('employees'));
    }

    /** update record employee */
    public function updateRecord(Request $request)
    {
        DB::beginTransaction();
        try {

            // update table Employee
            $updateEmployee = [
                'id'            => $request->id,
                'name'          => $request->name,
                'email'         => $request->email,
                'employee_id'   => $request->employee_id,
            ];

            // update table user
            $updateUser = [
                'id'            => $request->id,
                'name'          => $request->name,
                'email'         => $request->email,
            ];

            User::where('id', $request->id)->update($updateUser);
            Employee::where('id', $request->id)->update($updateEmployee);

            DB::commit();
            Toastr::success('Data daftar pegawai berhasil diperbaharui :)', 'Success');
            return redirect()->route('daftar/pegawai/card');
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Data daftar pegawai gagal diperbaharui :(', 'Error');
            return redirect()->back();
        }
    }

    /** delete record */
    public function deleteRecord($employee_id)
    {
        DB::beginTransaction();
        try {
            Employee::where('employee_id', $employee_id)->delete();

            DB::commit();
            Toastr::success('Data daftar pegawai berhasil dihapus :)', 'Success');
            return redirect()->route('daftar/pegawai/card');
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Data daftar pegawai gagal dihapus :(', 'Error');
            return redirect()->back();
        }
    }

    /** employee search */
    public function employeeSearch(Request $request)
    {
        $users = DB::table('users')
                    ->join('employees','users.user_id','employees.employee_id')
                    ->select('users.*','employees.name','employees.email')->get();
        $userList = DB::table('users')->get();

        // search by id
        if ($request->employee_id)
        {
            $users = DB::table('users')
                        ->join('employees','users.user_id','employees.employee_id')
                        ->select('users.*','employees.name','employees.email')
                        ->where('employee_id','LIKE','%'.$request->employee_id.'%')->get();
        }
        // search by name
        if ($request->name)
        {
            $users = DB::table('users')
                        ->join('employees','users.user_id','employees.employee_id')
                        ->select('users.*','employees.name','employees.email')
                        ->where('users.name','LIKE','%'.$request->name.'%')->get();
        }
        // search by email
        if ($request->email)
        {
            $users = DB::table('users')
                        ->join('employees','users.user_id','employees.employee_id')
                        ->select('users.*','employees.name','employees.email')
                        ->where('users.email','LIKE','%'.$request->email.'%')->get();
        }

        // search by name and id
        if ($request->employee_id && $request->name)
        {
            $users = DB::table('users')
                        ->join('employees','users.user_id','employees.employee_id')
                        ->select('users.*','employees.name','employees.email')
                        ->where('employee_id','LIKE','%'.$request->employee_id.'%')
                        ->where('users.name','LIKE','%'.$request->name.'%')
                        ->get();
        }
        // search by email and id
        if ($request->employee_id && $request->email)
        {
            $users = DB::table('users')
                        ->join('employees','users.user_id','employees.employee_id')
                        ->select('users.*','employees.name','employees.email')
                        ->where('employee_id','LIKE','%'.$request->employee_id.'%')
                        ->where('users.email','LIKE','%'.$request->email.'%')->get();
        }
        // search by name and email
        if ($request->name && $request->email)
        {
            $users = DB::table('users')
                        ->join('employees','users.user_id','employees.employee_id')
                        ->select('users.*','employees.name','employees.email')
                        ->where('users.name','LIKE','%'.$request->name.'%')
                        ->where('users.email','LIKE','%'.$request->email.'%')->get();
        }
        // search by name and email and id
        if ($request->employee_id && $request->name && $request->email)
        {
            $users = DB::table('users')
                        ->join('employees','users.user_id','employees.employee_id')
                        ->select('users.*','employees.name','employees.email')
                        ->where('employee_id','LIKE','%'.$request->employee_id.'%')
                        ->where('users.name','LIKE','%'.$request->name.'%')
                        ->where('users.email','LIKE','%'.$request->email.'%')->get();
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

        return view('employees.allemployeecard', compact('users', 'userList', 'unreadNotifications', 'readNotifications'));
    }

    public function employeeSearchRuangan(Request $request)
    {
        $users = DB::table('users')
                    ->join('employees','users.user_id','employees.employee_id')
                    ->select('users.*','employees.name','employees.email')->get();
        $userList = DB::table('users')->get();

        // search by id
        if ($request->employee_id)
        {
            $users = DB::table('users')
                        ->join('employees','users.user_id','employees.employee_id')
                        ->select('users.*','employees.name','employees.email')
                        ->where('employee_id','LIKE','%'.$request->employee_id.'%')->get();
        }
        // search by name
        if ($request->name)
        {
            $users = DB::table('users')
                        ->join('employees','users.user_id','employees.employee_id')
                        ->select('users.*','employees.name','employees.email')
                        ->where('users.name','LIKE','%'.$request->name.'%')->get();
        }
        // search by email
        if ($request->email)
        {
            $users = DB::table('users')
                        ->join('employees','users.user_id','employees.employee_id')
                        ->select('users.*','employees.name','employees.email')
                        ->where('users.email','LIKE','%'.$request->email.'%')->get();
        }

        // search by name and id
        if ($request->employee_id && $request->name)
        {
            $users = DB::table('users')
                        ->join('employees','users.user_id','employees.employee_id')
                        ->select('users.*','employees.name','employees.email')
                        ->where('employee_id','LIKE','%'.$request->employee_id.'%')
                        ->where('users.name','LIKE','%'.$request->name.'%')
                        ->get();
        }
        // search by email and id
        if ($request->employee_id && $request->email)
        {
            $users = DB::table('users')
                        ->join('employees','users.user_id','employees.employee_id')
                        ->select('users.*','employees.name','employees.email')
                        ->where('employee_id','LIKE','%'.$request->employee_id.'%')
                        ->where('users.email','LIKE','%'.$request->email.'%')->get();
        }
        // search by name and email
        if ($request->name && $request->email)
        {
            $users = DB::table('users')
                        ->join('employees','users.user_id','employees.employee_id')
                        ->select('users.*','employees.name','employees.email')
                        ->where('users.name','LIKE','%'.$request->name.'%')
                        ->where('users.email','LIKE','%'.$request->email.'%')->get();
        }
        // search by name and email and id
        if ($request->employee_id && $request->name && $request->email)
        {
            $users = DB::table('users')
                        ->join('employees','users.user_id','employees.employee_id')
                        ->select('users.*','employees.name','employees.email')
                        ->where('employee_id','LIKE','%'.$request->employee_id.'%')
                        ->where('users.name','LIKE','%'.$request->name.'%')
                        ->where('users.email','LIKE','%'.$request->email.'%')->get();
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

        return view('employees.dataruangancard', compact('users', 'userList', 'unreadNotifications', 'readNotifications'));
    }

    /** list search employee */
    public function employeeListSearch(Request $request)
    {
        $query = DB::table('users')
        ->leftJoin('profil_pegawai', 'users.user_id', '=', 'profil_pegawai.user_id')
        ->leftJoin('posisi_jabatan', 'users.user_id', '=', 'posisi_jabatan.user_id')
        ->select(
            'users.*',
            'profil_pegawai.name as employee_name',
            'profil_pegawai.email as employee_email',
            'profil_pegawai.nip',
            'profil_pegawai.gelar_depan',
            'profil_pegawai.gelar_belakang',
            'profil_pegawai.tempat_lahir',
            'profil_pegawai.tanggal_lahir',
            'profil_pegawai.jenis_kelamin',
            'profil_pegawai.agama',
            'profil_pegawai.jenis_dokumen',
            'profil_pegawai.no_dokumen',
            'profil_pegawai.kelurahan',
            'profil_pegawai.kecamatan',
            'profil_pegawai.kota',
            'profil_pegawai.provinsi',
            'profil_pegawai.kode_pos',
            'profil_pegawai.no_hp',
            'profil_pegawai.no_telp',
            'profil_pegawai.jenis_pegawai',
            'profil_pegawai.kedudukan_pns',
            'profil_pegawai.status_pegawai',
            'profil_pegawai.tmt_pns',
            'profil_pegawai.no_seri_karpeg',
            'profil_pegawai.tmt_cpns',
            'profil_pegawai.tingkat_pendidikan',
            'profil_pegawai.pendidikan_terakhir',
            'profil_pegawai.ruangan',
            'users.name as user_name',
            'posisi_jabatan.jabatan'
        );

        // Lakukan pencarian berdasarkan input form
        if ($request->input('nip')) {
            $query->where('profil_pegawai.nip', 'LIKE', '%' . $request->input('nip') . '%');
        }

        if ($request->input('name')) {
            $query->where('profil_pegawai.name', 'LIKE', '%' . $request->input('name') . '%');
        }

        if ($request->input('email')) {
            $query->where('profil_pegawai.email', 'LIKE', '%' . $request->input('email') . '%');
        }

        $users = $query->get();

        // Lanjutkan dengan bagian notifikasi jika diperlukan
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

        return view('employees.employeelist', compact('users', 'unreadNotifications', 'readNotifications'));
    }
    /** End Search */

    public function employeeListSearchRuangan(Request $request)
    {
        $users = DB::table('users')
                    ->join('employees','users.user_id','employees.employee_id')
                    ->select('users.*','employees.name','employees.email')->get();
        $userList         = DB::table('users')->get();

        // search by id
        if ($request->employee_id)
        {
            $users = DB::table('users')
                        ->join('employees','users.user_id','employees.employee_id')
                        ->select('users.*','employees.name','employees.email')
                        ->where('employee_id','LIKE','%'.$request->employee_id.'%')->get();
        }
        // search by name
        if ($request->name)
        {
            $users = DB::table('users')
                        ->join('employees','users.user_id','employees.employee_id')
                        ->select('users.*','employees.name','employees.email')
                        ->where('users.name','LIKE','%'.$request->name.'%')->get();
        }
        // search by email
        if ($request->email)
        {
            $users = DB::table('users')
                        ->join('employees','users.user_id','employees.employee_id')
                        ->select('users.*','employees.name','employees.email')
                        ->where('users.email','LIKE','%'.$request->email.'%')->get();
        }

        // search by name and id
        if ($request->employee_id && $request->name) 
        {
            $users = DB::table('users')
                        ->join('employees','users.user_id','employees.employee_id')
                        ->select('users.*','employees.name','employees.email')
                        ->where('employee_id','LIKE','%'.$request->employee_id.'%')
                        ->where('users.name','LIKE','%'.$request->name.'%')->get();
        }
        // search by email and id
        if ($request->employee_id && $request->email)
        {
            $users = DB::table('users')
                        ->join('employees','users.user_id','employees.employee_id')
                        ->select('users.*','employees.name','employees.email')
                        ->where('employee_id','LIKE','%'.$request->employee_id.'%')
                        ->where('users.email','LIKE','%'.$request->email.'%')->get();
        }
        // search by name and email
        if ($request->name && $request->email)
        {
            $users = DB::table('users')
                        ->join('employees','users.user_id','employees.employee_id')
                        ->select('users.*','employees.name','employees.email')
                        ->where('users.name','LIKE','%'.$request->name.'%')
                        ->where('users.email','LIKE','%'.$request->email.'%')->get();
        }
        // search by name and email and id
        if ($request->employee_id && $request->name && $request->email)
        {
            $users = DB::table('users')
                        ->join('employees','users.user_id','employees.employee_id')
                        ->select('users.*','employees.name','employees.email')
                        ->where('employee_id','LIKE','%'.$request->employee_id.'%')
                        ->where('users.name','LIKE','%'.$request->name.'%')
                        ->where('users.email','LIKE','%'.$request->email.'%')->get();
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

        return view('employees.dataruanganlist', compact('users', 'userList', 'unreadNotifications', 'readNotifications'));
    }
    /** End Search */

    /** employee profile with all controller user */
    public function profileEmployee($user_id)
    {
        $user = DB::table('users')
            ->leftJoin('profile_information as pr','pr.user_id','users.user_id')
            // ->leftJoin('riwayat_pendidikan as rp','rp.user_id','users.user_id')
            // ->leftJoin('riwayat_golongan as rg','rg.user_id','users.user_id')
            // ->leftJoin('riwayat_jabatan as rj','rj.user_id','users.user_id')
            // ->leftJoin('riwayat_diklat as rd','rd.user_id','users.user_id')
            ->leftJoin('profil_pegawai as pg','pg.user_id','users.user_id')
            ->leftJoin('posisi_jabatan as pj','pj.user_id','users.user_id')
            ->select('users.*','pr.tgl_lahir','pr.jk','pr.alamat','pr.tmpt_lahir','pg.name','pg.email','pg.nip','pg.gelar_depan',
                'pg.gelar_belakang','pg.tempat_lahir','pg.tanggal_lahir','pg.jenis_kelamin','pg.agama','pg.jenis_dokumen','pg.no_dokumen',
                'pg.kelurahan','pg.kecamatan','pg.kota','pg.provinsi','pg.kode_pos','pg.no_hp','pg.no_telp','pg.jenis_pegawai','pg.kedudukan_pns',
                'pg.status_pegawai','pg.tmt_pns','pg.no_seri_karpeg','pg.tmt_cpns','pg.tingkat_pendidikan','pg.pendidikan_terakhir','pg.ruangan','pg.dokumen_ktp',
                'pj.unit_organisasi','pj.unit_organisasi_induk','pj.jenis_jabatan','pj.eselon','pj.jabatan','pj.tmt','pj.lokasi_kerja','pj.gol_ruang_awal','pj.gol_ruang_akhir',
                'pj.tmt_golongan','pj.gaji_pokok','pj.masa_kerja_tahun','pj.masa_kerja_bulan','pj.no_spmt','pj.tanggal_spmt','pj.kppn')
            ->where('users.user_id', $user_id)->get();
            
        $users = DB::table('users')
            ->leftJoin('profile_information as pr','pr.user_id','users.user_id')
            // ->leftJoin('riwayat_pendidikan as rp','rp.user_id','users.user_id')
            // ->leftJoin('riwayat_golongan as rg','rg.user_id','users.user_id')
            // ->leftJoin('riwayat_jabatan as rj','rj.user_id','users.user_id')
            // ->leftJoin('riwayat_diklat as rd','rd.user_id','users.user_id')
            ->leftJoin('profil_pegawai as pg','pg.user_id','users.user_id')
            ->leftJoin('posisi_jabatan as pj','pj.user_id','users.user_id')
            ->select('users.*','pr.tgl_lahir','pr.jk','pr.alamat','pr.tmpt_lahir','pg.name','pg.email','pg.nip','pg.gelar_depan',
                'pg.gelar_belakang','pg.tempat_lahir','pg.tanggal_lahir','pg.jenis_kelamin','pg.agama','pg.jenis_dokumen','pg.no_dokumen',
                'pg.kelurahan','pg.kecamatan','pg.kota','pg.provinsi','pg.kode_pos','pg.no_hp','pg.no_telp','pg.jenis_pegawai','pg.kedudukan_pns',
                'pg.status_pegawai','pg.tmt_pns','pg.no_seri_karpeg','pg.tmt_cpns','pg.tingkat_pendidikan','pg.pendidikan_terakhir','pg.ruangan','pg.dokumen_ktp',
                'pj.unit_organisasi','pj.unit_organisasi_induk','pj.jenis_jabatan','pj.eselon','pj.jabatan','pj.tmt','pj.lokasi_kerja','pj.gol_ruang_awal','pj.gol_ruang_akhir',
                'pj.tmt_golongan','pj.gaji_pokok','pj.masa_kerja_tahun','pj.masa_kerja_bulan','pj.no_spmt','pj.tanggal_spmt','pj.kppn')
            ->where('users.user_id', $user_id)->first();

            $riwayatPendidikan = DB::table('users')
            ->leftJoin('riwayat_pendidikan as rp', 'rp.user_id', 'users.user_id')
            ->select('users.*', 'rp.id', 'rp.id_pend', 'rp.ting_ped', 'rp.pendidikan', 'rp.tahun_lulus', 'rp.no_ijazah', 'rp.nama_sekolah', 'rp.gelar_depan_pend', 'rp.gelar_belakang_pend',
                'rp.jenis_pendidikan', 'rp.dokumen_transkrip', 'rp.dokumen_ijazah', 'rp.dokumen_gelar')
            ->where('users.user_id', $user_id)->get();
            $riwayatPendidikans = $riwayatPendidikan->first();

            $riwayatGolongan = DB::table('users')
            ->leftJoin('riwayat_golongan as rg', 'rg.user_id', 'users.user_id')
            ->select('users.*', 'rg.id', 'rg.id_gol','rg.golongan','rg.jenis_kenaikan_pangkat','rg.masa_kerja_golongan_tahun','rg.masa_kerja_golongan_bulan',
                'rg.tmt_golongan_riwayat','rg.no_teknis_bkn','rg.tanggal_teknis_bkn','rg.no_sk_golongan','rg.tanggal_sk_golongan','rg.dokumen_skkp','rg.dokumen_teknis_kp')
            ->where('users.user_id', $user_id)->get();
            $riwayatGolongans = $riwayatGolongan->first();

            $riwayatJabatan = DB::table('users')
            ->leftJoin('riwayat_jabatan as rj','rj.user_id','users.user_id')
            ->select('users.*','rj.id', 'rj.id_jab','rj.jenis_jabatan_riwayat','rj.satuan_kerja','rj.satuan_kerja_induk','rj.unit_organisasi_riwayat',
                    'rj.no_sk','rj.tanggal_sk','rj.tmt_jabatan','rj.tmt_pelantikan','rj.dokumen_sk_jabatan','rj.dokumen_pelantikan')
            ->where('users.user_id', $user_id)->get();
            $riwayatJabatans = $riwayatJabatan->first();

            $riwayatDiklat = DB::table('users')
            ->leftJoin('riwayat_diklat as rd','rd.user_id','users.user_id')
            ->select('users.*','rd.id','rd.id_dik','rd.jenis_diklat','rd.nama_diklat','rd.institusi_penyelenggara','rd.no_sertifikat',
                    'rd.tanggal_mulai','rd.tanggal_selesai','rd.tahun_diklat','rd.durasi_jam','rd.dokumen_diklat')
            ->where('users.user_id', $user_id)->get();
            $riwayatDiklats = $riwayatDiklat->first();

            $agamaOptions = DB::table('agama_id')->pluck('agama', 'agama');

            $kedudukanOptions = DB::table('kedudukan_hukum_id')->pluck('kedudukan', 'kedudukan');

            $jenispegawaiOptions = DB::table('jenis_pegawai_id')->pluck('jenis_pegawai', 'jenis_pegawai');

            $tingkatpendidikanOptions = DB::table('tingkat_pendidikan_id')->pluck('tingkat_pendidikan', 'tingkat_pendidikan');
        
            $ruanganOptions = DB::table('ruangan_id')->pluck('ruangan', 'ruangan');

            $jenisjabatanOptions = DB::table('jenis_jabatan_id')->pluck('nama', 'nama');
        
            $golonganOptions = DB::table('golongan_id')->pluck('nama_golongan', 'nama_golongan');

            $jenisdiklatOptions = DB::table('jenis_diklat_id')->pluck('jenis_diklat', 'jenis_diklat');

            $pendidikanterakhirOptions = DB::table('pendidikan_id')->pluck('pendidikan', 'pendidikan');

        $provinces = Province::all();


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

        return view('employees.employeeprofile', compact('user', 'users','riwayatPendidikan','riwayatPendidikans','riwayatGolongan','riwayatGolongans',
        'riwayatJabatan','riwayatJabatans','riwayatDiklat','riwayatDiklats','agamaOptions', 'kedudukanOptions',
        'jenispegawaiOptions', 'tingkatpendidikanOptions', 'ruanganOptions', 'jenisjabatanOptions', 'golonganOptions', 'jenisdiklatOptions',
        'pendidikanterakhirOptions' ,'unreadNotifications', 'readNotifications', 'provinces'));
    }

    public function getkota(Request $request)
    {
        $id_provinsi = $request->id_provinsi;
        $kotakabupatens = Regency::where('province_id', $id_provinsi)->get();

        $option = "<option value='' disabled selected>-- Pilih Kota/Kabupaten --</option>";
        foreach ($kotakabupatens as $kotakabupaten) {
            $option .= "<option value='$kotakabupaten->id'>$kotakabupaten->name</option>";
        }
        echo $option;
    }

    public function getkecamatan_employee(Request $request)
    {
        $id_kotakabupaten = $request->id_kotakabupaten;
        $kecamatans = District::where('regency_id', $id_kotakabupaten)->get();

        $option = "<option value='' disabled selected>-- Pilih Kecamatan --</option>";
        foreach ($kecamatans as $kecamatan) {
            $option .= "<option value='$kecamatan->id'>$kecamatan->name</option>";
        }
        echo $option;
    }

    public function getkelurahan(Request $request)
    {
        $id_kecamatan = $request->id_kecamatan;
        $desakelurahans = Village::where('district_id', $id_kecamatan)->get();
        $option = "<option value='' disabled selected>-- Pilih Desa/Kelurahan --</option>";

        foreach ($desakelurahans as $desakelurahan) {
            $option .= "<option value='$desakelurahan->id'>$desakelurahan->name</option>";
        }
        echo $option;
    }

    /** page agama */
    public function indexAgama()
    {
        $agama = DB::table('agama_id')->get();

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
        
        return view('employees.agama', compact('agama', 'unreadNotifications', 'readNotifications'));
    }

    /** search for agama */
    public function searchAgama(Request $request)
    {
        $keyword = $request->input('keyword');

        $agama = DB::table('agama_id')
        ->where('agama', 'like', '%' . $keyword . '%')
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

        return view('employees.agama', compact('agama', 'unreadNotifications', 'readNotifications'));
    }

    /** save record agama */
    public function saveRecordAgama(Request $request)
    {
        $request->validate([
            'agama' => 'required|string|max:255',
        ]);

        DB::beginTransaction();
        try {

            $agama = agama::where('agama', $request->agama)->first();
            if ($agama === null) {
                $agama = new agama;
                $agama->agama = $request->agama;
                $agama->save();

                DB::commit();
                Toastr::success('Data agama telah ditambah :)', 'Sukses');
                return redirect()->back();
            } else {
                DB::rollback();
                Toastr::error('Data agama telah tersedia :(', 'Error');
                return redirect()->back();
            }
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Data agama gagal ditambah :(', 'Error');
            return redirect()->back();
        }
    }

    /** update record agama */
    public function updateRecordAgama(Request $request)
    {
        DB::beginTransaction();
        try {

            $agama = [
                'id'    => $request->id,
                'agama' => $request->agama,
            ];
            agama::where('id', $request->id)->update($agama);

            DB::commit();
            Toastr::success('Data agama berhasil diperbaharui :)', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Data agama gagal diperbaharui :(', 'Error');
            return redirect()->back();
        }
    }

    /** delete record agama */
    public function deleteRecordAgama(Request $request)
    {
        try {

            agama::destroy($request->id);
            Toastr::success('Data agama berhasil dihapus :)', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Data agama gagal dihapus :)', 'Error');
            return redirect()->back();
        }
    }

    

    /** page kedudukan */
    public function indexKedudukan()
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

        $kedudukan = DB::table('kedudukan_hukum_id')->get();
        return view('employees.kedudukan', compact('kedudukan', 'unreadNotifications', 'readNotifications'));
    }

    /** search for kedudukan */
    public function searchKedudukan(Request $request)
    {
        $keyword = $request->input('keyword');

        $kedudukan = DB::table('kedudukan_hukum_id')
        ->where('kedudukan', 'like', '%' . $keyword . '%')
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

        return view('employees.kedudukan', compact('kedudukan', 'unreadNotifications', 'readNotifications'));
    }

    /** save record kedudukan */
    public function saveRecordKedudukan(Request $request)
    {
        $request->validate([
            'kedudukan' => 'required|string|max:255',
        ]);

        DB::beginTransaction();
        try {

            $kedudukan = kedudukan::where('kedudukan', $request->kedudukan)->first();
            if ($kedudukan === null) {
                $kedudukan = new kedudukan;
                $kedudukan->kedudukan = $request->kedudukan;
                $kedudukan->save();

                DB::commit();
                Toastr::success('Data kedudukan telah ditambah :)', 'Sukses');
                return redirect()->back();
            } else {
                DB::rollback();
                Toastr::error('Data kedudukan telah tersedia :(', 'Error');
                return redirect()->back();
            }
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Data kedudukan gagal ditambah :(', 'Error');
            return redirect()->back();
        }
    }

    /** update record kedudukan */
    public function updateRecordKedudukan(Request $request)
    {
        DB::beginTransaction();
        try {

            $kedudukan = [
                'id'    => $request->id,
                'kedudukan' => $request->kedudukan,
            ];
            kedudukan::where('id', $request->id)->update($kedudukan);

            DB::commit();
            Toastr::success('Data kedudukan berhasil diperbaharui :)', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Data kedudukan gagal diperbaharui :(', 'Error');
            return redirect()->back();
        }
    }

    /** delete record kedudukan */
    public function deleteRecordKedudukan(Request $request)
    {
        try {

            kedudukan::destroy($request->id);
            Toastr::success('Data kedudukan berhasil dihapus :)', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Data kedudukan gagal dihapus :)', 'Error');
            return redirect()->back();
        }
    }

    /** page pendidikan */
    public function indexPendidikan()
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

        $pendidikan = DB::table('pendidikan_id')->get();
        return view('employees.pendidikan', compact('pendidikan', 'unreadNotifications', 'readNotifications'));
    }

    /** search for pendidikan */
    public function searchPendidikan(Request $request)
    {
        $keyword = $request->input('keyword');

        $pendidikan = DB::table('pendidikan_id')
        ->where('pendidikan', 'like', '%' . $keyword . '%')
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

        return view('employees.pendidikan', compact('pendidikan', 'unreadNotifications', 'readNotifications'));
    }


    /** save record pendidikan */
    public function saveRecordPendidikan(Request $request)
    {
        $request->validate([
            'pendidikan' => 'required|string|max:255',
        ]);

        DB::beginTransaction();
        try {

            $pendidikan = pendidikan::where('pendidikan', $request->pendidikan)->first();
            if ($pendidikan === null) {
                $pendidikan = new pendidikan;
                $pendidikan->pendidikan         = $request->pendidikan;
                $pendidikan->tk_pendidikan_id   = $request->tk_pendidikan_id;
                $pendidikan->status_pendidikan  = $request->status_pendidikan;
                $pendidikan->save();

                DB::commit();
                Toastr::success('Data pendidikan telah ditambah :)', 'Sukses');
                return redirect()->back();
            } else {
                DB::rollback();
                Toastr::error('Data pendidikan telah tersedia :(', 'Error');
                return redirect()->back();
            }
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Data pendidikan gagal ditambah :)', 'Error');
            return redirect()->back();
        }
    }

    /** update record pendidikan */
    public function updateRecordPendidikan(Request $request)
    {
        $request->validate([
            'pendidikan'        => 'required|string|max:255',
            'tk_pendidikan_id'  => 'required|string|max:255',
            'status_pendidikan' => 'required|string|max:255',
        ]);

        DB::beginTransaction();
        try {

            $pendidikan = [
                'pendidikan'        => $request->pendidikan,
                'tk_pendidikan_id'  => $request->tk_pendidikan_id,
                'status_pendidikan' => $request->status_pendidikan,
            ];

            DB::table('pendidikan_id')->where('id', $request->id)->update($pendidikan);

            DB::commit();
            Toastr::success('Data pendidikan berhasil diperbaharui :)', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Data pendidikan gagal diperbaharui :(', 'Error');
            return redirect()->back();
        }
    }

    /** delete record pendidikan */
    public function deleteRecordPendidikan(Request $request)
    {
        try {

            pendidikan::destroy($request->id);
            Toastr::success('Data pendidikan berhasil dihapus :)', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Data pendidikan gagal dihapus :)', 'Error');
            return redirect()->back();
        }
    }

    /** page ruangan */
    public function indexRuangan()
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

        $ruangan = DB::table('ruangan_id')->get();
        return view('employees.ruangan', compact('ruangan', 'unreadNotifications', 'readNotifications'));
    }

    /** search for ruangan */
    public function searchRuangan(Request $request)
    {
        $keyword = $request->input('keyword');

        $ruangan = DB::table('ruangan_id')
        ->where('ruangan', 'like', '%' . $keyword . '%')
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

        return view('employees.ruangan', compact('ruangan', 'unreadNotifications', 'readNotifications'));
    }

    /** save record ruangan */
    public function saveRecordRuangan(Request $request)
    {
        $request->validate([
            'ruangan' => 'required|string|max:255',
            'jumlah_tempat_tidur' => 'nullable|string|max:255',
        ]);

        DB::beginTransaction();
        try {

            $ruangan = ruangan::where('ruangan', $request->ruangan)->first();
            if ($ruangan === null) {
                $ruangan = new ruangan;
                $ruangan->ruangan = $request->ruangan;
                $ruangan->jumlah_tempat_tidur = $request->jumlah_tempat_tidur;
                $ruangan->save();

                DB::commit();
                Toastr::success('Data ruangan telah ditambah :)', 'Sukses');
                return redirect()->back();
            } else {
                DB::rollback();
                Toastr::error('Data ruangan telah tersedia :(', 'Error');
                return redirect()->back();
            }
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Data ruangan gagal ditambah :(', 'Error');
            return redirect()->back();
        }
    }

    /** update record ruangan */
    public function updateRecordRuangan(Request $request)
    {
        DB::beginTransaction();
        try {

            $ruangan = [
                'id'    => $request->id,
                'ruangan' => $request->ruangan,
                'jumlah_tempat_tidur' => $request->jumlah_tempat_tidur,
            ];
            ruangan::where('id', $request->id)->update($ruangan);

            DB::commit();
            Toastr::success('Data ruangan berhasil diperbaharui :)', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Data ruangan gagal diperbaharui :(', 'Error');
            return redirect()->back();
        }
    }

    /** delete record ruangan */
    public function deleteRecordRuangan(Request $request)
    {
        try {

            ruangan::destroy($request->id);
            Toastr::success('Data ruangan berhasil dihapus :)', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Data ruangan gagal dihapus :)', 'Error');
            return redirect()->back();
        }
    }

    /** page sumpah */
    public function indexSumpah()
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

        $sumpah = DB::table('sumpah_id')->get();
        return view('employees.sumpah', compact('sumpah', 'unreadNotifications', 'readNotifications'));
    }

    /** search for sumpah */
    public function searchSumpah(Request $request)
    {
        $keyword = $request->input('keyword');

        $sumpah = DB::table('sumpah_id')
        ->where('sumpah', 'like', '%' . $keyword . '%')
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

        return view('employees.sumpah', compact('sumpah', 'unreadNotifications', 'readNotifications'));
    }

    /** save record sumpah */
    public function saveRecordSumpah(Request $request)
    {
        $request->validate([
            'sumpah' => 'required|string|max:255',
        ]);

        DB::beginTransaction();
        try {

            $sumpah = Sumpah::where('sumpah', $request->sumpah)->first();
            if ($sumpah === null) {
                $sumpah = new Sumpah();
                $sumpah->sumpah = $request->sumpah;
                $sumpah->save();

                DB::commit();
                Toastr::success('Data sumpah telah ditambah :)', 'Sukses');
                return redirect()->back();
            } else {
                DB::rollback();
                Toastr::error('Data sumpah telah tersedia :(', 'Error');
                return redirect()->back();
            }
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Data sumpah gagal ditambah :(', 'Error');
            return redirect()->back();
        }
    }

    /** update record sumpah */
    public function updateRecordSumpah(Request $request)
    {
        DB::beginTransaction();
        try {

            $sumpah = [
                'id'    => $request->id,
                'sumpah' => $request->sumpah,
            ];
            sumpah::where('id', $request->id)->update($sumpah);

            DB::commit();
            Toastr::success('Data sumpah berhasil diperbaharui :)', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Data sumpah gagal diperbaharui :(', 'Error');
            return redirect()->back();
        }
    }

    /** delete record sumpah */
    public function deleteRecordSumpah(Request $request)
    {
        try {

            sumpah::destroy($request->id);
            Toastr::success('Data sumpah berhasil dihapus :)', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Data sumpah gagal dihapus :)', 'Error');
            return redirect()->back();
        }
    }

    /** page status */
    public function indexStatus()
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

        $jenis_pegawai = DB::table('jenis_pegawai_id')->get();
        return view('employees.status', compact('jenis_pegawai', 'unreadNotifications', 'readNotifications'));
    }

    /** search for status */
    public function searchStatus(Request $request)
    {
        $keyword = $request->input('keyword');

        $jenis_pegawai = DB::table('jenis_pegawai_id')
        ->where('jenis_pegawai', 'like', '%' . $keyword . '%')
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

        return view('employees.status', compact('jenis_pegawai', 'unreadNotifications', 'readNotifications'));
    }

    /** save record status */
    public function saveRecordStatus(Request $request)
    {
        $request->validate([
            'jenis_pegawai' => 'required|string|max:255',
        ]);

        DB::beginTransaction();
        try {

            $jenis_pegawai = jenis_pegawai::where('jenis_pegawai', $request->jenis_pegawai)->first();
            if ($jenis_pegawai === null) {
                $jenis_pegawai = new jenis_pegawai;
                $jenis_pegawai->jenis_pegawai = $request->jenis_pegawai;
                $jenis_pegawai->save();

                DB::commit();
                Toastr::success('Data status telah ditambah :)', 'Sukses');
                return redirect()->back();
            } else {
                DB::rollback();
                Toastr::error('Data status telah tersedia :(', 'Error');
                return redirect()->back();
            }
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Data status gagal ditambah :(', 'Error');
            return redirect()->back();
        }
    }

    /** update record status */
    public function updateRecordStatus(Request $request)
    {
        DB::beginTransaction();
        try {

            $jenis_pegawai = [
                'id'    => $request->id,
                'jenis_pegawai' => $request->jenis_pegawai,
            ];
            jenis_pegawai::where('id', $request->id)->update($jenis_pegawai);

            DB::commit();
            Toastr::success('Data status berhasil diperbaharui :)', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Data status gagal diperbaharui :(', 'Error');
            return redirect()->back();
        }
    }

    /** delete record status */
    public function deleteRecordStatus(Request $request)
    {
        try {

            jenis_pegawai::destroy($request->id);
            Toastr::success('Data status berhasil dihapus :)', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Data status gagal dihapus :)', 'Error');
            return redirect()->back();
        }
    }

    /** page pangkat */
    public function indexPangkat()
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

        $ref_pangkat = DB::table('referensi_pangkat')->get();
        return view('employees.referensi-pangkat', compact('ref_pangkat', 'unreadNotifications', 'readNotifications'));
    }

    /** search for pangkat */
    public function searchPangkat(Request $request)
    {
        $keyword = $request->input('keyword');

        $ref_pangkat = DB::table('referensi_pangkat')
        ->where('ref_pangkat', 'like', '%' . $keyword . '%')
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

        return view('employees.referensi-pangkat', compact('ref_pangkat', 'unreadNotifications', 'readNotifications'));
    }

    /** save record pangkat */
    public function saveRecordPangkat(Request $request)
    {
        $request->validate([
            'ref_pangkat' => 'required|string|max:255',
        ]);

        DB::beginTransaction();
        try {

            $ref_pangkat = ReferensiPangkat::where('ref_pangkat', $request->ref_pangkat)->first();
            if ($ref_pangkat === null) {
                $ref_pangkat = new ReferensiPangkat;
                $ref_pangkat->ref_pangkat = $request->ref_pangkat;
                $ref_pangkat->save();

                DB::commit();
                Toastr::success('Data pangkat telah ditambah :)', 'Sukses');
                return redirect()->back();
            } else {
                DB::rollback();
                Toastr::error('Data pangkat telah tersedia :(', 'Error');
                return redirect()->back();
            }
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Data pangkat gagal ditambah :(', 'Error');
            return redirect()->back();
        }
    }

    /** update record pangkat */
    public function updateRecordPangkat(Request $request)
    {
        DB::beginTransaction();
        try {

            $ref_pangkat = [
                'id'    => $request->id,
                'ref_pangkat' => $request->jenis_pegawai,
            ];
            ReferensiPangkat::where('id', $request->id)->update($ref_pangkat);

            DB::commit();
            Toastr::success('Data pangkat berhasil diperbaharui :)', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Data pangkat gagal diperbaharui :(', 'Error');
            return redirect()->back();
        }
    }

    /** delete record pangkat */
    public function deleteRecordPangkat(Request $request)
    {
        try {

            jenis_pegawai::destroy($request->id);
            Toastr::success('Data pangkat berhasil dihapus :)', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Data pangkat gagal dihapus :)', 'Error');
            return redirect()->back();
        }
    }

    /** page SIP */
    public function indexSIP()
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

        $datasip = Session::get('user_id');
        $sip = sipDokter::where('user_id', $datasip)->get();

        return view('employees.sip_dokter', compact('datasip', 'sip', 'unreadNotifications', 'readNotifications'));
    }

    /** save record SIP dokter */
    public function saveRecordSIPDokter(Request $request)
    {
        $request->validate([
            'user_id'           => 'required|string|max:255',
            'nip'               => 'required|string|max:255',
            'name'              => 'required|string|max:255',
            'unit_kerja'        => 'required|string|max:255',
            'nomor_sip'         => 'required|string|max:255',
            'tanggal_terbit'    => 'required|string|max:255',
            'tanggal_berlaku'   => 'required|string|max:255',
            'dokumen_sip'       => 'required|mimes:pdf|max:5120',
        ]);

        DB::beginTransaction();
        try {
            $dokumen_sip = time() . '.' . $request->dokumen_sip->extension();
            $request->dokumen_sip->move(public_path('assets/DokumenSIP'), $dokumen_sip);

            $sip = new sipDokter;
            $sip->user_id               = $request->user_id;
            $sip->nip                   = $request->nip;
            $sip->name                  = $request->name;
            $sip->unit_kerja            = $request->unit_kerja;
            $sip->nomor_sip             = $request->nomor_sip;
            $sip->tanggal_terbit        = $request->tanggal_terbit;
            $sip->tanggal_berlaku       = $request->tanggal_berlaku;
            $sip->dokumen_sip           = $dokumen_sip;
            $sip->save();

            DB::commit();
            Toastr::success('Data SIP dokter telah ditambah :)', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Data SIP dokter gagal ditambah :(', 'Error');
            return redirect()->back();
        }
    }
    /** end Add record SIP dokter */

    public function searchpegawaipensiunList(Request $request)
    {
        $query = DB::table('users')
        ->leftjoin('profil_pegawai', 'users.user_id', 'profil_pegawai.user_id')
        ->leftjoin('posisi_jabatan', 'users.user_id', 'posisi_jabatan.user_id')
        ->select(
            'users.*',
            'profil_pegawai.name',
            'profil_pegawai.email',
            'profil_pegawai.nip',
            'profil_pegawai.gelar_depan',
            'profil_pegawai.gelar_belakang',
            'profil_pegawai.tempat_lahir',
            'profil_pegawai.tanggal_lahir',
            'profil_pegawai.jenis_kelamin',
            'profil_pegawai.agama',
            'profil_pegawai.jenis_dokumen',
            'profil_pegawai.no_dokumen',
            'profil_pegawai.kelurahan',
            'profil_pegawai.kecamatan',
            'profil_pegawai.kota',
            'profil_pegawai.provinsi',
            'profil_pegawai.kode_pos',
            'profil_pegawai.no_hp',
            'profil_pegawai.no_telp',
            'profil_pegawai.jenis_pegawai',
            'profil_pegawai.kedudukan_pns',
            'profil_pegawai.status_pegawai',
            'profil_pegawai.tmt_pns',
            'profil_pegawai.no_seri_karpeg',
            'profil_pegawai.tmt_cpns',
            'profil_pegawai.tingkat_pendidikan',
            'profil_pegawai.pendidikan_terakhir',
            'profil_pegawai.ruangan',
            'users.name',
            'posisi_jabatan.jabatan'
        )
            ->where('users.role_name', 'User');

        if ($request->has('nip')) {
            $query->where('profil_pegawai.nip', 'LIKE', '%' . $request->input('nip') . '%');
        }

        if ($request->has('name')) {
            $query->where('profil_pegawai.name', 'LIKE', '%' . $request->input('name') . '%');
        }

        if ($request->has('email')) {
            $query->where('profil_pegawai.email', 'LIKE', '%' . $request->input('email') . '%');
        }

        // Tambahkan kondisi untuk kedudukan_pns
        $query->where('profil_pegawai.kedudukan_pns', 'Pensiun');

        $users = $query->get();

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

        return view('employees.datapensiunlist', compact('users', 'unreadNotifications', 'readNotifications'));
    }
}
