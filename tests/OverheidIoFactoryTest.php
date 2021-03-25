<?php

declare(strict_types=1);

namespace MStroink\Test\OverheidIo;

use MStroink\OverheidIo\OverheidIo;
use MStroink\OverheidIo\OverheidIoFactory;
use PHPUnit\Framework\TestCase;

class OverheidIoFactoryTest extends TestCase
{
    public function testCreate()
    {
        $client = OverheidIoFactory::create('apikey');

        $this->assertInstanceOf(OverheidIo::class, $client);
    }
}
