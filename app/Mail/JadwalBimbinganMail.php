<?php
namespace App\Mail;

use App\Models\JadwalBimbingan;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;

class JadwalBimbinganMail extends Mailable
{
    use Queueable, SerializesModels;

    public $jadwal;
    public $dosenNama;
    public $mahasiswaNama;

    /**
     * Create a new message instance.
     *
     * @param  \App\Models\JadwalBimbingan  $jadwal
     * @return void
     */
    public function __construct(JadwalBimbingan $jadwal)
    {
        $this->jadwal = $jadwal;
        $this->dosenNama = $jadwal->dosen->nama; // Ambil nama dosen
        $this->mahasiswaNama = $jadwal->mahasiswa->nama; // Ambil nama mahasiswa
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Content
     */
    public function content()
    {
        return new Content(
            view: 'email.jadwal_bimbingan',  // Pastikan tampilan email sesuai
        );
    }
}
