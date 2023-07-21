<?php

namespace App\Http\Controllers\Public;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Cache;
use App\Http\Controllers\Controller;


class ProductController extends Controller
{

    public function all()
    {
        $cacheKey = 'products-all';
        if (Cache::has($cacheKey)) {
            $result = Cache::get($cacheKey);
        } else {
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
            Cache::put($cacheKey, $result, now()->addHour());
        }

        return response()->json($result);
    }
}
