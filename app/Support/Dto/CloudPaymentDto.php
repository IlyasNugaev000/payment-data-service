<?php

namespace App\Support\Dto;

use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Normalizers\ArrayableNormalizer;
use Spatie\LaravelData\Normalizers\ArrayNormalizer;
use Spatie\LaravelData\Normalizers\JsonNormalizer;
use Spatie\LaravelData\Normalizers\ModelNormalizer;
use Spatie\LaravelData\Normalizers\ObjectNormalizer;

class CloudPaymentDto extends Data
{
    public function __construct(
        #[MapInputName('PublicId')]      //public_id
        public string $public_id,
        #[MapInputName('TransactionId')]     //id транзакции
        public ?int $transaction_id,
        #[MapInputName('TerminalUrl')]       //Ссылка на сайт
        public ?string $terminal_url,
        #[MapInputName('Amount')]            //Полная сумма платежа (сколько списали у пользователя)
        public ?float $amount,
        #[MapInputName('Currency')]          //Валюта
        public ?string $currency,
        #[MapInputName('CurrencyCode')]      //Код валюты
        public ?int $currency_code,
        #[MapInputName('PaymentAmount')]     //Сумма платежа после вычета комиссии платежного провайдера (чистая сумма)
        public ?float $payment_amount,
        #[MapInputName('PaymentCurrency')]   //Валюта
        public ?string $payment_currency,
        #[MapInputName('PaymentCurrencyCode')]   //код валюты
        public ?int $payment_currency_code,
        #[MapInputName('InvoiceId')]         //ID чека
        public ?string $invoice_id,
        #[MapInputName('AccountId')]         //ID плательщика
        public ?string $account_id,
        #[MapInputName('Email')]             //Email плательщика
        public ?string $email,
        #[MapInputName('ReasonCode')]        //Причина отказа
        public ?int $reason_code,
        #[MapInputName('Description')]       //Описание платежа
        public ?string $description,
        #[MapInputName('JsonData')]          //Кастомные метаданные платежа
        public ?string $json_data,
        #[MapInputName('CreatedDate')]       //Время создания платежа
        public ?string $created_date,
        #[MapInputName('PayoutDate')]        //Дата-Время выплаты
        public ?string $payout_date,
        #[MapInputName('PayoutDateIso')]     //Дата-Время выплаты
        public ?string $payout_date_iso,
        #[MapInputName('PayoutAmount')]      //сумма выплаты
        public ?float $payout_amount,
        #[MapInputName('CreatedDateIso')]    //Время создания платежа
        public ?string $created_date_iso,
        #[MapInputName('AuthDate')]          //Дата-Время авторизации транзакции
        public ?string $auth_date,
        #[MapInputName('AuthDateIso')]       //Дата-Время авторизации транзакции
        public ?string $auth_date_iso,
        #[MapInputName('ConfirmDate')]       //Дата-Время подтверждения транзакции
        public ?string $confirm_date,
        #[MapInputName('ConfirmDateIso')]    //Дата-Время подтверждения транзакции
        public ?string $confirm_date_iso,
        #[MapInputName('AuthCode')]          //Код авторизации
        public ?string $auth_code,
        #[MapInputName('TestMode')]          //Тестовый шлюз? Если TRUE значит платеж провели по тестовой карте (и наоборот), вот их список https://developers.cloudpayments.ru/#testirovanie
        public ?bool $test_mode,
        #[MapInputName('Rrn')]               //возможно это ККТ, но это не точно
        public ?string $rrn,
        #[MapInputName('OriginalTransactionId')] //ID оригинальной транзакции, т.е. какой платеж был возвращен если это возврат
        public ?int $original_transaction_id,
        #[MapInputName('FallBackScenarioDeclinedTransactionId')] //Номер первой неуспешной транзакции
        public ?int $fall_back_scenario_declined_transaction_id,
        #[MapInputName('IpAddress')]         //координаты платежа
        public ?string $ip_address,
        #[MapInputName('IpCountry')]         //координаты платежа
        public ?string $ip_country,
        #[MapInputName('IpCity')]            //координаты платежа
        public ?string $ip_city,
        #[MapInputName('IpRegion')]          //координаты платежа
        public ?string $ip_region,
        #[MapInputName('IpDistrict')]        //координаты платежа
        public ?string $ip_district,
        #[MapInputName('IpLatitude')]        //координаты платежа
        public ?string $ip_latitude,
        #[MapInputName('IpLongitude')]       //координаты платежа
        public ?string $ip_longitude,
        #[MapInputName('CardFirstSix')]      //Первые 6 цифр карты
        public ?string $card_first_six,
        #[MapInputName('CardLastFour')]      //Последние 4 цифры карты
        public ?string $card_last_four,
        #[MapInputName('CardExpDate')]       //Срок карты
        public ?string $card_exp_date,
        #[MapInputName('CardType')]          //Тип карты
        public ?string $card_type,
        #[MapInputName('CardProduct')]       //DEBIT, CREDIT, TNW, N, N1, SAP, F, CPP, MNW, TWB, WBE, MLP, C, TPL и много других, хз для чего используется
        public ?string $card_product,
        #[MapInputName('CardCategory')]      //категория карты (CLASSIC, PLATINUM, DEBIT, ELECTRON, etc.)
        public ?string $card_category,
        #[MapInputName('EscrowAccumulationId')]  //ID счета эскроу
        public ?int $escrow_accumulation_id,
        #[MapInputName('IssuerBankCountry')]     //Страна банка владельца карты
        public ?string $issuer_bank_country,
        #[MapInputName('Issuer')]                //Банк владельца карты
        public ?string $issuer,
        #[MapInputName('CardTypeCode')]          //неизвестно
        public ?int $card_type_code,
        #[MapInputName('Status')]                //Статусы операций, вот справочник https://developers.cloudpayments.ru/#statusy-operatsiy
        public ?string $status,
        #[MapInputName('StatusCode')]            //Статус платежа, ID
        public ?int $status_code,
        #[MapInputName('CultureName')]           //неизвестно, тут либо локаль того места откуда пользователь совершал платеж, либо какая-то другая локаль
        public ?string $culture_name,
        #[MapInputName('Reason')]                // Причина отказа, текст
        public ?string $reason,
        #[MapInputName('CardHolderMessage')]     //Системное сообщение, обычно текст ошибки для пользователя
        public ?string $card_holder_message,
        #[MapInputName('Type')]                  //неизвестно
        public ?int $type,
        #[MapInputName('Refunded')]              //Был ли платеж частично или полностью возвращен
        public bool $refunded,
        #[MapInputName('Name')]                  //Имя владельца карты
        public ?string $name,
        #[MapInputName('Token')]                 //Оплата по токену
        public ?string $token,
        #[MapInputName('SubscriptionId')]        //ID подписки
        public ?string $subscription_id,
        #[MapInputName('GatewayName')]           //Название шлюза, через который прошла транзакция
        public ?string $gateway_name,
        #[MapInputName('ApplePay')]              //Оплата была через ApplePay
        public bool $apple_pay,
        #[MapInputName('AndroidPay')]            //Оплата была через AndroidPay
        public bool $android_pay,
        #[MapInputName('WalletType')]            //неизвестно, может тип кошелька
        public ?string $wallet_type,
        #[MapInputName('TotalFee')]              //Сумма комиссии платежного провайдера
        public ?float $total_fee,
        #[MapInputName('IsLocalOrder')]          //неизвестно
        public bool $is_local_order,
        #[MapInputName('Gateway')]               //ID шлюза
        public ?int $gateway,
        #[MapInputName('MasterPass')]            //неизвестно
        public bool $master_pass,
        #[MapInputName('InfoShopData')]          //неизвестно, информация о магазине
        public ?string $info_shop_data,
    ) {
    }

    public static function normalizers(): array
    {
        return [
            ModelNormalizer::class,
            ArrayableNormalizer::class,
            ObjectNormalizer::class,
            ArrayNormalizer::class,
            JsonNormalizer::class,
        ];
    }
}
