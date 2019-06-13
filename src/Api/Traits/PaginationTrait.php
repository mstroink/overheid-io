<?php
declare(strict_types=1);

namespace MStroink\OverheidIo\Api\Traits;

/**
 * @todo refactor
 */
trait PaginationTrait
{
    abstract protected function performHttpCall(string $url, array $query = []): array;

    public function next(array $response): ?array
    {
        $url = $response['_links']['next']['href'] ?? null;

        return (!empty($url)) ? $this->performHttpCall($url) : null;
    }

    public function prev(array $response): ?array
    {
        $url = $response['_links']['prev']['href'] ?? null;

        return (!empty($url)) ? $this->performHttpCall($url) : null;
    }

    public function first(array $response): ?array
    {
        $url = $response['_links']['first']['href'] ?? null;

        return (!empty($url)) ? $this->performHttpCall($url) : null;
    }

    public function last(array $response): ?array
    {
        $url = $response['_links']['last']['href'] ?? null;

        return (!empty($url)) ? $this->performHttpCall($url) : null;
    }
}
