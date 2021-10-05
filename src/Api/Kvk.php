<?php
declare(strict_types=1);

namespace MStroink\OverheidIo\Api;

final class Kvk extends Api
{
    public const RESOURCE = 'openkvk';

    protected function getResourceName(): string
    {
        return self::RESOURCE;
    }

    /**
     * {@inheritdoc}
     */
    public function suggest(string $search): array
    {
        return parent::suggest($search);
    }
}
