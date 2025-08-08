<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">
            {{ $assignment->training->title }}
        </h2>
    </x-slot>
    
    <div class="max-w-3xl mx-auto bg-white p-6 shadow rounded-md">
        <div class="space-y-4 text-gray-700">
            <p><strong>Description:</strong> {{ $assignment->training->description }}</p>
            <p><strong>Due Date:</strong> {{ $assignment->training->due_date?->format('d M Y') ?? '-' }}</p>
            <p>
                <strong>Status:</strong>
                <span class="inline-block px-2 py-1 text-xs font-medium rounded 
                    {{ $assignment->status === 'completed' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                    {{ ucfirst($assignment->status) }}
                </span>
            </p>
        </div>

        @if ($assignment->status !== 'completed')
            <form method="POST" action="{{ route('employee.training.complete', $assignment->id) }}" class="mt-6">
                @csrf
                <button type="submit"
                        class="bg-green-600 hover:bg-green-700 text-white font-medium text-sm px-4 py-2 rounded"
                        onclick="return confirm('Mark this training as completed?')" style="color: black;background: darkturquoise;">
                    ✅ Mark as Completed
                </button>
            </form>
        @else
            <div class="mt-6 bg-green-100 text-green-800 px-4 py-3 rounded"  style="color: black;">
                ✅ You have already completed this training.
            </div>
        @endif
    </div>
</x-app-layout>
