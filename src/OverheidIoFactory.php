<?php
declare(strict_types=1);

namespace MStroink\OverheidIo;

use MStroink\OverheidIo\Http\Adapter\Guzzle\HttpClient;
use MStroink\OverheidIo\Http\HttpClientInterface;
use GuzzleHttp\Middleware;
use GuzzleHttp\HandlerStack;
use Psr\Http\Message\RequestInterface;

final class OverheidIoFactory
{
    public static function create(string $apiKey): OverheidIo
    {
        return new OverheidIo(
            self::createHttpClient($apiKey)
        );
    }

    public static function createHttpClient(string $apiKey): HttpClientInterface
    {
        $stack = HandlerStack::create();
        $stack->unshift(Middleware::mapRequest(function (RequestInterface $request) use ($apiKey) {
            return $request->withHeader('ovio-api-key', $apiKey);
        }));

        return new HttpClient(
            new \GuzzleHttp\Client(['handler' => $stack])
        );
    }
}
