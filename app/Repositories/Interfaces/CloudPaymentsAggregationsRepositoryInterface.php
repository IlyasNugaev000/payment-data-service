<?php

namespace App\Repositories\Interfaces;

use App\Models\CloudPayments\CloudPaymentCredential;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Spatie\LaravelData\Data;

interface CloudPaymentsAggregationsRepositoryInterface
{
    public function save(Data $aggregationDataDto): void;

    public function getAggregationByCredential(
        CloudPaymentCredential $credential,
        string $dateFrom,
        string $dateTo
    ): Model;

    public function getCredentialsByFundId(
        int $fund_id
    ): iterable;

    public function getCredentialByPublicId(
        string $public_id,
    ): Model;

    public function getAggregationByPaymentsPurpose(
        CloudPaymentCredential $credential,
        string $dateFrom,
        string $dateTo
    ): Collection;
}