<?php
declare(strict_types=1);

namespace MStroink\OverheidIo\Api;

use MStroink\OverheidIo\Api\Traits\QueryBuilderTrait;
use MStroink\OverheidIo\Api\Traits\PaginationTrait;
use MStroink\OverheidIo\Http\HttpClientInterface;
use RuntimeException;

abstract class Api
{
    const BASE_URL = 'https://api.overheid.io';

    use QueryBuilderTrait;
    use PaginationTrait;

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

    abstract protected function getResourceName(): string;

    public function get(string $id): array
    {
        $url = sprintf('/%s/%s', $this->getResourceName(), $id);

        return $this->performHttpCall($url);
    }

    public function search(): array
    {
        $url = sprintf(
            '/%s%s',
            $this->getResourceName(),
            $this->buildQueryString($this->getQuery())
        );

        return $this->performHttpCall($url);
    }

    protected function suggest(string $search): array
    {
        $url = sprintf(
            '/suggest/%s/%s%s',
            $this->getResourceName(),
            $search,
            $this->buildQueryString($this->getQuery())
        );

        return $this->performHttpCall($url);
    }

    protected function performHttpCall(string $url): array
    {
        $response = $this->client->getUrl(self::BASE_URL . $url);
        $data = $this->jsonDecode($this->client->getJson($response));

        $this->paginate($data);
        $this->clearQuery();

        return $data;
    }

    private function jsonDecode(string $body): array
    {
        $data = json_decode($body, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new RuntimeException('Invalid json data');
        }

        return $data;
    }

    protected function buildQueryString(array $query): string
    {
        if (empty($query)) {
            return '';
        }

        return '?' . http_build_query($query, '', '&');
    }
}
