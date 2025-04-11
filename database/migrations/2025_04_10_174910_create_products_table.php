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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string("name");
            $table->text("description");
            $table->foreignId("category_id")->constrained("categories")->cascadeOnDelete();
            $table->double("price");
            $table->text("image")->nullable();
            $table->double("delivery_price")->default(0);
            $table->string("make_time");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
