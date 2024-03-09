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
        Schema::create('cloud_payments_new_credentials', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('credential_id');
            $table->timestamps();

            $table->foreign('credential_id')->on('cloud_payment_credentials')->references('id')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cloud_payments_new_credentials');
    }
};
