<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    # Show all branches
    public function index()
    {
        return response()->json([
            'branches' => Branch::all()
        ], 200);
    }

    public function show(Branch $branch)
    {
        return response()->json([
            'branch' => $branch->load('products')
        ], 200);
    }

    public function new(Request $request)
    {
        if(!auth()->user()->admin){
            return response()->json([
                'message' => 'Only admin can add new branch.'
            ]);
        }

        $request->validate([ 'name' => 'required|unique:branches,name' ]);
        Branch::create([ 'name' => $request->name ]);

        return response()->json([
            'message' => 'Successfully created.'
        ], 201);
    }
}
