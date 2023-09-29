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

class EmployeeController extends Controller
{
    /** all employee card view */
    public function cardAllEmployee(Request $request)
    {
        $users = DB::table('users')
            ->join('profil_pegawai','users.user_id','profil_pegawai.user_id')
            ->select('users.*','profil_pegawai.nip','profil_pegawai.nama','profil_pegawai.gelar_depan','profil_pegawai.gelar_belakang','profil_pegawai.tempat_lahir',
            'profil_pegawai.tanggal_lahir','profil_pegawai.jenis_kelamin','profil_pegawai.agama','profil_pegawai.jenis_dokumen','profil_pegawai.no_dokumen',
            'profil_pegawai.kelurahan','profil_pegawai.kecamatan','profil_pegawai.kota','profil_pegawai.provinsi','profil_pegawai.kode_pos',
            'profil_pegawai.no_hp','profil_pegawai.no_telp','profil_pegawai.jenis_pegawai','profil_pegawai.kedudukan_pns', 'profil_pegawai.status_pegawai',
            'profil_pegawai.tmt_pns','profil_pegawai.no_seri_karpeg','profil_pegawai.tmt_cpns','profil_pegawai.tingkat_pendidikan','profil_pegawai.pendidikan_terakhir')
            ->get();
        $userList = DB::table('users')->get();
        return view('employees.allemployeecard',compact('users','userList'));
    }

    /** all employee list */
    public function listAllEmployee()
    {
        $users = DB::table('users')
            ->join('profil_pegawai','users.user_id','profil_pegawai.user_id')
            ->select('users.*','profil_pegawai.nip','profil_pegawai.nama','profil_pegawai.gelar_depan','profil_pegawai.gelar_belakang','profil_pegawai.tempat_lahir',
            'profil_pegawai.tanggal_lahir','profil_pegawai.jenis_kelamin','profil_pegawai.agama','profil_pegawai.jenis_dokumen','profil_pegawai.no_dokumen',
            'profil_pegawai.kelurahan','profil_pegawai.kecamatan','profil_pegawai.kota','profil_pegawai.provinsi','profil_pegawai.kode_pos',
            'profil_pegawai.no_hp','profil_pegawai.no_telp','profil_pegawai.jenis_pegawai','profil_pegawai.kedudukan_pns', 'profil_pegawai.status_pegawai',
            'profil_pegawai.tmt_pns','profil_pegawai.no_seri_karpeg','profil_pegawai.tmt_cpns','profil_pegawai.tingkat_pendidikan','profil_pegawai.pendidikan_terakhir')
            ->get();
        $userList = DB::table('users')->get();
        return view('employees.employeelist',compact('users','userList'));
    }

    /** save data employee */
    public function saveRecord(Request $request)
    {
        $request->validate([
            'user_id'               => 'required|string|max:255',
            'nip'                   => 'required|string|max:255',
            'name'                  => 'required|string|max:255',
            'email'                 => 'required|string|email',
            'nama'                  => 'required|string|max:255',
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
        ]);

        DB::beginTransaction();
        try{

            $employees = Employee::where('email', '=',$request->email)->first();
            if ($employees === null)
            {

                $employee = new Employee;
                $employee->user_id              = $request->user_id;
                $employee->nip                  = $request->nip;
                $employee->name                 = $request->name;
                $employee->email                = $request->email;
                $employee->nama                 = $request->nama;
                $employee->gelar_depan          = $request->gelar_depan;
                $employee->gelar_belakang       = $request->gelar_belakang;
                $employee->tempat_lahir         = $request->tempat_lahir;
                $employee->tanggal_lahir        = $request->tanggal_lahir;
                $employee->jenis_kelamin        = $request->jenis_kelamin;
                $employee->agama                = $request->agama;
                $employee->jenis_dokumen        = $request->jenis_dokumen;
                $employee->no_dokumen           = $request->no_dokumen;
                $employee->kelurahan            = $request->kelurahan;
                $employee->kecamatan            = $request->kecamatan;
                $employee->kota                 = $request->kota;
                $employee->provinsi             = $request->provinsi;
                $employee->kode_pos             = $request->kode_pos;
                $employee->no_hp                = $request->no_hp;
                $employee->no_telp              = $request->no_telp;
                $employee->jenis_pegawai        = $request->jenis_pegawai;
                $employee->kedudukan_pns        = $request->kedudukan_pns;
                $employee->status_pegawai       = $request->status_pegawai;
                $employee->tmt_pns              = $request->tmt_pns;
                $employee->no_seri_karpeg       = $request->no_seri_karpeg;
                $employee->tmt_cpns             = $request->tmt_cpns;
                $employee->tingkat_pendidikan   = $request->tingkat_pendidikan;
                $employee->pendidikan_terakhir  = $request->pendidikan_terakhir;
                $employee->save();

                DB::commit();
                Toastr::success('Berhasil menambahkan pegawai baru :)','Success');
                return redirect()->route('all/employee/card');
            } else {
                DB::rollback();
                Toastr::error('Data tersebuut sudah tersedia :(','Error');
                return redirect()->back();
            }
        }catch(\Exception $e){
            DB::rollback();
            Toastr::error('Gagal menambahkan pegawai baru :(','Error');
            return redirect()->back();
        }
    }

