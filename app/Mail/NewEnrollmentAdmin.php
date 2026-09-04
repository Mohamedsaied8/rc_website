<?php

namespace App\Mail;

use App\Models\Enrollment;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewEnrollmentAdmin extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Enrollment $enrollment)
    {
    }

    public function build()
    {
        return $this->subject('New enrollment: ' . $this->enrollment->first_name . ' ' . $this->enrollment->last_name)
            ->view('emails.new-enrollment-admin');
    }
}
