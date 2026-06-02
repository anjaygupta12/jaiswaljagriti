<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    public string $senderName;
    public string $senderEmail;
    public string $subject;
    public string $messageBody;

    public function __construct(string $senderName, string $senderEmail, string $subject, string $messageBody)
    {
        $this->senderName  = $senderName;
        $this->senderEmail = $senderEmail;
        $this->subject     = $subject;
        $this->messageBody = $messageBody;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Contact Form: ' . $this->subject,
            replyTo: [$this->senderEmail],
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.contact',
        );
    }
}
