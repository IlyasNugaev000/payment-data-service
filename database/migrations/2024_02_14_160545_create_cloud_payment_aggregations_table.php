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
        Schema::create('cloud_payment_aggregations', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->unsignedBigInteger('credential_id')->index();
            $table->string('purpose')->nullable()->comment('Назначение платежа');
            $table->unique(['credential_id', 'date', 'purpose']);
            $table->foreign('credential_id')->references('id')->on('cloud_payment_credentials')->cascadeOnDelete();
            $table->integer('payments_sum')->nullable()->comment('Сумма пожертвований');
            $table->integer('payments_count')->nullable()->comment('Количество пожертвований');
            $table->integer('recurrents_sum')->nullable()->comment('Сумма пожертований от рекуррентов');
            $table->integer('recurrents_count')->nullable()->comment('Количество пожертований от рекуррентов');
            $table->integer('donations_sum')->nullable()->comment('Сумма разовых пожертований');
            $table->integer('donations_count')->nullable()->comment('Количество разовых пожертований');
            $table->integer('new_recurrents_sum')->nullable()->comment('Сумма пожертвований от новых рекуррентов');
            $table->integer('new_recurrents_count')->nullable()->comment('Количество новых рекуррентов');
//            $table->string('payments_sum_bank_card')->comment('');
//            $table->string('payments_count_bank_card')->comment('');
//            $table->string('payments_sum_sbp')->comment('');
//            $table->string('payments_count_sbp')->comment('');
//            $table->string('payments_sum_sms')->comment('');
//            $table->string('payments_count_sms')->comment('');
            $table->integer('payments_sum_cancelled')->nullable()->comment('Сумма отмененных рекуррентов');
            $table->integer('payments_count_cancelled')->nullable()->comment('Количество отмененных рекуррентов');
            $table->integer('payments_sum_declined')->nullable()->comment('Сумма отклоненных рекуррентов');
            $table->integer('payments_count_declined')->nullable()->comment('Количество отклоненных рекуррентов');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cloud_payment_aggregations');
    }
};
