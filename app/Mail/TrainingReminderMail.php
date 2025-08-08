<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TrainingReminderMail extends Mailable
{
    use Queueable, SerializesModels;

    public $training;
    public $employee;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($training, $employee)
    {
        $this->training = $training;
        $this->employee = $employee;
    }

    public function build()
    {
        return $this->subject('Training Reminder')
                    ->view('emails.training_reminder');
    }
}
