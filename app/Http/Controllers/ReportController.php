<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\TrainingAssignment;

class ReportController extends Controller
{
    public function trainingReport()
    {
        $report = User::where('role', 'employee')
        ->select('id', 'name')
        ->withCount([
            'trainingAssignments as assigned_count',
            'trainingAssignments as completed_count' => function ($q) {
                $q->where('status', 'completed');
            },
        ])
        ->get()
        ->map(function ($employee) {
            $employee->completion_rate = $employee->assigned_count > 0
                ? round(($employee->completed_count / $employee->assigned_count) * 100, 2)
                : 0;

            return $employee;
        });

        return view('report.trainings', compact('report'));
    }
}
