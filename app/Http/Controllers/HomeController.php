<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use PDF;
use App\Models\User;
use App\Models\CompanySettings;
use App\Models\Notification;
use App\Charts\GrafikChart;
use App\Models\ProfilPegawai;
use App\Models\ruangan;
use App\Notifications\UserFollowNotification;
use App\Notifications\UlangTahunNotification;
use App\Notifications\MasaBerlakuSIPNotification;
use App\Notifications\MasaBerlakuSPKDokterNotification;
use App\Notifications\MasaBerlakuSPKPerawatNotification;
use App\Notifications\MasaBerlakuSPKNakesLainNotification;

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
            $dataPNS = ProfilPegawai::where('jenis_pegawai', 'PNS')->count();
            $dataCPNS = ProfilPegawai::where('jenis_pegawai', 'CPNS')->count();
            $dataPPPK = ProfilPegawai::where('jenis_pegawai', 'PPPK')->count();
            $datanonASN = ProfilPegawai::where('jenis_pegawai', 'Non ASN')->count();
            $dataTempatTidur = ruangan::sum('jumlah_tempat_tidur');
            $dataTempatTidurIGD = ruangan::where('ruangan', 'Ruang IGD Terpadu')->sum('jumlah_tempat_tidur');
            $dataTempatTidurBedah = ruangan::where('ruangan', 'Ruang Bedah Central')->sum('jumlah_tempat_tidur');
            $dataTempatTidurRR = ruangan::where('ruangan', 'Ruang RR')->sum('jumlah_tempat_tidur');
            $dataTempatTidurPoliJantung = ruangan::where('ruangan', 'Ruang Poli Jantung')->sum('jumlah_tempat_tidur');
            $dataTempatTidurPoliKelamindanKulit = ruangan::where('ruangan', 'Ruang Poli Kelamin dan Kulit')->sum('jumlah_tempat_tidur');
            $dataTempatTidurRuangPoliSaraf = ruangan::where('ruangan', 'Ruang Poli Saraf')->sum('jumlah_tempat_tidur');
            $dataTempatTidurRuangPoliGigi = ruangan::where('ruangan', 'Ruang Poli Gigi')->sum('jumlah_tempat_tidur');
            $dataTempatTidurRuangPoliDalam = ruangan::where('ruangan', 'Ruang Poli Dalam')->sum('jumlah_tempat_tidur');
            $dataTempatTidurRuangPoliMata = ruangan::where('ruangan', 'Ruang Poli Mata')->sum('jumlah_tempat_tidur');
            $dataTempatTidurRuangPoliTHT = ruangan::where('ruangan', 'Ruang Poli THT')->sum('jumlah_tempat_tidur');
            $dataTempatTidurRuangPoliParu = ruangan::where('ruangan', 'Ruang Poli Paru')->sum('jumlah_tempat_tidur');
            $dataTempatTidurRuangPoliUmum = ruangan::where('ruangan', 'Ruang Poli Umum')->sum('jumlah_tempat_tidur');
            $dataTempatTidurRuangPoliAnak = ruangan::where('ruangan', 'Ruang Poli Anak')->sum('jumlah_tempat_tidur');
            $dataTempatTidurRuangPoliKandungan = ruangan::where('ruangan', 'Ruang Poli Kandungan')->sum('jumlah_tempat_tidur');
            $dataTempatTidurRuangPoliJiwa = ruangan::where('ruangan', 'Ruang Poli Jiwa')->sum('jumlah_tempat_tidur');
            $dataTempatTidurRuangPoliOrthopedi = ruangan::where('ruangan', 'Ruang Poli Othopedi')->sum('jumlah_tempat_tidur');
            $dataTempatTidurRuangPoliDots = ruangan::where('ruangan', 'Ruang Poli Dots')->sum('jumlah_tempat_tidur');
            $dataTempatTidurRuangHemodialisis = ruangan::where('ruangan', 'Ruang Hemodialisis(HD)')->sum('jumlah_tempat_tidur');
            $dataTempatTidurRuangKebidanan = ruangan::where('ruangan', 'Ruang Kebidanan')->sum('jumlah_tempat_tidur');
            $dataTempatTidurRuangPinang = ruangan::where('ruangan', 'Ruang Pinang')->sum('jumlah_tempat_tidur');
            $dataTempatTidurRuangPerinatologi = ruangan::where('ruangan', 'Ruang Perinatologi')->sum('jumlah_tempat_tidur');
            $dataTempatTidurRuangCemara = ruangan::where('ruangan', 'Ruang Cemara')->sum('jumlah_tempat_tidur');
            $dataTempatTidurRuangHCUBougenvill = ruangan::where('ruangan', 'Ruang HCU Bougenvill')->sum('jumlah_tempat_tidur');
            $dataTempatTidurRuangICU = ruangan::where('ruangan', 'Ruang ICU')->sum('jumlah_tempat_tidur');
            $dataTempatTidurRuangICCU = ruangan::where('ruangan', 'Ruang ICCU')->sum('jumlah_tempat_tidur');
            $dataTempatTidurRuangAsoka = ruangan::where('ruangan', 'Ruang Asoka')->sum('jumlah_tempat_tidur');
            $dataTempatTidurRuangPinus = ruangan::where('ruangan', 'Ruang Pinus')->sum('jumlah_tempat_tidur');
            $dataTempatTidurRuangWijayaKusuma = ruangan::where('ruangan', 'Ruang Wijaya Kusuma')->sum('jumlah_tempat_tidur');
            $dataTempatTidurRuangPavilliun = ruangan::where('ruangan', 'Ruang Pavilliun')->sum('jumlah_tempat_tidur');
            $dataTempatTidurRuangPalem = ruangan::where('ruangan', 'Ruang Palem/PICU')->sum('jumlah_tempat_tidur');
            $dataTempatTidurRuangUnitStroke = ruangan::where('ruangan', 'Ruang Unit Stroke')->sum('jumlah_tempat_tidur');
            $dataTempatTidurRuangBidara = ruangan::where('ruangan', 'Ruang Bidara/Ranap Jiwa')->sum('jumlah_tempat_tidur');
            $dataTempatTidurRuangNonPerawatan = ruangan::where('ruangan', 'Ruang Lain-Lain/Non Perawatan')->sum('jumlah_tempat_tidur');

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
            
            return view('dashboard.Halaman-admin', [
                'chart' => $chart->build(),
                'grafikAgama' => $chart->grafikAgama(),
                'grafikJenisKelamin' => $chart->grafikJenisKelamin(),
                'grafikPangkat' => $chart->grafikPangkat(),
                'dataPegawai' => $dataPegawai,
                'dataPNS'=> $dataPNS,
                'dataCPNS' => $dataCPNS,
                'dataPPPK' => $dataPPPK,
                'datanonASN' => $datanonASN,
                'dataTempatTidur' => $dataTempatTidur,
                'dataTempatTidurIGD' => $dataTempatTidurIGD,
                'dataTempatTidurBedah' => $dataTempatTidurBedah,
                'dataTempatTidurRR' => $dataTempatTidurRR,
                'dataTempatTidurPoliJantung' => $dataTempatTidurPoliJantung,
                'dataTempatTidurPoliKelamindanKulit' => $dataTempatTidurPoliKelamindanKulit,
                'dataTempatTidurRuangPoliSaraf' => $dataTempatTidurRuangPoliSaraf,
                'dataTempatTidurRuangPoliGigi' => $dataTempatTidurRuangPoliGigi,
                'dataTempatTidurRuangPoliDalam' => $dataTempatTidurRuangPoliDalam,
                'dataTempatTidurRuangPoliMata' => $dataTempatTidurRuangPoliMata,
                'dataTempatTidurRuangPoliTHT' => $dataTempatTidurRuangPoliTHT,
                'dataTempatTidurRuangPoliParu' => $dataTempatTidurRuangPoliParu,
                'dataTempatTidurRuangPoliUmum' => $dataTempatTidurRuangPoliUmum,
                'dataTempatTidurRuangPoliAnak' => $dataTempatTidurRuangPoliAnak,
                'dataTempatTidurRuangPoliKandungan' => $dataTempatTidurRuangPoliKandungan,
                'dataTempatTidurRuangPoliJiwa' => $dataTempatTidurRuangPoliJiwa,
                'dataTempatTidurRuangPoliOrthopedi' => $dataTempatTidurRuangPoliOrthopedi,
                'dataTempatTidurRuangPoliDots' => $dataTempatTidurRuangPoliDots,
                'dataTempatTidurRuangHemodialisis' => $dataTempatTidurRuangHemodialisis,
                'dataTempatTidurRuangKebidanan' => $dataTempatTidurRuangKebidanan,
                'dataTempatTidurRuangPinang' => $dataTempatTidurRuangPinang,
                'dataTempatTidurRuangPerinatologi' => $dataTempatTidurRuangPerinatologi,
                'dataTempatTidurRuangCemara' => $dataTempatTidurRuangCemara,
                'dataTempatTidurRuangHCUBougenvill' => $dataTempatTidurRuangHCUBougenvill,
                'dataTempatTidurRuangICU' => $dataTempatTidurRuangICU,
                'dataTempatTidurRuangICCU' => $dataTempatTidurRuangICCU,
                'dataTempatTidurRuangAsoka' => $dataTempatTidurRuangAsoka,
                'dataTempatTidurRuangPinus' => $dataTempatTidurRuangPinus,
                'dataTempatTidurRuangWijayaKusuma' => $dataTempatTidurRuangWijayaKusuma,
                'dataTempatTidurRuangPavilliun' => $dataTempatTidurRuangPavilliun,
                'dataTempatTidurRuangPalem' => $dataTempatTidurRuangPalem,
                'dataTempatTidurRuangUnitStroke' => $dataTempatTidurRuangUnitStroke,
                'dataTempatTidurRuangBidara' => $dataTempatTidurRuangBidara,
                'dataTempatTidurRuangNonPerawatan' => $dataTempatTidurRuangNonPerawatan,
                'unreadNotifications' => $unreadNotifications,
                'readNotifications' => $readNotifications
            ]);
            
        }

        elseif ($user->role_name === 'Super Admin')
        {
            $dataPegawai = User::where('role_name', 'User')->count();
            $dataPNS = ProfilPegawai::where('jenis_pegawai', 'PNS')->count();
            $dataCPNS = ProfilPegawai::where('jenis_pegawai', 'CPNS')->count();
            $dataPPPK = ProfilPegawai::where('jenis_pegawai', 'PPPK')->count();
            $datanonASN = ProfilPegawai::where('jenis_pegawai', 'Non ASN')->count();
            $dataTempatTidur = ruangan::sum('jumlah_tempat_tidur');
            $dataTempatTidurIGD = ruangan::where('ruangan', 'Ruang IGD Terpadu')->sum('jumlah_tempat_tidur');
            $dataTempatTidurBedah = ruangan::where('ruangan', 'Ruang Bedah Central')->sum('jumlah_tempat_tidur');
            $dataTempatTidurRR = ruangan::where('ruangan', 'Ruang RR')->sum('jumlah_tempat_tidur');
            $dataTempatTidurPoliJantung = ruangan::where('ruangan', 'Ruang Poli Jantung')->sum('jumlah_tempat_tidur');
            $dataTempatTidurPoliKelamindanKulit = ruangan::where('ruangan', 'Ruang Poli Kelamin dan Kulit')->sum('jumlah_tempat_tidur');
            $dataTempatTidurRuangPoliSaraf = ruangan::where('ruangan', 'Ruang Poli Saraf')->sum('jumlah_tempat_tidur');
            $dataTempatTidurRuangPoliGigi = ruangan::where('ruangan', 'Ruang Poli Gigi')->sum('jumlah_tempat_tidur');
            $dataTempatTidurRuangPoliDalam = ruangan::where('ruangan', 'Ruang Poli Dalam')->sum('jumlah_tempat_tidur');
            $dataTempatTidurRuangPoliMata = ruangan::where('ruangan', 'Ruang Poli Mata')->sum('jumlah_tempat_tidur');
            $dataTempatTidurRuangPoliTHT = ruangan::where('ruangan', 'Ruang Poli THT')->sum('jumlah_tempat_tidur');
            $dataTempatTidurRuangPoliParu = ruangan::where('ruangan', 'Ruang Poli Paru')->sum('jumlah_tempat_tidur');
            $dataTempatTidurRuangPoliUmum = ruangan::where('ruangan', 'Ruang Poli Umum')->sum('jumlah_tempat_tidur');
            $dataTempatTidurRuangPoliAnak = ruangan::where('ruangan', 'Ruang Poli Anak')->sum('jumlah_tempat_tidur');
            $dataTempatTidurRuangPoliKandungan = ruangan::where('ruangan', 'Ruang Poli Kandungan')->sum('jumlah_tempat_tidur');
            $dataTempatTidurRuangPoliJiwa = ruangan::where('ruangan', 'Ruang Poli Jiwa')->sum('jumlah_tempat_tidur');
            $dataTempatTidurRuangPoliOrthopedi = ruangan::where('ruangan', 'Ruang Poli Othopedi')->sum('jumlah_tempat_tidur');
            $dataTempatTidurRuangPoliDots = ruangan::where('ruangan', 'Ruang Poli Dots')->sum('jumlah_tempat_tidur');
            $dataTempatTidurRuangHemodialisis = ruangan::where('ruangan', 'Ruang Hemodialisis(HD)')->sum('jumlah_tempat_tidur');
            $dataTempatTidurRuangKebidanan = ruangan::where('ruangan', 'Ruang Kebidanan')->sum('jumlah_tempat_tidur');
            $dataTempatTidurRuangPinang = ruangan::where('ruangan', 'Ruang Pinang')->sum('jumlah_tempat_tidur');
            $dataTempatTidurRuangPerinatologi = ruangan::where('ruangan', 'Ruang Perinatologi')->sum('jumlah_tempat_tidur');
            $dataTempatTidurRuangCemara = ruangan::where('ruangan', 'Ruang Cemara')->sum('jumlah_tempat_tidur');
            $dataTempatTidurRuangHCUBougenvill = ruangan::where('ruangan', 'Ruang HCU Bougenvill')->sum('jumlah_tempat_tidur');
            $dataTempatTidurRuangICU = ruangan::where('ruangan', 'Ruang ICU')->sum('jumlah_tempat_tidur');
            $dataTempatTidurRuangICCU = ruangan::where('ruangan', 'Ruang ICCU')->sum('jumlah_tempat_tidur');
            $dataTempatTidurRuangAsoka = ruangan::where('ruangan', 'Ruang Asoka')->sum('jumlah_tempat_tidur');
            $dataTempatTidurRuangPinus = ruangan::where('ruangan', 'Ruang Pinus')->sum('jumlah_tempat_tidur');
            $dataTempatTidurRuangWijayaKusuma = ruangan::where('ruangan', 'Ruang Wijaya Kusuma')->sum('jumlah_tempat_tidur');
            $dataTempatTidurRuangPavilliun = ruangan::where('ruangan', 'Ruang Pavilliun')->sum('jumlah_tempat_tidur');
            $dataTempatTidurRuangPalem = ruangan::where('ruangan', 'Ruang Palem/PICU')->sum('jumlah_tempat_tidur');
            $dataTempatTidurRuangUnitStroke = ruangan::where('ruangan', 'Ruang Unit Stroke')->sum('jumlah_tempat_tidur');
            $dataTempatTidurRuangBidara = ruangan::where('ruangan', 'Ruang Bidara/Ranap Jiwa')->sum('jumlah_tempat_tidur');
            $dataTempatTidurRuangNonPerawatan = ruangan::where('ruangan', 'Ruang Lain-Lain/Non Perawatan')->sum('jumlah_tempat_tidur');

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
            
            return view('dashboard.Halaman-super-admin', [
                'chart' => $chart->build(),
                'grafikAgama' => $chart->grafikAgama(),
                'grafikJenisKelamin' => $chart->grafikJenisKelamin(),
                'grafikPangkat' => $chart->grafikPangkat(),
                'dataPegawai' => $dataPegawai,
                'dataPNS' => $dataPNS,
                'dataCPNS' => $dataCPNS,
                'dataPPPK' => $dataPPPK,
                'datanonASN' => $datanonASN,
                'dataTempatTidur' => $dataTempatTidur,
                'dataTempatTidurIGD' => $dataTempatTidurIGD,
                'dataTempatTidurBedah' => $dataTempatTidurBedah,
                'dataTempatTidurRR' => $dataTempatTidurRR,
                'dataTempatTidurPoliJantung' => $dataTempatTidurPoliJantung,
                'dataTempatTidurPoliKelamindanKulit' => $dataTempatTidurPoliKelamindanKulit,
                'dataTempatTidurRuangPoliSaraf' => $dataTempatTidurRuangPoliSaraf,
                'dataTempatTidurRuangPoliGigi' => $dataTempatTidurRuangPoliGigi,
                'dataTempatTidurRuangPoliDalam' => $dataTempatTidurRuangPoliDalam,
                'dataTempatTidurRuangPoliMata' => $dataTempatTidurRuangPoliMata,
                'dataTempatTidurRuangPoliTHT' => $dataTempatTidurRuangPoliTHT,
                'dataTempatTidurRuangPoliParu' => $dataTempatTidurRuangPoliParu,
                'dataTempatTidurRuangPoliUmum' => $dataTempatTidurRuangPoliUmum,
                'dataTempatTidurRuangPoliAnak' => $dataTempatTidurRuangPoliAnak,
                'dataTempatTidurRuangPoliKandungan' => $dataTempatTidurRuangPoliKandungan,
                'dataTempatTidurRuangPoliJiwa' => $dataTempatTidurRuangPoliJiwa,
                'dataTempatTidurRuangPoliOrthopedi' => $dataTempatTidurRuangPoliOrthopedi,
                'dataTempatTidurRuangPoliDots' => $dataTempatTidurRuangPoliDots,
                'dataTempatTidurRuangHemodialisis' => $dataTempatTidurRuangHemodialisis,
                'dataTempatTidurRuangKebidanan' => $dataTempatTidurRuangKebidanan,
                'dataTempatTidurRuangPinang' => $dataTempatTidurRuangPinang,
                'dataTempatTidurRuangPerinatologi' => $dataTempatTidurRuangPerinatologi,
                'dataTempatTidurRuangCemara' => $dataTempatTidurRuangCemara,
                'dataTempatTidurRuangHCUBougenvill' => $dataTempatTidurRuangHCUBougenvill,
                'dataTempatTidurRuangICU' => $dataTempatTidurRuangICU,
                'dataTempatTidurRuangICCU' => $dataTempatTidurRuangICCU,
                'dataTempatTidurRuangAsoka' => $dataTempatTidurRuangAsoka,
                'dataTempatTidurRuangPinus' => $dataTempatTidurRuangPinus,
                'dataTempatTidurRuangWijayaKusuma' => $dataTempatTidurRuangWijayaKusuma,
                'dataTempatTidurRuangPavilliun' => $dataTempatTidurRuangPavilliun,
                'dataTempatTidurRuangPalem' => $dataTempatTidurRuangPalem,
                'dataTempatTidurRuangUnitStroke' => $dataTempatTidurRuangUnitStroke,
                'dataTempatTidurRuangBidara' => $dataTempatTidurRuangBidara,
                'dataTempatTidurRuangNonPerawatan' => $dataTempatTidurRuangNonPerawatan,
                'unreadNotifications' => $unreadNotifications,
                'readNotifications' => $readNotifications
            ]);
        }

        elseif ($user->role_name === 'Kepala Ruang')
        {
            $dataIGD = User::where('ruangan', 'Ruang IGD Terpadu')->count();
            $dataBedahCentral = User::where('ruangan', 'Ruang Bedah Central')->count();
            $dataRR = User::where('ruangan', 'Ruang RR')->count();
            $dataPoliJantung = User::where('ruangan', 'Ruang Poli Jantung')->count();
            $dataPoliKelaminDanKulit = User::where('ruangan', 'Ruang Poli Kelamin dan Kulit')->count();
            $dataPoliSaraf = User::where('ruangan', 'Ruang Poli Saraf')->count();
            $dataPoliGigi = User::where('ruangan', 'Ruang Poli Gigi')->count();
            $dataPoliDalam = User::where('ruangan', 'Ruang Poli Dalam')->count();
            $dataPoliMata = User::where('ruangan', 'Ruang Poli Mata')->count();
            $dataPoliTHT = User::where('ruangan', 'Ruang Poli THT')->count();
            $dataPoliParu = User::where('ruangan', 'Ruang Poli Paru')->count();
            $dataPoliUmum = User::where('ruangan', 'Ruang Poli Umum')->count();
            $dataPoliAnak = User::where('ruangan', 'Ruang Poli Anak')->count();
            $dataPoliKandungan = User::where('ruangan', 'Ruang Poli Kandungan')->count();
            $dataPoliJiwa = User::where('ruangan', 'Ruang Poli Jiwa')->count();
            $dataPoliOrthopedi = User::where('ruangan', 'Ruang Poli Orthopedi')->count();
            $dataPoliDots = User::where('ruangan', 'Ruang Poli Dots')->count();
            $dataHemodialisis = User::where('ruangan', 'Ruang Hemodialisis(HD)')->count();
            $dataKebidanan = User::where('ruangan', 'Ruang Kebidanan')->count();
            $dataPinang = User::where('ruangan', 'Ruang Pinang')->count();
            $dataPerinatologi = User::where('ruangan', 'Ruang Perinatologi')->count();
            $dataCemara = User::where('ruangan', 'Ruang Cemara')->count();
            $dataHCU_Bougenvill = User::where('ruangan', 'Ruang HCU Bougenvill')->count();
            $dataICU = User::where('ruangan', 'Ruang ICU')->count();
            $dataICCU = User::where('ruangan', 'Ruang ICCU')->count();
            $dataAsoka = User::where('ruangan', 'Ruang Asoka')->count();
            $dataPinus = User::where('ruangan', 'Ruang Pinus')->count();
            $dataWijayaKusuma = User::where('ruangan', 'Ruang Wijaya Kusuma')->count();
            $dataPaviliun = User::where('ruangan', 'Ruang Pavilliun')->count();
            $dataPalem_PICU = User::where('ruangan', 'Ruang Palem/PICU')->count();
            $dataUnitStroke = User::where('ruangan', 'Ruang Unit Stroke')->count();
            $dataBidara_RanapJiwa = User::where('ruangan', 'Ruang Bidara/Ranap Jiwa')->count();
            $dataLain_Lain_NonPerawatan = User::where('ruangan', 'Ruang Lain-Lain/Non Perawatan')->count();
            $dataTempatTidur = ruangan::sum('jumlah_tempat_tidur');
            $dataTempatTidurIGD = ruangan::where('ruangan', 'Ruang IGD Terpadu')->sum('jumlah_tempat_tidur');
            $dataTempatTidurBedah = ruangan::where('ruangan', 'Ruang Bedah Central')->sum('jumlah_tempat_tidur');
            $dataTempatTidurRR = ruangan::where('ruangan', 'Ruang RR')->sum('jumlah_tempat_tidur');
            $dataTempatTidurPoliJantung = ruangan::where('ruangan', 'Ruang Poli Jantung')->sum('jumlah_tempat_tidur');
            $dataTempatTidurPoliKelamindanKulit = ruangan::where('ruangan', 'Ruang Poli Kelamin dan Kulit')->sum('jumlah_tempat_tidur');
            $dataTempatTidurRuangPoliSaraf = ruangan::where('ruangan', 'Ruang Poli Saraf')->sum('jumlah_tempat_tidur');
            $dataTempatTidurRuangPoliGigi = ruangan::where('ruangan', 'Ruang Poli Gigi')->sum('jumlah_tempat_tidur');
            $dataTempatTidurRuangPoliDalam = ruangan::where('ruangan', 'Ruang Poli Dalam')->sum('jumlah_tempat_tidur');
            $dataTempatTidurRuangPoliMata = ruangan::where('ruangan', 'Ruang Poli Mata')->sum('jumlah_tempat_tidur');
            $dataTempatTidurRuangPoliTHT = ruangan::where('ruangan', 'Ruang Poli THT')->sum('jumlah_tempat_tidur');
            $dataTempatTidurRuangPoliParu = ruangan::where('ruangan', 'Ruang Poli Paru')->sum('jumlah_tempat_tidur');
            $dataTempatTidurRuangPoliUmum = ruangan::where('ruangan', 'Ruang Poli Umum')->sum('jumlah_tempat_tidur');
            $dataTempatTidurRuangPoliAnak = ruangan::where('ruangan', 'Ruang Poli Anak')->sum('jumlah_tempat_tidur');
            $dataTempatTidurRuangPoliKandungan = ruangan::where('ruangan', 'Ruang Poli Kandungan')->sum('jumlah_tempat_tidur');
            $dataTempatTidurRuangPoliJiwa = ruangan::where('ruangan', 'Ruang Poli Jiwa')->sum('jumlah_tempat_tidur');
            $dataTempatTidurRuangPoliOrthopedi = ruangan::where('ruangan', 'Ruang Poli Orthopedi')->sum('jumlah_tempat_tidur');
            $dataTempatTidurRuangPoliDots = ruangan::where('ruangan', 'Ruang Poli Dots')->sum('jumlah_tempat_tidur');
            $dataTempatTidurRuangHemodialisis = ruangan::where('ruangan', 'Ruang Hemodialisis(HD)')->sum('jumlah_tempat_tidur');
            $dataTempatTidurRuangKebidanan = ruangan::where('ruangan', 'Ruang Kebidanan')->sum('jumlah_tempat_tidur');
            $dataTempatTidurRuangPinang = ruangan::where('ruangan', 'Ruang Pinang')->sum('jumlah_tempat_tidur');
            $dataTempatTidurRuangPerinatologi = ruangan::where('ruangan', 'Ruang Perinatologi')->sum('jumlah_tempat_tidur');
            $dataTempatTidurRuangCemara = ruangan::where('ruangan', 'Ruang Cemara')->sum('jumlah_tempat_tidur');
            $dataTempatTidurRuangHCUBougenvill = ruangan::where('ruangan', 'Ruang HCU Bougenvill')->sum('jumlah_tempat_tidur');
            $dataTempatTidurRuangICU = ruangan::where('ruangan', 'Ruang ICU')->sum('jumlah_tempat_tidur');
            $dataTempatTidurRuangICCU = ruangan::where('ruangan', 'Ruang ICCU')->sum('jumlah_tempat_tidur');
            $dataTempatTidurRuangAsoka = ruangan::where('ruangan', 'Ruang Asoka')->sum('jumlah_tempat_tidur');
            $dataTempatTidurRuangPinus = ruangan::where('ruangan', 'Ruang Pinus')->sum('jumlah_tempat_tidur');
            $dataTempatTidurRuangWijayaKusuma = ruangan::where('ruangan', 'Ruang Wijaya Kusuma')->sum('jumlah_tempat_tidur');
            $dataTempatTidurRuangPavilliun = ruangan::where('ruangan', 'Ruang Pavilliun')->sum('jumlah_tempat_tidur');
            $dataTempatTidurRuangPalem = ruangan::where('ruangan', 'Ruang Palem/PICU')->sum('jumlah_tempat_tidur');
            $dataTempatTidurRuangUnitStroke = ruangan::where('ruangan', 'Ruang Unit Stroke')->sum('jumlah_tempat_tidur');
            $dataTempatTidurRuangBidara = ruangan::where('ruangan', 'Ruang Bidara/Ranap Jiwa')->sum('jumlah_tempat_tidur');
            $dataTempatTidurRuangNonPerawatan = ruangan::where('ruangan', 'Ruang Lain-Lain/Non Perawatan')->sum('jumlah_tempat_tidur');

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
            
            return view('dashboard.Halaman-kepala-ruang', [
                'chart' => $chart->build(),
                'grafikAgama' => $chart->grafikAgama(),
                'grafikJenisKelamin' => $chart->grafikJenisKelamin(),
                'grafikPangkat' => $chart->grafikPangkat(),
                'dataIGD' => $dataIGD,
                'dataBedahCentral' => $dataBedahCentral,
                'dataRR' => $dataRR,
                'dataPoliJantung' => $dataPoliJantung,
                'dataPoliKelaminDanKulit' => $dataPoliKelaminDanKulit,
                'dataPoliSaraf' => $dataPoliSaraf,
                'dataPoliGigi' => $dataPoliGigi,
                'dataPoliDalam' => $dataPoliDalam,
                'dataPoliMata' => $dataPoliMata,
                'dataPoliTHT' => $dataPoliTHT,
                'dataPoliParu' => $dataPoliParu,
                'dataPoliUmum' => $dataPoliUmum,
                'dataPoliAnak' => $dataPoliAnak,
                'dataPoliKandungan' => $dataPoliKandungan,
                'dataPoliJiwa' => $dataPoliJiwa,
                'dataPoliOrthopedi' => $dataPoliOrthopedi,
                'dataPoliDots' => $dataPoliDots,
                'dataHemodialisis' => $dataHemodialisis,
                'dataKebidanan' => $dataKebidanan,
                'dataPinang' => $dataPinang,
                'dataPerinatologi' => $dataPerinatologi,
                'dataCemara' => $dataCemara,
                'dataHCU_Bougenvill' => $dataHCU_Bougenvill,
                'dataICU' => $dataICU,
                'dataICCU' => $dataICCU,
                'dataAsoka' => $dataAsoka,
                'dataPinus' => $dataPinus,
                'dataWijayaKusuma' => $dataWijayaKusuma,
                'dataPaviliun' => $dataPaviliun,
                'dataPalem_PICU' => $dataPalem_PICU,
                'dataUnitStroke' => $dataUnitStroke,
                'dataBidara_RanapJiwa' => $dataBidara_RanapJiwa,
                'dataLain_Lain_NonPerawatan' => $dataLain_Lain_NonPerawatan,
                'dataTempatTidur' => $dataTempatTidur,
                'dataTempatTidurIGD' => $dataTempatTidurIGD,
                'dataTempatTidurBedah' => $dataTempatTidurBedah,
                'dataTempatTidurRR' => $dataTempatTidurRR,
                'dataTempatTidurPoliJantung' => $dataTempatTidurPoliJantung,
                'dataTempatTidurPoliKelamindanKulit' => $dataTempatTidurPoliKelamindanKulit,
                'dataTempatTidurRuangPoliSaraf' => $dataTempatTidurRuangPoliSaraf,
                'dataTempatTidurRuangPoliGigi' => $dataTempatTidurRuangPoliGigi,
                'dataTempatTidurRuangPoliDalam' => $dataTempatTidurRuangPoliDalam,
                'dataTempatTidurRuangPoliMata' => $dataTempatTidurRuangPoliMata,
                'dataTempatTidurRuangPoliTHT' => $dataTempatTidurRuangPoliTHT,
                'dataTempatTidurRuangPoliParu' => $dataTempatTidurRuangPoliParu,
                'dataTempatTidurRuangPoliUmum' => $dataTempatTidurRuangPoliUmum,
                'dataTempatTidurRuangPoliAnak' => $dataTempatTidurRuangPoliAnak,
                'dataTempatTidurRuangPoliKandungan' => $dataTempatTidurRuangPoliKandungan,
                'dataTempatTidurRuangPoliJiwa' => $dataTempatTidurRuangPoliJiwa,
                'dataTempatTidurRuangPoliOrthopedi' => $dataTempatTidurRuangPoliOrthopedi,
                'dataTempatTidurRuangPoliDots' => $dataTempatTidurRuangPoliDots,
                'dataTempatTidurRuangHemodialisis' => $dataTempatTidurRuangHemodialisis,
                'dataTempatTidurRuangKebidanan' => $dataTempatTidurRuangKebidanan,
                'dataTempatTidurRuangPinang' => $dataTempatTidurRuangPinang,
                'dataTempatTidurRuangPerinatologi' => $dataTempatTidurRuangPerinatologi,
                'dataTempatTidurRuangCemara' => $dataTempatTidurRuangCemara,
                'dataTempatTidurRuangHCUBougenvill' => $dataTempatTidurRuangHCUBougenvill,
                'dataTempatTidurRuangICU' => $dataTempatTidurRuangICU,
                'dataTempatTidurRuangICCU' => $dataTempatTidurRuangICCU,
                'dataTempatTidurRuangAsoka' => $dataTempatTidurRuangAsoka,
                'dataTempatTidurRuangPinus' => $dataTempatTidurRuangPinus,
                'dataTempatTidurRuangWijayaKusuma' => $dataTempatTidurRuangWijayaKusuma,
                'dataTempatTidurRuangPavilliun' => $dataTempatTidurRuangPavilliun,
                'dataTempatTidurRuangPalem' => $dataTempatTidurRuangPalem,
                'dataTempatTidurRuangUnitStroke' => $dataTempatTidurRuangUnitStroke,
                'dataTempatTidurRuangBidara' => $dataTempatTidurRuangBidara,
                'dataTempatTidurRuangNonPerawatan' => $dataTempatTidurRuangNonPerawatan,
                'unreadNotifications' => $unreadNotifications,
                'readNotifications' => $readNotifications
            ]);
        }

        elseif ($user->role_name === 'User')
        {
            $tampilanPerusahaan = CompanySettings::where('id',1)->first();

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
            
            return view('dashboard.Halaman-user',compact('tampilanPerusahaan', 'unreadNotifications', 'readNotifications'));
        }
    }

    public function bacaNotifikasi($id){
        if($id)
        {
            auth()->user()->notifications->where('id',$id)->markAsRead();
            Toastr::success('Notifikasi Telah Dibaca ✔','Success');
        }
        return back();
    }

    public function bacasemuaNotifikasi()
    {
        $user = auth()->user();
        $user->notifications->markAsRead();
        Toastr::success('Semua Notifikasi Telah Dibaca ✔','Success');
        return redirect()->back();
    }

    public function ulangtahun()
    {
        if (auth()->user())
        {
            $user = User::first();
            $notification = auth()->user()->notifications->where('data.user_id', $user->id)->first();
        
                if (!$notification) {
                    $notification = new UlangTahunNotification($user);
                    $notification->data['user_id'] = $user->id;
                    auth()->user()->notify($notification);
                }
        }
        return back();
    }

    public function masaberlakuSIP()
    {
        if (auth()->user())
        {
            $user = User::first();
            $notification = auth()->user()->notifications->where('data.user_id', $user->id)->first();
        
                if (!$notification) {
                    $notification = new MasaBerlakuSIPNotification($user);
                    $notification->data['user_id'] = $user->id;
                    auth()->user()->notify($notification);
                }
        }
        return back();
    }

    public function masaberlakuSPKDokter()
    {
        if (auth()->user())
        {
            $user = User::first();
            $notification = auth()->user()->notifications->where('data.user_id', $user->id)->first();
        
                if (!$notification) {
                    $notification = new MasaBerlakuSPKDokterNotification($user);
                    $notification->data['user_id'] = $user->id;
                    auth()->user()->notify($notification);
                }
        }
        return back();
    }

    public function masaberlakuSPKPerawat()
    {
        if (auth()->user())
        {
            $user = User::first();
            $notification = auth()->user()->notifications->where('data.user_id', $user->id)->first();
        
                if (!$notification) {
                    $notification = new MasaBerlakuSPKPerawatNotification($user);
                    $notification->data['user_id'] = $user->id;
                    auth()->user()->notify($notification);
                }
        }
        return back();
    }

    public function masaberlakuSPKNakesLain()
    {
        if (auth()->user())
        {
            $user = User::first();
            $notification = auth()->user()->notifications->where('data.user_id', $user->id)->first();
        
                if (!$notification) {
                    $notification = new MasaBerlakuSPKNakesLainNotification($user);
                    $notification->data['user_id'] = $user->id;
                    auth()->user()->notify($notification);
                }
        }
        return back();
    }
}
