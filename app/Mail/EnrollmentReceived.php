<?php

namespace App\Mail;

use App\Models\Enrollment;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EnrollmentReceived extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Enrollment $enrollment)
    {
    }

    public function build()
    {
        return $this->subject('We received your application — Robotics Corner')
            ->view('emails.enrollment-received');
    }
}
