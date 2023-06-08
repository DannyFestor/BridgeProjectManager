<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ProjectUserInviteMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public function __construct(private ?User $user)
    {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Project User Invite',
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.project-user-invite',
            with: [
                'email' => $this->to[0]['address'],
                'name' => $this->user?->name,
            ]
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
