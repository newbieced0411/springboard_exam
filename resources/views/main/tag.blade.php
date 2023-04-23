@if (Route::currentRouteName() == 'tag')

@extends('app')
@section('title', 'Tag Product')

@section('content')
    <div class="flex items-center justify-center h-screen">
        <div class="w-[800px] h-[700px] p-4 text-left bg-white border shadow rounded ">
            <div class="mb-6">
                <h1 class="font-bold text-3xl">Tag Products</h1>
                <p class="mt-2 mb-4 text-sm">Check neccessary products and tag it in a branch/es</p>
            </div>
            <form id="addProduct">
                @csrf
                <div id="errors" class="grid grid-cols-4 gap-x-0 text-left text-red-500"></div>
                <div id="result" class="text-center text-green-500"></div>
                <div class="flex flex-row items-center space-x-2">
                    <div class="space-y-2">
                        <input type="text" name="product" id="name" placeholder="Name" class="w-full px-2 border-2 border-l-lg outline-none">
                        <input type="text" name="description" id="description" placeholder="Description" class="w-full px-2 border-2 border-l-lg outline-none">
                    </div>
                    <div class="space-y-2">
                        <input type="text" name="price" id="price" placeholder="Price" class="w-full px-2 border-2 border-l-lg outline-none">
                        <input type="text" name="stock" id="stock" placeholder="Stock" class="w-full px-2 border-2 border-l-lg outline-none">
                    </div>
                    <div class="flex items-baseline justify-between">
                        <button id="addProduct" class="p-2 text-white bg-blue-600 rounded-lg transition duration-300 ease-in-out hover:bg-blue-900">Add</button>
                    </div>
                </div>
            </form>

            {{-- List of branches and products --}}
            <div class="flex flex-row space-x-8 mt-4">
                <div class="basis-1/2">
                    <span class="mb-2 text-xl">Select branch</span>
                    <div id="listBranches" class="h-80 overflow-auto">
                        <form id="formBranches" class="mt-2 flex flex-col">
        
                        </form>
                    </div>
                </div>
                <div class="basis-1/2">
                    <span class="mb-2 text-xl">Select product</span>
                    <div id="listProducts" class="h-80 overflow-auto">
                        <form id="formProducts" class="mt-2 flex flex-col">
        
                        </form>
                    </div>
                </div>

            </div>
            <div class="w-full mt-6 text-right">
                <button id="tag" class="py-2 px-4 text-white bg-blue-600 rounded-lg transition duration-300 ease-in-out hover:bg-blue-900">Tag</button>
            </div>
        </div>
    </div>
@endsection

@endif
