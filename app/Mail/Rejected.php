<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Rejected extends Mailable
{
    use Queueable, SerializesModels;

    public array $data;

    public function __construct(array $data) {
        $this->data = $data;
    }

    public function build(): Rejected {
        return $this->subject('Request Rejected')
            ->view('emails.reject')
            ->with('data', $this->data);
    }
}
