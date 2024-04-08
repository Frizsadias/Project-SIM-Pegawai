<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;
use Brian2694\Toastr\Facades\Toastr;
use DB;
use Session;

class NotificationController extends Controller
{
    public function tampilanNotifikasi(Request $request)
    {

        $result_tema = DB::table('mode_aplikasi')
            ->select(
                'mode_aplikasi.id',
                'mode_aplikasi.tema_aplikasi',
                'mode_aplikasi.warna_sistem',
                'mode_aplikasi.warna_sistem_tulisan',
                'mode_aplikasi.warna_mode',
                'mode_aplikasi.tabel_warna',
                'mode_aplikasi.tabel_tulisan_tersembunyi',
                'mode_aplikasi.warna_dropdown_menu',
                'mode_aplikasi.ikon_plugin',
                'mode_aplikasi.bayangan_kotak_header',
                'mode_aplikasi.warna_mode_2',
                )
            ->where('user_id', auth()->user()->user_id)
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

        $semua_notifikasi = DB::table('notifications')
            ->leftjoin('users', 'notifications.notifiable_id', 'users.id')
            ->select(
                'notifications.*',
                'notifications.id',
                'users.name',
                'users.avatar'
            )
            ->get();

        $belum_dibaca = DB::table('notifications')
            ->leftjoin('users', 'notifications.notifiable_id', 'users.id')
            ->select(
                'notifications.*',
                'notifications.id',
                'users.name',
                'users.avatar'
            )
            ->whereNull('read_at')
            ->get();

        $dibaca = DB::table('notifications')
            ->leftjoin('users', 'notifications.notifiable_id', 'users.id')
            ->select(
                'notifications.*',
                'notifications.id',
                'users.name',
                'users.avatar'
            )
            ->whereNotNull('read_at')
            ->get();
        return view('notifikasi.semua-tampilan', compact('semua_notifikasi', 'belum_dibaca', 'dibaca', 'unreadNotifications', 'readNotifications', 'result_tema'));
    }

    public function hapusNotifikasi($id)
    {
        try {
            if($id) {
                Notification::where('id', $id)->delete();
            }
            Toastr::success('Notifikasi Berhasil Dihapus ✔', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Notifikasi Gagal Dihapus ✘', 'Error');
            return redirect()->back();
        }
    }
}