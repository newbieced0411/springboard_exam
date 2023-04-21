<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        // if(auth()->user()->admin !== 1){
        //     return response()->json([
        //         // 'branches' => 
        //     ]);
        // }
        return response()->json([
            'branches' => Branch::all()
        ]);
    }

    public function new(Request $request)
    {
        if(!auth()->user()->admin){
            return response()->json([
                'message' => 'Only admin can add new branch.'
            ]);
        }

        $request->validate([ 
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|decimal:2',
            'stock' => 'required|integer'
        ]);

        Product::create([ 
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock
        ]);

        return response()->json([
            'message' => 'Successfully created.'
        ]);
    }
}
