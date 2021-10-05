<?php
declare(strict_types=1);

namespace MStroink\OverheidIo\Api;

final class Rdw extends Api
{
    public const RESOURCE = 'voertuiggegevens';

    protected function getResourceName(): string
    {
        return self::RESOURCE;
    }
}
