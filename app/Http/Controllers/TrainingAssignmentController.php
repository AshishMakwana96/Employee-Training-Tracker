<?php

// app/Http/Controllers/TrainingAssignmentController.php

namespace App\Http\Controllers;

use App\Models\Training;
use App\Models\User;
use App\Models\TrainingAssignment;
use Illuminate\Http\Request;

class TrainingAssignmentController extends Controller
{
    public function create()
    {
        $trainings = Training::all();
        $employees = User::where('role', 'employee')->get();
        return view('assignments.create', compact('trainings', 'employees'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'training_id' => 'required|exists:trainings,id',
            'employee_ids' => 'required|array',
            'employee_ids.*' => 'exists:users,id',
        ]);

        foreach ($request->employee_ids as $employeeId) {
            // Avoid duplicate
            TrainingAssignment::firstOrCreate(
                ['training_id' => $request->training_id, 'employee_id' => $employeeId],
                ['status' => 'assigned', 'assigned_at' => now()]
            );
        }

        return redirect()->route('assignments.index')->with('success', 'Training assigned successfully.');
    }

    // Optional: show all assignments
    public function index()
    {
        $assignments = TrainingAssignment::with('training', 'employee')->paginate(10);
        return view('assignments.index', compact('assignments'));
    }

    // Optional: employee marks as completed
    public function complete(TrainingAssignment $assignment)
    {
        $assignment->update([
            'status' => 'completed',
            'completed_at' => now()
        ]);

        return back()->with('success', 'Training marked as completed.');
    }
}

