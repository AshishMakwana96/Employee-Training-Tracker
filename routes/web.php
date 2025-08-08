<?php

use App\Http\Controllers\TrainingAssignmentController;
use App\Http\Controllers\EmployeeTrainingController;
use App\Http\Controllers\TrainingController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        if (auth()->user()->role === 'admin') {
            return view('dashboard.admin');
        }
        return view('dashboard.employee');
    })->name('dashboard');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('employees', EmployeeController::class);
    Route::resource('trainings', TrainingController::class);
    Route::get('trainings/{training}/assign', [AdminTrainingAssignmentController::class, 'edit'])->name('trainings.assign');
    Route::post('trainings/{training}/assign', [AdminTrainingAssignmentController::class, 'update'])->name('trainings.assign.update');
    Route::get('/assignments/create', [TrainingAssignmentController::class, 'create'])->name('assignments.create');
    Route::post('/assignments', [TrainingAssignmentController::class, 'store'])->name('assignments.store');
    Route::get('/assignments', [TrainingAssignmentController::class, 'index'])->name('assignments.index');
    Route::get('/report/trainings', [ReportController::class, 'trainingReport'])->name('report.trainings');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/employee/trainings', [EmployeeTrainingController::class, 'index'])->name('employee.trainings.index');
    Route::post('/employee/trainings/{id}/complete', [EmployeeTrainingController::class, 'complete'])->name('employee.trainings.complete');
    Route::post('/assignments/{assignment}/complete', [TrainingAssignmentController::class, 'complete'])->name('assignments.complete');
    Route::get('/employee/dashboard', [EmployeeTrainingController::class, 'dashboard'])->name('employee.dashboard');
    Route::get('/employee/training/{id}', [EmployeeTrainingController::class, 'show'])->name('employee.training.show');
    Route::post('/employee/training/{id}/complete', [EmployeeTrainingController::class, 'markComplete'])->name('employee.training.complete');
});

Route::get('/my-trainings', function () {
    $assignments = \App\Models\TrainingAssignment::with('training')
        ->where('employee_id', auth()->id())
        ->get();

    return view('assignments.employee', compact('assignments'));
})->middleware('auth')->name('employee.trainings');
require __DIR__.'/auth.php';
