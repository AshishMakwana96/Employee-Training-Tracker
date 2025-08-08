<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\TrainingAssignment;
use App\Jobs\SendTrainingReminderJob;
use Carbon\Carbon;

class SendTrainingReminders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reminders:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send training reminders for due trainings within 3 days';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $now = Carbon::now();
        $cutoff = $now->copy()->addDays(3);

        $assignments = TrainingAssignment::with(['employee', 'training'])
            ->where('status', 'assigned')
            ->whereHas('training', function ($query) use ($now, $cutoff) {
                $query->whereBetween('due_date', [$now, $cutoff]);
            })->get();

        foreach ($assignments as $assignment) {
            dispatch(new SendTrainingReminderJob($assignment->training, $assignment->employee));
        }

        $this->info("Reminder emails dispatched.");
    }
}
