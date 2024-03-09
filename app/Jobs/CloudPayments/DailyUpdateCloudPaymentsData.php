<?php

namespace App\Jobs\CloudPayments;

use App\Models\CloudPayments\CloudPaymentCredential;
use App\Services\PaymentsApi\CloudPaymentsApiService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class DailyUpdateCloudPaymentsData implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle()
    {
        $service = resolve(CloudPaymentsApiService::class);
        CloudPaymentCredential::query()->chunk(100, function (Collection $credentials) use ($service) {
            $credentials->each(fn (CloudPaymentCredential $credential) => $service->storeTransactionsPerDay(now()->subDay(), $credential));
        });
    }
}
