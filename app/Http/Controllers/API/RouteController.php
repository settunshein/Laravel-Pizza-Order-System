<?php

namespace App\Http\Controllers\API;

use Carbon\Carbon;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RouteController extends Controller
{
    // Get All Categories Data
    public function getCategoryList()
    {
        $data = Category::orderBy('created_at', 'DESC')->get();
        return response()->json($data, 200);
    }


    // Create New Category
    public function createCategory(Request $request)
    {
        $data = [
            'name'       => $request->name,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];

        $response = Category::create($data);
        return response()->json($response, 200);
    }


    // Delete Category
    public function deleteCategory($id)
    {
        $data = Category::where('id', $id)->first();

        if( isset($data) ){
            Category::where('id', $id)->delete();
            return response()->json([
                'status'  => true,
                'message' => 'Category Deleted Successfully'
            ], 200);
        }

        return response()->json([
            'status'  => false,
            'message' => 'Category Not Found'
        ], 404);
    }


    // Get Category Details
    public function getCategoryDetails($id)
    {
        $data = Category::where('id', $id)->first();

        if( isset($data) ){
            $response = Category::where('id', $id)->first();
            return response()->json([
                'status'   => true,
                'category' => $response,
            ], 200);
        }

        return response()->json([
            'status'  => false,
            'message' => 'Category Not Found'
        ], 404);
    }


    // Update Category
    public function updateCategory($id)
    {
        $data = Category::where('id', $id)->first();

        if( isset($data) ){
            $category = Category::where('id', $id)->update($this->getCategoryData()); 
            return response()->json([
                'status'   => true,
                'message'  => 'Category Updated Successfully',
                'category' => Category::find($id),
            ], 200);
        }
        
        return response()->json([
            'status'  => false,
            'message' => 'Category Not Found'
        ], 404);
    }


    // Get All Products Data
    public function getProductList()
    {
        $products = Product::orderBy('created_at', 'DESC')->get();
        return response()->json($products);
    }


    // Get All Contact Message Data
    public function getContactMessageList()
    {
        $data = Contact::orderBy('created_at', 'DESC')->get();
        return response()->json($data, 200);
    }


    // Create New Contact Message
    public function createContactMessage()
    {
        $data = Contact::create($this->getContactMessageData());
        return response()->json($data, 200);
    }


    // Get Category Data
    private function getCategoryData()
    {
        return [
            'name'       => request()->name,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }


    // Get Contact Message Data
    private function getContactMessageData()
    {
        return [   
            'name'       => request()->name,
            'email'      => request()->email,
            'subject'    => request()->subject,
            'message'    => request()->message,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
    }
}
