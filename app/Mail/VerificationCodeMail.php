<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;

class VerificationCodeMail extends Mailable
{
    use Queueable, SerializesModels;

    public $name,$code;

    public function __construct($name,$code)
    {
        $this->name=$name;
        $this->code = $code;
    }
    public function content(): Content
    {
        return new Content(
            view: 'verification-code',
            with:(['name' => $this->name, 'code' => $this->code]),
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
