<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    // Redirect Category List Page
    public function index()
    {
        $categories = Category::when(request('search'), function($query){
            $query->where('name', 'like', '%'.request('search').'%');
        })->orderBy('created_at', 'DESC')->paginate(5);

        $categories->appends(request()->all());
        
        return view('admin.category.index', compact('categories'))
        ->with('i', (request()->input('page', 1) - 1) * 5);
    }


    // Redirect Category Create Page
    public function create()
    {
        return view('admin.category.form');
    }


    // Create New Category
    public function store(Request $request)
    {
        Category::create($this->validateCategoryRequest());
        
        return redirect()->route('category#index')->with('success', 'New Category Created Successfully');
    }


    // Redirect Category Edit Page
    public function edit($id)
    {
        $category = Category::find($id);

        return view('admin.category.form', compact('category'));
    }


    // Update Category
    public function update($id)
    {
        $category = Category::find($id);
        $category->update($this->validateCategoryRequest($id));

        return redirect()->route('category#index')->with('success', 'Category Updated Successfully');
    }


    // Delete Category
    public function delete($id)
    {
        Category::where('id', $id)->delete();
    }
    

    // Validate Category Request
    private function validateCategoryRequest($id=null)
    {
        is_null($id) ? $name = 'required|min:3|unique:categories,name' : $name = 'required|min:3|unique:categories,name,'.$id;

        return request()->validate([
            'name' => $name
        ]);
    }
}
