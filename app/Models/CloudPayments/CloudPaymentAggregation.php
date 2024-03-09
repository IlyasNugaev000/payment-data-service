<?php

namespace App\Models\CloudPayments;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\CloudPayments\CloudPaymentAggregation
 *
 * @property int $id
 * @property string $public_id
 * @property string $date
 * @property string|null $payments_sum Сумма пожертвований
 * @property string|null $payments_count Количество пожертвований
 * @property string|null $recurrents_sum Сумма пожертований от рекуррентов
 * @property string|null $recurrents_count Количество пожертований от рекуррентов
 * @property string|null $donations_sum Сумма разовых пожертований
 * @property string|null $donations_count Количество разовых пожертований
 * @property string|null $new_recurrents_count Количество новых рекуррентов
 * @property string|null $new_recurrents_sum Сумма пожертвований от новых рекуррентов
 * @property string|null $payments_sum_completed Сумма успешных
 * @property string|null $payments_count_completed Количество успешных
 * @property string|null $payments_sum_cancelled Сумма отмененных
 * @property string|null $payments_count_cancelled Количество отмененных
 * @property string|null $payments_sum_declined Сумма отклоненных
 * @property string|null $payments_count_declined Количество отклоненных
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|CloudPaymentAggregation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CloudPaymentAggregation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CloudPaymentAggregation query()
 * @method static \Illuminate\Database\Eloquent\Builder|CloudPaymentAggregation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CloudPaymentAggregation whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CloudPaymentAggregation whereDonationsCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CloudPaymentAggregation whereDonationsSum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CloudPaymentAggregation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CloudPaymentAggregation whereNewRecurrentsCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CloudPaymentAggregation whereNewRecurrentsSum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CloudPaymentAggregation wherePaymentsCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CloudPaymentAggregation wherePaymentsCountCancelled($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CloudPaymentAggregation wherePaymentsCountCompleted($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CloudPaymentAggregation wherePaymentsCountDeclined($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CloudPaymentAggregation wherePaymentsSum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CloudPaymentAggregation wherePaymentsSumCancelled($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CloudPaymentAggregation wherePaymentsSumCompleted($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CloudPaymentAggregation wherePaymentsSumDeclined($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CloudPaymentAggregation wherePublicId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CloudPaymentAggregation whereRecurrentsCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CloudPaymentAggregation whereRecurrentsSum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CloudPaymentAggregation whereUpdatedAt($value)
 * @property int $credential_id
 * @method static \Illuminate\Database\Eloquent\Builder|CloudPaymentAggregation whereCredentialId($value)
 * @mixin \Eloquent
 */
class CloudPaymentAggregation extends Model
{
    use HasFactory;

    const TABLE = 'cloud_payment_aggregations';

    protected $fillable = [
        'public_id',
        'date',
        'payments_sum',
        'payments_count',
        'recurrents_sum',
        'recurrents_count',
        'donations_sum',
        'donations_count',
        'new_recurrents_sum',
        'new_recurrents_count',
        'payments_sum_completed',
        'payments_count_completed',
        'payments_sum_cancelled',
        'payments_count_cancelled',
        'payments_sum_declined',
        'payments_count_declined',
    ];
}
