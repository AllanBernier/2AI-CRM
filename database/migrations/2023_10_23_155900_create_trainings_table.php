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
            $table->string('status')->default('nouveau');
            $table->string('product_id')->nullable();
            $table->string('customer_id' )->nullable();
            $table->string('subcontractor_id')->nullable();
            $table->integer('tjm_client')->default(0)->nullable();
            $table->integer('tjm_subcontractor')->default(0)->nullable();
            $table->float('duree',3,1)->nullable();
            $table->string('start_date')->nullable();
            $table->string('end_date')->nullable();
            $table->string('num_session')->nullable();
            $table->string('num_bdc')->nullable();
            $table->string('location')->nullable();
            $table->integer('travelling_expenses')->nullable();
            $table->string('text')->nullable();
            $table->string('action_customer')->nullable();
            $table->string('action_subcontractor')->nullable();
            $table->string('name')->nullable();
            $table->ulid('cursus_id')->nullable();
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
