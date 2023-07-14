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
        Schema::create('checkouts', function (Blueprint $table) {
            $table->id();
            $table->integer('processCode');
            $table->string(('shipping'));
            $table->bigInteger('subTotal');
            $table->integer('product_id');
            $table->integer('user_id');
            $table->integer('quantity');
            $table->enum('status',['waiting for payment','packed','in delivery','finished']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('checkouts');
    }
};
