{{-- resources/views/assignments/employee.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2>My Trainings</h2>
    </x-slot>

    <div class="card p-4">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Training</th>
                    <th>Status</th>
                    <th>Due Date</th>
                    <th>Assigned At</th>
                    <th>Completed At</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($assignments as $assignment)
                    <tr>
                        <td>{{ $assignment->training->title }}</td>
                        <td>{{ ucfirst($assignment->status) }}</td>
                        <td>{{ $assignment->training->due_date }}</td>
                        <td>{{ $assignment->assigned_at?->format('d M Y') ?? '-' }}</td>
                        <td>{{ $assignment->completed_at?->format('d M Y') ?? '-' }}</td>
                        <td>
                            @if ($assignment->status !== 'completed')
                                <form action="{{ route('assignments.complete', $assignment) }}" method="POST" onsubmit="return confirm('Mark as complete?')">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-success">Mark Complete</button>
                                </form>
                            @else
                                <span class="badge bg-success">Completed</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6">No trainings assigned.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-app-layout>
