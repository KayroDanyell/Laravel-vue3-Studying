<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Despesa;

class newDespesa extends Mailable
{
    use Queueable, SerializesModels;
    public $user;
    public $despesa;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user,Despesa $despesa)
    {
        $this->user = $user;
        $this->despesa = $despesa;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            from: new Address('jeffrey@example.com', 'Jeffrey Way'),
            subject: 'New Despesa',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: 'emails.newDespesa',
            with:['user'=>$this->user,'despesa'=>$this->despesa]
        );
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
