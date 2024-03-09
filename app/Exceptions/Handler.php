<?php

namespace App\Exceptions;

use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        if (env('APP_ENV') !== 'local') {
            $this->renderable(function (QueryException $e) {
                report($e);

                return response()->json([
                    'success' => false,
                    'error' => 'Ошибка в sql запросе'
                ]);
            });

            $this->renderable(function (\Exception $e) {
                report($e);

                return response()->json([
                    'success' => false,
                    'error' => $e->getMessage()
                ]);
            });
        }
    }
}
