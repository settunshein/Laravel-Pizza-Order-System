<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Redirect Admin User List Page
    public function index()
    {
        $admins = User::when(request('search'), function($query){
            $query->orWhere('name', 'like', '%'.request('search').'%')
                  ->orWhere('email', 'like', '%'.request('search').'%')
                  ->orWhere('gender', 'like', '%'.request('search').'%')
                  ->orWhere('address', 'like', '%'.request('search').'%');
        })
        ->where('role', 'admin')
        ->orderBy('created_at', 'DESC')
        ->paginate(4);

        $admins->appends(request()->all());
        
        return view('admin.account.index', compact('admins'))
        ->with('i', (request()->input('page', 1) - 1) * 4);
    }

    // Delete Admin User
    public function delete($id)
    {
        User::where('id', $id)->delete();
    }

    // Redirect Change Role Page
    public function showChangeRolePage($id)
    {
        $account = User::find($id);
        
        return view('admin.account.change-role', compact('account'));
    }

    // Change Admin User Role
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
