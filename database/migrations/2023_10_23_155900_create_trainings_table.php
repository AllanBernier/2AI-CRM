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
        Schema::create('trainings', function (Blueprint $table) {
            $table->ulid('id');
            $table->string('status')->nullable();
            $table->string('product_id')->nullable();
            $table->string('customer_id' )->nullable();
            $table->string('subcontractor_id')->nullable();
            $table->integer('tjm_client')->nullable();
            $table->integer('tjm_subcontractor')->nullable();
            $table->float('duree',3,1)->nullable();
            $table->string('start_date')->nullable();
            $table->string('end_date')->nullable();
            $table->string('num_session')->nullable();
            $table->string('num_bdc')->nullable();
            $table->string('location')->nullable();
            $table->integer('travelling_expenses')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trainings');
    }
};
