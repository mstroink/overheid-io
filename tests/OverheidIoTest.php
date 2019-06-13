<?php
namespace MStroink\OverheidIo\Tests;

use MStroink\OverheidIo\OverheidIo;
use MStroink\OverheidIo\Http\HttpClientInterface;
use MStroink\OverheidIo\Api\Kvk;
use MStroink\OverheidIo\Api\Bag;
use MStroink\OverheidIo\Api\Rdw;
use PHPUnit\Framework\TestCase;

class OverheidIoTest extends TestCase
{
    /**
     * @var OverheidIo
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
