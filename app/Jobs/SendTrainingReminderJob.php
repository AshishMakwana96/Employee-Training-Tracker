<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\TrainingReminderMail;
use Illuminate\Support\Facades\Mail;

class SendTrainingReminderJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $training;
    public $employee;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($training, $employee)
    {
        $this->training = $training;
        $this->employee = $employee;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->employee->email)->send(new TrainingReminderMail($this->training, $this->employee));
    }
}
