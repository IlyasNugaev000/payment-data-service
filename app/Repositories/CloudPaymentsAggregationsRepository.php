<?php

namespace App\Repositories;

use App\Models\CloudPayments\CloudPaymentAggregation;
use App\Models\CloudPayments\CloudPaymentCredential;
use App\Repositories\Interfaces\CloudPaymentsAggregationsRepositoryInterface;
use App\Support\Dto\Aggregation\CloudPaymentsAggregationCollectionDto;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Spatie\LaravelData\Data;

class CloudPaymentsAggregationsRepository implements CloudPaymentsAggregationsRepositoryInterface
{
    /**
     * @param CloudPaymentsAggregationCollectionDto $aggregationDataDto
     */
    public function save(Data $aggregationDataDto): void
    {
        CloudPaymentAggregation::query()->upsert(
            $aggregationDataDto->aggregations->toArray(),
            ['credential_id', 'purpose', 'date']
        );
    }
    public function getCredentialsByFundId(
        int $fund_id,
    ): Collection {
        return CloudPaymentCredential::query()
            ->where('fund_id', '=', $fund_id)
            ->get();
    }

    public function getCredentialByPublicId(
        string $public_id,
    ): Model {
        return CloudPaymentCredential::query()
            ->where('public_id', '=', $public_id)
            ->first();
    }

    public function getAggregationByCredential(
        CloudPaymentCredential $credential,
        string $dateFrom,
        string $dateTo
    ): Model {
        return $credential->aggregations()
            ->selectRaw('
                SUM(payments_sum) as payments_sum,
                SUM(payments_count) as payments_count,
                SUM(recurrents_sum) as recurrents_sum,
                SUM(recurrents_count) as recurrents_count,
                SUM(donations_sum) as donations_sum,
                SUM(donations_count) as donations_count,
                SUM(new_recurrents_sum) as new_recurrents_sum,
                SUM(new_recurrents_count) as new_recurrents_count,
                SUM(payments_sum_cancelled) as payments_sum_cancelled,
                SUM(payments_count_cancelled) as payments_count_cancelled,
                SUM(payments_sum_declined) as payments_sum_declined,
                SUM(payments_count_declined) as payments_count_declined
            ')
            ->whereDate('date', '>=', $dateFrom)
            ->whereDate('date', '<=', $dateTo)
            ->first();
    }

    public function getAggregationByPaymentsPurpose(
        CloudPaymentCredential $credential,
        string $dateFrom,
        string $dateTo
    ): Collection {
        return $credential->aggregations()
            ->selectRaw('purpose, SUM(payments_sum) as payments_sum')
            ->whereDate('date', '>=', $dateFrom)
            ->whereDate('date', '<=', $dateTo)
            ->groupBy('purpose')
            ->get();
    }
}