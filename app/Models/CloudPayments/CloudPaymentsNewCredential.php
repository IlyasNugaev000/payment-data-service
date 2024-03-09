<?php

namespace App\Models\CloudPayments;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\CloudPayments\CloudPaymentsNewCredential
 *
 * @property int $id
 * @property int $credential_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|CloudPaymentsNewCredential newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CloudPaymentsNewCredential newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CloudPaymentsNewCredential query()
 * @method static \Illuminate\Database\Eloquent\Builder|CloudPaymentsNewCredential whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CloudPaymentsNewCredential whereCredentialId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CloudPaymentsNewCredential whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CloudPaymentsNewCredential whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class CloudPaymentsNewCredential extends Model
{
    use HasFactory;
}
