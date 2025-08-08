<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            👥 Employees
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Success Message --}}
            @if(session('success'))
                <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-800 rounded">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Filters --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <form method="GET" action="{{ route('employees.index') }}" class="flex flex-wrap gap-3 items-center">
                        <input
                            type="text"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Search by name or email"
                            class="w-full sm:w-1/3 px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400"
                        >
                        <select
                            name="status"
                            class="w-full sm:w-1/4 px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400"
                        >
                            <option value="">All Statuses</option>
                            <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                        <button
                            type="submit"
                            class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 font-semibold flex items-center gap-1"
                        >
                            <span>🔍</span> Filter
                        </button>
                        <a
                            href="{{ route('employees.index') }}"
                            class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 font-semibold flex items-center gap-1"
                        >
                            <span>🔄</span> Reset
                        </a>
                    </form>
                </div>
            </div>

            {{-- Add Button --}}
            <div class="mb-4">
                <a
                    href="{{ route('employees.create') }}"
                    class="inline-block px-5 py-2 bg-purple-600 rounded-md hover:bg-purple-700 transition font-semibold flex items-center gap-1"
                >
                    <span class="text-lg">➕</span> Add Employee
                </a>
            </div>

            {{-- Employee Table --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 overflow-x-auto">
                    <table class="table-auto w-full border border-gray-200" style="text-align: center;">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-6 py-3 font-semibold text-gray-700">Name</th>
                                <th class="px-6 py-3 font-semibold text-gray-700">Email</th>
                                <th class="px-6 py-3 font-semibold text-gray-700">Department</th>
                                <th class="px-6 py-3 font-semibold text-gray-700">Status</th>
                                <th class="px-6 py-3 font-semibold text-gray-700">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse ($employees as $employee)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-3">{{ $employee->name }}</td>
                                    <td class="px-6 py-3">{{ $employee->email }}</td>
                                    <td class="px-6 py-3">{{ $employee->department }}</td>
                                    <td class="px-6 py-3">
                                        <span class="inline-block px-3 py-1 rounded-full text-xs font-medium
                                            {{ $employee->status === 'active' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                            {{ ucfirst($employee->status) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 flex gap-2 flex-wrap">
                                        <a
                                            href="{{ route('employees.edit', $employee) }}"
                                            class="px-3 py-1 bg-yellow-500 rounded hover:bg-yellow-600 text-sm font-semibold"
                                        >
                                            ✏️ Edit
                                        </a>
                                        <form
                                            action="{{ route('employees.destroy', $employee) }}"
                                            method="POST"
                                            onsubmit="return confirm('Are you sure to delete?');"
                                        >
                                            @csrf
                                            @method('DELETE')
                                            <button
                                                type="submit"
                                                class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700 text-sm font-semibold"
                                            >
                                                🗑️ Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-4 text-center text-gray-500">No employees found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    {{-- Pagination --}}
                    <div class="mt-6">
                        {{ $employees->withQueryString()->links() }}
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
