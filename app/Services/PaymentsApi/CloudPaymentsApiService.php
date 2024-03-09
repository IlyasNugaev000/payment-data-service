<?php

namespace App\Services\PaymentsApi;

use App\Http\Middleware\GuzzleMiddleware;
use App\Models\CloudPayments\CloudPaymentCredential;
use App\Models\CloudPayments\CloudPaymentTransaction;
use App\Support\Dto\CloudPaymentDto;
use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use Illuminate\Support\Carbon;

class CloudPaymentsApiService
{
    /** @var Client */
    protected Client $client;

    public function __construct()
    {
        $handlerStack = HandlerStack::create();
        $retryMiddleware = GuzzleMiddleware::retryRequest(2);
        $handlerStack->push($retryMiddleware);

        $this->client = new Client([
            'handler' => $handlerStack,
            'base_uri' => config('payments.cloud_payments_base_url'),
            'http_errors' => true,
        ]);
    }

    /**
     * @param string $publicId
     * @param string $apiSecret
     * @return bool
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function testCredentials(string $publicId, string $apiSecret): bool
    {
        $data = [
            'headers' => ['Authorization' => [
                'Basic '.base64_encode($publicId.':'.decrypt($apiSecret))
                ]
            ]
        ];

        $response = $this->client->post(config('payments.cloud_payments_test'), $data);

        return $response->getStatusCode() === 200;
    }

    /**
     * @return void
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function storeCloudPaymentsData(CloudPaymentCredential $credential)
    {
        $startDate = Carbon::parse($credential->date_start);
        do {
            $this->storeTransactionsPerDay($startDate, $credential);
            $startDate->addDay();
        } while ($startDate <= now());
    }

    /**
     * @param Carbon $startDate
     * @param CloudPaymentCredential $credential
     * @return true
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function storeTransactionsPerDay(Carbon $startDate, CloudPaymentCredential $credential)
    {
        $page = 1;

        $dateStart = $startDate;
        $dateEnd = Carbon::parse($dateStart)->addDay();

        do {
            $query = [
                'headers' => ['Authorization' => [
                    'Basic '.base64_encode($credential->public_id . ':' . decrypt($credential->api_secret))
                    ]
                ],
                'query' => [
                    'CreatedDateGte' => $dateStart->format('Y-m-d'),
                    'CreatedDateLte' => $dateEnd->format('Y-m-d'),
                    'PageNumber' => $page
                ]
            ];

            $response = $this->client->post(config('payments.cloud_payments_list'), $query);
            logger()->info('iteration', $query);
            $data = json_decode($response->getBody()->getContents());

            $transactions = collect($data->Model);
            $transactions->each(function ($transaction) use ($query, $credential) {
                $transactionDto = CloudPaymentDto::from($transaction);
                CloudPaymentTransaction::query()->updateOrCreate([
                    'transaction_id' => $transactionDto->transaction_id
                ], array_merge($transactionDto->toArray(), ['credential_id' => $credential->id]));
                logger()->info('created', $query);
            });

            $page++;
        } while ($transactions->isNotEmpty());

        return true;
    }
}
