<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Training') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow sm:rounded-lg p-6">
                <form action="{{ route('trainings.update', $training) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-1">Title</label>
                        <input type="text" name="title" value="{{ $training->title }}"
                            class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-blue-200" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-1">Description</label>
                        <textarea name="description"
                            class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-blue-200"
                            rows="4">{{ $training->description }}</textarea>
                    </div>

                    <div class="mb-6">
                        <label class="block text-gray-700 font-medium mb-1">Due Date</label>
                        <input type="date" name="due_date" class="form-input" value="{{ \Carbon\Carbon::parse($training->due_date)->format('Y-m-d') }}" required>
                    </div>

                    <div class="flex items-center gap-3">
                        <button type="submit"
                            class="px-3 py-1 bg-green-600 text-white rounded hover:bg-green-700 text-sm font-semibold" style="background: blue;">
                            Update
                        </button>
                        <a href="{{ route('trainings.index') }}"
                            class="btn px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700 text-sm font-semibold">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
