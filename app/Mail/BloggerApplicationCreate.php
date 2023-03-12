<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BloggerApplicationCreate extends Mailable
{
    use Queueable, SerializesModels;
    public $message; // define the property


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($message)
    {
        $this->message = $message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.blogger.create',[
            'message' => $this->message,
        ])->subject('Applying to VirtualBD');
    }
}
