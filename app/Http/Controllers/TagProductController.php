<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;

class TagProductController extends Controller
{
    public function insert(Request $request)
    {
        $request->validate([
            'products' => 'required',
            'branches' => 'required'
        ]);

        $products = $request->products;
        $branches = $request->branches;
        
        foreach($branches as $branch){
            $branch = Branch::find($branch);
            $branch->products()->syncWithoutDetaching($products);
        }

        return response()->json([
            'message' => 'Successfully tagged all products.'
        ], 201);
    }
}
