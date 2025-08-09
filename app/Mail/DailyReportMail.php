<?php

namespace App\Mail;

use App\Models\Post;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class DailyReportMail extends Mailable
{
    use Queueable, SerializesModels;
    public $todayPosts;
    public $todayUsers;

    /**
     * Create a new message instance.
     */
    public function __construct($users, $posts)
    {
        $this->todayPosts = $posts;
        $this->todayUsers = $users;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Daily Report Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.daily-report',
            with: [
                'todayPosts' => $this->todayPosts,
                'todayUsers' => $this->todayUsers
            ]
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
