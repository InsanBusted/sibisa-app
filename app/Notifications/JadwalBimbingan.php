<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class JadwalBimbingan extends Notification
{
    use Queueable;

    public $tanggal;
    public $jam;
    public $status;

    /**
     * Create a new notification instance.
     */
    public function __construct($tanggal, $jam, $status)
    {
        $this->tanggal = $tanggal;
        $this->jam = $jam;
        $this->status = $status;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Notifikasi Jadwal Bimbingan')
            ->line("Jadwal bimbingan telah dijadwalkan.")
            ->line("Tanggal: {$this->tanggal}")
            ->line("Jam: {$this->jam}")
            ->line("Status: {$this->status}")
            ->action('Lihat Jadwal', url('/'))
            ->line('Terima kasih atas perhatiannya.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
