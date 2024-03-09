<?php
namespace App\Http\Middleware;

use GuzzleHttp\Middleware;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\RequestException;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class GuzzleMiddleware
{
    /**
     * @param int $numberOfRetries
     * @return callable
     */
    public static function retryRequest(int $numberOfRetries): callable
    {
        return Middleware::retry(
            self::retryDecider($numberOfRetries),
            self::exponentialDelay()
        );
    }

    /**
     * @param int $numberOfRetries
     * @return \Closure
     */
    public static function retryDecider(int $numberOfRetries): \Closure
    {
        return function (
            $retries,
            RequestInterface $request,
            ResponseInterface $response = null,
            RequestException|ConnectException $exception = null
        ) use ($numberOfRetries) {
            if ($retries >= $numberOfRetries) {
                return false;
            }

            // Retry connection exceptions
            if ($exception instanceof ConnectException) {
                return true;
            }

            if ($response) {
                // Retry on server errors
                if ($response->getStatusCode() >= 500) {
                    return true;
                }
            }

            return false;
        };
    }

    /**
     * @return \Closure
     */
    public static function exponentialDelay()
    {
        return function ($retries) {
            return (int) pow(2, $retries - 1);
        };
    }
}
