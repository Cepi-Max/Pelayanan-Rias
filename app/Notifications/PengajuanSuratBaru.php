<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class PengajuanSuratBaru extends Notification
{
    public $pengajuan;

    public function __construct($pengajuan)
    {
        $this->pengajuan = $pengajuan;
    }

    public function via($notifiable)
    {
        return ['mail', 'database']; 
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Pengajuan Surat Baru')
            ->greeting('Halo Operator Desa Rias!')
            ->line('Ada pengajuan surat baru dari user: ' . $this->pengajuan->user->name)
            ->action('Lihat Pengajuan', url('/antrian-pengajuan-surat/' . $this->pengajuan->id))
            ->line('Segera proses pengajuan tersebut.');
    }

    public function toArray($notifiable)
    {
        return [
            'pengajuan_id' => $this->pengajuan->id,
            'user' => $this->pengajuan->user->name,
            'jenis_surat' => $this->pengajuan->jenisSurat->nama,
        ];
    }
}
