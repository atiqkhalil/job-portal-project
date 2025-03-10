<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class welcomeemail extends Mailable
{
    use Queueable, SerializesModels;

    public $jobTitle;
    public $employerName;
    public $employerEmail;
    public $employerMobile;

    /**
     * Create a new message instance.
     */
    public function __construct($jobTitle,$employerName,$employerEmail,$employerMobile)
    {
        $this->jobTitle = $jobTitle;
        $this->employerEmail = $employerEmail;
        $this->employerName = $employerName;
        $this->employerMobile = $employerMobile;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Job Notification',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.jobnotification',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
