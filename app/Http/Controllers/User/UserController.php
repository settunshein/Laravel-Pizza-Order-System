<?php

namespace App\Http\Controllers\User;

use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    // Redirect Home Page
    public function home()
    {
        $categories = Category::get();
        $products   = Product::get();
        $carts      = Cart::where('user_id', Auth::id())->get();
        $histories  = Order::where('user_id', Auth::id())->get();

        return view('user.main.home', compact('categories', 'products', 'carts', 'histories'));
    }



    // Redirect Change Password Page
    public function showChangePasswordPage()
    {
        return view('user.password.change-password');
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

            Toastr::success('Your Password Updated Successfully &nbsp;<i class="far fa-check-circle"></i>', 'SUCCESS');
            return back();
        }

        return back()->with('error', 'Current Password Does Not Match');
    }



    // Redirect Edit Profile Page
    public function showEditProfilePage()
    {
        $authUser = Auth::user();

        return view('user.account.profile-edit', compact('authUser'));
    }



    // Update Profile
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

        Toastr::success('Your Profile Updated Successfully &nbsp;<i class="far fa-check-circle"></i>', 'SUCCESS');
        return back();
    }



    // Get Products by Category Id
    public function getProductsByCategory($id)
    {
        $categories = Category::get();
        $products   = Product::where('category_id', $id)->orderBy('created_at', 'DESC')->get();
        $carts      = Cart::where('user_id', Auth::id())->get();
        $histories  = Order::where('user_id', Auth::id())->get();

        return view('user.main.home', compact('categories', 'products', 'carts', 'histories'));
    }



    // Get Product Details by Id
    public function getProductDetails($id)
    {
        $product = Product::find($id);
        $randomProducts = Product::inRandomOrder()->take(8)->get();

        $view_count_session = 'pizza_'.$id;
        if( !Session::has($view_count_session) ){
            $product->increment('view_count');
            Session::put($view_count_session, 1);
        }

        return view('user.main.product-details', compact('product', 'randomProducts'));
    }



    // Redirect Cart List Page
    public function showCartListPage()
    {
        $carts = Cart::select('carts.*', 'products.name AS product_name', 'products.price AS product_price', 'products.image AS product_image')
                 ->leftJoin('products', 'products.id', 'carts.product_id')
                 ->where('user_id', Auth::id())
                 ->get();

        $totalPrice = 0;
        foreach($carts as $cart){
            $totalPrice += $cart->product_price * $cart->qty;
        }

        return view('user.main.cart', compact('carts', 'totalPrice'));
    }


    
    // Redirect Cart Histroy Page
    public function showOrderHistoryPage()
    {
        $orders = Order::where('user_id', Auth::id())->orderBy('created_at', 'DESC')->paginate(5);
        
        return view('user.main.order-history', compact('orders'));
    }



    // Redirect Contact Page
    public function showContactPage()
    {
        return view('user.main.contact');
    }



    // Store Contact Data
    public function storeContactData()
    {
        Contact::create($this->validateContactRequest());

        return redirect()->route('user#home');
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



    // Validate Contact Request
    private function validateContactRequest()
    {
        return request()->validate([
            'name'    => 'required',
            'email'   => 'required|email',
            'subject' => 'required',
            'message' => 'required',
        ]);
    }
}
