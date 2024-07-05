<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TaskNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */

    public $get_user_name;
    public $token;
    public $task_name;
    public $start_time;
    public $end_time;
    public $priority;
    public $content;

    public function __construct($get_user_name, $token, $task_name, $start_time, $end_time, $priority, $content)
    {
        $this->get_user_name = $get_user_name;
        $this->token = $token;
        $this->task_name = $task_name;
        $this->start_time = $start_time;
        $this->end_time = $end_time;

        $this->priority = $priority;
        $this->content = $content;
    }

    /**
     * Get the message envelope.
     */
    public function build()
    {
        $content = $this->content;

        return $this->view('emails.managers.meets.invitation')
        ->subject($this->subject)
                    ->with([
                        'content' => $content,
                    ]);
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: "Une nouvelle tâche vous a été assigné : ". $this->task_name,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.managers.tasks.invitation',
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
