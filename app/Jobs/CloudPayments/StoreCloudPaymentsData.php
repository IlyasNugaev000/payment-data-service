<?php

namespace App\Jobs\CloudPayments;

use App\Models\CloudPayments\CloudPaymentCredential;
use App\Models\CloudPayments\CloudPaymentsNewCredential;
use App\Services\PaymentsApi\CloudPaymentsApiService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class StoreCloudPaymentsData implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $service = resolve(CloudPaymentsApiService::class);
        CloudPaymentsNewCredential::query()->each(function (CloudPaymentsNewCredential $newCredential) use ($service) {
            $credential = CloudPaymentCredential::query()->where('id', $newCredential->credential_id)->first();
            $service->storeCloudPaymentsData($credential);
            $newCredential->delete();
        });
    }
}
