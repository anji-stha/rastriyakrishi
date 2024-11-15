<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Queue\SerializesModels;

class FeedbackResponse extends Mailable
{
    use Queueable, SerializesModels;

    public $statusMessage;
    public $registrationNumber;

    /**
     * Create a new message instance.
     */
    public function __construct($status, $registredNumber)
    {
        $this->statusMessage = $status === 'approved'
            ? 'Your Form has been Approved'
            : 'Your Form has been Disapproved';

        $this->registrationNumber = $registredNumber;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('noreply@rastriyakrishi.com.np', 'Rastriya Krishi'),
            subject: 'Form Response',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.feedback_response',
            with: [
                'statusMessage' => $this->statusMessage,
                'registrationNumber' => $this->registrationNumber,
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
