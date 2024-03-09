<?php

namespace App\Repositories\Interfaces;

interface CloudPaymentsTransactionsRepositoryInterface
{
    public function getAggregationDataCollection(): iterable;
}