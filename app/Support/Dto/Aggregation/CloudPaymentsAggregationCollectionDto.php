<?php

namespace App\Support\Dto\Aggregation;

use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

class CloudPaymentsAggregationCollectionDto extends Data
{
    #[DataCollectionOf(CloudPaymentsAggregationDto::class)]
    public DataCollection $aggregations;
}