    /** view edit record */
    public function viewRecord($user_id)
    {
        $permission = DB::table('profil_pegawai')
            ->join('module_permissions', 'profil_pegawai.user_id', 'module_permissions.user_id')
            ->select('profil_pegawai.*', 'module_permissions.*')->where('profil_pegawai.user_id', $user_id)->get();
        $employees = DB::table('profil_pegawai')->where('user_id', $user_id)->get();
        return view('employees.edit.editemployee',compact('employees','permission'));
    }

    /** update record employee */
    public function updateRecord( Request $request)
    {
        DB::beginTransaction();
        try {

            // update table Employee
            $updateEmployee = [
                'id'                    => $request->id,
                'name'                  => $request->name,
                'user_id'               => $request->user_id,
                'email'                 => $request->email,
                'nip'                   => $request->nip,
                'nama'                  => $request->nama,
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
            ];

            // update table user
            $updateUser = [
                'id'                    =>$request->id,
                'name'                  =>$request->name,
                'email'                 =>$request->email,
            ];

            User::where('id',$request->id)->update($updateUser);
            Employee::where('id',$request->id)->update($updateEmployee);

            DB::commit();
            Toastr::success('Berhasil update data :)','Success');
            return redirect()->route('all/employee/card');
        }catch(\Exception $e){
            DB::rollback();
            Toastr::error('Gagal update data :(','Error');
            return redirect()->back();
        }
    }

    /** delete record */
    public function deleteRecord($user_id)
    {
        DB::beginTransaction();
        try{
            Employee::where('user_id', $user_id)->delete();
            module_permission::where('user_id', $user_id)->delete();

            DB::commit();
            Toastr::success('Berhasil hapus data :)','Success');
            return redirect()->route('all/employee/card');
        }catch(\Exception $e){
            DB::rollback();
            Toastr::error('Gagal hapus data :(','Error');
            return redirect()->back();
        }
    }





    




