<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    // Redirect Customer List Page
    public function index()
    {
        $customers = User::when(request('search'), function($query){
            $query->orWhere('name', 'like', '%'.request('search').'%')
                  ->orWhere('email', 'like', '%'.request('search').'%')
                  ->orWhere('gender', 'like', '%'.request('search').'%')
                  ->orWhere('address', 'like', '%'.request('search').'%');
        })
        ->where('role', 'user')
        ->orderBy('created_at', 'DESC')
        ->paginate(4);

        $customers->appends(request()->all());

        return view('admin.customer.index', compact('customers'))
        ->with('i', (request()->input('page', 1) - 1) * 4);
    }


    // Change Customer Role
    public function changeRole(Request $request)
    {
        User::where('id', $request->user_id)->update([
            'role' => $request->role,
        ]);
        
        return response()->json([
            'message' => 'SUCCESS'
        ]);
    }
}
