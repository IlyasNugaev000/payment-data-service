<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ResponseServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot()
    {
        response()->macro('api', function ($data = null) {
            $customFormat['success'] = true;

            if ($data !== null) {
                $customFormat['data'] = $data;
            }

            return response()->make($customFormat);
        });
    }
}
