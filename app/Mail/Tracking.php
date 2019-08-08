<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Tracking extends Mailable
{
    use Queueable, SerializesModels;

    public $meta;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($meta)
    {
        $this->meta = $meta;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.tracking')
            ->subject('testingggggg email');
    }
}
