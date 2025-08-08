<?php

namespace App\Http\Controllers;

use App\Models\Training;
use App\Models\User;
use Illuminate\Http\Request;

class AdminTrainingAssignmentController extends Controller
{
    public function edit(Training $training)
    {
        $employees = User::where('role', 'employee')->get();
        $assigned = $training->employees()->pluck('users.id')->toArray();

        return view('admin.trainings.assign', compact('training', 'employees', 'assigned'));
    }

    public function update(Request $request, Training $training)
    {
        $employeeIds = $request->input('employees', []);

        // Update assignments
        $training->employees()->sync($employeeIds);

        return redirect()->route('trainings.index')->with('success', 'Training assigned to employees.');
    }
}
