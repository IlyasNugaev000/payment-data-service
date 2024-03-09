<?php

namespace App\Repositories\Interfaces;

use Spatie\LaravelData\Data;

interface CloudPaymentsCredentialRepositoryInterface
{
    public function getAll(array $columns): iterable;
}