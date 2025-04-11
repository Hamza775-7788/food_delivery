<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $averageRating = 0;
        if ($this->product_rate) {
            $averageRating = $this->product_rate->avg('rate') ?? 0;
        }
        // حساب متوسط التقييم


        return [
            'id' => $this->id,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'), // تنسيق التاريخ
            'name' => $this->name,
            'image' => $this->image,
            'description' => $this->description,
            'category_id' => $this->category_id,
            'price' => (float)$this->price, // تحويل لـ float للتأكد من النوع
            'delivery_price' => (float)$this->delivery_price,
            'make_time' => $this->make_time,
            'average_rating' => round($averageRating, 2), // تقريب لرقمين عشريين
            'category' => $this->category->name,
            'category_image' => $this->category->image

        ];
    }
}
