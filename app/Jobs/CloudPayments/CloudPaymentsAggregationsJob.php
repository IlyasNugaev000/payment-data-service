<?php

namespace App\Jobs\CloudPayments;

use App\Services\CloudPayments\CloudPaymentsAggregationsService;
use App\Support\Dto\Aggregation\CloudPaymentsAggregationJobParamsDto;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CloudPaymentsAggregationsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Execute the job.
     */
    public function handle(CloudPaymentsAggregationsService $cloudPaymentsAggregationService)
    {
        $cloudPaymentsAggregationService->aggregation();
    }
}
