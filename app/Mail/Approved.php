<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Approved extends Mailable
{
    use Queueable, SerializesModels;

    public array $data;

    public function __construct(array $data) {
        $this->data = $data;
    }

    public function build(): Approved {
        return $this->subject('Request Approved')
            ->view('emails.approve')
            ->with('data', $this->data);
    }
}
