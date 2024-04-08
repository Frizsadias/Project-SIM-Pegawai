<?php

namespace App\Http\Controllers;

use App\Charts\GrafikChart;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use DB;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\PDF;

class RekapitulasiController extends Controller
{
    public function index(GrafikChart $chart)
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

        $dataPegawai = User::where('role_name', 'User')->count();
        return view('rekapitulasi.super-admin', [
            'chart' => $chart->build(),
            'grafikAgama' => $chart->grafikAgama(),
            'grafikJenisKelamin' => $chart->grafikJenisKelamin(),
            'grafikPangkat' => $chart->grafikPangkat(),
            'dataPegawai' => $dataPegawai,
            'unreadNotifications' => $unreadNotifications,
            'readNotifications' => $readNotifications,
            'result_tema' => $result_tema,
            'semua_notifikasi' => $semua_notifikasi,
            'belum_dibaca' => $belum_dibaca,
            'dibaca' => $dibaca    
        ]);
    }
}