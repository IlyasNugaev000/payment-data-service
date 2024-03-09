<?php

namespace App\Models\CloudPayments;

use App\Events\CloudPayments\CredentialCreated;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\CloudPaymentCredential
 *
 * @property int $id
 * @property int $fund_id
 * @property string $public_id
 * @property string $api_secret
 * @property string|null $date_start
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|CloudPaymentCredential newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CloudPaymentCredential newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CloudPaymentCredential query()
 * @method static \Illuminate\Database\Eloquent\Builder|CloudPaymentCredential whereApiSecret($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CloudPaymentCredential whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CloudPaymentCredential whereDateStart($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CloudPaymentCredential whereFundId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CloudPaymentCredential whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CloudPaymentCredential wherePublicId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CloudPaymentCredential whereUpdatedAt($value)
 * @property string|null $name
 * @method static \Illuminate\Database\Eloquent\Builder|CloudPaymentCredential whereName($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\CloudPayments\CloudPaymentAggregation> $aggregations
 * @property-read int|null $aggregations_count
 * @mixin \Eloquent
 */
class CloudPaymentCredential extends Model
{
    use HasFactory;

    const TABLE = 'cloud_payment_credentials';

    protected $fillable = [
        'fund_id',
        'public_id',
        'api_secret',
        'date_start'
    ];

    protected $dispatchesEvents = [
        'created' => CredentialCreated::class
    ];

    public function aggregations()
    {
        return $this->hasMany(CloudPaymentAggregation::class, 'credential_id');
    }
}
