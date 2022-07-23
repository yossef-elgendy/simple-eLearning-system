<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class QuestionMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $credentials;

    public function __construct($data)
    {
        $this->credentials = $data;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($address =$this->credentials['from'], $name= $this->credentials['name'])
            ->subject(' '.$this->credentials['subject'])
            ->markdown('emails.question-mail')->with([
            'from'=> $this->credentials['from'],
            'subject'=> $this->credentials['subject'],
            'body' => $this->credentials['body'],
        ]);
    }
}
