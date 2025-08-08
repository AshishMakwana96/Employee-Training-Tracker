<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TrainingAssignment;
use Carbon\Carbon;

class EmployeeTrainingController extends Controller
{
    public function dashboard()
    {
        $userId = auth()->id();

        $pending = TrainingAssignment::with('training')
            ->where('employee_id', $userId)
            ->where('status', '!=', 'completed')
            ->get();

        $completed = TrainingAssignment::with('training')
            ->where('employee_id', $userId)
            ->where('status', 'completed')
            ->get();

        return view('employee.dashboard', compact('pending', 'completed'));
    }

    public function show($id)
    {
        $assignment = TrainingAssignment::with('training')
            ->where('id', $id)
            ->where('employee_id', auth()->id())
            ->firstOrFail();

        return view('employee.show', compact('assignment'));
    }

    public function markComplete($id)
    {
        $assignment = TrainingAssignment::where('id', $id)
            ->where('employee_id', auth()->id())
            ->firstOrFail();

        if ($assignment->status !== 'completed') {
            $assignment->status = 'completed';
            $assignment->completed_at = Carbon::now();
            $assignment->save();
        }

        return redirect()->route('employee.dashboard')->with('success', 'Training marked as completed.');
    }
}
