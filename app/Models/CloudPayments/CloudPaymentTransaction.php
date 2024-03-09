<?php

namespace App\Models\CloudPayments;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\CloudPaymentTransaction
 *
 * @mixin Builder
 * @property int $id
 * @property string $public_id
 * @property string $terminal_url
 * @property int $transaction_id
 * @property string $amount
 * @property string|null $currency
 * @property int|null $currency_code
 * @property string $payment_amount
 * @property string|null $payment_currency
 * @property int|null $payment_currency_code
 * @property string|null $invoice_id
 * @property string|null $account_id
 * @property string|null $email
 * @property string|null $description
 * @property mixed|null $json_data
 * @property string|null $created_date
 * @property string|null $payout_date
 * @property string|null $payout_date_iso
 * @property string|null $payout_amount
 * @property string|null $created_date_iso
 * @property string|null $auth_date
 * @property string|null $auth_date_iso
 * @property string|null $confirm_date
 * @property string|null $confirm_date_iso
 * @property string|null $auth_code
 * @property int $test_mode
 * @property string|null $rrn
 * @property int|null $original_transaction_id
 * @property int|null $fall_back_scenario_declined_transaction_id
 * @property string|null $ip_address
 * @property string|null $ip_country
 * @property string|null $ip_city
 * @property string|null $ip_region
 * @property string|null $ip_district
 * @property string|null $ip_latitude
 * @property string|null $ip_longitude
 * @property string|null $card_first_six
 * @property string|null $card_last_four
 * @property string|null $card_exp_date
 * @property string|null $card_type
 * @property string|null $card_product
 * @property string|null $card_category
 * @property string|null $issuer_bank_country
 * @property string|null $issuer
 * @property int|null $card_type_code
 * @property string $status
 * @property int $status_code
 * @property string|null $culture_name
 * @property string|null $reason
 * @property string|null $card_holder_message
 * @property int $type
 * @property int $refunded
 * @property string|null $name
 * @property string|null $token
 * @property string|null $subscription_id
 * @property int|null $is_local_order
 * @property int|null $gateway
 * @property string|null $gateway_name
 * @property int $apple_pay
 * @property int $android_pay
 * @property string|null $wallet_type
 * @property int $master_pass
 * @property string $total_fee
 * @property int|null $reason_code
 * @property int|null $escrow_accumulation_id
 * @property string|null $info_shop_data
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static Builder|CloudPaymentTransaction newModelQuery()
 * @method static Builder|CloudPaymentTransaction newQuery()
 * @method static Builder|CloudPaymentTransaction query()
 * @method static Builder|CloudPaymentTransaction whereAccountId($value)
 * @method static Builder|CloudPaymentTransaction whereAmount($value)
 * @method static Builder|CloudPaymentTransaction whereAndroidPay($value)
 * @method static Builder|CloudPaymentTransaction whereApplePay($value)
 * @method static Builder|CloudPaymentTransaction whereAuthCode($value)
 * @method static Builder|CloudPaymentTransaction whereAuthDate($value)
 * @method static Builder|CloudPaymentTransaction whereAuthDateIso($value)
 * @method static Builder|CloudPaymentTransaction whereCardCategory($value)
 * @method static Builder|CloudPaymentTransaction whereCardExpDate($value)
 * @method static Builder|CloudPaymentTransaction whereCardFirstSix($value)
 * @method static Builder|CloudPaymentTransaction whereCardHolderMessage($value)
 * @method static Builder|CloudPaymentTransaction whereCardLastFour($value)
 * @method static Builder|CloudPaymentTransaction whereCardProduct($value)
 * @method static Builder|CloudPaymentTransaction whereCardType($value)
 * @method static Builder|CloudPaymentTransaction whereCardTypeCode($value)
 * @method static Builder|CloudPaymentTransaction whereConfirmDate($value)
 * @method static Builder|CloudPaymentTransaction whereConfirmDateIso($value)
 * @method static Builder|CloudPaymentTransaction whereCreatedAt($value)
 * @method static Builder|CloudPaymentTransaction whereCreatedDate($value)
 * @method static Builder|CloudPaymentTransaction whereCreatedDateIso($value)
 * @method static Builder|CloudPaymentTransaction whereCultureName($value)
 * @method static Builder|CloudPaymentTransaction whereCurrency($value)
 * @method static Builder|CloudPaymentTransaction whereCurrencyCode($value)
 * @method static Builder|CloudPaymentTransaction whereDescription($value)
 * @method static Builder|CloudPaymentTransaction whereEmail($value)
 * @method static Builder|CloudPaymentTransaction whereEscrowAccumulationId($value)
 * @method static Builder|CloudPaymentTransaction whereFallBackScenarioDeclinedTransactionId($value)
 * @method static Builder|CloudPaymentTransaction whereFundId($value)
 * @method static Builder|CloudPaymentTransaction whereGateway($value)
 * @method static Builder|CloudPaymentTransaction whereGatewayName($value)
 * @method static Builder|CloudPaymentTransaction whereId($value)
 * @method static Builder|CloudPaymentTransaction whereInfoShopData($value)
 * @method static Builder|CloudPaymentTransaction whereInvoiceId($value)
 * @method static Builder|CloudPaymentTransaction whereIpAddress($value)
 * @method static Builder|CloudPaymentTransaction whereIpCity($value)
 * @method static Builder|CloudPaymentTransaction whereIpCountry($value)
 * @method static Builder|CloudPaymentTransaction whereIpDistrict($value)
 * @method static Builder|CloudPaymentTransaction whereIpLatitude($value)
 * @method static Builder|CloudPaymentTransaction whereIpLongitude($value)
 * @method static Builder|CloudPaymentTransaction whereIpRegion($value)
 * @method static Builder|CloudPaymentTransaction whereIsLocalOrder($value)
 * @method static Builder|CloudPaymentTransaction whereIssuer($value)
 * @method static Builder|CloudPaymentTransaction whereIssuerBankCountry($value)
 * @method static Builder|CloudPaymentTransaction whereJsonData($value)
 * @method static Builder|CloudPaymentTransaction whereMasterPass($value)
 * @method static Builder|CloudPaymentTransaction whereName($value)
 * @method static Builder|CloudPaymentTransaction whereOriginalTransactionId($value)
 * @method static Builder|CloudPaymentTransaction wherePaymentAmount($value)
 * @method static Builder|CloudPaymentTransaction wherePaymentCurrency($value)
 * @method static Builder|CloudPaymentTransaction wherePaymentCurrencyCode($value)
 * @method static Builder|CloudPaymentTransaction wherePayoutAmount($value)
 * @method static Builder|CloudPaymentTransaction wherePayoutDate($value)
 * @method static Builder|CloudPaymentTransaction wherePayoutDateIso($value)
 * @method static Builder|CloudPaymentTransaction wherePublicId($value)
 * @method static Builder|CloudPaymentTransaction whereReason($value)
 * @method static Builder|CloudPaymentTransaction whereReasonCode($value)
 * @method static Builder|CloudPaymentTransaction whereRefunded($value)
 * @method static Builder|CloudPaymentTransaction whereRrn($value)
 * @method static Builder|CloudPaymentTransaction whereStatus($value)
 * @method static Builder|CloudPaymentTransaction whereStatusCode($value)
 * @method static Builder|CloudPaymentTransaction whereSubscriptionId($value)
 * @method static Builder|CloudPaymentTransaction whereTerminalUrl($value)
 * @method static Builder|CloudPaymentTransaction whereTestMode($value)
 * @method static Builder|CloudPaymentTransaction whereToken($value)
 * @method static Builder|CloudPaymentTransaction whereTotalFee($value)
 * @method static Builder|CloudPaymentTransaction whereTransactionId($value)
 * @method static Builder|CloudPaymentTransaction whereType($value)
 * @method static Builder|CloudPaymentTransaction whereUpdatedAt($value)
 * @method static Builder|CloudPaymentTransaction whereWalletType($value)
 * @property int $credential_id
 * @method static Builder|CloudPaymentTransaction whereCredentialId($value)
 * @mixin \Eloquent
 */
