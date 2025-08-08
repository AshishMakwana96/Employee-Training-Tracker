<x-app-layout>
    <x-slot name="header">
        <h2>Add New Employee</h2>
    </x-slot>

    <form action="{{ route('employees.store') }}" method="POST" class="max-w-xl mx-auto">
        @csrf

        <div class="mb-4">
            <label>Name</label>
            <input type="text" name="name" class="form-input w-full" required>
        </div>

        <div class="mb-4">
            <label>Email</label>
            <input type="email" name="email" class="form-input w-full" required>
        </div>

        <div class="mb-4">
            <label>Department</label>
            <input type="text" name="department" class="form-input w-full" required>
        </div>

        <div class="mb-4">
            <label>Status</label>
            <select name="status" class="form-select w-full">
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
            </select>
        </div>

        <div class="mt-4">
            <button class="px-3 py-1 bg-green-600 text-white rounded hover:bg-green-700 text-sm font-semibold" style="background: blue;">Save</button>
            <a href="{{ route('employees.index') }}" class="btn px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700 text-sm font-semibold">Cancel</a>
        </div>
    </form>
</x-app-layout>
