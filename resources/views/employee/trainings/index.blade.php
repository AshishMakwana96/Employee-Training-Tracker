<x-app-layout>
    <x-slot name="header">
        <h2>My Trainings</h2>
    </x-slot>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <table class="table-auto w-full border">
        <thead>
            <tr>
                <th>Title</th>
                <th>Due Date</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($trainings as $training)
                <tr>
                    <td>{{ $training->title }}</td>
                    <td>{{ $training->due_date }}</td>
                    <td>{{ $training->pivot->is_completed ? 'Completed' : 'Pending' }}</td>
                    <td>
                        @if(!$training->pivot->is_completed)
                            <form action="{{ route('employee.trainings.complete', $training->id) }}" method="POST">
                                @csrf
                                <button class="btn btn-sm btn-success" type="submit">Mark Complete</button>
                            </form>
                        @else
                            <button class="btn btn-sm btn-secondary" disabled>Completed</button>
                        @endif
                    </td>
                </tr>
            @empty
                <tr><td colspan="4">No trainings assigned.</td></tr>
            @endforelse
        </tbody>
    </table>
</x-app-layout>
