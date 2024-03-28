<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Contracts\Queue\ShouldQueue;

class TestSendingEmail extends Mailable
{
    use Queueable, SerializesModels;

    // delkarasikan dulu
    public $user;

    /**
     * Create a new message instance.
     */
    public function __construct($user)
    {   
        // isi $user dengan user yang dikirim dari controller
        $this->user = $user;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            // pengirim email
            // from: new Address('admin123@example.com', 'Saya Reizki'),
            // // ini agar ngirim emailnya dapat di reply
            // replyTo: [
            //     new Address('bbb@example.com', 'Saya Reizki 2'),
            // ],
            // subject header dari emailnya
            subject: 'Test Sending Email',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            // view dari content di recources
            // untuk isi dari email
            view: 'emails.test-mail',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [
            // Attachment::fromPath('/path/to/file'),
                    // karena saya ingin mengirim data 
                    // yang ada di folder public maka ditambahkan
            Attachment::fromPath(public_path('docs/Proposal-5W+1H-Laravel.docx')),
        ];
    
    }
}
