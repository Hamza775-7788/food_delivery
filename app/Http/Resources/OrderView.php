<?php

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class OrderView extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'data' => $this->collection->map(function ($order) {
                return [
                    'id' => $order->id,
                    'created_at' => $order->created_at,
                    'updated_at' => $order->updated_at,
                    'user_id' => $order->user_id,
                    'address' => $order->address,
                    'totle' => $order->totle,
                    'orderStatus_id' => $order->orderStatus_id,
                    'pieces_number' => $order->pieces_number,
                    'order_detils' => collect($order->order_detils)->map(function ($detail) {
                        return [
                            'id' => $detail['id'],
                            'created_at' => $detail['created_at'],
                            'updated_at' => $detail['updated_at'],
                            'order_id' => $detail['order_id'],
                            'product_id' => $detail['product_id'],
                            'uint_price' => $detail['uint_price'],
                            'quntity' => $detail['quntity'],
                            'totle' => $detail['totle'],
                            'product_name' => $detail['product']['name'] ?? null,
                            'product_image' => asset('storage/' . $detail['product']['image'] ?? ''), // إذا أردت رابط كامل
                        ];
                    }),
                    'user' => [
                        'name' => $order->user['name'] ?? null,
                        'email' => $order->user['email'] ?? null,
                    ],
                    'order_status' => $order->order_status,
                ];
            }),
        ];
    }
}
