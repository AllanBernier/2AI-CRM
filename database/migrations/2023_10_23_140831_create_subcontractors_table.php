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
        Schema::create('subcontractors', function (Blueprint $table) {
            $table->ulid('id');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email_perso')->nullable();
            $table->string('email_company')->nullable();
            $table->string('company_name')->nullable();
            $table->string('phone')->nullable();
            $table->string('city')->nullable();
            $table->ulid('subcontractor_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subcontractors');
    }
};
