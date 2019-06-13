<?php
declare(strict_types=1);

namespace MStroink\OverheidIo\Api\Traits;

trait QueryBuilderTrait
{
    private $query = [];

    public function fields(array $fields): self
    {
        $this->query['fields'] = $fields;

        return $this;
    }

    public function filters(array $filters): self
    {
        $this->query['filters'] = $filters;

        return $this;
    }

    public function limit(int $limit = 100): self
    {
        $this->query['size'] = $limit;

        return $this;
    }

    public function order(string $order = 'desc'): self
    {
        $this->query['ordering'] = $order;

        return $this;
    }

    public function page(int $page): self
    {
        $this->query['page'] = $page;

        return $this;
    }

    public function query(string $query): self
    {
        $this->query['query'] = $query;

        return $this;
    }

    public function queryFields(array $queryFields): self
    {
        $this->query['queryfields'] = $queryFields;

        return $this;
    }

    public function getQuery(): array
    {
        return $this->query;
    }
}
