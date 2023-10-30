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
        Schema::create('cursuses', function (Blueprint $table) {
            $table->ulid('id');
            $table->string('name');
            $table->string('send_to_subcontractors')->nullable();
            $table->string('send_to_customer')->nullable();
            $table->string('status')->nullable();
            $table->string('location')->nullable();
            $table->integer('tjm')->nullable();
            $table->integer('travelling_expenses')->nullable();
            $table->ulid('product_id')->nullable();
            $table->ulid('customer_id')->nullable();
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cursuses');
    }
};
