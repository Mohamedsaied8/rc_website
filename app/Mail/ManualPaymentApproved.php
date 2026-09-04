<?php

namespace App\Mail;

use App\Models\ManualPayment;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ManualPaymentApproved extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public ManualPayment $manualPayment)
    {
    }

    public function build()
    {
        return $this->subject('Payment confirmed — Robotics Corner')
            ->view('emails.manual-payment-approved');
    }
}
