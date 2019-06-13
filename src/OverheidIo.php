<?php
declare(strict_types=1);

namespace MStroink\OverheidIo;

use MStroink\OverheidIo\Http\HttpClientInterface;
use MStroink\OverheidIo\Api\Bag;
use MStroink\OverheidIo\Api\Kvk;
use MStroink\OverheidIo\Api\Rdw;

final class OverheidIo
{
    /**
     * @var HttpClientInterface
     */
    protected $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    public function rdw(): Rdw
    {
        return new Rdw($this->client);
    }

    public function kvk(): Kvk
    {
        return new Kvk($this->client);
    }

    public function bag(): Bag
    {
        return new Bag($this->client);
    }
}
