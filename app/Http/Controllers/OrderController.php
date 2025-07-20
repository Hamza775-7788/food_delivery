<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderResources;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Resources\OrderView;


class OrderController extends Controller
{
    public function index()
    {
        $data = Order::with(['orderDetils', 'orderStatus', 'orderDetils.Product', "user"])->get();
        // $order = Order::with(['orderDetils', 'orderStatus', 'orderDetils.Product', "user"])->get();
        // $data = OrderResources::collection($order);
        return response()->json(['data' => $data]);
    }


    public function addOrder(Request $request)
    {
        $request->validate([
            "address" => 'required',
            'totle' => 'required',
            'orderStatus_id' => "required",
            'pieces_number' => "required",
            'order_detils' => "required",

        ]);

        

    }
}
