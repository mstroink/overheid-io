<?php
declare(strict_types=1);

namespace MStroink\OverheidIo\Api;

use MStroink\OverheidIo\Api\Traits\QueryBuilderTrait;
use MStroink\OverheidIo\Api\Traits\PaginationTrait;
use MStroink\OverheidIo\Http\HttpClientInterface;

abstract class ApiAbstract
{
    const BASE_URL = "https://api.overheid.io";

    use QueryBuilderTrait,
        PaginationTrait;
 
    /**
     * @var HttpClientInterface
     */
    private $client;

    /**
     * @var string
     */
    protected $resource;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    public function get(string $id): array
    {
        return $this->performHttpCall(sprintf('/%s/%s', $this->getResource(), $id));
    }

    public function search(): array
    {
        return $this->performHttpCall(
            sprintf('/%s', $this->getResource()),
            $this->getQuery()
        );
    }

    protected function suggest(string $search): array
    {
        return $this->performHttpCall(
            sprintf('/suggest/%s/%s', $this->getResource(), $search),
            $this->getQuery()
        );
    }

    protected function performHttpCall(string $url, array $query = []): array
    {
        $json = $this->client->getJson(
            $this->client->getUrl(self::BASE_URL . $url, $query)
        );

        return $this->jsonDecode($json);
    }

    private function jsonDecode(string $json): array
    {
        return json_decode($json, true);
    }

    private function getResource(): string
    {
        return $this->resource;
    }
}
