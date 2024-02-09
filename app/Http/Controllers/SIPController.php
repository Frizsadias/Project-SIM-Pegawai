<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\SIPDokter;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use DB;

class SIPController extends Controller
{
    public function tampilanSIPDokter()
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

        $user_id = auth()->user()->user_id;
        $data_sip_dokter = DB::table('sip_spk_dokter')
            ->select(
                'sip_spk_dokter.*',
                'sip_spk_dokter.user_id',
                'sip_spk_dokter.name',
                'sip_spk_dokter.nip',
                'sip_spk_dokter.unit_kerja',
                'sip_spk_dokter.nomor_sip',
                'sip_spk_dokter.tanggal_terbit',
                'sip_spk_dokter.tanggal_berlaku',
                'sip_spk_dokter.jenis_dokumen',
                'sip_spk_dokter.ruangan',
                'sip_spk_dokter.dokumen_sip'
            )
            ->where('sip_spk_dokter.user_id', $user_id)
            ->where('sip_spk_dokter.sip_spk_jabatan', 'Dokter')
            ->where('sip_spk_dokter.jenis_dokumen', 'SIP Dokter')
            ->get();

        $ruanganOptions = DB::table('ruangan_id')->pluck('ruangan', 'ruangan');

        $data_profil_sip = DB::table('profil_pegawai')
            ->select('profil_pegawai.*', 'profil_pegawai.name', 'profil_pegawai.nip')
            ->where('profil_pegawai.user_id', $user_id)
            ->get();
        return view('transaksi.sip-dokter', compact('data_sip_dokter', 'data_profil_sip', 
            'unreadNotifications', 'readNotifications', 'ruanganOptions', 'result_tema'));
    }
    /** /Tampilan SIP Dokter */

    /** Daftar SIP Dokter */
    public function tampilanSIPDokterAdmin()
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

        $data_sip_dokter = DB::table('sip_spk_dokter')
            ->select(
                'sip_spk_dokter.*',
                'sip_spk_dokter.user_id',
                'sip_spk_dokter.name',
                'sip_spk_dokter.nip',
                'sip_spk_dokter.unit_kerja',
                'sip_spk_dokter.nomor_sip',
                'sip_spk_dokter.tanggal_terbit',
                'sip_spk_dokter.tanggal_berlaku',
                'sip_spk_dokter.sip_spk_jabatan',
                'sip_spk_dokter.jenis_dokumen',
                'sip_spk_dokter.ruangan',
                'sip_spk_dokter.dokumen_sip'
            )
            ->where('sip_spk_dokter.sip_spk_jabatan', 'Dokter')
            ->where('sip_spk_dokter.jenis_dokumen', 'SIP Dokter')
            ->get();
        $userList = DB::table('profil_pegawai')
        ->join('users', 'profil_pegawai.user_id', 'users.user_id')
        ->where('role_name', '=', 'User')
        ->get();

        $ruanganOptions = DB::table('ruangan_id')->pluck('ruangan', 'ruangan');

        return view('transaksi.sip-dokter-admin', compact('data_sip_dokter', 'userList', 'ruanganOptions', 
            'unreadNotifications', 'readNotifications', 'result_tema'));
    }

    /** Filter SIP Dokter  Admin*/
    public function filterSIPDokterAdmin(Request $request)
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

        $name = $request->input('name');
        $nip = $request->input('nip');
        $tanggal_terbit = $request->input('tanggal_terbit');

        $data_sip_dokter = DB::table('sip_spk_dokter')
        ->select(
            'sip_spk_dokter.*',
            'sip_spk_dokter.user_id',
            'sip_spk_dokter.name',
            'sip_spk_dokter.nip',
            'sip_spk_dokter.unit_kerja',
            'sip_spk_dokter.nomor_sip',
            'sip_spk_dokter.tanggal_terbit',
            'sip_spk_dokter.tanggal_berlaku',
            'sip_spk_dokter.sip_spk_jabatan',
            'sip_spk_dokter.jenis_dokumen',
            'sip_spk_dokter.ruangan',
            'sip_spk_dokter.dokumen_sip'
        )
            ->where('sip_spk_dokter.jenis_dokumen', '=', 'SIP Dokter')
            ->where('sip_spk_dokter.name', 'like', '%' . $name . '%')
            ->where('sip_spk_dokter.nip', 'like', '%' . $nip . '%')
            ->where('sip_spk_dokter.tanggal_terbit', 'like', '%' . $tanggal_terbit . '%')
            ->get();

        $userList = DB::table('profil_pegawai')
        ->join('users', 'profil_pegawai.user_id', 'users.user_id')
        ->where('role_name', '=', 'User')
        ->get();

        $ruanganOptions = DB::table('ruangan_id')->pluck('ruangan', 'ruangan');

        return view('transaksi.sip-dokter-admin', compact('data_sip_dokter', 'userList', 'ruanganOptions', 
            'unreadNotifications', 'readNotifications', 'result_tema'));
    }

    /** Filter SIP Dokter User*/
    public function filterSIPDokter(Request $request)
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

        $nomor_sip = $request->input('nomor_sip');
        $tanggal_terbit = $request->input('tanggal_terbit');
        $tanggal_berlaku = $request->input('tanggal_berlaku');
        $user_id = auth()->user()->user_id;

        $data_sip_dokter = DB::table('sip_spk_dokter')
        ->join('users', 'users.user_id', '=', 'sip_spk_dokter.user_id')
        ->select(
            'sip_spk_dokter.*',
            'sip_spk_dokter.user_id',
            'sip_spk_dokter.name',
            'sip_spk_dokter.nip',
            'sip_spk_dokter.unit_kerja',
            'sip_spk_dokter.nomor_sip',
            'sip_spk_dokter.tanggal_terbit',
            'sip_spk_dokter.tanggal_berlaku',
            'sip_spk_dokter.sip_spk_jabatan',
            'sip_spk_dokter.jenis_dokumen',
            'sip_spk_dokter.ruangan',
            'sip_spk_dokter.dokumen_sip'
        )
            ->where('users.user_id', $user_id)
            ->where('sip_spk_dokter.jenis_dokumen', '=', 'SIP Dokter')
            ->where('sip_spk_dokter.nomor_sip', 'like', '%' . $nomor_sip . '%')
            ->where('sip_spk_dokter.tanggal_terbit', 'like', '%' . $tanggal_terbit . '%')
            ->where('sip_spk_dokter.tanggal_berlaku', 'like', '%' . $tanggal_berlaku . '%')
            ->get();

        $ruanganOptions = DB::table('ruangan_id')->pluck('ruangan', 'ruangan');
        $user_id = auth()->user()->user_id;
        $data_profil_sip = DB::table('profil_pegawai')
        ->select('profil_pegawai.*', 'profil_pegawai.name', 'profil_pegawai.nip')
        ->where('profil_pegawai.user_id', $user_id)
        ->get();

        return view('transaksi.sip-dokter', compact('data_sip_dokter', 'data_profil_sip','ruanganOptions', 
            'unreadNotifications', 'readNotifications', 'result_tema'));
    }

    /** Tambah Data SIP Dokter */
    public function tambahDataSIPDokter(Request $request)
    {
        $request->validate([
            'user_id'               => 'required|string|max:255',
            'name'                  => 'required|string|max:255',
            'nip'                   => 'required|string|max:255',
            'unit_kerja'            => 'required|string|max:255',
            'nomor_sip'             => 'required|string|max:255',
            'tanggal_terbit'        => 'required|string|max:255',
            'tanggal_berlaku'       => 'required|string|max:255',
            'sip_spk_jabatan'       => 'required|string|max:255',
            'jenis_dokumen'         => 'required|string|max:255',
            'ruangan'               => 'required|string|max:255',
            'dokumen_sip'           => 'required|mimes:pdf|max:5120',
        ]);
        DB::beginTransaction();

        try {
            $dokumen_sip = time() . '.' . $request->dokumen_sip->extension();
            $request->dokumen_sip->move(public_path('assets/DokumenSIPDokter'), $dokumen_sip);

            $SIPDokter = new SIPDokter;
            $SIPDokter->user_id               = $request->user_id;
            $SIPDokter->name                  = $request->name;
            $SIPDokter->nip                   = $request->nip;
            $SIPDokter->unit_kerja            = $request->unit_kerja;
            $SIPDokter->nomor_sip             = $request->nomor_sip;
            $SIPDokter->tanggal_terbit        = $request->tanggal_terbit;
            $SIPDokter->tanggal_berlaku       = $request->tanggal_berlaku;
            $SIPDokter->sip_spk_jabatan       = $request->sip_spk_jabatan;
            $SIPDokter->jenis_dokumen         = $request->jenis_dokumen;
            $SIPDokter->ruangan               = $request->ruangan;
            $SIPDokter->dokumen_sip           = $dokumen_sip;
            $SIPDokter->save();

            DB::commit();
            Toastr::success('Data SIP Dokter berhasil ditambah ✔', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Data SIP Dokter gagal ditambah ✘', 'Error');
            return redirect()->back();
        }
    }
    /** /Tambah Data SIP Dokter */

    /** Edit Data SIP Dokter */
    public function editSIPDokter(Request $request)
    {
        DB::beginTransaction();
        try {
            $dokumen_sip = $request->hidden_dokumen_sip;
            $dokumen_sips  = $request->file('dokumen_sip');
            if ($dokumen_sips != '') {
                unlink('assets/DokumenSIPDokter/' . $dokumen_sip);
                $dokumen_sip = time() . '.' . $dokumen_sips->getClientOriginalExtension();
                $dokumen_sips->move(public_path('assets/DokumenSIPDokter'), $dokumen_sip);
            } else {
                $dokumen_sip;
            }

            $update = [
                'unit_kerja'            => $request->unit_kerja,
                'nomor_sip'             => $request->nomor_sip,
                'tanggal_terbit'        => $request->tanggal_terbit,
                'tanggal_berlaku'       => $request->tanggal_berlaku,
                'ruangan'               => $request->ruangan,
                'dokumen_sip'           => $dokumen_sip,
            ];

            SIPDokter::where('id', $request->id)->update($update);
            DB::commit();
            Toastr::success('Data SIP Dokter berhasil diperbaharui ✔', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Data SIP Dokter gagal diperbaharui ✘', 'Error');
            return redirect()->back();
        }
    }
    /** /Edit Data SIP Dokter */

    /** Hapus Data SIP Dokter */
    public function hapusDataSIPDokter(Request $request)
    {
        DB::beginTransaction();
        try {
            $dokumen_sip = SIPDokter::where('id', $request->id)->pluck('dokumen_sip')->first();
            unlink('assets/DokumenSIPDokter/' . $dokumen_sip);
            SIPDokter::where('id', $request->id)->delete();
            DB::commit();
            Toastr::success('Data SIP Dokter berhasil dihapus ✔', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Data SIP Dokter gagal dihapus ✘', 'Error');
            return redirect()->back();
        }
    }

    /** /Tampilan SPK Dokter */
    public function tampilanSPKDokter()
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

        $user_id = auth()->user()->user_id;
        $data_spk_dokter = DB::table('sip_spk_dokter')
            ->select(
                'sip_spk_dokter.*',
                'sip_spk_dokter.user_id',
                'sip_spk_dokter.name',
                'sip_spk_dokter.nip',
                'sip_spk_dokter.unit_kerja',
                'sip_spk_dokter.nomor_sip',
                'sip_spk_dokter.tanggal_terbit',
                'sip_spk_dokter.tanggal_berlaku',
                'sip_spk_dokter.jenis_dokumen',
                'sip_spk_dokter.ruangan',
                'sip_spk_dokter.dokumen_sip'
            )
            ->where('sip_spk_dokter.user_id', $user_id)
            ->where('sip_spk_dokter.sip_spk_jabatan', 'Dokter')
            ->where('sip_spk_dokter.jenis_dokumen', 'SPK Dokter')
            ->get();

        $ruanganOptions = DB::table('ruangan_id')->pluck('ruangan', 'ruangan');
        $data_profil_sip = DB::table('profil_pegawai')
            ->select('profil_pegawai.*', 'profil_pegawai.name', 'profil_pegawai.nip')
            ->where('profil_pegawai.user_id', $user_id)
            ->get();
        return view('transaksi.spk-dokter', compact('data_spk_dokter', 'data_profil_sip', 
            'unreadNotifications', 'readNotifications', 'ruanganOptions', 'result_tema'));
    }

    /** Daftar SPK Dokter */
    public function tampilanSPKDokterAdmin()
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

        $data_spk_dokter = DB::table('sip_spk_dokter')
            ->select(
                'sip_spk_dokter.*',
                'sip_spk_dokter.user_id',
                'sip_spk_dokter.name',
                'sip_spk_dokter.nip',
                'sip_spk_dokter.unit_kerja',
                'sip_spk_dokter.nomor_sip',
                'sip_spk_dokter.tanggal_terbit',
                'sip_spk_dokter.tanggal_berlaku',
                'sip_spk_dokter.sip_spk_jabatan',
                'sip_spk_dokter.jenis_dokumen',
                'sip_spk_dokter.ruangan',
                'sip_spk_dokter.dokumen_sip'
            )
            ->where('sip_spk_dokter.sip_spk_jabatan', 'dokter')
            ->where('sip_spk_dokter.jenis_dokumen', 'SPK Dokter')
            ->get();
        $userList = DB::table('profil_pegawai')
        ->join('users', 'profil_pegawai.user_id', 'users.user_id')
        ->where('role_name', '=', 'User')
        ->get();

        $ruanganOptions = DB::table('ruangan_id')->pluck('ruangan', 'ruangan');
        return view('transaksi.spk-dokter-admin', compact('data_spk_dokter', 'userList', 
            'ruanganOptions', 'unreadNotifications', 'readNotifications', 'result_tema'));
    }

    /** Filter SPK Dokter Admin*/
    public function filterSPKDokterAdmin(Request $request)
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

        $name = $request->input('name');
        $nip = $request->input('nip');
        $tanggal_terbit = $request->input('tanggal_terbit');

        $data_spk_dokter = DB::table('sip_spk_dokter')
        ->select(
            'sip_spk_dokter.*',
            'sip_spk_dokter.user_id',
            'sip_spk_dokter.name',
            'sip_spk_dokter.nip',
            'sip_spk_dokter.unit_kerja',
            'sip_spk_dokter.nomor_sip',
            'sip_spk_dokter.tanggal_terbit',
            'sip_spk_dokter.tanggal_berlaku',
            'sip_spk_dokter.sip_spk_jabatan',
            'sip_spk_dokter.jenis_dokumen',
            'sip_spk_dokter.ruangan',
            'sip_spk_dokter.dokumen_sip'
        )
            ->where('sip_spk_dokter.jenis_dokumen', '=', 'SPK Dokter')
            ->where('sip_spk_dokter.name', 'like', '%' . $name . '%')
            ->where('sip_spk_dokter.nip', 'like', '%' . $nip . '%')
            ->where('sip_spk_dokter.tanggal_terbit', 'like', '%' . $tanggal_terbit . '%')
            ->get();

        $userList = DB::table('profil_pegawai')
        ->join('users', 'profil_pegawai.user_id', 'users.user_id')
        ->where('role_name', '=', 'User')
        ->get();

        $ruanganOptions = DB::table('ruangan_id')->pluck('ruangan', 'ruangan');
        return view('transaksi.spk-dokter-admin', compact('data_spk_dokter', 'userList', 'ruanganOptions', 
            'unreadNotifications', 'readNotifications', 'result_tema'));
    }

    /** Filter SPK Dokter User*/
    public function filterSPKDokter(Request $request)
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

        $nomor_sip = $request->input('nomor_sip');
        $tanggal_terbit = $request->input('tanggal_terbit');
        $tanggal_berlaku = $request->input('tanggal_berlaku');
        $user_id = auth()->user()->user_id;

        $data_spk_dokter = DB::table('sip_spk_dokter')
        ->join('users', 'users.user_id', '=', 'sip_spk_dokter.user_id')
        ->select(
            'sip_spk_dokter.*',
            'sip_spk_dokter.user_id',
            'sip_spk_dokter.name',
            'sip_spk_dokter.nip',
            'sip_spk_dokter.unit_kerja',
            'sip_spk_dokter.nomor_sip',
            'sip_spk_dokter.tanggal_terbit',
            'sip_spk_dokter.tanggal_berlaku',
            'sip_spk_dokter.sip_spk_jabatan',
            'sip_spk_dokter.jenis_dokumen',
            'sip_spk_dokter.ruangan',
            'sip_spk_dokter.dokumen_sip'
        )
            ->where('users.user_id', $user_id)
            ->where('sip_spk_dokter.jenis_dokumen', '=', 'SPK Dokter')
            ->where('sip_spk_dokter.nomor_sip', 'like', '%' . $nomor_sip . '%')
            ->where('sip_spk_dokter.tanggal_terbit', 'like', '%' . $tanggal_terbit . '%')
            ->where('sip_spk_dokter.tanggal_berlaku', 'like', '%' . $tanggal_berlaku . '%')
            ->get();

        $user_id = auth()->user()->user_id;
        $data_profil_sip = DB::table('profil_pegawai')
        ->select('profil_pegawai.*', 'profil_pegawai.name', 'profil_pegawai.nip')
        ->where('profil_pegawai.user_id', $user_id)
        ->get();

        $ruanganOptions = DB::table('ruangan_id')->pluck('ruangan', 'ruangan');
        return view('transaksi.spk-dokter', compact('data_spk_dokter', 'data_profil_sip', 'ruanganOptions', 
            'unreadNotifications', 'readNotifications', 'result_tema'));
    }

    /** Tambah Data SPK Dokter */
    public function tambahDataSPKDokter(Request $request)
    {
        $request->validate([
            'user_id'               => 'required|string|max:255',
            'name'                  => 'required|string|max:255',
            'nip'                   => 'required|string|max:255',
            'unit_kerja'            => 'required|string|max:255',
            'nomor_sip'             => 'required|string|max:255',
            'tanggal_terbit'        => 'required|string|max:255',
            'tanggal_berlaku'       => 'required|string|max:255',
            'sip_spk_jabatan'       => 'required|string|max:255',
            'jenis_dokumen'         => 'required|string|max:255',
            'ruangan'               => 'required|string|max:255',
            'dokumen_sip'           => 'required|mimes:pdf|max:5120',
        ]);
        DB::beginTransaction();

        try {
            $dokumen_sip = time() . '.' . $request->dokumen_sip->extension();
            $request->dokumen_sip->move(public_path('assets/DokumenSPKDokter'), $dokumen_sip);

            $SPKDokter = new SIPDokter;
            $SPKDokter->user_id               = $request->user_id;
            $SPKDokter->name                  = $request->name;
            $SPKDokter->nip                   = $request->nip;
            $SPKDokter->unit_kerja            = $request->unit_kerja;
            $SPKDokter->nomor_sip             = $request->nomor_sip;
            $SPKDokter->tanggal_terbit        = $request->tanggal_terbit;
            $SPKDokter->tanggal_berlaku       = $request->tanggal_berlaku;
            $SPKDokter->sip_spk_jabatan       = $request->sip_spk_jabatan;
            $SPKDokter->jenis_dokumen         = $request->jenis_dokumen;
            $SPKDokter->ruangan               = $request->ruangan;
            $SPKDokter->dokumen_sip           = $dokumen_sip;
            $SPKDokter->save();

            DB::commit();
            Toastr::success('Data SPK Dokter berhasil ditambah ✔', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Data SPK Dokter gagal ditambah ✘', 'Error');
            return redirect()->back();
        }
    }
    /** /Tambah Data SPK Dokter */

    /** Edit Data SPK Dokter */
    public function editSPKDokter(Request $request)
    {
        DB::beginTransaction();
        try {
            $dokumen_sip = $request->hidden_dokumen_sip;
            $dokumen_sips  = $request->file('dokumen_sip');
            if ($dokumen_sips != '') {
                unlink('assets/DokumenSPKDokter/' . $dokumen_sip);
                $dokumen_sip = time() . '.' . $dokumen_sips->getClientOriginalExtension();
                $dokumen_sips->move(public_path('assets/DokumenSPKDokter'), $dokumen_sip);
            } else {
                $dokumen_sip;
            }

            $update = [
                'unit_kerja'            => $request->unit_kerja,
                'nomor_sip'             => $request->nomor_sip,
                'tanggal_terbit'        => $request->tanggal_terbit,
                'tanggal_berlaku'       => $request->tanggal_berlaku,
                'ruangan'               => $request->ruangan,
                'dokumen_sip'           => $dokumen_sip,
            ];

            SIPDokter::where('id', $request->id)->update($update);
            DB::commit();
            Toastr::success('Data SPK Dokter berhasil diperbaharui ✔', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Data SPK Dokter gagal diperbaharui ✘', 'Error');
            return redirect()->back();
        }
    }
    /** /Edit Data SPK Dokter */

    /** Hapus Data SPK Dokter */
    public function hapusDataSPKDokter(Request $request)
    {
        DB::beginTransaction();
        try {
            $dokumen_sip = SIPDokter::where('id', $request->id)->pluck('dokumen_sip')->first();
            unlink('assets/DokumenSPKDokter/' . $dokumen_sip);
            SIPDokter::where('id', $request->id)->delete();
            DB::commit();
            Toastr::success('Data SPK Dokter berhasil dihapus ✔', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Data SPK Dokter gagal dihapus ✘', 'Error');
            return redirect()->back();
        }
    }

    /** /Tampilan SPK Perawat */
    public function tampilanSPKPerawat()
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

        $user_id = auth()->user()->user_id;
        $data_spk_perawat = DB::table('sip_spk_dokter')
        ->select(
            'sip_spk_dokter.*',
            'sip_spk_dokter.user_id',
            'sip_spk_dokter.name',
            'sip_spk_dokter.nip',
            'sip_spk_dokter.unit_kerja',
            'sip_spk_dokter.nomor_sip',
            'sip_spk_dokter.tanggal_terbit',
            'sip_spk_dokter.tanggal_berlaku',
            'sip_spk_dokter.jenis_dokumen',
            'sip_spk_dokter.ruangan',
            'sip_spk_dokter.dokumen_sip'
        )
            ->where('sip_spk_dokter.user_id', $user_id)
            ->where('sip_spk_dokter.sip_spk_jabatan', 'Perawat')
            ->where('sip_spk_dokter.jenis_dokumen', 'SPK Perawat')
            ->get();

        $ruanganOptions = DB::table('ruangan_id')->pluck('ruangan', 'ruangan');
        $data_profil_sip = DB::table('profil_pegawai')
        ->select('profil_pegawai.*', 'profil_pegawai.name', 'profil_pegawai.nip')
        ->where('profil_pegawai.user_id', $user_id)
            ->get();
        return view('transaksi.spk-perawat', compact('data_spk_perawat', 'data_profil_sip', 
            'unreadNotifications', 'readNotifications', 'ruanganOptions', 'result_tema'));
    }

    /** Daftar SPK Perawat */
    public function tampilanSPKPerawatAdmin()
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

        $data_spk_perawat = DB::table('sip_spk_dokter')
            ->select(
                'sip_spk_dokter.*',
                'sip_spk_dokter.user_id',
                'sip_spk_dokter.name',
                'sip_spk_dokter.nip',
                'sip_spk_dokter.unit_kerja',
                'sip_spk_dokter.nomor_sip',
                'sip_spk_dokter.tanggal_terbit',
                'sip_spk_dokter.tanggal_berlaku',
                'sip_spk_dokter.sip_spk_jabatan',
                'sip_spk_dokter.jenis_dokumen',
                'sip_spk_dokter.ruangan',
                'sip_spk_dokter.dokumen_sip'
            )
            ->where('sip_spk_dokter.sip_spk_jabatan', 'perawat')
            ->where('sip_spk_dokter.jenis_dokumen', 'SPK Perawat')
            ->get();
        $userList = DB::table('profil_pegawai')
        ->join('users', 'profil_pegawai.user_id', 'users.user_id')
        ->where('role_name', '=', 'User')
        ->get();
        $ruanganOptions = DB::table('ruangan_id')->pluck('ruangan', 'ruangan');

        return view('transaksi.spk-perawat-admin', compact('data_spk_perawat', 'userList', 'ruanganOptions', 
            'unreadNotifications', 'readNotifications', 'result_tema'));
    }

    /** Search SPK Perawat Admin*/
    public function filterSPKPerawatAdmin(Request $request)
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

        $name = $request->input('name');
        $nip = $request->input('nip');
        $tanggal_terbit = $request->input('tanggal_terbit');

        $data_spk_perawat = DB::table('sip_spk_dokter')
        ->select(
            'sip_spk_dokter.*',
            'sip_spk_dokter.user_id',
            'sip_spk_dokter.name',
            'sip_spk_dokter.nip',
            'sip_spk_dokter.unit_kerja',
            'sip_spk_dokter.nomor_sip',
            'sip_spk_dokter.tanggal_terbit',
            'sip_spk_dokter.tanggal_berlaku',
            'sip_spk_dokter.sip_spk_jabatan',
            'sip_spk_dokter.jenis_dokumen',
            'sip_spk_dokter.ruangan',
            'sip_spk_dokter.dokumen_sip'
        )
            ->where('sip_spk_dokter.jenis_dokumen', '=', 'SPK Perawat')
            ->where('sip_spk_dokter.name', 'like', '%' . $name . '%')
            ->where('sip_spk_dokter.nip', 'like', '%' . $nip . '%')
            ->where('sip_spk_dokter.tanggal_terbit', 'like', '%' . $tanggal_terbit . '%')
            ->get();
        $userList = DB::table('profil_pegawai')
        ->join('users', 'profil_pegawai.user_id', 'users.user_id')
        ->where('role_name', '=', 'User')
        ->get();
        $ruanganOptions = DB::table('ruangan_id')->pluck('ruangan', 'ruangan');

        return view('transaksi.spk-perawat-admin', compact('data_spk_perawat', 'userList', 'ruanganOptions', 
            'unreadNotifications', 'readNotifications', 'result_tema'));
    }
    /** Search SPK Perawat User*/
    public function filterSPKPerawat(Request $request)
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

        $nomor_sip = $request->input('nomor_sip');
        $tanggal_terbit = $request->input('tanggal_terbit');
        $tanggal_berlaku = $request->input('tanggal_berlaku');
        $user_id = auth()->user()->user_id;

        $data_spk_perawat = DB::table('sip_spk_dokter')
        ->join('users', 'users.user_id', '=', 'sip_spk_dokter.user_id')
        ->select(
            'sip_spk_dokter.*',
            'sip_spk_dokter.user_id',
            'sip_spk_dokter.name',
            'sip_spk_dokter.nip',
            'sip_spk_dokter.unit_kerja',
            'sip_spk_dokter.nomor_sip',
            'sip_spk_dokter.tanggal_terbit',
            'sip_spk_dokter.tanggal_berlaku',
            'sip_spk_dokter.sip_spk_jabatan',
            'sip_spk_dokter.jenis_dokumen',
            'sip_spk_dokter.ruangan',
            'sip_spk_dokter.dokumen_sip'
        )
            ->where('users.user_id', $user_id)
            ->where('sip_spk_dokter.jenis_dokumen', '=', 'SPK Perawat')
            ->where('sip_spk_dokter.nomor_sip', 'like', '%' . $nomor_sip . '%')
            ->where('sip_spk_dokter.tanggal_terbit', 'like', '%' . $tanggal_terbit . '%')
            ->where('sip_spk_dokter.tanggal_berlaku', 'like', '%' . $tanggal_berlaku . '%')
            ->get();

        $ruanganOptions = DB::table('ruangan_id')->pluck('ruangan', 'ruangan');
        $userList = DB::table('profil_pegawai')
        ->join('users', 'profil_pegawai.user_id', 'users.user_id')
        ->where('role_name', '=', 'User')
        ->get();

        $user_id = auth()->user()->user_id;
        $data_profil_sip = DB::table('profil_pegawai')
        ->select('profil_pegawai.*', 'profil_pegawai.name', 'profil_pegawai.nip')
        ->where('profil_pegawai.user_id', $user_id)
        ->get();

        return view('transaksi.spk-perawat', compact('data_spk_perawat', 'userList', 'data_profil_sip', 'ruanganOptions', 
            'unreadNotifications', 'readNotifications', 'result_tema'));
    }

    /** Tambah Data SPK Perawat */
    public function tambahDataSPKPerawat(Request $request)
    {
        $request->validate([
            'user_id'               => 'required|string|max:255',
            'name'                  => 'required|string|max:255',
            'nip'                   => 'required|string|max:255',
            'unit_kerja'            => 'required|string|max:255',
            'nomor_sip'             => 'required|string|max:255',
            'tanggal_terbit'        => 'required|string|max:255',
            'tanggal_berlaku'       => 'required|string|max:255',
            'sip_spk_jabatan'       => 'required|string|max:255',
            'jenis_dokumen'         => 'required|string|max:255',
            'ruangan'               => 'required|string|max:255',
            'dokumen_sip'           => 'required|mimes:pdf|max:5120',
        ]);
        DB::beginTransaction();

        try {
            $dokumen_sip = time() . '.' . $request->dokumen_sip->extension();
            $request->dokumen_sip->move(public_path('assets/DokumenSPKPerawat'), $dokumen_sip);

            $SPKPerawat = new SIPDokter;
            $SPKPerawat->user_id               = $request->user_id;
            $SPKPerawat->name                  = $request->name;
            $SPKPerawat->nip                   = $request->nip;
            $SPKPerawat->unit_kerja            = $request->unit_kerja;
            $SPKPerawat->nomor_sip             = $request->nomor_sip;
            $SPKPerawat->tanggal_terbit        = $request->tanggal_terbit;
            $SPKPerawat->tanggal_berlaku       = $request->tanggal_berlaku;
            $SPKPerawat->sip_spk_jabatan       = $request->sip_spk_jabatan;
            $SPKPerawat->jenis_dokumen         = $request->jenis_dokumen;
            $SPKPerawat->ruangan               = $request->ruangan;
            $SPKPerawat->dokumen_sip           = $dokumen_sip;
            $SPKPerawat->save();

            DB::commit();
            Toastr::success('Data SPK Perawat berhasil ditambah ✔', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Data SPK Perawat gagal ditambah ✘', 'Error');
            return redirect()->back();
        }
    }
    /** /Tambah Data SPK Perawat */

    /** Edit Data SPK Perawat */
    public function editSPKPerawat(Request $request)
    {
        DB::beginTransaction();
        try {
            $dokumen_sip = $request->hidden_dokumen_sip;
            $dokumen_sips  = $request->file('dokumen_sip');
            if ($dokumen_sips != '') {
                unlink('assets/DokumenSPKPerawat/' . $dokumen_sip);
                $dokumen_sip = time() . '.' . $dokumen_sips->getClientOriginalExtension();
                $dokumen_sips->move(public_path('assets/DokumenSPKPerawat'), $dokumen_sip);
            } else {
                $dokumen_sip;
            }

            $update = [
                'unit_kerja'            => $request->unit_kerja,
                'nomor_sip'             => $request->nomor_sip,
                'tanggal_terbit'        => $request->tanggal_terbit,
                'tanggal_berlaku'       => $request->tanggal_berlaku,
                'ruangan'               => $request->ruangan,
                'dokumen_sip'           => $dokumen_sip,
            ];

            SIPDokter::where('id', $request->id)->update($update);
            DB::commit();
            Toastr::success('Data SPK Perawat berhasil diperbaharui ✔', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Data SPK Perawat gagal diperbaharui ✘', 'Error');
            return redirect()->back();
        }
    }
    /** /Edit Data SPK Perawat */

    /** Hapus Data SPK Perawat */
    public function hapusDataSPKPerawat(Request $request)
    {
        DB::beginTransaction();
        try {
            $dokumen_sip = SIPDokter::where('id', $request->id)->pluck('dokumen_sip')->first();
            unlink('assets/DokumenSPKPerawat/' . $dokumen_sip);
            SIPDokter::where('id', $request->id)->delete();
            DB::commit();
            Toastr::success('Data SPK Perawat berhasil dihapus ✔', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Data SPK Perawat gagal dihapus ✘', 'Error');
            return redirect()->back();
        }
    }

    /** /Tampilan SPK Nakes Lain */
    public function tampilanSPKNakesLain()
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

        $user_id = auth()->user()->user_id;
        $data_spk_nakes_lain = DB::table('sip_spk_dokter')
        ->select(
            'sip_spk_dokter.*',
            'sip_spk_dokter.user_id',
            'sip_spk_dokter.name',
            'sip_spk_dokter.nip',
            'sip_spk_dokter.unit_kerja',
            'sip_spk_dokter.nomor_sip',
            'sip_spk_dokter.tanggal_terbit',
            'sip_spk_dokter.tanggal_berlaku',
            'sip_spk_dokter.jenis_dokumen',
            'sip_spk_dokter.ruangan',
            'sip_spk_dokter.dokumen_sip'
        )
            ->where('sip_spk_dokter.user_id', $user_id)
            ->where('sip_spk_dokter.sip_spk_jabatan', 'Nakes Lain')
            ->where('sip_spk_dokter.jenis_dokumen', 'SPK Nakes Lain')
            ->get();

        $ruanganOptions = DB::table('ruangan_id')->pluck('ruangan', 'ruangan');
        $data_profil_sip = DB::table('profil_pegawai')
        ->select('profil_pegawai.*', 'profil_pegawai.name', 'profil_pegawai.nip')
        ->where('profil_pegawai.user_id', $user_id)
            ->get();
        return view('transaksi.spk-nakes-lain', compact('data_spk_nakes_lain', 'data_profil_sip', 
            'unreadNotifications', 'readNotifications', 'ruanganOptions', 'result_tema'));
    }

    /** Daftar SPK Nakes Lain */
    public function tampilanSPKNakesLainAdmin()
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

        $data_spk_nakeslain = DB::table('sip_spk_dokter')
            ->select(
                'sip_spk_dokter.*',
                'sip_spk_dokter.user_id',
                'sip_spk_dokter.name',
                'sip_spk_dokter.nip',
                'sip_spk_dokter.unit_kerja',
                'sip_spk_dokter.nomor_sip',
                'sip_spk_dokter.tanggal_terbit',
                'sip_spk_dokter.tanggal_berlaku',
                'sip_spk_dokter.sip_spk_jabatan',
                'sip_spk_dokter.jenis_dokumen',
                'sip_spk_dokter.ruangan',
                'sip_spk_dokter.dokumen_sip'
            )
            ->where('sip_spk_dokter.sip_spk_jabatan', 'nakes lain')
            ->where('sip_spk_dokter.jenis_dokumen', 'SPK Nakes Lain')
            ->get();
        $userList = DB::table('profil_pegawai')
        ->join('users', 'profil_pegawai.user_id', 'users.user_id')
        ->where('role_name', '=', 'User')
        ->get();
        $ruanganOptions = DB::table('ruangan_id')->pluck('ruangan', 'ruangan');
        return view('transaksi.spk-nakes-lain-admin', compact('data_spk_nakeslain', 'userList', 'ruanganOptions', 
            'unreadNotifications', 'readNotifications', 'result_tema'));
    }

    /** Filter SPK Nakes Lain Admin*/
    public function filterSPKNakesLainAdmin(Request $request)
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

        $name = $request->input('name');
        $nip = $request->input('nip');
        $tanggal_terbit = $request->input('tanggal_terbit');

        $data_spk_nakeslain = DB::table('sip_spk_dokter')
        ->select(
            'sip_spk_dokter.*',
            'sip_spk_dokter.user_id',
            'sip_spk_dokter.name',
            'sip_spk_dokter.nip',
            'sip_spk_dokter.unit_kerja',
            'sip_spk_dokter.nomor_sip',
            'sip_spk_dokter.tanggal_terbit',
            'sip_spk_dokter.tanggal_berlaku',
            'sip_spk_dokter.sip_spk_jabatan',
            'sip_spk_dokter.jenis_dokumen',
            'sip_spk_dokter.ruangan',
            'sip_spk_dokter.dokumen_sip'
        )
            ->where('sip_spk_dokter.jenis_dokumen', '=', 'SPK Nakes Lain')
            ->where('sip_spk_dokter.name', 'like', '%' . $name . '%')
            ->where('sip_spk_dokter.nip', 'like', '%' . $nip . '%')
            ->where('sip_spk_dokter.tanggal_terbit', 'like', '%' . $tanggal_terbit . '%')
            ->get();
        $userList = DB::table('profil_pegawai')
        ->join('users', 'profil_pegawai.user_id', 'users.user_id')
        ->where('role_name', '=', 'User')
        ->get();
        $ruanganOptions = DB::table('ruangan_id')->pluck('ruangan', 'ruangan');
        return view('transaksi.spk-nakes-lain-admin', compact('data_spk_nakeslain', 'userList', 'ruanganOptions', 
            'unreadNotifications', 'readNotifications', 'result_tema'));
    }

    /** Filter SPK Nakes Lain User*/
    public function filterSPKNakesLain(Request $request)
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

        $nomor_sip = $request->input('nomor_sip');
        $tanggal_terbit = $request->input('tanggal_terbit');
        $tanggal_berlaku = $request->input('tanggal_berlaku');
        $user_id = auth()->user()->user_id;

        $data_spk_nakes_lain = DB::table('sip_spk_dokter')
        ->join('users', 'users.user_id', '=', 'sip_spk_dokter.user_id')
        ->select(
            'sip_spk_dokter.*',
            'sip_spk_dokter.user_id',
            'sip_spk_dokter.name',
            'sip_spk_dokter.nip',
            'sip_spk_dokter.unit_kerja',
            'sip_spk_dokter.nomor_sip',
            'sip_spk_dokter.tanggal_terbit',
            'sip_spk_dokter.tanggal_berlaku',
            'sip_spk_dokter.sip_spk_jabatan',
            'sip_spk_dokter.jenis_dokumen',
            'sip_spk_dokter.ruangan',
            'sip_spk_dokter.dokumen_sip'
        )
            ->where('users.user_id', $user_id)
            ->where('sip_spk_dokter.jenis_dokumen', '=', 'SPK Nakes Lain')
            ->where('sip_spk_dokter.nomor_sip', 'like', '%' . $nomor_sip . '%')
            ->where('sip_spk_dokter.tanggal_terbit', 'like', '%' . $tanggal_terbit . '%')
            ->where('sip_spk_dokter.tanggal_berlaku', 'like', '%' . $tanggal_berlaku . '%')
            ->get();
        $userList = DB::table('profil_pegawai')
        ->join('users', 'profil_pegawai.user_id', 'users.user_id')
        ->where('role_name', '=', 'User')
        ->get();

        $user_id = auth()->user()->user_id;
        $data_profil_sip = DB::table('profil_pegawai')
        ->select('profil_pegawai.*', 'profil_pegawai.name', 'profil_pegawai.nip')
        ->where('profil_pegawai.user_id', $user_id)
        ->get();
        $ruanganOptions = DB::table('ruangan_id')->pluck('ruangan', 'ruangan');
        return view('transaksi.spk-nakes-lain', compact('data_spk_nakes_lain', 'data_profil_sip', 'userList', 'ruanganOptions', 
            'unreadNotifications', 'readNotifications', 'result_tema'));
    }

    /** Tambah Data SPK Nakes Lain */
    public function tambahDataSPKNakesLain(Request $request)
    {
        $request->validate([
            'user_id'               => 'required|string|max:255',
            'name'                  => 'required|string|max:255',
            'nip'                   => 'required|string|max:255',
            'unit_kerja'            => 'required|string|max:255',
            'nomor_sip'             => 'required|string|max:255',
            'tanggal_terbit'        => 'required|string|max:255',
            'tanggal_berlaku'       => 'required|string|max:255',
            'sip_spk_jabatan'       => 'required|string|max:255',
            'jenis_dokumen'         => 'required|string|max:255',
            'ruangan'               => 'required|string|max:255',
            'dokumen_sip'           => 'required|mimes:pdf|max:5120',
        ]);
        DB::beginTransaction();

        try {
            $dokumen_sip = time() . '.' . $request->dokumen_sip->extension();
            $request->dokumen_sip->move(public_path('assets/DokumenSPKNakesLain'), $dokumen_sip);

            $SPKNakesLain = new SIPDokter;
            $SPKNakesLain->user_id               = $request->user_id;
            $SPKNakesLain->name                  = $request->name;
            $SPKNakesLain->nip                   = $request->nip;
            $SPKNakesLain->unit_kerja            = $request->unit_kerja;
            $SPKNakesLain->nomor_sip             = $request->nomor_sip;
            $SPKNakesLain->tanggal_terbit        = $request->tanggal_terbit;
            $SPKNakesLain->tanggal_berlaku       = $request->tanggal_berlaku;
            $SPKNakesLain->sip_spk_jabatan       = $request->sip_spk_jabatan;
            $SPKNakesLain->jenis_dokumen         = $request->jenis_dokumen;
            $SPKNakesLain->ruangan               = $request->ruangan;
            $SPKNakesLain->dokumen_sip           = $dokumen_sip;
            $SPKNakesLain->save();

            DB::commit();
            Toastr::success('Data SPK nakes lain berhasil ditambah ✔', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Data SPK nakes lain gagal ditambah ✘', 'Error');
            return redirect()->back();
        }
    }
    /** /Tambah Data SPK Nakes Lain */

    /** Edit Data SPK Nakes Lain */
    public function editSPKNakesLain(Request $request)
    {
        DB::beginTransaction();
        try {
            $dokumen_sip = $request->hidden_dokumen_sip;
            $dokumen_sips  = $request->file('dokumen_sip');
            if ($dokumen_sips != '') {
                unlink('assets/DokumenSPKNakesLain/' . $dokumen_sip);
                $dokumen_sip = time() . '.' . $dokumen_sips->getClientOriginalExtension();
                $dokumen_sips->move(public_path('assets/DokumenSPKNakesLain'), $dokumen_sip);
            } else {
                $dokumen_sip;
            }

            $update = [
                'unit_kerja'            => $request->unit_kerja,
                'nomor_sip'             => $request->nomor_sip,
                'tanggal_terbit'        => $request->tanggal_terbit,
                'tanggal_berlaku'       => $request->tanggal_berlaku,
                'ruangan'               => $request->ruangan,
                'dokumen_sip'           => $dokumen_sip,
            ];

            SIPDokter::where('id', $request->id)->update($update);
            DB::commit();
            Toastr::success('Data SPK nakes lain berhasil diperbaharui ✔', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Data SPK nakes lain gagal diperbaharui ✘', 'Error');
            return redirect()->back();
        }
    }
    /** /Edit Data SPK Nakes Lain */

    /** Hapus Data SPK Nakes Lain */
    public function hapusDataSPKNakesLain(Request $request)
    {
        DB::beginTransaction();
        try {
            $dokumen_sip = SIPDokter::where('id', $request->id)->pluck('dokumen_sip')->first();
            unlink('assets/DokumenSPKNakesLain/' . $dokumen_sip);
            SIPDokter::where('id', $request->id)->delete();
            DB::commit();
            Toastr::success('Data SPK Nakes Lain berhasil dihapus ✔', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Data SPK Nakes Lain gagal dihapus ✘', 'Error');
            return redirect()->back();
        }
    }
}
