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
        Schema::create('cloud_payment_credentials', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('fund_id');
            $table->string('public_id');
            $table->text('api_secret');
            $table->date('date_start')->nullable();
            $table->string('name')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cloud_payment_credentials');
    }
};
