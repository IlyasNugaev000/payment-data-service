<?php

namespace App\Support\Dto;

use App\Http\Requests\StoreCloudPaymentsCredentialsRequest;
use Carbon\Carbon;
use Spatie\LaravelData\Data;

class CloudPaymentsCredentialsDto extends Data
{
    public function __construct(
        public int $fund_id,
        public string $public_id,
        public string $api_secret,
        public Carbon $date_start
    ) {
    }

    public static function fromRequest(StoreCloudPaymentsCredentialsRequest $request)
    {
        return new self(
            $request->input('fund_id'),
            $request->input('public_id'),
            encrypt($request->input('api_secret')),
            Carbon::parse($request->input('date_start'))
        );
    }
}

