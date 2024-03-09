<?php

namespace App\Services\CloudPayments;

use App\Models\CloudPayments\CloudPaymentCredential;
use App\Repositories\Interfaces\CloudPaymentsAggregationsRepositoryInterface;
use App\Repositories\Interfaces\CloudPaymentsCredentialRepositoryInterface;
use App\Repositories\Interfaces\CloudPaymentsTransactionsRepositoryInterface;
use App\Support\Dto\Aggregation\CloudPaymentsAggregationByFundResponseDto;
use App\Support\Dto\Aggregation\CloudPaymentsAggregationByPurposeRequestDto;
use App\Support\Dto\Aggregation\CloudPaymentsAggregationCollectionDto;
use App\Support\Dto\Aggregation\CloudPaymentsAggregationFrCampaignsRequestDto;
use App\Support\Dto\Aggregation\CloudPaymentsAggregationJobParamsDto;
use App\Support\Dto\Aggregation\CloudPaymentsAggregationByFundRequestDto;
use App\Support\Dto\Aggregation\CloudPaymentsAggregationByPurposeResponseDto;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\LazyCollection;

class CloudPaymentsAggregationsService
{
    public function __construct(
        private readonly CloudPaymentsAggregationsRepositoryInterface $cloudPaymentsAggregationsRepository,
        private readonly CloudPaymentsCredentialRepositoryInterface $cloudPaymentsCredentialRepository
    ) {

    }
    public function aggregation(): void
    {
        /** @var LazyCollection $credentialDataCollection */
        $credentialDataCollection = $this->cloudPaymentsCredentialRepository->getAll(['id']);

        $credentialDataCollection->each(function ($credentials) {
            /** @var CloudPaymentCredential $credential */
            foreach ($credentials as $credential) {
                if ($credential->aggregations()->exists()) {
                    $this->handle(
                        CloudPaymentsAggregationJobParamsDto::from([
                            'credential_id' => $credential->id,
                            'date_from' => Carbon::now()->subDays(4)->format('Y-m-d')
                        ])
                    );
                } else {
                    $this->handle(
                        CloudPaymentsAggregationJobParamsDto::from([
                            'credential_id' => $credential->id
                        ])
                    );
                };
            }
        });
    }

    public function handle(CloudPaymentsAggregationJobParamsDto $cloudPaymentsAggregationJobParamsDto)
    {
        $cloudPaymentsTransactionsRepository = resolve(
            CloudPaymentsTransactionsRepositoryInterface::class,
            ['aggregationJobParamsDto' => $cloudPaymentsAggregationJobParamsDto]
        );

        /** @var LazyCollection $lazyAggregationsDataCollection */
        $lazyAggregationsDataCollection = $cloudPaymentsTransactionsRepository->getAggregationDataCollection();

        $lazyAggregationsDataCollection->each(function ($chunkedAggregationsData) {
            $aggregationDataDto = CloudPaymentsAggregationCollectionDto::from(['aggregations' => $chunkedAggregationsData->toArray()]);
            $this->cloudPaymentsAggregationsRepository->save($aggregationDataDto);
        });
    }

    public function getAggregationsDataByFund(CloudPaymentsAggregationByFundRequestDto $requestDto): CloudPaymentsAggregationByFundResponseDto
    {
        /** @var \Illuminate\Support\Collection $credentials */
        $credentials = $this->cloudPaymentsAggregationsRepository->getCredentialsByFundId(
            $requestDto->fund_id
        );

        $aggregations = [];
        $frCampaignsData = [];

        $credentials->each(function (CloudPaymentCredential $credential) use(&$aggregations, &$frCampaignsData, $requestDto) {
            $aggregationDataByCredential = $this->cloudPaymentsAggregationsRepository
                ->getAggregationByCredential($credential, $requestDto->dateFrom, $requestDto->dateTo)
                ->toArray();

            $frCampaignsData[] = [
                'public_id' => $credential->public_id,
                'payments_sum' => $aggregationDataByCredential['payments_sum']
            ];

            foreach ($aggregationDataByCredential as $key => $value) {
                if (!isset($aggregations[$key])) {
                    $aggregations[$key] = 0;
                }
                $aggregations[$key] += $value;
            }
        });

        $aggregations['fr_campaigns'] = $frCampaignsData;

        return CloudPaymentsAggregationByFundResponseDto::from($aggregations);
    }

    public function getAggregationsDataByPurpose(CloudPaymentsAggregationByPurposeRequestDto $requestDto): CloudPaymentsAggregationByPurposeResponseDto
    {
        /** @var CloudPaymentCredential $credential */
        $credential = $this->cloudPaymentsAggregationsRepository->getCredentialByPublicId(
            $requestDto->public_id
        );

        $aggregationDataByCredential = $this->cloudPaymentsAggregationsRepository
            ->getAggregationByCredential(
                $credential,
                $requestDto->dateFrom,
                $requestDto->dateTo
            )
            ->toArray();

        $aggregationDataByCredential['payments_purpose'] = $this->cloudPaymentsAggregationsRepository
            ->getAggregationByPaymentsPurpose(
                $credential,
                $requestDto->dateFrom,
                $requestDto->dateTo
        )
        ->toArray();

        $aggregationDataByCredential = array_map(function($value) {
            return $value ?? 0;
        }, $aggregationDataByCredential);

        return CloudPaymentsAggregationByPurposeResponseDto::from($aggregationDataByCredential);
    }
}