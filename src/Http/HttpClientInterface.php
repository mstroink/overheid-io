<?php
declare(strict_types=1);

namespace MStroink\OverheidIo\Http;

use Psr\Http\Message\ResponseInterface;

interface HttpClientInterface
{
    public function getUrl(string $url): ResponseInterface;

    public function getJson(ResponseInterface $response): string;
}
