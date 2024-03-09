<?php

namespace App\Support\Dto\Aggregation;

use Spatie\LaravelData\Attributes\Validation\Date;
use Spatie\LaravelData\Data;

class CloudPaymentsAggregationFrCampaignsRequestDto extends Data
{
    public int $fund_id;
    #[Date]
    public string $dateFrom;
    #[Date]
    public string $dateTo;
}