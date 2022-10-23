<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ResetPassword extends Mailable
{
    use Queueable, SerializesModels;

    private $code;
    public function __construct($code)
    {
        $this->code = $code;
    }
    public function envelope()
    {
        return new Envelope(
            subject: 'Reset Password',
        );
    }
    public function content()
    {
        return new Content(
            markdown: 'emails.auth.reset',
            with:['code'=>$this->code],
        );
    }
    public function attachments()
    {
        return [];
    }
}
