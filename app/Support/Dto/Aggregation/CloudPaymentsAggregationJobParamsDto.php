<?php

namespace App\Support\Dto\Aggregation;

use Spatie\LaravelData\Data;

class CloudPaymentsAggregationJobParamsDto extends Data
{
    public ?string $credential_id;
    public ?string $date_from;
    public ?string $date_to;
}