<?php

namespace App\Http\Controllers\Api\Payments;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCloudPaymentsCredentialsRequest;
use App\Models\CloudPayments\CloudPaymentCredential;
use App\Services\CloudPayments\CloudPaymentsService;
use App\Support\Dto\CloudPaymentsCredentialsDto;

class PaymentsController extends Controller
{
    public function __construct(
        private readonly CloudPaymentsService $cloudPaymentsService
    ) {
    }

    /**
     * @param StoreCloudPaymentsCredentialsRequest $request
     * @return CloudPaymentCredential
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function storeCloudPaymentsCredentials(StoreCloudPaymentsCredentialsRequest $request): CloudPaymentCredential
    {
        $dto = CloudPaymentsCredentialsDto::fromRequest($request);
        return $this->cloudPaymentsService->storeCredentials($dto->toArray());
    }
}
