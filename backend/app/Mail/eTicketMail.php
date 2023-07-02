<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Queue\ShouldQueue;

class eTicketMail extends Mailable
{
    use Queueable, SerializesModels;
     public $data;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Eticket Receipt',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    // public function content()
    // {
    //     return new Content(
    //         view: 'mail.eTicketTest',
    //     );
    // }
     public function build()
    {
        
         $logoPath = 'images/logo_transparent_blue.png';
        $logoContent = Storage::disk('public')->get($logoPath);

        return $this->view('mail.eTicketTest')
            ->subject('Eticket Receipt')
            ->attachData($logoContent, 'logo.png', ['mime' => 'image/png']);
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
