<?php
namespace MStroink\OverheidIo\Tests\Api;

use MStroink\OverheidIo\Api\Bag;

class BagTest extends ApiTestBase
{
    protected $resource = 'bag';

    public function getInstance()
    {
        return new Bag($this->clientMock);
    }
}
