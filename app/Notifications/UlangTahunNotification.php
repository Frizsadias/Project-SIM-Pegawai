<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\User;
use App\Models\ProfileInformation;

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
        $profileInformation = ProfileInformation::find($notifiable->id);

        // Menghitung usia berdasarkan tanggal lahir
        $tglLahir = new \DateTime($profileInformation->tgl_lahir);
        $today = new \DateTime();
        $usia = $tglLahir->diff($today)->y;

        return [
            'user_id' => $profileInformation->id,
            'name' => $profileInformation->name,
            'tgl_lahir' => $profileInformation->tgl_lahir,
            'tmpt_lahir' => $profileInformation->tmpt_lahir,
            'message' => $profileInformation->tmpt_lahir,
            'message2' => $profileInformation->tgl_lahir,
            'message3' => 'Selamat Ulang Tahun',
            'message4' => 'Pegawai pada',
            'message5' => 'RUMAH SAKIT UMUM DAERAH',
            'message6' => 'Kota Caruban.',
            'message7' => 'Atas Nama Pemerintah Kota Caruban Mengucapkan Selamat Ulang Tahun Yang ke-',
            'message8' => ''.$usia.'',
            'message9' => 'Semoga Senantiasa Selalu Diberikan Kesehatan dan Kelancaran.',
            'avatar' => $profileInformation->avatar
        ];
    }
}
