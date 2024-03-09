<?php

namespace App\Repositories;

use App\Models\CloudPayments\CloudPaymentTransaction;
use App\Repositories\Interfaces\CloudPaymentsTransactionsRepositoryInterface;
use App\Support\Dto\Aggregation\CloudPaymentsAggregationJobParamsDto;
use Illuminate\Database\Query\Builder;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\LazyCollection;

class CloudPaymentsTransactionsRepository implements CloudPaymentsTransactionsRepositoryInterface
{
    public function __construct(
        private readonly CloudPaymentsAggregationJobParamsDto $aggregationJobParamsDto
    ) {

    }

    public function getAggregationDataCollection(): LazyCollection
    {
        return $this->joinAllInfo()->orderBy('main_query.date')->lazy(100)->chunk(100);
    }

    private function getPaymentsInfo(): Builder
    {
        return DB::table(CloudPaymentTransaction::TABLE)
            ->selectRaw('
                credential_id,
                description,
                SUM(payment_amount) as payments_sum,
                COUNT(*) as payments_count,
                DATE(created_date_iso) as date
            ')
            ->when($this->aggregationJobParamsDto->credential_id ?? null, function (Builder $query) {
                $query->where('credential_id', '=', $this->aggregationJobParamsDto->credential_id);
            })
            ->where('status', '=', 'Completed')
            ->when($this->aggregationJobParamsDto->date_from ?? null, function (Builder $query, $dateFrom) {
                $query->whereDate('created_date_iso', '>=', $dateFrom);
            })
            ->when($this->aggregationJobParamsDto->date_to ?? null, function (Builder $query, $dateTo) {
                $query->whereDate('created_date_iso', '<=', $dateTo);
            })
            ->groupBy('credential_id', 'date', 'description');
    }

    private function getRecurrentsInfo(): Builder
    {
        return DB::table(CloudPaymentTransaction::TABLE)
            ->selectRaw('
                credential_id,
                description,
                SUM(payment_amount) as recurrents_sum,
                COUNT(*) as recurrents_count,
                DATE(created_date_iso) as date
            ')
            ->whereNotNull('subscription_id')
            ->when($this->aggregationJobParamsDto->credential_id ?? null, function (Builder $query) {
                $query->where('credential_id', '=', $this->aggregationJobParamsDto->credential_id);
            })
            ->where('status', '=', 'Completed')
            ->when($this->aggregationJobParamsDto->date_from ?? null, function (Builder $query, $dateFrom) {
                $query->whereDate('created_date_iso', '>=', $dateFrom);
            })
            ->when($this->aggregationJobParamsDto->date_to ?? null, function (Builder $query, $dateTo) {
                $query->whereDate('created_date_iso', '<=', $dateTo);
            })
            ->groupBy('credential_id', 'date', 'description');
    }

    private function getDonationsInfo(): Builder
    {
        return DB::table(CloudPaymentTransaction::TABLE)
            ->selectRaw('
                credential_id,
                description,
                SUM(payment_amount) as donations_sum,
                COUNT(*) as donations_count,
                DATE(created_date_iso) as date
            ')
            ->whereNull('subscription_id')
            ->when($this->aggregationJobParamsDto->credential_id ?? null, function (Builder $query) {
                $query->where('credential_id', '=', $this->aggregationJobParamsDto->credential_id);
            })
            ->where('status', '=', 'Completed')
            ->when($this->aggregationJobParamsDto->date_from ?? null, function (Builder $query, $dateFrom) {
                $query->whereDate('created_date_iso', '>=', $dateFrom);
            })
            ->when($this->aggregationJobParamsDto->date_to ?? null, function (Builder $query, $dateTo) {
                $query->whereDate('created_date_iso', '<=', $dateTo);
            })
            ->groupBy('credential_id', 'date', 'description');
    }

    private function getNewRecurrentsInfo()
    {
        return DB::table(CloudPaymentTransaction::TABLE)
            ->selectRaw('
                credential_id,
                description,
                SUM(payment_amount) as new_recurrents_sum,
                COUNT(credential_id) as new_recurrents_count,
                DATE(created_date_iso) as date
            ')
            ->when($this->aggregationJobParamsDto->credential_id ?? null, function (Builder $query) {
                $query->where('credential_id', '=', $this->aggregationJobParamsDto->credential_id);
            })
            ->whereNotNull('subscription_id')
            ->where('status', '=', 'Completed')
            ->whereRaw("(created_date_iso, subscription_id) IN (SELECT MIN(created_date_iso), subscription_id
                FROM cloud_payment_transactions
                WHERE subscription_id IS NOT NULL"
                .
                (
                    isset($this->aggregationJobParamsDto->credential_id)
                    ? " AND credential_id = '{$this->aggregationJobParamsDto->credential_id}'" : " "
                )
                .
                "AND status = 'Completed'
                GROUP BY subscription_id)")
            ->when($this->aggregationJobParamsDto->date_from ?? null, function (Builder $query, $dateFrom) {
                $query->whereDate('created_date_iso', '>=', $dateFrom);
            })
            ->when($this->aggregationJobParamsDto->date_to ?? null, function (Builder $query, $dateTo) {
                $query->whereDate('created_date_iso', '<=', $dateTo);
            })
            ->groupBy('credential_id', 'date', 'description');
    }

    private function getCancelledInfo(): Builder
    {
        return DB::table(CloudPaymentTransaction::TABLE)
            ->selectRaw('
                credential_id,
                description,
                SUM(payment_amount) as payments_sum_cancelled,
                COUNT(*) as payments_count_cancelled,
                DATE(created_date_iso) as date
            ')
            ->whereNotNull('subscription_id')
            ->when($this->aggregationJobParamsDto->credential_id ?? null, function (Builder $query) {
                $query->where('credential_id', '=', $this->aggregationJobParamsDto->credential_id);
            })
            ->where('status', '=', 'Cancelled')
            ->when($this->aggregationJobParamsDto->date_from ?? null, function (Builder $query, $dateFrom) {
                $query->whereDate('created_date_iso', '>=', $dateFrom);
            })
            ->when($this->aggregationJobParamsDto->date_to ?? null, function (Builder $query, $dateTo) {
                $query->whereDate('created_date_iso', '<=', $dateTo);
            })
            ->groupBy('credential_id', 'date', 'description');
    }

    private function getDeclinedInfo(): Builder
    {
        return DB::table(CloudPaymentTransaction::TABLE)
            ->selectRaw('
                credential_id,
                description,
                SUM(payment_amount) as payments_sum_declined,
                COUNT(*) as payments_count_declined,
                DATE(created_date_iso) as date
            ')
            ->whereNotNull('subscription_id')
            ->when($this->aggregationJobParamsDto->credential_id ?? null, function (Builder $query) {
                $query->where('credential_id', '=', $this->aggregationJobParamsDto->credential_id);
            })
            ->where('status', '=', 'Declined')
            ->when($this->aggregationJobParamsDto->date_from ?? null, function (Builder $query, $dateFrom) {
                $query->whereDate('created_date_iso', '>=', $dateFrom);
            })
            ->when($this->aggregationJobParamsDto->date_to ?? null, function (Builder $query, $dateTo) {
                $query->whereDate('created_date_iso', '<=', $dateTo);
            })
            ->groupBy('credential_id', 'date', 'description');
    }

    private function joinAllInfo(): Builder
    {
        return DB::table(DB::table('cloud_payment_transactions')
            ->selectRaw('credential_id, description, DATE(created_date_iso) as date')
            ->when($this->aggregationJobParamsDto->credential_id ?? null, function (Builder $query) {
                $query->where('credential_id', '=', $this->aggregationJobParamsDto->credential_id);
            })
            ->when($this->aggregationJobParamsDto->date_from ?? null, function (Builder $query, $dateFrom) {
                $query->whereDate('created_date_iso', '>=', $dateFrom);
            })
            ->when($this->aggregationJobParamsDto->date_to ?? null, function (Builder $query, $dateTo) {
                $query->whereDate('created_date_iso', '<=', $dateTo);
            })
            ->groupBy('credential_id', 'date', 'description'), 'main_query')
            ->leftJoinSub($this->getPaymentsInfo(), 'payments_info', function (JoinClause $join){
                $join->on('main_query.credential_id', '=', 'payments_info.credential_id')
                    ->on('main_query.date', '=', 'payments_info.date')
                    ->on(function (JoinClause $additionalCondition) {
                        $additionalCondition->on('main_query.description', '=', 'payments_info.description')
                            ->orOn(function ($query) {
                                $query->whereNull(['main_query.description', 'payments_info.description']);
                            });
                    });
            })
            ->leftJoinSub($this->getRecurrentsInfo(), 'recurrents_info', function (JoinClause $join){
                $join->on('main_query.credential_id', '=', 'recurrents_info.credential_id')
                    ->on('main_query.date', '=', 'recurrents_info.date')
                    ->on(function (JoinClause $additionalCondition) {
                        $additionalCondition->on('main_query.description', '=', 'recurrents_info.description')
                            ->orOn(function ($query) {
                                $query->whereNull(['main_query.description', 'recurrents_info.description']);
                            });
                    });
            })
            ->leftJoinSub($this->getDonationsInfo(), 'donations_info', function (JoinClause $join){
                $join->on('main_query.credential_id', '=', 'donations_info.credential_id')
                    ->on('main_query.date', '=', 'donations_info.date')
                    ->on(function (JoinClause $additionalCondition) {
                        $additionalCondition->on('main_query.description', '=', 'donations_info.description')
                            ->orOn(function ($query) {
                                $query->whereNull(['main_query.description', 'donations_info.description']);
                            });
                    });
            })
            ->leftJoinSub($this->getNewRecurrentsInfo(), 'new_recurrents_info', function (JoinClause $join){
                $join->on('main_query.credential_id', '=', 'new_recurrents_info.credential_id')
                    ->on('main_query.date', '=', 'new_recurrents_info.date')
                    ->on(function (JoinClause $additionalCondition) {
                        $additionalCondition->on('main_query.description', '=', 'new_recurrents_info.description')
                            ->orOn(function ($query) {
                                $query->whereNull(['main_query.description', 'new_recurrents_info.description']);
                            });
                    });
            })
            ->leftJoinSub($this->getCancelledInfo(), 'cancelled_info', function (JoinClause $join){
                $join->on('main_query.credential_id', '=', 'cancelled_info.credential_id')
                    ->on('main_query.date', '=', 'cancelled_info.date')
                    ->on(function (JoinClause $additionalCondition) {
                        $additionalCondition->on('main_query.description', '=', 'cancelled_info.description')
                            ->orOn(function ($query) {
                                $query->whereNull(['main_query.description', 'cancelled_info.description']);
                            });
                    });
            })
            ->leftJoinSub($this->getDeclinedInfo(), 'declined_info', function (JoinClause $join){
                $join->on('main_query.credential_id', '=', 'declined_info.credential_id')
                    ->on('main_query.date', '=', 'declined_info.date')
                    ->on(function (JoinClause $additionalCondition) {
                        $additionalCondition->on('main_query.description', '=', 'declined_info.description')
                            ->orOn(function ($query) {
                                $query->whereNull(['main_query.description', 'declined_info.description']);
                            });
                    });
            })
            ->select(
                'main_query.credential_id',
                'main_query.description AS purpose',
                'main_query.date',
                'payments_info.payments_sum',
                'payments_info.payments_count',
                'recurrents_info.recurrents_sum',
                'recurrents_info.recurrents_count',
                'donations_info.donations_sum',
                'donations_info.donations_count',
                'new_recurrents_info.new_recurrents_sum',
                'new_recurrents_info.new_recurrents_count',
                'cancelled_info.payments_sum_cancelled',
                'cancelled_info.payments_count_cancelled',
                'declined_info.payments_sum_declined',
                'declined_info.payments_count_declined',
            )
            ->when($this->aggregationJobParamsDto->date_from ?? null, function (Builder $query, $dateFrom) {
                $query->whereDate('main_query.date', '>=', $dateFrom);
            })
            ->when($this->aggregationJobParamsDto->date_to ?? null, function (Builder $query, $dateTo) {
                $query->whereDate('main_query.date', '<=', $dateTo);
            });
    }
}