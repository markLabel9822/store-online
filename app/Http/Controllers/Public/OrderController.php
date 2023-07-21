<?php

namespace App\Http\Controllers\Public;

use App\Listeners\SendEmailJob;
use App\Models\MainOrder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{

    public function index(Request $request)
    {
        return response()->json(['message' => 'order successfully']);
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'telephone' => 'required',
            'shipping_address' => 'required',
            'billing_address' => 'required',
            'price_summary' => 'required',
            'total_amount' => 'required|numeric',
            'detailed_orders' => 'required|array',
            'detailed_orders.*.id_product' => 'required',
            'detailed_orders.*.product_name' => 'required',
            'detailed_orders.*.product_price' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $data = $request->json()->all();
        $mainOrder = MainOrder::create([
            'email' => $data['email'],
            'telephone' => $data['telephone'],
            'shipping_address' => $data['shipping_address'],
            'billing_address' => $data['billing_address'],
            'price_summary' => $data['price_summary'],
            'total_amount' => $data['total_amount'],
            'status' => 'wait_confirmed',
        ]);

        $detailedOrdersData = $data['detailed_orders'];
        foreach ($detailedOrdersData as $detailedOrderData) {
            $mainOrder->detailedOrders()->create([
                'id_product' => $detailedOrderData['id_product'],
                'product_name' => $detailedOrderData['product_name'],
                'product_price' => $detailedOrderData['product_price'],
            ]);
        }

        dispatch(new SendEmailJob($mainOrder));
        return response()->json(['message' => 'order created successfully']);
    }
}
