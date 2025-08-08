<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">Training Completion Report</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded p-6">
                <div class="overflow-x-auto">
                    <table class="table-auto w-full border border-gray-200">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-2 border text-left">Employee</th>
                                <th class="px-4 py-2 border text-left">Assigned</th>
                                <th class="px-4 py-2 border text-left">Completed</th>
                                <th class="px-4 py-2 border text-left">Completion Rate</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($report as $employee)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-2 border">{{ $employee->name }}</td>
                                    <td class="px-4 py-2 border">{{ $employee->assigned_count }}</td>
                                    <td class="px-4 py-2 border">{{ $employee->completed_count }}</td>
                                    <td class="px-4 py-2 border">
                                        {{ $employee->completion_rate }}%
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-4 py-2 text-center border">No data available.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
