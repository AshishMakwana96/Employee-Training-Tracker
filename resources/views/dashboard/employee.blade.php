<x-app-layout>
    <x-slot name="header">
        <h2>Employee Dashboard</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <p>Welcome, {{ auth()->user()->name }} (Employee)</p>
        </div>
    </div>
</x-app-layout>
