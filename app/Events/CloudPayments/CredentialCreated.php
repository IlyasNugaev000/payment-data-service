<?php

namespace App\Events\CloudPayments;

use App\Models\CloudPayments\CloudPaymentCredential;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CredentialCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(public CloudPaymentCredential $credential)
    {
    }
}
