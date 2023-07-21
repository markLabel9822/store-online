<?php

namespace App\Http\Controllers\Internal;

use App\Models\ProductCategory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class CategoryController extends Controller
{

    public function index()
    {
        $productCategories = ProductCategory::where('status', 'active')->get();
        $result = $productCategories->map(function ($value, $item) {
            return [
                'category_id' => $value->id,
                'category_name' => $value->name
            ];
        });
        return response()->json($result);
    }

    public function store(Request $request)
    {
        $data = $request->json()->all();
        ProductCategory::create([
            'name' => $data['name'],
            'status' => $data['status'],
        ]);

        return response()->json(["message" => "Create Category Successfully"]);
    }


    public function update(Request $request, $id)
    {
        $data = $request->json()->all();
        $productCategory = ProductCategory::find($id);
        if (!$productCategory) {
            return response()->json(["error" => "Product category not found"], 404);
        }
        $productCategory->update([
            'name' => $data['name'],
            'status' => $data['status'],
        ]);
        return response()->json(["message" => "Edit Category Successfully"]);
    }

    public function destroy(Request $request, $id)
    {

        $ProductCategory = ProductCategory::find($id);
        if (!$ProductCategory) {
            return response()->json(["error" => "ProductCategory not found"], 404);
        }

        $ProductCategory->update([
            'status' => 'not_active',
        ]);
        return response()->json(["message" => "Delete Category Successfully"]);
    }
}
