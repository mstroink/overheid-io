<?php
namespace MStroink\OverheidIo\Tests\Api;

use MStroink\OverheidIo\Api\Rdw;

class RdwTest extends ApiTestBase
{
    protected $resource = 'voertuiggegevens';

    public function getInstance()
    {
        return new Rdw($this->clientMock);
    }
}
