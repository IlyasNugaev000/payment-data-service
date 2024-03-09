<?php

namespace App\Support\Dto\Aggregation;

use Spatie\LaravelData\Attributes\Computed;
use Spatie\LaravelData\Attributes\Validation\Date;
use Spatie\LaravelData\Data;

class CloudPaymentsAggregationByFundResponseDto extends Data
{
    #[Computed]
    public float $payments_avg;
    public function __construct(
        public int $payments_sum,
        public int $payments_count,
        public int $recurrents_sum,
        public int $recurrents_count,
        public int $donations_sum,
        public int $donations_count,
        public int $new_recurrents_sum,
        public int $new_recurrents_count,
        public int $payments_sum_cancelled,
        public int $payments_count_cancelled,
        public int $payments_sum_declined,
        public int $payments_count_declined,
        public ?array $fr_campaigns
    ) {
        $this->payments_avg = $payments_sum / $payments_count;
    }

}