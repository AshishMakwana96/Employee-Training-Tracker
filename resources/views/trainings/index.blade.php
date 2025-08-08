<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Training List') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                
                {{-- Filter/Search --}}
                <div class="mb-4">
                    <form method="GET" action="{{ route('trainings.index') }}" class="flex flex-wrap gap-2 items-center">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search title..." class="border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 w-full sm:w-auto px-3 py-2">
                        
                        {{-- Overdue Filter --}}
                        <label class="inline-flex items-center text-sm text-gray-700">
                            <input type="checkbox" name="overdue" value="1" {{ request('overdue') == '1' ? 'checked' : '' }} class="mr-1">
                            Show only overdue
                        </label>

                        <button type="submit" class="px-3 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 text-sm font-semibold" style="background: aquamarine; color:black;">
                            Filter
                        </button>
                    </form>
                </div>

                {{-- Create Training Button --}}
                <div class="mb-4">
                    <a href="{{ route('trainings.create') }}" class="px-3 py-2 bg-green-600 rounded hover:bg-green-700 text-sm font-semibold">
                        + Create Training
                    </a>
                </div>

                {{-- Success Message --}}
                @if(session('success'))
                    <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                {{-- Trainings Table --}}
                <div class="overflow-x-auto">
                    <table class="table-auto w-full border border-gray-200">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="text-left px-4 py-2 font-semibold">Title</th>
                                <th class="text-left px-4 py-2 font-semibold">Due Date</th>
                                <th class="text-left px-4 py-2 font-semibold">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($trainings as $training)
                                <tr class="border-b">
                                    <td class="px-4 py-2">{{ $training->title }}</td>
                                    <td class="px-4 py-2">
                                        {{ $training->due_date }}
                                        @php
                                            $dueDate = \Carbon\Carbon::parse($training->due_date);
                                            $now = \Carbon\Carbon::now();
                                        @endphp

                                        @if ($dueDate->isPast() && !$dueDate->isToday())
                                            <span class="ml-2 inline-block text-xs px-2 py-1 bg-red-600 text-white rounded">Overdue</span>
                                        @elseif ($dueDate->isBetween($now, $now->copy()->addDays(3), true))
                                            <span class="ml-2 inline-block text-xs px-2 py-1 bg-red-500 text-white rounded" style="color: white; background: blue;">Upcoming</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-2 space-x-2">
                                        <a href="{{ route('trainings.edit', $training) }}" class="px-3 py-1 bg-blue-600  rounded hover:bg-blue-700 text-sm font-semibold">Edit</a>
                                        <!-- <a href="{{ route('trainings.assign', $training) }}" class="px-3 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600 text-sm font-semibold">Assign</a> -->
                                        <form action="{{ route('trainings.destroy', $training) }}" method="POST" class="inline-block" onsubmit="return confirm('Delete this training?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700 text-sm font-semibold">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="px-4 py-4 text-gray-600">No trainings found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                <div class="mt-4">
                    {{ $trainings->withQueryString()->links() }}
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
