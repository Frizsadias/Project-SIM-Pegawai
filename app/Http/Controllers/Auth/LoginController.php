<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
use DB;
use App\Models\User;
use Carbon\Carbon;
use Session;
use Brian2694\Toastr\Facades\Toastr;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except([
            'logout',
            'locked',
            'unlock'
        ]);
    }

    /** index login page */
    public function login()
    {
        return view('auth.login');
    }

    /** login page to check database table users */
    public function authenticate(Request $request)
    {
        $request->validate([
            'nip_or_no_dokumen' => 'required|string',
            'password'          => 'required|string'
        ]);
        try {
            $username = $request->nip_or_no_dokumen;
            $password = $request->password;
            $dt         = Carbon::now();
            $todayDate  = $dt->toDayDateTimeString();
            if (Auth::attempt(['nip'        => $username, 'password' => $password, 'status' => 'Active']) ||
                Auth::attempt(['no_dokumen' => $username, 'password' => $password, 'status' => 'Active'])) {
                $user = Auth::User();
                Session::put('name', $user->name);
                Session::put('nip', $user->nip);
                Session::put('no_dokumen', $user->no_dokumen);
                Session::put('user_id', $user->user_id);
                Session::put('join_date', $user->join_date);
                Session::put('status', $user->status);
                Session::put('role_name', $user->role_name);
                Session::put('avatar', $user->avatar);
                $activityLog = ['name' => Session::get('name'), 'nip' => $user->nip, 'no_dokumen' => $user->no_dokumen, 'description' => 'Telah masuk aplikasi', 'date_time' => $todayDate];
                DB::table('activity_logs')->insert($activityLog);
                
                Toastr::success('Berhasil masuk aplikasi :)', 'Success');
                return redirect()->intended('home');
            } else {
                Toastr::error('Gagal, Nama Pengguna dan Kata Sandi tidak sama ✘', 'Error');
                return redirect('login');
            }
        } catch (\Exception $e) {
            \Log::info($e);
            DB::rollback();
            Toastr::error('Gagal, NIP/NIK anda tidak tersedia pada aplikasi :(', 'Error');
            return redirect()->back();
        }
    }

    /** logout and forget session */
    public function logout(Request $request)
    {
        $dt         = Carbon::now();
        $todayDate  = $dt->toDayDateTimeString();
        $activityLog = ['name' => Session::get('name'), 'nip'=> Session::get('nip'), 'no_dokumen'=> Session::get('no_dokumen'), 'description' => 'Telah keluar aplikasi', 'date_time' => $todayDate];
        DB::table('activity_logs')->insert($activityLog);
        $request->session()->forget('name');
        $request->session()->forget('nip');
        $request->session()->forget('no_dokumen');
        $request->session()->forget('user_id');
        $request->session()->forget('join_date');
        $request->session()->forget('status');
        $request->session()->forget('role_name');
        $request->session()->forget('avatar');
        $request->session()->flush();
        Auth::logout();
        Toastr::success('Berhasil keluar aplikasi :)','Success');
        return redirect('login');
    }
}
