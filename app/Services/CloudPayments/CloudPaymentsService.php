<?php

namespace App\Services\CloudPayments;

use App\Models\CloudPayments\CloudPaymentCredential;
use App\Services\PaymentsApi\CloudPaymentsApiService;
use Exception;

class CloudPaymentsService
{
    /**
     * @param array $data
     * @return CloudPaymentCredential
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function storeCredentials(array $data): CloudPaymentCredential
    {
        $credentials = CloudPaymentCredential::query()
            ->firstWhere([
                'fund_id' => $data['fund_id'],
                'public_id' => $data['public_id']
            ]);
        $apiService = new CloudPaymentsApiService();
        $isSuccessful = $apiService->testCredentials($data['public_id'], $data['api_secret']);

        if (!$isSuccessful) {
            throw new Exception("Cannot connect");
        }

        if ($credentials) {
            abort(422, 'CloudPayments credentials already exists');
        }

        return CloudPaymentCredential::query()->create($data);
    }
}
