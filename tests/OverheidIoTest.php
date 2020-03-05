<?php
declare(strict_types=1);

namespace MStroink\OverheidIo\Tests;

use MStroink\OverheidIo\Api\Bag;
use MStroink\OverheidIo\Api\Kvk;
use MStroink\OverheidIo\Api\Rdw;
use MStroink\OverheidIo\Http\HttpClientInterface;
use MStroink\OverheidIo\OverheidIo;
use PHPUnit\Framework\TestCase;
use PHPUnit_Framework_MockObject_MockObject;

class OverheidIoTest extends TestCase
{
    /**
     * @var OverheidIo|PHPUnit_Framework_MockObject_MockObject
     */
    protected $overheidIo;

    public function setUp()
    {
        $clientMock = $this->getMockBuilder(HttpClientInterface::class)
            ->getMock();

        $this->overheidIo = new OverheidIo($clientMock);
    }

    public function testRdw()
    {
        $this->assertInstanceOf(Rdw::class, $this->overheidIo->rdw());
    }

    public function testKvk()
    {
        $this->assertInstanceOf(Kvk::class, $this->overheidIo->kvk());
    }

    public function testBag()
    {
        $this->assertInstanceOf(Bag::class, $this->overheidIo->bag());
    }
}
