<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">Employee Dashboard</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded p-6 max-w-4xl mx-auto">
                @if (session('success'))
                    <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Pending Trainings -->
                <div class="mb-6">
                    <h3 class="text-lg font-semibold mb-3">📌 Pending Trainings</h3>
                    @forelse($pending as $item)
                        <div class="flex justify-between items-center border border-gray-200 rounded p-3 mb-2">
                            <span>{{ $item->training->title }}</span>
                            <a href="{{ route('employee.training.show', $item->id) }}" class="text-sm text-blue-600 hover:underline">
                                View
                            </a>
                        </div>
                    @empty
                        <p class="text-gray-600">No pending trainings.</p>
                    @endforelse
                </div>

                <!-- Completed Trainings -->
                <div>
                    <h3 class="text-lg font-semibold mb-3">✅ Completed Trainings</h3>
                    @forelse($completed as $item)
                        <div class="border border-gray-200 rounded p-3 mb-2 text-sm text-gray-800">
                            {{ $item->training->title }}
                            <span class="text-gray-500">– Completed at {{ $item->completed_at?->format('d M Y') }}</span>
                        </div>
                    @empty
                        <p class="text-gray-600">No completed trainings.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
