<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">All Training Assignments</h2>
    </x-slot>

    <div class="mb-4 flex justify-end">
        <a href="{{ route('assignments.create') }}" 
           class="px-4 py-2 bg-blue-600 rounded hover:bg-blue-700 text-sm font-medium">
            + Add Assignment
        </a>
    </div>

    <div class="bg-white shadow rounded p-6">
        @if (session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto">
            <table class="table-auto w-full border border-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 border text-left">Training</th>
                        <th class="px-4 py-2 border text-left">Employee</th>
                        <th class="px-4 py-2 border text-left">Status</th>
                        <th class="px-4 py-2 border text-left">Assigned At</th>
                        <th class="px-4 py-2 border text-left">Completed At</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($assignments as $assignment)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2 border">{{ $assignment->training->title }}</td>
                            <td class="px-4 py-2 border">{{ $assignment->employee->name }} ({{ $assignment->employee->email }})</td>
                            <td class="px-4 py-2 border capitalize">{{ $assignment->status }}</td>
                            <td class="px-4 py-2 border">
                                {{ $assignment->assigned_at?->format('d M Y') ?? '-' }}
                            </td>
                            <td class="px-4 py-2 border">
                                {{ $assignment->completed_at?->format('d M Y') ?? '-' }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-2 text-center border">No assignments found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $assignments->links() }}
        </div>
    </div>
</x-app-layout>
