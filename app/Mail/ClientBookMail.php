<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ClientBookMail extends Mailable
{
    use Queueable, SerializesModels;
    public $book;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($details)
    {
        $this->book = $details;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $email_to = $this->book->client[0]->email === null ? 'support@islandtourphuket.com' : $this->book->client[0]->email;
        //dd($this->book);
        $message = request()->ip() === '127.0.0.1' ? '[test]' : '';
        $subject = $message." Client Booking detail";
        return $this->view('emails.book')
            ->subject($subject)
            ->to($email_to)
            ->bcc(['support@islandtourphuket.com','no-reply@islandtourphuket.com']);
    }
}
