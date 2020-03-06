<?php
declare(strict_types=1);

namespace MStroink\OverheidIo\Http\Adapter\Guzzle;

use Exception;
use Psr\Http\Message\ResponseInterface;
use MStroink\OverheidIo\Http\Adapter\Guzzle\Exception\ExceptionHandler;
use MStroink\OverheidIo\Http\HttpClientInterface;
use GuzzleHttp\Exception\TransferException;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Psr7\Request;
use RuntimeException;

final class HttpClient implements HttpClientInterface
{
    /**
     * @var ClientInterface
     */
    private $guzzleClient;

    public function __construct(ClientInterface $guzzleClient)
    {
        $this->guzzleClient = $guzzleClient;
    }

    public function getUrl(string $url): ResponseInterface
    {
        $request = new Request('GET', $url, ['Accept' => 'application/json']);

        try {
            return $this->guzzleClient->send($request);
        } catch (TransferException $exception) {
            ExceptionHandler::handleRequestException($exception);
        }
    }

    public function getJson(ResponseInterface $response): string
    {
        return $response->getBody()->getContents();
    }
}
