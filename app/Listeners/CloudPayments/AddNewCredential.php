<?php

namespace App\Listeners\CloudPayments;

use App\Models\CloudPayments\CloudPaymentsNewCredential;

class AddNewCredential
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        $newCredential = new CloudPaymentsNewCredential();
        $newCredential->credential_id = $event->credential->id;
        $newCredential->save();
    }
}
