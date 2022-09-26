<?php

namespace Database\Seeders;

use Faker\Factory;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $txt = "There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet.";

        // User Data
        $json = File::get(public_path() . '/files/users.json');
        $objs = json_decode($json);
        foreach($objs as $obj){
            DB::table('users')->insert([
                'name'       => $obj->name,
                'email'      => $obj->email,
                'phone'      => $obj->phone,
                'gender'     => $obj->gender,
                'role'       => $obj->role,
                'address'    => $obj->address,
                'password'   => Hash::make('password'),
                'created_at' => now(),
            ]);
        }


        // Category Data
        $json = File::get(public_path() . '/files/categories.json');
        $objs = json_decode($json);
        foreach($objs as $obj){
            DB::table('categories')->insert([
                'name'       => $obj->name,
                'created_at' => '2022-08-01 12:00:00'
            ]);
        }


        // Product Data
        $json = File::get(public_path() . '/files/products.json');
        $objs = json_decode($json);
        foreach($objs as $obj){
            DB::table('products')->insert([
                'id'           => $obj->id,
                'category_id'  => $obj->category_id,
                'name'         => $obj->name,
                'image'        => $obj->image,
                'price'        => $obj->price,
                'waiting_time' => 5,
                'view_count'   => rand(25, 100),
                'description'  => $txt,
                'created_at'   => $obj->created_at
            ]);
        }


        // Order Data
        $json = File::get(public_path() . '/files/orders.json');
        $objs = json_decode($json);
        foreach($objs as $obj){
            DB::table('orders')->insert([
                'id'          => $obj->id,
                'user_id'     => $obj->user_id,
                'order_code'  => $obj->order_code,
                'total_price' => $obj->total_price,
                'status'      => $obj->status,
                'created_at'  => $obj->created_at
            ]);
        }


        // Order Item Data
        $json = File::get(public_path() . '/files/order_items.json');
        $objs = json_decode($json);
        foreach($objs as $obj){
            DB::table('order_items')->insert([
                'id'         => $obj->id,
                'user_id'    => $obj->user_id,
                'product_id' => $obj->product_id,
                'qty'        => $obj->qty,
                'order_code' => $obj->order_code,
                'total'      => $obj->total,
                'created_at' => $obj->created_at
            ]);
        }


        // Contact Data
        $json = File::get(public_path() . '/files/contacts.json');
        $objs = json_decode($json);
        foreach($objs as $obj){
            DB::table('contacts')->insert([
                'name'       => $obj->name,
                'email'      => $obj->email,
                'subject'    => $obj->subject,
                'message'    => $txt,
                'created_at' => '2022-09-10 12:00:00'
            ]);
        }
    }
}
