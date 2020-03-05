<?php
declare(strict_types=1);

namespace MStroink\OverheidIo\Api\Traits;

/**
 * @todo refactor
 */
trait PaginationTrait
{
    protected $next;
    protected $prev;
    protected $first;
    protected $last;

    abstract protected function performHttpCall(string $url): array;

    public function next(): ?array
    {
        return $this->next ? $this->performHttpCall($this->next) : null;
    }

    public function prev(): ?array
    {
        return $this->prev ? $this->performHttpCall($this->prev) : null;
    }

    public function first(): ?array
    {
        return $this->first ? $this->performHttpCall($this->first) : null;
    }

    public function last(): ?array
    {
        return $this->last ? $this->performHttpCall($this->last) : null;
    }

    protected function paginate(array $response)
    {
        $this->next = $response['_links']['next']['href'] ?? null;
        $this->prev = $response['_links']['previous']['href'] ?? null;
        $this->first = $response['_links']['first']['href'] ?? null;
        $this->last = $response['_links']['last']['href'] ?? null;
    }
}
