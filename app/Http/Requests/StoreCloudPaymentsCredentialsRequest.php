<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCloudPaymentsCredentialsRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'fund_id' => ['int', 'required'],
            'public_id' => ['string', 'required'],
            'api_secret' => ['string', 'required'],
            'date_start' => ['date_format:d.m.Y', 'required']
        ];
    }
}
