<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\User;
use DB;

class UlangTahunNotification extends Notification
{
    use Queueable;
    public $user;

    /**
     * Create a new notification instance.
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        $result_pribadi = DB::table('profil_pegawai')->find($notifiable->id);
        $result_user = User::find($notifiable->id);

        $result_tanggal_lahir = new \DateTime($result_pribadi->tanggal_lahir);
        $hari_ini = new \DateTime();
        $result_usia = $result_tanggal_lahir->diff($hari_ini)->y;

        return [
            'name' => $result_user->name,
            'avatar' => $result_user->avatar,
            'tanggal_lahir' => $result_pribadi->tanggal_lahir,
            'tempat_lahir' => $result_pribadi->tempat_lahir,
            'message' => $result_pribadi->tempat_lahir,
            'message2' => $result_pribadi->tanggal_lahir,
            'message3' => 'Selamat Ulang Tahun',
            'message4' => 'Pegawai pada',
            'message5' => 'RUMAH SAKIT UMUM DAERAH CARUBAN',
            'message6' => 'Kabupaten Madiun.',
            'message7' => 'Atas Nama Pemerintah Kabupaten Madiun Mengucapkan Selamat Ulang Tahun Yang ke-',
            'message8' => ''.$result_usia.'',
            'message9' => 'Semoga Senantiasa Selalu Diberikan Kesehatan dan Kelancaran.'
        ];
    }
}