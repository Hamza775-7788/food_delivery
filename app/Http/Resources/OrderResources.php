<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResources extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'user_id' => $this->user_id,
            'address' => $this->address,
            'totle' => $this->totle,
            'orderStatus_id' => $this->orderStatus_id,
            'pieces_number' => $this->pieces_number,
            'order_detils' => collect($this->order_detils ?? [])->map(function ($detail) {
                return [
                    'id' => $detail->id,
                    'created_at' => $detail->created_at,
                    'updated_at' => $detail->updated_at,
                    'order_id' => $detail->order_id,
                    'product_id' => $detail->product_id,
                    'uint_price' => $detail->uint_price,
                    'quntity' => $detail->quntity,
                    'totle' => $detail->totle,
                    'product_name' => $detail->product->name ?? null,
                    'product_image' => isset($detail->product->image) ? asset('storage/' . $detail->product->image) : null,
                ];
            }),
            'user' => [
                'name' => $this->user['name'] ?? null,
                'email' => $this->user['email'] ?? null,
            ],
            'order_status' => $this->order_status,
        ];
    }
}
