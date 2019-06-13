<?php
declare(strict_types=1);

namespace MStroink\OverheidIo\Http\Adapter\Guzzle;

use GuzzleHttp\ClientInterface;
use Psr\Http\Message\ResponseInterface;
use MStroink\OverheidIo\Http\Adapter\Guzzle\Exception\ExceptionHandler;
use MStroink\OverheidIo\Http\HttpClientInterface;
use GuzzleHttp\Exception\TransferException;

final class HttpClient implements HttpClientInterface
{
    /**
     * @var \GuzzleHttp\Client
     */
    private $guzzleClient;

    public function __construct(ClientInterface $guzzleClient)
    {
        $this->guzzleClient = $guzzleClient;
    }

    public function getUrl(string $url, array $query = []): ResponseInterface
    {
        try {
            return $this->guzzleClient->get($url, [
                'query' => $query,
                'headers' => [
                    'Accept' => 'application/json'
                ]
            ]);
        } catch (TransferException $exception) {
            ExceptionHandler::handleRequestException($exception);
        }
    }

    public function getJson(ResponseInterface $response): string
    {
        return $response->getBody()->getContents();
    }
}
