<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactMessage extends Mailable
{
  use Queueable, SerializesModels;

  public $contactName;
  public $contactEmail;
  public $contactMessage;

  /**
   * Create a new message instance.
   */
  public function __construct($name, $email, $message)
  {
    $this->contactName = $name;
    $this->contactEmail = $email;
    $this->contactMessage = $message;
  }

  /**
   * Get the message envelope.
   */
  public function envelope(): Envelope
  {
    return new Envelope(
      subject: "Nova mensagem de contato de {$this->contactName}",
      from: $this->contactEmail,
    );
  }

  /**
   * Get the message content definition.
   */
  public function content(): Content
  {
    return new Content(
      view: 'emails.contact',
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
