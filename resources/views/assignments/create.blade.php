<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">Assign Training</h2>
    </x-slot>

    <div class="bg-white shadow rounded p-6 max-w-3xl mx-auto">
        @if (session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('assignments.store') }}">
            @csrf

            <!-- Training Selection -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Select Training</label>
                <select name="training_id" required class="w-full border border-gray-300 rounded px-3 py-2">
                    <option value="">-- Select Training --</option>
                    @foreach ($trainings as $training)
                        <option value="{{ $training->id }}">{{ $training->title }}</option>
                    @endforeach
                </select>
                @error('training_id')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Employees Selection -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Select Employees</label>
                <select name="employee_ids[]" multiple required class="w-full border border-gray-300 rounded px-3 py-2 h-40">
                    @foreach ($employees as $employee)
                        <option value="{{ $employee->id }}">{{ $employee->name }} ({{ $employee->email }})</option>
                    @endforeach
                </select>
                @error('employee_ids')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit -->
            <div class="flex justify-start gap-3 mt-6">
                <button type="submit" 
                    class="px-3 py-1 bg-green-600 text-white rounded hover:bg-green-700 text-sm font-semibold" style="background: blue;">
                    Assign
                </button>
                <a href="{{ route('assignments.index') }}" 
                    class="btn px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700 text-sm font-semibold">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</x-app-layout>
