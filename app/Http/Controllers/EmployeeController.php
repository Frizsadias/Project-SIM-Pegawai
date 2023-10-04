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
use Carbon\Carbon;

class EmployeeController extends Controller
{
    /** all employee card view */
    public function cardAllEmployee(Request $request)
    {
        $users = DB::table('users')
            ->leftjoin('employees','users.user_id','employees.employee_id')
            ->leftjoin('profil_pegawai', 'users.user_id', 'profil_pegawai.user_id')
            ->select('users.*','profil_pegawai.nip','profil_pegawai.nama','profil_pegawai.gelar_depan','profil_pegawai.gelar_belakang','profil_pegawai.tempat_lahir',
                'profil_pegawai.tanggal_lahir','profil_pegawai.jenis_kelamin','profil_pegawai.agama','profil_pegawai.jenis_dokumen','profil_pegawai.no_dokumen',
                'profil_pegawai.kelurahan','profil_pegawai.kecamatan','profil_pegawai.kota','profil_pegawai.provinsi','profil_pegawai.kode_pos',
                'profil_pegawai.no_hp','profil_pegawai.no_telp','profil_pegawai.jenis_pegawai','profil_pegawai.kedudukan_pns','profil_pegawai.status_pegawai',
                'profil_pegawai.tmt_pns','profil_pegawai.no_seri_karpeg','profil_pegawai.tmt_cpns','profil_pegawai.tingkat_pendidikan','profil_pegawai.pendidikan_terakhir',
                'employees.name','employees.email','users.name','users.email')
            ->get();
        $userList = DB::table('users')->get();
        $permission_lists = DB::table('permission_lists')->get();
        return view('employees.allemployeecard', compact('users', 'userList', 'permission_lists'));
    }

    /** all employee list */
    public function listAllEmployee()
    {
        $users = DB::table('users')
            ->leftjoin('employees','users.user_id','employees.employee_id')
            ->leftjoin('profil_pegawai', 'users.user_id', 'profil_pegawai.user_id')
            ->select('users.*','profil_pegawai.nip','profil_pegawai.nama','profil_pegawai.gelar_depan','profil_pegawai.gelar_belakang','profil_pegawai.tempat_lahir',
                'profil_pegawai.tanggal_lahir','profil_pegawai.jenis_kelamin','profil_pegawai.agama','profil_pegawai.jenis_dokumen','profil_pegawai.no_dokumen',
                'profil_pegawai.kelurahan','profil_pegawai.kecamatan','profil_pegawai.kota','profil_pegawai.provinsi','profil_pegawai.kode_pos',
                'profil_pegawai.no_hp','profil_pegawai.no_telp','profil_pegawai.jenis_pegawai','profil_pegawai.kedudukan_pns','profil_pegawai.status_pegawai',
                'profil_pegawai.tmt_pns','profil_pegawai.no_seri_karpeg','profil_pegawai.tmt_cpns','profil_pegawai.tingkat_pendidikan','profil_pegawai.pendidikan_terakhir',
                'employees.name','employees.email','users.name','users.email')
            ->get();
        $userList = DB::table('users')->get();
        $permission_lists = DB::table('permission_lists')->get();
        return view('employees.employeelist', compact('users', 'userList', 'permission_lists'));
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
        return view('employees.allemployeecard', compact('users', 'userList'));
    }