    /** employee search */
    public function employeeSearch(Request $request)
    {
        $users = DB::table('users')
            ->join('employees', 'users.user_id', 'employees.employee_id')
            ->select('users.*', 'employees.tgl_lahir', 'employees.jk', 'employees.company')->get();
        $permission_lists = DB::table('permission_lists')->get();
        $userList = DB::table('users')->get();

        // search by id
        if ($request->employee_id) {
            $users = DB::table('users')
                ->join('employees', 'users.user_id', 'employees.employee_id')
                ->select('users.*', 'employees.tgl_lahir', 'employees.jk', 'employees.company')
                ->where('employee_id', 'LIKE', '%' . $request->employee_id . '%')->get();
        }
        // search by name
        if ($request->name) {
            $users = DB::table('users')
                ->join('employees', 'users.user_id', 'employees.employee_id')
                ->select('users.*', 'employees.tgl_lahir', 'employees.jk', 'employees.company')
                ->where('users.name', 'LIKE', '%' . $request->name . '%')->get();
        }
        // search by name
        if ($request->position) {
            $users = DB::table('users')
                ->join('employees', 'users.user_id', 'employees.employee_id')
                ->select('users.*', 'employees.tgl_lahir', 'employees.jk', 'employees.company')
                ->where('users.position', 'LIKE', '%' . $request->position . '%')->get();
        }

        // search by name and id
        if ($request->employee_id && $request->name) {
            $users = DB::table('users')
                ->join('employees', 'users.user_id', 'employees.employee_id')
                ->select('users.*', 'employees.tgl_lahir', 'employees.jk', 'employees.company')
                ->where('employee_id', 'LIKE', '%' . $request->employee_id . '%')
                ->where('users.name', 'LIKE', '%' . $request->name . '%')
                ->get();
        }
        // search by position and id
        if ($request->employee_id && $request->position) {
            $users = DB::table('users')
                ->join('employees', 'users.user_id', 'employees.employee_id')
                ->select('users.*', 'employees.tgl_lahir', 'employees.jk', 'employees.company')
                ->where('employee_id', 'LIKE', '%' . $request->employee_id . '%')
                ->where('users.position', 'LIKE', '%' . $request->position . '%')->get();
        }
        // search by name and position
        if ($request->name && $request->position) {
            $users = DB::table('users')
                ->join('employees', 'users.user_id', 'employees.employee_id')
                ->select('users.*', 'employees.tgl_lahir', 'employees.jk', 'employees.company')
                ->where('users.name', 'LIKE', '%' . $request->name . '%')
                ->where('users.position', 'LIKE', '%' . $request->position . '%')->get();
        }
        // search by name and position and id
        if ($request->employee_id && $request->name && $request->position) {
            $users = DB::table('users')
                ->join('employees', 'users.user_id', 'employees.employee_id')
                ->select('users.*', 'employees.tgl_lahir', 'employees.jk', 'employees.company')
                ->where('employee_id', 'LIKE', '%' . $request->employee_id . '%')
                ->where('users.name', 'LIKE', '%' . $request->name . '%')
                ->where('users.position', 'LIKE', '%' . $request->position . '%')->get();
        }
        return view('employees.allemployeecard', compact('users', 'userList', 'permission_lists'));
    }

