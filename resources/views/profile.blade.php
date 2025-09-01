@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto py-10">
    <h1 class="text-3xl font-bold mb-6">Profile</h1>
    <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
        <div class="mb-4">
            <label class="block text-gray-700 dark:text-gray-200 font-bold mb-2">Name:</label>
            <div>{{ $user->name }}</div>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 dark:text-gray-200 font-bold mb-2">Email:</label>
            <div>{{ $user->email }}</div>
        </div>
        <!-- Add more profile fields here if needed -->
    </div>
</div>
@endsection