    /** list search employee */
    public function employeeListSearch(Request $request)
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
        return view('employees.employeelist', compact('users', 'userList'));
    }
    /** End Search */

    /** employee profile with all controller user */
    public function profileEmployee($user_id)
    {
        $user = DB::table('users')
            ->leftJoin('profile_information as pr','pr.user_id','users.user_id')
            ->leftJoin('riwayat_pendidikan as rp','rp.user_id','users.user_id')
            ->leftJoin('riwayat_golongan as rg','rg.user_id','users.user_id')
            ->leftJoin('riwayat_jabatan as rj','rj.user_id','users.user_id')
            ->leftJoin('riwayat_diklat as rd','rd.user_id','users.user_id')
            ->leftJoin('profil_pegawai as pg','pg.user_id','users.user_id')
            ->leftJoin('posisi_jabatan as pj','pj.user_id','users.user_id')
            ->select('users.*','pr.tgl_lahir','pr.jk','pr.alamat','rp.ting_ped','rp.pendidikan',
                'rp.tahun_lulus','rp.no_ijazah','rp.nama_sekolah','rp.gelar_depan','rp.gelar_belakang',
                'rp.jenis_pendidikan','rp.dokumen_transkrip','rp.dokumen_ijazah','rp.dokumen_gelar','rg.golongan',
                'rg.jenis_kenaikan_pangkat','rg.masa_kerja_golongan_tahun','rg.masa_kerja_golongan_bulan','rg.tmt_golongan_riwayat','rg.no_teknis_bkn',
                'rg.tanggal_teknis_bkn','rg.no_sk_golongan','rg.tanggal_sk','rg.dokumen_skkp','rg.dokumen_teknis_kp','rj.jenis_jabatan_riwayat',
                'rj.satuan_kerja','rj.satuan_kerja_induk','rj.unit_organisasi_riwayat','rj.no_sk','rj.tanggal_sk','rj.tmt_jabatan','rj.tmt_pelantikan',
                'rj.dokumen_sk_jabatan','rj.dokumen_pelantikan','rd.jenis_diklat','rd.nama_diklat','rd.institusi_penyelenggara','rd.no_sertifikat',
                'rd.tanggal_mulai','rd.tanggal_selesai','rd.tahun_diklat','rd.durasi_jam','rd.dokumen_diklat','pg.nip','pg.nama','pg.gelar_depan',
                'pg.gelar_belakang','pg.tempat_lahir','pg.tanggal_lahir','pg.jenis_kelamin','pg.agama','pg.jenis_dokumen','pg.no_dokumen',
                'pg.kelurahan','pg.kecamatan','pg.kota','pg.provinsi','pg.kode_pos','pg.no_hp','pg.no_telp','pg.jenis_pegawai','pg.kedudukan_pns',
                'pg.status_pegawai','pg.tmt_pns','pg.no_seri_karpeg','pg.tmt_cpns','pg.tingkat_pendidikan','pg.pendidikan_terakhir','pj.unit_organisasi',
                'pj.unit_organisasi_induk','pj.jenis_jabatan','pj.eselon','pj.jabatan','pj.tmt','pj.lokasi_kerja','pj.gol_ruang_awal','pj.gol_ruang_akhir',
                'pj.tmt_golongan','pj.gaji_pokok','pj.masa_kerja_tahun','pj.masa_kerja_bulan','pj.no_spmt','pj.tanggal_spmt','pj.kppn')
            ->where('users.user_id', $user_id)->get();
        $users = DB::table('users')
            ->leftJoin('profile_information as pr','pr.user_id','users.user_id')
            ->leftJoin('riwayat_pendidikan as rp','rp.user_id','users.user_id')
            ->leftJoin('riwayat_golongan as rg','rg.user_id','users.user_id')
            ->leftJoin('riwayat_jabatan as rj','rj.user_id','users.user_id')
            ->leftJoin('riwayat_diklat as rd','rd.user_id','users.user_id')
            ->leftJoin('profil_pegawai as pg','pg.user_id','users.user_id')
            ->leftJoin('posisi_jabatan as pj','pj.user_id','users.user_id')
            ->select('users.*','pr.tgl_lahir','pr.jk','pr.alamat','rp.ting_ped','rp.pendidikan',
                'rp.tahun_lulus','rp.no_ijazah','rp.nama_sekolah','rp.gelar_depan','rp.gelar_belakang',
                'rp.jenis_pendidikan','rp.dokumen_transkrip','rp.dokumen_ijazah','rp.dokumen_gelar','rg.golongan',
                'rg.jenis_kenaikan_pangkat','rg.masa_kerja_golongan_tahun','rg.masa_kerja_golongan_bulan','rg.tmt_golongan_riwayat','rg.no_teknis_bkn',
                'rg.tanggal_teknis_bkn','rg.no_sk_golongan','rg.tanggal_sk','rg.dokumen_skkp','rg.dokumen_teknis_kp','rj.jenis_jabatan_riwayat',
                'rj.satuan_kerja','rj.satuan_kerja_induk','rj.unit_organisasi_riwayat','rj.no_sk','rj.tanggal_sk','rj.tmt_jabatan','rj.tmt_pelantikan',
                'rj.dokumen_sk_jabatan','rj.dokumen_pelantikan','rd.jenis_diklat','rd.nama_diklat','rd.institusi_penyelenggara','rd.no_sertifikat',
                'rd.tanggal_mulai','rd.tanggal_selesai','rd.tahun_diklat','rd.durasi_jam','rd.dokumen_diklat','pg.nip','pg.nama','pg.gelar_depan',
                'pg.gelar_belakang','pg.tempat_lahir','pg.tanggal_lahir','pg.jenis_kelamin','pg.agama','pg.jenis_dokumen','pg.no_dokumen',
                'pg.kelurahan','pg.kecamatan','pg.kota','pg.provinsi','pg.kode_pos','pg.no_hp','pg.no_telp','pg.jenis_pegawai','pg.kedudukan_pns',
                'pg.status_pegawai','pg.tmt_pns','pg.no_seri_karpeg','pg.tmt_cpns','pg.tingkat_pendidikan','pg.pendidikan_terakhir','pj.unit_organisasi',
                'pj.unit_organisasi_induk','pj.jenis_jabatan','pj.eselon','pj.jabatan','pj.tmt','pj.lokasi_kerja','pj.gol_ruang_awal','pj.gol_ruang_akhir',
                'pj.tmt_golongan','pj.gaji_pokok','pj.masa_kerja_tahun','pj.masa_kerja_bulan','pj.no_spmt','pj.tanggal_spmt','pj.kppn')
            ->where('users.user_id', $user_id)->first();
        return view('employees.employeeprofile', compact('user', 'users'));
    }

    /** page agama */
    public function indexAgama()
    {
        $agama = DB::table('agama_id')->get();
        return view('employees.agama', compact('agama'));
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

    /** page pendidikan */
    public function indexPendidikan()
    {
        $pendidikan = DB::table('pendidikan_id')->get();
        return view('employees.pendidikan', compact('pendidikan'));
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
}
