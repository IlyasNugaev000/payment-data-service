<?php

namespace App\Http\Controllers\Api\Aggregations;

use App\Http\Controllers\Controller;
use App\Services\CloudPayments\CloudPaymentsAggregationsService;
use App\Support\Dto\Aggregation\CloudPaymentsAggregationByPurposeRequestDto;
use App\Support\Dto\Aggregation\CloudPaymentsAggregationByFundRequestDto;
use Illuminate\Http\Response;

class AggregationsController extends Controller
{
    public function __construct(
        private readonly CloudPaymentsAggregationsService $cloudPaymentsAggregationsService
    ) {
    }

    /**
     * @param CloudPaymentsAggregationByFundRequestDto $requestDto
     * @return Response
     */
    public function getAggregationsDataByFund(CloudPaymentsAggregationByFundRequestDto $requestDto): Response
    {
        return response()->api($this->cloudPaymentsAggregationsService->getAggregationsDataByFund($requestDto));
    }

    /**
     * @param CloudPaymentsAggregationByPurposeRequestDto $requestDto
     * @return Response
     */
    public function getAggregationsDataByPurpose(CloudPaymentsAggregationByPurposeRequestDto $requestDto): Response
    {
        return response()->api($this->cloudPaymentsAggregationsService->getAggregationsDataByPurpose($requestDto));
    }
}
