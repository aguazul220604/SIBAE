<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ClienteRegistrado extends Mailable
{
    use Queueable, SerializesModels;

    public $nombre;
    public $contraseña;

    /**
     * Create a new message instance.
     */
    public function __construct($nombre, $contraseña)
    {
        $this->nombre = $nombre;
        $this->contraseña = $contraseña;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Usuario registrado',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.cliente_registrado',
            with: [
                'nombre' => $this->nombre,
                'contraseña' => $this->contraseña,
            ],
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
