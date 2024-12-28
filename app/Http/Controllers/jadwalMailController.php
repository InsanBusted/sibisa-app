<?php

namespace App\Http\Controllers;

use App\Mail\JadwalMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class jadwalMailController extends Controller
{
    public function index(){
        $mailData = [
            'title' => 'Mail From SIBISA APP',
            'body' => 'testing aja',
        ];

        Mail::to('insanbusted@gmail.com')->send(new JadwalMail($mailData));

        dd('email berhasil dikirim');
    }
}
