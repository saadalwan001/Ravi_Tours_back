<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactInquiry extends Mailable
{
    use Queueable, SerializesModels;

    public $inquiryData;

    public function __construct($inquiryData)
    {
        $this->inquiryData = $inquiryData;
    }

    public function build()
    {
        return $this->subject('New Contact Inquiry - Embark Ceylon')
                    ->view('emails.contact-inquiry');
    }
}