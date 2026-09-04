<?php

namespace App\Mail;

use App\Models\ManualPayment;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ManualPaymentRejected extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public ManualPayment $manualPayment)
    {
    }

    public function build()
    {
        return $this->subject('Action needed: payment could not be verified — Robotics Corner')
            ->view('emails.manual-payment-rejected');
    }
}