    /** list search employee */
    public function employeeListSearch(Request $request)
    {
        $users = DB::table('users')
            ->join('employees', 'users.user_id', 'employees.employee_id')
            ->select('users.*', 'employees.tgl_lahir', 'employees.jk', 'employees.company')->get();
        $permission_lists = DB::table('permission_lists')->get();
        $userList         = DB::table('users')->get();

        // search by id
        if ($request->employee_id) {
            $users = DB::table('users')
                ->join('employees', 'users.user_id', 'employees.employee_id')
                ->select('users.*', 'employees.tgl_lahir', 'employees.jk', 'employees.company')
                ->where('employee_id', 'LIKE', '%' . $request->employee_id . '%')->get();
        }
        // search by name
        if ($request->name) {
            $users = DB::table('users')
                ->join('employees', 'users.user_id', 'employees.employee_id')
                ->select('users.*', 'employees.tgl_lahir', 'employees.jk', 'employees.company')
                ->where('users.name', 'LIKE', '%' . $request->name . '%')->get();
        }
        // search by name
        if ($request->position) {
            $users = DB::table('users')
                ->join('employees', 'users.user_id', 'employees.employee_id')
                ->select('users.*', 'employees.tgl_lahir', 'employees.jk', 'employees.company')
                ->where('users.position', 'LIKE', '%' . $request->position . '%')->get();
        }

        // search by name and id
        if ($request->employee_id && $request->name) {
            $users = DB::table('users')
                ->join('employees', 'users.user_id', 'employees.employee_id')
                ->select('users.*', 'employees.tgl_lahir', 'employees.jk', 'employees.company')
                ->where('employee_id', 'LIKE', '%' . $request->employee_id . '%')
                ->where('users.name', 'LIKE', '%' . $request->name . '%')->get();
        }
        // search by position and id
        if ($request->employee_id && $request->position) {
            $users = DB::table('users')
                ->join('employees', 'users.user_id', 'employees.employee_id')
                ->select('users.*', 'employees.tgl_lahir', 'employees.jk', 'employees.company')
                ->where('employee_id', 'LIKE', '%' . $request->employee_id . '%')
                ->where('users.position', 'LIKE', '%' . $request->position . '%')->get();
        }
        // search by name and position
        if ($request->name && $request->position) {
            $users = DB::table('users')
                ->join('employees', 'users.user_id', 'employees.employee_id')
                ->select('users.*', 'employees.tgl_lahir', 'employees.jk', 'employees.company')
                ->where('users.name', 'LIKE', '%' . $request->name . '%')
                ->where('users.position', 'LIKE', '%' . $request->position . '%')->get();
        }
        // search by name and position and id
        if ($request->employee_id && $request->name && $request->position) {
            $users = DB::table('users')
                ->join('employees', 'users.user_id', 'employees.employee_id')
                ->select('users.*', 'employees.tgl_lahir', 'employees.jk', 'employees.company')
                ->where('employee_id', 'LIKE', '%' . $request->employee_id . '%')
                ->where('users.name', 'LIKE', '%' . $request->name . '%')
                ->where('users.position', 'LIKE', '%' . $request->position . '%')->get();
        }
        return view('employees.employeelist', compact('users', 'userList', 'permission_lists'));
    }




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
                ->select('users.*','pr.tgl_lahir','pr.jk','pr.alamat',
                'rp.tingkat_pendidikan','rp.pendidikan','rp.tahun_lulus','rp.no_ijazah',
                'rp.nama_sekolah','rp.gelar_depan','rp.gelar_belakang','rp.jenis_pendidikan',
                'rp.dokumen_transkrip','rp.dokumen_ijazah','rp.dokumen_gelar',
                'rg.golongan','rg.jenis_kenaikan_pangkat','rg.masa_kerja_golongan_tahun',
                'rg.masa_kerja_golongan_bulan','rg.tmt_golongan','rg.no_teknis_bkn',
                'rg.tanggal_teknis_bkn','rg.no_sk_golongan','rg.tanggal_sk',
                'rg.dokumen_skkp','rg.dokumen_teknis_kp',
                'rj.jenis_jabatan','rj.satuan_kerja','rj.satuan_kerja_induk',
                'rj.unit_organisasi','rj.no_sk','rj.tanggal_sk','rj.tmt_jabatan',
                'rj.tmt_pelantikan','rj.dokumen_sk_jabatan','rj.dokumen_pelantikan',
                'rd.jenis_diklat','rd.nama_diklat','rd.institusi_penyelenggara',
                'rd.no_sertifikat','rd.tanggal_mulai','rd.tanggal_selesai',
                'rd.tahun_diklat','rd.durasi_jam','rd.dokumen_diklat',
                'pg.nip','pg.nama','pg.gelar_depan','pg.gelar_belakang','pg.tempat_lahir',
                'pg.tanggal_lahir','pg.jenis_kelamin','pg.agama','pg.jenis_dokumen','pg.no_dokumen',
                'pg.kelurahan','pg.kecamatan','pg.kota','pg.provinsi','pg.kode_pos',
                'pg.no_hp','pg.no_telp','pg.jenis_pegawai','pg.kedudukan_pns','pg.status_pegawai',
                'pg.tmt_pns','pg.no_seri_karpeg','pg.tmt_cpns','pg.tingkat_pendidikan','pg.pendidikan_terakhir',
                'pj.unit_organisasi','pj.unit_organisasi_induk','pj.jenis_jabatan','pj.eselon',
                'pj.jabatan','pj.tmt','pj.lokasi_kerja','pj.gol_ruang_awal','pj.gol_ruang_akhir',
                'pj.tmt_golongan','pj.gaji_pokok','pj.masa_kerja_tahun','pj.masa_kerja_bulan',
                'pj.no_spmt','pj.tanggal_spmt','pj.kppn')
                ->where('users.user_id',$user_id)->get();

