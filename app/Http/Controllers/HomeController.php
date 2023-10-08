<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use PDF;
use App\Models\User;
use App\Models\CompanySettings;
use App\Charts\GrafikChart;
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
    public function index(GrafikChart $chart)
    {
        // Mendapatkan peran pengguna saat ini
        $user = auth()->user();

        // Memeriksa peran pengguna dan mengarahkannya ke halaman yang sesuai
        if ($user->role_name === 'Admin')
        {
            $dataPegawai = User::where('role_name', 'User')->count();
            return view('dashboard.Halaman-super-admin', [
                'chart' => $chart->build(),
                'grafikAgama' => $chart->grafikAgama(),
                'grafikJenisKelamin' => $chart->grafikJenisKelamin(),
                'grafikPangkat' => $chart->grafikPangkat(),
                'dataPegawai' => $dataPegawai
            ]);
        }
        elseif ($user->role_name === 'Super Admin') 
        {
            $dataPegawai = User::where('role_name', 'User')->count();
            return view('dashboard.Halaman-super-admin', [
                'chart' => $chart->build(),
                'grafikAgama' => $chart->grafikAgama(),
                'grafikJenisKelamin' => $chart->grafikJenisKelamin(),
                'grafikPangkat' => $chart->grafikPangkat(),
                'dataPegawai' => $dataPegawai
            ]);
        }
        elseif ($user->role_name === 'User')
        {
            $tampilanPerusahaan = CompanySettings::where('id',1)->first();
            return view('dashboard.Halaman-user',compact('tampilanPerusahaan'));
        }
    }
}
