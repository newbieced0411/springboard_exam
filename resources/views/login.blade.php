@if (Route::currentRouteName() == 'login')

@extends('app')
@section('title', 'Login')

@section('content')
    <div class="flex items-center justify-center h-screen">
        <form id="login" class="w-[400px] p-4 text-left border shadow rounded bg-white">
            @csrf
            <div class="mb-2 text-3xl font-semibold text-center">Login</div>
            <div id="errors" class="text-center text-red-500"></div>
            <div class="mt-4">
                <div>
                    <input type="text" placeholder="Email" id="email" class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600">
                </div>
                <div class="mt-4">
                    <input type="password" placeholder="Password" id="password" class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600">
                </div>
                <div class="flex items-baseline justify-between">
                    <button class="px-6 py-2 mt-4 text-white bg-blue-600 rounded-lg transition duration-300 ease-in-out hover:bg-blue-900">Login</button>
                    <a href="/register" class="text-sm text-blue-600 hover:underline">Create Here</a>
                </div>
            </div>
        </form>
    </div>
@endsection

@endif
