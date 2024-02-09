<?php

namespace App\Http\Controllers;

// use App\Charts\AgamaChart;
use App\Charts\GrafikChart;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;

class RekapitulasiController extends Controller
{
    public function index(GrafikChart $chart)
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

        $dataPegawai = User::where('role_name', 'User')->count();
        return view('rekapitulasi.super-admin', [
            'chart' => $chart->build(),
            'grafikAgama' => $chart->grafikAgama(),
            'grafikJenisKelamin' => $chart->grafikJenisKelamin(),
            'grafikPangkat' => $chart->grafikPangkat(),
            'dataPegawai' => $dataPegawai,
            'unreadNotifications' => $unreadNotifications,
            'readNotifications' => $readNotifications,
            'result_tema' => $result_tema
        ]);
    }
}
