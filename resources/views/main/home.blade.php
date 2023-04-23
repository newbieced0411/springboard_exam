@if (Route::currentRouteName() == 'home')

@extends('app')
@section('title', 'Home')

@section('content')
    <div class="flex items-center justify-center h-screen">
        <div class="w-[800px] h-[700px] p-4 text-left bg-white border shadow rounded ">
            <div class="mb-6">
                <h1 class="font-bold text-3xl">Branches</h1>
                <div class="flex flex-row justify-between items-center">
                    <p class="text-sm">Click a specific branch to see tagged products.</p>
                    @if(auth()->user()->admin)
                    <div class="flex flex-row">
                        <input type="text" name="branch" id="inputBranch" placeholder="Branch name..." class="flex-1 px-2 border-2 border-l-lg outline-none">
                        <button id="addBranch" class="p-2 text-white bg-blue-600 rounded-r-lg transition duration-300 ease-in-out hover:bg-blue-900">Add</button>
                    </div>
                    @endif
                </div>
            </div>

            {{-- List of branches and products --}}
            <div class="flex flex-row space-x-8">
                <div id="branches" class="basis-1/4 overflow-auto">
                    <ul class="text-center">
    
                    </ul>
                </div>
                <div id="products" class="basis-3/4 h-[32rem] overflow-auto">
                    <ul class="grid grid-cols-3 gap-4">
    
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection

@endif
