<?php

namespace App\Support\Dto\Aggregation;

use Spatie\LaravelData\Attributes\Validation\Date;
use Spatie\LaravelData\Data;

class CloudPaymentsAggregationByPurposeRequestDto extends Data
{
    public string $public_id;
    #[Date]
    public string $dateFrom;
    #[Date]
    public string $dateTo;
}