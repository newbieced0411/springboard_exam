<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    # Show all products
    public function index()
    {
        return response()->json([
            'products' => Product::all()
        ], 200);
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
        ], 201);
    }
}
