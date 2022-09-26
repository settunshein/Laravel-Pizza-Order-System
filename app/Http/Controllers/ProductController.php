<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // Redirect Product List Page
    public function index()
    {
        $products = Product::select('products.*', 'categories.name as category_name')
            ->when(request('search'), function($query){
                $query->where('products.name', 'like', '%'.request('search').'%');
            })
            ->leftJoin('categories', 'products.category_id', 'categories.id')
            ->orderBy('products.created_at', 'DESC')
            ->paginate(5);
        $products->appends(request()->all());

        return view('admin.product.index', compact('products'))
        ->with('i', (request()->input('page', 1) - 1) * 5);

    }


    // Redirect Product Create Page
    public function create()
    {
        $categories = Category::select('id', 'name')->get();

        return view('admin.product.form', compact('categories'));
    }


    // Create New Product
    public function store()
    {
        $data = $this->validateProductRequest();

        if( request()->hasFile('image') ){
            $file_name = uniqid(time()) . request()->file('image')->getClientOriginalName();
            request()->file('image')->storeAs('public', $file_name);
            $data['image'] = $file_name;
        }

        $product = Product::create($data);

        return redirect()->route('product#index')->with('success', 'New Product Created Successfully');
    }


    // Redirect Edit Product Page
    public function edit($id)
    {
        $product    = Product::find($id);
        $categories = Category::select('id', 'name')->get();
        
        return view('admin.product.form', compact('categories', 'product'));
    }


    // Update Product
    public function update($id)
    {
        $data = $this->validateProductRequest($id);

        if( request()->hasFile('image') ){
            $product   = Product::find($id);
            $old_image = $product->image;

            if($old_image != null){
                Storage::delete('public/'.$old_image);
            }

            $file_name = uniqid(time()) . request()->file('image')->getClientOriginalName();
            request()->file('image')->storeAs('public', $file_name);
            $data['image'] = $file_name;
        }

        Product::where('id', $id)->update($data);

        return redirect()->route('product#index')->with('success', 'Product Updated Successfully');
    }


    // Delete Product
    public function delete($id)
    {
        Product::where('id', $id)->delete();
    }
    

    // Validate Product Request
    private function validateProductRequest($id=null)
    {
        if( is_null($id) ){
            $name  = 'required|min:5|unique:products,name';
            $image = 'mimes:png,jpg,jpeg|file';
        }else{
            $name  = 'required|min:5|unique:products,name,'.$id;
            $image = 'required|mimes:png,jpg,jpeg|file';
        }

        return request()->validate([
            'name'         => $name,
            'category_id'  => 'required',
            'price'        => 'required',
            'description'  => 'required',
            'waiting_time' => 'required',
            'image'        => $image
        ],[
            'category_id.required' => 'The category name field is required.'
        ]);
    }
}
