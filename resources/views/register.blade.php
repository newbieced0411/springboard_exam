@if (Route::currentRouteName() == 'register')
@extends('app')

@section('title', 'Register')

@section('content')
<div class="flex items-center justify-center h-screen">
    <form id="register" class="w-[400px] p-4 text-left border shadow rounded bg-white">
        @csrf
        <div class="text-3xl font-semibold text-center">Register</div>
        <div id="result" class="text-center text-green-500"></div>
        <div id="errors" class="text-center text-red-500"></div>
        <div class="mt-4">
            <div>
                <input type="text" placeholder="Name" name="name" id="name" class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600">
            </div>
            <div class="mt-4">
                <input type="text" placeholder="Email" name="email" id="email" class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600">
            </div>
            <div class="mt-4">
                <input type="password" placeholder="Password" name="password" id="password" class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600">
            </div>
            <div class="mt-4">
                <input type="password" placeholder="Confirm Password" name="password_confirmation" id="c_password" class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600">
            </div>
            <div class="flex items-baseline justify-between">
                <button class="px-6 py-2 mt-4 text-white bg-blue-600 rounded-lg hover:bg-blue-900">Register</button>
                <a href="/login" class="text-sm text-blue-600 hover:underline">Login Here</a>
            </div>
        </div>
    </form>
</div>
@endsection
@endif