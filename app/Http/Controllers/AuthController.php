<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller
{
    // Redirect Login Page
    public function showLoginPage()
    {
        return view('auth.login');
    }

    // Redirect Register Page
    public function showRegisterPage()
    {
        return view('auth.register');
    }

    // Redirect Page By Role
    public function redirectPageByRole()
    {
        if( Auth::user()->role === 'admin' ){
            return redirect()->route('dashboard');
        }
        
        return redirect()->route('user#home');
    }

    // Logout
    public function logout()
    {
        Session::flush();
        Auth::logout();

        return redirect()->route('auth#loginPage');
    }

    // Redirect Dashboard Page
    public function dashboard()
    {
        $categories   = Category::count();
        $products     = Product::count();
        $customers    = User::where('role', 'user')->count();
        $orders       = Order::count();
        $today_orders = Order::select('orders.*', 'users.name AS user_name')
            ->leftJoin('users', 'users.id', 'orders.user_id')
            ->orderBy('orders.created_at', 'DESC')
            ->whereDate('orders.created_at', Carbon::today())
            ->orderBy('orders.created_at', 'DESC')
            ->paginate(5);

        return view('admin.dashboard', compact('categories', 'products', 'customers', 'orders', 'today_orders'))
        ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    // Redirect Change Password Page
    public function showChangePasswordPage()
    {
        return view('admin.password.change-password');
    }

    // Change Password
    public function changePassword()
    {
        $data = $this->validatePasswordRequest();
        $dbHashValue = Auth::user()->password;

        if( Hash::check( $data['current_password'], $dbHashValue ) ){
            $user = User::where('id', Auth::id())->update([
                'password' => Hash::make($data['new_password']),
            ]);

            Auth::logout();

            return redirect()->route('auth#loginPage')->with('success', 'Your Password Updated Successfully');
        }

        return back()->with('error', 'Current Password Does Not Match');
    }

    // Redirect Admin Profile Page
    public function showProfilePage()
    {
        $authUser = Auth::user();

        return view('admin.account.profile', compact('authUser'));
    }

    // Redirect Admin Edit Profile Page
    public function showEditProfilePage()
    {
        $authUser = Auth::user();

        return view('admin.account.profile-edit', compact('authUser'));
    }

    // Update Admin Profile
    public function updateProfile()
    {
        $user = User::find(auth()->id());
        $user->update($this->validateUserRequest());

        if( request()->hasFile('image') ){
            request()->validate([
                'image'   => 'mimes:png,jpg,jpeg|file'
            ]);
            $old_image = $user->image;

            if($old_image != null){
                Storage::delete('public/'.$old_image);
            }
            $file_name = uniqid(time()) . request()->file('image')->getClientOriginalName();
            request()->file('image')->storeAs('public', $file_name);
            $user->update([
                'image' => $file_name,
            ]);
        }

        return redirect()->route('admin#profilePage')->with('success', 'Your Profile Updated Successfully');
    }

    // Validate Password Request
    private function validatePasswordRequest()
    {
        return request()->validate([
            'current_password' => 'required|min:8',
            'new_password'     => 'required|min:8',
            'confirm_password' => 'required|min:8|same:new_password',
        ]);
    }

    // Validate User Request
    private function validateUserRequest()
    {
        return request()->validate([
            'name'    => 'required',
            'email'   => 'required',
            'gender'  => 'required',
            'phone'   => 'required',
            'address' => 'required',
        ]);
    }
}
