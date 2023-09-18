<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use PDF;
use App\Models\User;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    // main dashboard
    public function index()
    {
        // Mendapatkan peran pengguna saat ini
        $user = auth()->user();

        // Memeriksa peran pengguna dan mengarahkannya ke halaman yang sesuai
        if ($user->role_name === 'Admin') {
            return view('dashboard.Halaman-admin');
        } elseif ($user->role_name === 'Super Admin') {
            return view('dashboard.Halaman-super-admin');
        } elseif ($user->role_name === 'User') {
            return view('dashboard.Halaman-user');
        }

        // Jika tidak ada peran yang sesuai, Anda dapat menangani ini sesuai dengan kebutuhan Anda
        return view('dashboard.dashboard');
    }

    // employee dashboard
    public function emDashboard()
    {
        $dt        = Carbon::now();
        $todayDate = $dt->toDayDateTimeString();
        return view('dashboard.emdashboard',compact('todayDate'));
    }
}
