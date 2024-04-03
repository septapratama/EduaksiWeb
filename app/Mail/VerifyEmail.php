<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class VerifyEmail extends Mailable
{
    use Queueable, SerializesModels;
    protected $data = [];
    public function __construct($data)
    {
        $this->data = $data; 
    }
    public function build(){
        // return $this->from(env('MAIL_FROM_ADDRESS','eduaksi@gmail.com'),env('APP_NAME','EduAksi'))->subject($this->data['subject'])->view('emails.forgotPassForm')->with('token',$this->data);
        // return $this->view('email.forgotPassForm');
        return $this->view('email.verifyEmail')
        ->with(['email' => $this->data['email'],'code'=>$this->data['code'],'link'=>$this->data['link']])
        ->from(env('MAIL_FROM_ADDRESS', 'eduaksi@gmail.com'), env('APP_NAME', 'EduAksi'));
    }
}