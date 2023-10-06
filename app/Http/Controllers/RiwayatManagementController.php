<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Session;
use Auth;
use Hash;
use DB;



class RiwayatManagementController extends Controller
{
    
       /** get list data agama and search */
    public function getAgamaData(Request $request)
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

        $agama =  DB::table('agama_id');
        $totalRecords = $agama->count();

        $totalRecordsWithFilter = $agama->where(function ($query) use ($searchValue) {
            $query->where('agama', 'like', '%' . $searchValue . '%');
        })->count();
        $records = $agama->orderBy($columnName, $columnSortOrder)
            ->where(function ($query) use ($searchValue) {
                $query->where('agama', 'like', '%' . $searchValue . '%');
            })
            ->skip($start)
            ->take($rowPerPage)
            ->get();
        $data_arr = [];
        foreach ($records as $key => $record) {
            $data_arr[] = [
                "no"           => '<span class="id" data-id = ' . $record->id . '>' . $start + ($key + 1) . '</span>',
                "agama"         => $record->agama,
                "action"       =>
                '
                <td>
                    <div class="dropdown dropdown-action">
                        <a class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            <i class="material-icons">more_vert</i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item agamaUpdate" data-toggle="modal" data-id="' . $record->id . '" data-target="#edit_agama">
                                <i class="fa fa-pencil m-r-5"></i> Edit
                            </a>
                            <a class="dropdown-item agamaDelete" data-toggle="modal" data-id="' . $record->id . '" data-target="#delete_agama">
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
        $result_profilpegawai = ProfilPegawai::where('user_id',$profile)->first();
        $user = DB::table('users')->get();
        $employees = DB::table('profile_information')->where('user_id',$profile)->first();

        $result_posisijabatan = PosisiJabatan::where('user_id',Session::get('user_id'))->first();

        $datauser = Session::get('user_id');
        $sqluser = User::where('user_id', $datauser)->get();
        $datapendidikan = Session::get('user_id');
        $riwayatPendidikan = RiwayatPendidikan::where('user_id', $datapendidikan)->get();
        $datadiklat = Session::get('user_id');
        $riwayatDiklat = RiwayatDiklat::where('user_id', $datadiklat)->get();
        $datagolongan = Session::get('user_id');
        $riwayatGolongan = RiwayatGolongan::where('user_id', $datagolongan)->get();
        $datajabatan = Session::get('user_id');
        $riwayatJabatan = RiwayatJabatan::where('user_id', $datajabatan)->get();
        
        if(empty($employees))
        {
            $information = DB::table('profile_information')->where('user_id',$profile)->first();
            return view('usermanagement.profile-user', compact('information','user','result_profilpegawai','result_posisijabatan','riwayatPendidikan', 'riwayatGolongan', 'riwayatJabatan', 'riwayatDiklat', 'sqluser'));
        } else {
            $user_id = $employees->user_id;
            if($user_id == $profile)
            {
                $information = DB::table('profile_information')->where('user_id', $profile)->first();
                return view('usermanagement.profile-user', compact('information','user','result_profilpegawai','result_posisijabatan','riwayatPendidikan', 'riwayatGolongan', 'riwayatJabatan', 'riwayatDiklat', 'sqluser'));
            } else {
                $information = ProfileInformation::all();
                return view('usermanagement.profile-user', compact('information','user','result_profilpegawai','result_posisijabatan','riwayatPendidikan', 'riwayatGolongan', 'riwayatJabatan', 'riwayatDiklat', 'sqluser'));
            }
        }
    }
    
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
            Toastr::success('Data profil informasi berhasil diperbaharui :)','Success');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Data profil informasi gagal diperbaharui :(', 'Error');
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

    /** Tambah Data Profil Pegawai */
    public function profilePegawaiAdd(Request $request)
    {
        $request->validate([
            'nip'                   => 'required|string|max:255',
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
        try {

            $addProfilPegawai = ProfilPegawai::where('user_id', '=', $request->user_id)->first();
            if ($addProfilPegawai === null) {

         $addProfilPegawai = new ProfilPegawai();
         $addProfilPegawai->user_id                 = $request->user_id;
         $addProfilPegawai->nip                     = $request->nip;
         $addProfilPegawai->nama                    = $request->nama;
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
         $addProfilPegawai->save();

         DB::commit();
            Toastr::success('Data profil pegawai berhasil ditambah :)','Success');
            return redirect()->back();
        } else {
            DB::rollback();
            Toastr::error('Data profil pegawai sudah tersedia :(','Error');
            return redirect()->back();
        }
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Data profil pegawai gagal ditambah :(', 'Error');
            return redirect()->back();
        }
    }
    /** End Tambah Data Profil Pegawai */

    /** Edit Data Posisi & Jabatan */
    public function profilePegawaiEdit(Request $request)
    {
        $request->validate([
            'nip'                   => 'required|string|max:255',
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
        try {
         
            $editProfilPegawai = [
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

         DB::table('profil_pegawai')->where('user_id', $request->user_id)->update($editProfilPegawai);

         DB::commit();
         Toastr::success('Data profil pegawai berhasil diperbaharui :)','Success');
         return redirect()->back();
        } catch (\Exception $e) {
         DB::rollback();
         Toastr::error('Data profil pegawai gagal diperbaharui :(', 'Error');
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
            Toastr::success('Data posisi & jabatan berhasil ditambah :)','Success');
            return redirect()->back();
        } else {
            DB::rollback();
            Toastr::error('Data posisi & jabatan sudah tersedia :(','Error');
            return redirect()->back();
        }
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Data posisi & jabatan gagal ditambah :(', 'Error');
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

         DB::table('posisi_jabatan')->where('user_id', $request->user_id)->update($editPosisiJabatan);

         DB::commit();
         Toastr::success('Data posisi & jabatan berhasil diperbaharui :)','Success');
         return redirect()->back();
        } catch (\Exception $e) {
         DB::rollback();
         Toastr::error('Data posisi & jabatan gagal diperbaharui :(', 'Error');
         return redirect()->back();
        }
    }
    /** End Edit Data Posisi & Jabatan */
}