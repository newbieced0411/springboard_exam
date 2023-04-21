<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;

class BranchController extends Controller
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

        $request->validate([ 'name' => 'required|unique:branches,name' ]);
        Branch::create([ 'name' => $request->name ]);

        return response()->json([
            'message' => 'Successfully created.'
        ]);
    }

    public function edit(Request $request)
    {
        
    }

    public function remove(Branch $branch)
    {
        # code...
    }
}
