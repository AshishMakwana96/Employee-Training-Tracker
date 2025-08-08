<x-app-layout>
    <x-slot name="header">
        <h2>Assign Training: {{ $training->title }}</h2>
    </x-slot>

    <form method="POST" action="{{ route('trainings.assign.update', $training->id) }}">
        @csrf

        <div class="mb-4">
            <label>Select Employees:</label>
            <div class="grid grid-cols-2 gap-2 mt-2">
                @foreach($employees as $employee)
                    <label class="flex items-center space-x-2">
                        <input type="checkbox" name="employees[]" value="{{ $employee->id }}"
                               {{ in_array($employee->id, $assigned) ? 'checked' : '' }}>
                        <span>{{ $employee->name }} ({{ $employee->email }})</span>
                    </label>
                @endforeach
            </div>
        </div>

        <div class="mt-4">
            <button class="btn btn-primary" type="submit">Update Assignments</button>
            <a href="{{ route('trainings.index') }}" class="btn btn-secondary">Back</a>
        </div>
    </form>
</x-app-layout>
