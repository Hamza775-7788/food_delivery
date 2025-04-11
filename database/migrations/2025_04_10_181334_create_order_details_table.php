<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId("order_id")->constrained("orders")->cascadeOnDelete();
            $table->foreignId("product_id")->constrained("products")->cascadeOnDelete();
            $table->double("uint_price");
            $table->integer("quntity");
            $table->double("totle");
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_details');
    }
};
