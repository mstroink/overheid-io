<?php
declare(strict_types=1);

namespace MStroink\OverheidIo\Api;

final class Kvk extends ApiAbstract
{
    public $resource = "openkvk";

    /**
     * @inheritdoc
     */
    public function suggest(string $search): array
    {
        return parent::suggest($search);
    }
}
