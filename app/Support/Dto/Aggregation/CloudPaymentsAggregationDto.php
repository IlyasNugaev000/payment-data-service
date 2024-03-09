<?php

namespace App\Support\Dto\Aggregation;

use Spatie\LaravelData\Data;

class CloudPaymentsAggregationDto extends Data
{
    public string $credential_id;
    public ?string $purpose;
    public string $date;
    public ?string $payments_sum;
    public ?string $payments_count;
    public ?string $recurrents_sum;
    public ?string $recurrents_count;
    public ?string $donations_sum;
    public ?string $donations_count;
    public ?string $new_recurrents_sum;
    public ?string $new_recurrents_count;
    public ?string $payments_sum_cancelled;
    public ?string $payments_count_cancelled;
    public ?string $payments_sum_declined;
    public ?string $payments_count_declined;
}