class CloudPaymentTransaction extends Model
{
    use HasFactory;

    const TABLE = 'cloud_payment_transactions';

    protected $fillable = [
        'credential_id',
        'public_id',
        'transaction_id',
        'terminal_url',
        'amount',
        'currency',
        'currency_code',
        'payment_amount',
        'payment_currency',
        'payment_currency_code',
        'invoice_id',
        'account_id',
        'email',
        'reason_code',
        'description',
        'json_data',
        'created_date',
        'payout_date',
        'payout_date_iso',
        'payout_amount',
        'created_date_iso',
        'auth_date',
        'auth_date_iso',
        'confirm_date',
        'confirm_date_iso',
        'auth_code',
        'test_mode',
        'rrn',
        'original_transaction_id',
        'fall_back_scenario_declined_transaction_id',
        'ip_address',
        'ip_country',
        'ip_city',
        'ip_region',
        'ip_district',
        'ip_latitude',
        'ip_longitude',
        'card_first_six',
        'card_last_four',
        'card_exp_date',
        'card_type',
        'card_product',
        'card_category',
        'escrow_accumulation_id',
        'issuer_bank_country',
        'issuer',
        'card_type_code',
        'status',
        'status_code',
        'culture_name',
        'reason',
        'card_holder_message',
        'type',
        'refunded',
        'name',
        'token',
        'subscription_id',
        'gateway_name',
        'apple_pay',
        'android_pay',
        'wallet_type',
        'total_fee',
        'is_local_order',
        'gateway',
        'master_pass',
        'info_shop_data',
    ];
}
