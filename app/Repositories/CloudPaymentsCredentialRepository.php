<?php

namespace App\Repositories;

use App\Models\CloudPayments\CloudPaymentAggregation;
use App\Models\CloudPayments\CloudPaymentCredential;
use App\Repositories\Interfaces\CloudPaymentsAggregationsRepositoryInterface;
use App\Repositories\Interfaces\CloudPaymentsCredentialRepositoryInterface;
use App\Support\Dto\Aggregation\CloudPaymentsAggregationCollectionDto;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\LazyCollection;
use Spatie\LaravelData\Data;

class CloudPaymentsCredentialRepository implements CloudPaymentsCredentialRepositoryInterface
{
    public function getAll(array $columns): LazyCollection
    {
        return CloudPaymentCredential::all($columns)->lazy()->chunk(100);
    }
}