            $users = DB::table('users')
                ->leftJoin('profile_information as pr','pr.user_id','users.user_id')
                ->leftJoin('riwayat_pendidikan as rp','rp.user_id','users.user_id')
                ->leftJoin('riwayat_golongan as rg','rg.user_id','users.user_id')
                ->leftJoin('riwayat_jabatan as rj','rj.user_id','users.user_id')
                ->leftJoin('riwayat_diklat as rd','rd.user_id','users.user_id')
                ->leftJoin('profil_pegawai as pg','pg.user_id','users.user_id')
                ->leftJoin('posisi_jabatan as pj','pj.user_id','users.user_id')
                ->select('users.*','pr.tgl_lahir','pr.jk','pr.alamat',
                'rp.tingkat_pendidikan','rp.pendidikan','rp.tahun_lulus','rp.no_ijazah',
                'rp.nama_sekolah','rp.gelar_depan','rp.gelar_belakang','rp.jenis_pendidikan',
                'rp.dokumen_transkrip','rp.dokumen_ijazah','rp.dokumen_gelar',
                'rg.golongan','rg.jenis_kenaikan_pangkat','rg.masa_kerja_golongan_tahun',
                'rg.masa_kerja_golongan_bulan','rg.tmt_golongan','rg.no_teknis_bkn',
                'rg.tanggal_teknis_bkn','rg.no_sk_golongan','rg.tanggal_sk',
                'rg.dokumen_skkp','rg.dokumen_teknis_kp',
                'rj.jenis_jabatan','rj.satuan_kerja','rj.satuan_kerja_induk',
                'rj.unit_organisasi','rj.no_sk','rj.tanggal_sk','rj.tmt_jabatan',
                'rj.tmt_pelantikan','rj.dokumen_sk_jabatan','rj.dokumen_pelantikan',
                'rd.jenis_diklat','rd.nama_diklat','rd.institusi_penyelenggara',
                'rd.no_sertifikat','rd.tanggal_mulai','rd.tanggal_selesai',
                'rd.tahun_diklat','rd.durasi_jam','rd.dokumen_diklat',
                'pg.nip','pg.nama','pg.gelar_depan','pg.gelar_belakang','pg.tempat_lahir',
                'pg.tanggal_lahir','pg.jenis_kelamin','pg.agama','pg.jenis_dokumen','pg.no_dokumen',
                'pg.kelurahan','pg.kecamatan','pg.kota','pg.provinsi','pg.kode_pos',
                'pg.no_hp','pg.no_telp','pg.jenis_pegawai','pg.kedudukan_pns','pg.status_pegawai',
                'pg.tmt_pns','pg.no_seri_karpeg','pg.tmt_cpns','pg.tingkat_pendidikan','pg.pendidikan_terakhir',
                'pj.unit_organisasi','pj.unit_organisasi_induk','pj.jenis_jabatan','pj.eselon',
                'pj.jabatan','pj.tmt','pj.lokasi_kerja','pj.gol_ruang_awal','pj.gol_ruang_akhir',
                'pj.tmt_golongan','pj.gaji_pokok','pj.masa_kerja_tahun','pj.masa_kerja_bulan',
                'pj.no_spmt','pj.tanggal_spmt','pj.kppn')
                ->where('users.user_id',$user_id)->first();
            return view('employees.employeeprofile',compact('user','users'));
    }

    /** page agama */
    public function indexAgama()
    {
        $agama = DB::table('agama_id')->get();
        return view('employees.agama',compact('agama'));
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
                Toastr::success('Data agama telah ditambah :)','Sukses');
                return redirect()->back();
            }else{
                DB::rollback();
                Toastr::error('Data agama telah tersedia :(','Error');
                return redirect()->back();
            }
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Data agama gagal ditambah :(','Error');
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
            Toastr::success('Data agama berhasil diperbaharui :)','Success');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Data agama gagal diperbaharui :(','Error');
            return redirect()->back();
        }
    }

    /** delete record agama */
    public function deleteRecordAgama(Request $request)
    {
        try {

            agama::destroy($request->id);
            Toastr::success('Data agama berhasil dihapus :)','Success');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Data agama gagal dihapus :)','Error');
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
                Toastr::success('Data pendidikan telah ditambah :)','Sukses');
                return redirect()->back();
            } else {
                DB::rollback();
                Toastr::error('Data pendidikan telah tersedia :(','Error');
                return redirect()->back();
            }
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Data pendidikan gagal ditambah :)','Error');
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
            Toastr::success('Data pendidikan berhasil diperbaharui :)','Success');
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
            Toastr::success('Data pendidikan berhasil dihapus :)','Success');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Data pendidikan gagal dihapus :)','Error');
            return redirect()->back();
        }
    }
}
