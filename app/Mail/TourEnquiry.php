<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TourEnquiry extends Mailable
{
    use Queueable, SerializesModels;

    public $enquiryData;

    public function __construct($enquiryData)
    {
        $this->enquiryData = $enquiryData;
    }

    public function build()
    {
        return $this->subject('New Tour Package Enquiry - ' . $this->enquiryData['tripName'])
                    ->view('emails.tour-enquiry');
    }
}