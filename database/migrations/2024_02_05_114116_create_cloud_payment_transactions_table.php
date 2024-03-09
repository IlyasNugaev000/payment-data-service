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
        Schema::create('cloud_payment_transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('credential_id')->index();
            $table->string('public_id');
            $table->string('terminal_url');
            $table->unsignedBigInteger('transaction_id');
            $table->decimal('amount', 22, 2, true);
            $table->string('currency')->nullable();
            $table->integer('currency_code')->nullable();
            $table->decimal('payment_amount', 22, 2, true);
            $table->string('payment_currency')->nullable();
            $table->integer('payment_currency_code')->nullable();
            $table->string('invoice_id')->nullable();
            $table->string('account_id')->nullable();
            $table->string('email')->nullable();
            $table->string('description')->nullable();
            $table->json('json_data')->nullable();
            $table->string('created_date')->nullable();
            $table->string('payout_date')->nullable();
            $table->dateTime('payout_date_iso')->nullable();
            $table->decimal('payout_amount', 22, 2, true)->nullable();
            $table->dateTime('created_date_iso')->nullable();
            $table->string('auth_date')->nullable();
            $table->dateTime('auth_date_iso')->nullable();
            $table->string('confirm_date')->nullable();
            $table->dateTime('confirm_date_iso')->nullable();
            $table->string('auth_code')->nullable();
            $table->boolean('test_mode')->default(false);
            $table->string('rrn')->nullable();
            $table->unsignedBigInteger('original_transaction_id')->nullable();
            $table->unsignedBigInteger('fall_back_scenario_declined_transaction_id')->nullable();
            $table->string('ip_address')->nullable();
            $table->string('ip_country')->nullable();
            $table->string('ip_city')->nullable();
            $table->string('ip_region')->nullable();
            $table->string('ip_district')->nullable();
            $table->string('ip_latitude')->nullable();
            $table->string('ip_longitude')->nullable();
            $table->string('card_first_six')->nullable();
            $table->string('card_last_four')->nullable();
            $table->string('card_exp_date')->nullable();
            $table->string('card_type')->nullable();
            $table->string('card_product')->nullable();
            $table->string('card_category')->nullable();
            $table->string('issuer_bank_country')->nullable();
            $table->string('issuer')->nullable();
            $table->integer('card_type_code')->nullable();
            $table->string('status');
            $table->integer('status_code');
            $table->string('culture_name')->nullable();
            $table->string('reason')->nullable();
            $table->string('card_holder_message')->nullable();
            $table->integer('type');
            $table->boolean('refunded')->default(false);
            $table->string('name')->nullable();
            $table->string('token')->nullable();
            $table->string('subscription_id')->nullable();
            $table->boolean('is_local_order')->nullable();
            $table->unsignedBigInteger('gateway')->nullable();
            $table->string('gateway_name')->nullable();
            $table->boolean('apple_pay')->default(false);
            $table->boolean('android_pay')->default(false);
            $table->string('wallet_type')->nullable();
            $table->boolean('master_pass')->default(false);
            $table->decimal('total_fee', 22, 2, true);
            $table->integer('reason_code')->nullable();
            $table->unsignedBigInteger('escrow_accumulation_id')->nullable();
            $table->string('info_shop_data')->nullable();
            $table->timestamps();

            $table->foreign('credential_id')->references('id')->on('cloud_payment_credentials')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cloud_payment_transactions');
    }
};
