<?php

namespace App\Http\Controllers\Internal;

use App\Policies\ProductPolicy;
use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{


    public function index()
    {
        $products = Product::with('category')->where('status', 'active')->get();
        $result = $products->map(function ($value, $item) {
            return [
                'product_id' => $value->id,
                'product_name' => $value->name,
                'product_price' => $value->price,
                'product_description' =>  $value->description,
                'category_id' => $value->category->id,
                'category_name' => $value->category->name
            ];
        });

        return response()->json($result);
    }

    public function store(Request $request)
    {

        $data = $request->json()->all();

        Product::create([
            'name' => $data['name'],
            'description' => $data['description'],
            'price' => $data['price'],
            'status' => $data['status'],
            'product_category_id' => $data['product_category_id'],
        ]);

        return response()->json(["message" => "Create Product Successfully"]);
    }

    public function update(Request $request, $id)
    {
        $data = $request->json()->all();

        $product = Product::find($id);
        $existingPrice = $product->price;
        $existingStatus = $product->status;
        $permission = $this->isEditingPriceAndStatus($data);
        if (!$permission) {
            return response()->json(["error" => "Forbidden not found"], 403);
        }

        if (!$product) {
            return response()->json(["error" => "Product not found"], 404);
        }

        $product->update([
            'name' => $data['name'],
            'description' => $data['description'],
            'price' => $data['price'] ?? $existingPrice,
            'status' => $data['status']  ?? $existingStatus,
            'product_category_id' => $data['product_category_id'],
        ]);


        return response()->json(["message" => "Edit Product Successfully"]);
    }

    public function destroy(Request $request, $id)
    {

        $product = Product::find($id);
        if (!$product) {
            return response()->json(["error" => "Product not found"], 404);
        }

        $product->update([
            'status' => 'not_active',
        ]);

        return response()->json(["message" => "Delete Product Successfully"]);
    }

    public function isEditingPriceAndStatus($data)
    {

        if (Auth::user()->roles[0]->name == 'Admin') {
            return true;
        }

        if (Auth::user()->roles[0]->name == 'Editor') {

            if (isset($data['price']) || isset($data['status'])) {
                return false;
            } else {
                return true;
            }
        }

        return false;
    }
}
