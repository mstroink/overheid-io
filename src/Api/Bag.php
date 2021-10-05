<?php
declare(strict_types=1);

namespace MStroink\OverheidIo\Api;

final class Bag extends Api
{
    public const RESOURCE = 'bag';

    protected function getResourceName(): string
    {
        return self::RESOURCE;
    }
}
