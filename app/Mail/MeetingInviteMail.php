<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MeetingInviteMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $get_user_email;
    public $sms;
    public $get_user_name;
    public $subject;
    public $get_meet_url;
    public $get_start_time;
    public $get_end_time;
    public function __construct($get_user_email, $sms, $get_user_name, $subject, $get_meet_url, $get_start_time, $get_end_time)
    {
        $this->get_user_email = $get_user_email;
        $this->subject = $subject;
        $this->sms = $sms;
        $this->get_user_name = $get_user_name;
        $this->get_meet_url = $get_meet_url;

        $this->get_start_time = $get_start_time;
        $this->get_end_time = $get_end_time;
    }


    public function build()
    {
        $sms = $this->sms;

        return $this->view('emails.managers.meets.invitation')
        ->subject($this->subject)
                    ->with([
                        'sms' => $sms,
                    ]);
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->subject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.managers.meets.invitation',
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
