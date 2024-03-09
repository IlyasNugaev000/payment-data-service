<?php

namespace App\Providers;

use App\Repositories\CloudPaymentsAggregationsRepository;
use App\Repositories\CloudPaymentsCredentialRepository;
use App\Repositories\CloudPaymentsTransactionsRepository;
use App\Repositories\Interfaces\CloudPaymentsAggregationsRepositoryInterface;
use App\Repositories\Interfaces\CloudPaymentsCredentialRepositoryInterface;
use App\Repositories\Interfaces\CloudPaymentsTransactionsRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoriesServiceProvider extends ServiceProvider
{
    public $bindings = [
        CloudPaymentsTransactionsRepositoryInterface::class => CloudPaymentsTransactionsRepository::class,
        CloudPaymentsAggregationsRepositoryInterface::class => CloudPaymentsAggregationsRepository::class,
        CloudPaymentsCredentialRepositoryInterface::class => CloudPaymentsCredentialRepository::class,
    ];

    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
