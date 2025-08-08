<x-app-layout>
    <x-slot name="header">
        <h2>Edit Employee</h2>
    </x-slot>

    <form action="{{ route('employees.update', $employee->id) }}" method="POST" class="max-w-xl mx-auto">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label>Name</label>
            <input type="text" name="name" value="{{ old('name', $employee->name) }}" class="form-input w-full" required>
        </div>

        <div class="mb-4">
            <label>Email</label>
            <input type="email" name="email" value="{{ old('email', $employee->email) }}" class="form-input w-full" required>
        </div>

        <div class="mb-4">
            <label>Department</label>
            <input type="text" name="department" value="{{ old('department', $employee->department) }}" class="form-input w-full" required>
        </div>

        <div class="mb-4">
            <label>Status</label>
            <select name="status" class="form-select w-full">
                <option value="active" {{ old('status', $employee->status) === 'active' ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ old('status', $employee->status) === 'inactive' ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>

        <div class="mt-4">
            <button class="px-3 py-1 bg-green-600 text-white rounded hover:bg-green-700 text-sm font-semibold" style="background: blue;">Update</button>
            <a href="{{ route('employees.index') }}" class="btn px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700 text-sm font-semibold">Cancel</a>
        </div>
    </form>
</x-app-layout>
