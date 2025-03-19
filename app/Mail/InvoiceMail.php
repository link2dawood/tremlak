<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class InvoiceMail extends Mailable
{
    use Queueable, SerializesModels;
    public $user;
    public $package;
    public $transaction;
    public $emailSettings;
    public $items;
    public $tax;
    public $total;
    /**
     * Create a new message instance.
     */
    public function __construct($user, $package, $emailSettings, $items, $tax, $total)
    {
        $this->user = $user;
        $this->package = $package;
        $this->emailSettings = $emailSettings;
        $this->items = $items;
        $this->tax = $tax;
        $this->total = $total;
    }

    public function build()
    {
        return $this->from($this->emailSettings->email, 'Tremlak360')
            ->subject('Your Invoice for Credit Purchase')
            ->view('emails.invoice')
            ->with([
                'user' => $this->user,
                'package' => $this->package,
                'emailSettings' => $this->emailSettings,
                'items' => $this->items,
                'tax' => $this->tax,
                'total' => $this->total,
            ]);
    }
    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Invoice Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.invoice',
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
