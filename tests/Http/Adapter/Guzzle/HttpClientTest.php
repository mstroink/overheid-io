<?php
namespace MStroink\OverheidIo\Tests\Http\Adapter\Guzzle;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use MStroink\OverheidIo\Http\Adapter\Guzzle\HttpClient;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;

class HttpClientTest extends TestCase
{
    protected $guzzleHttpClient;
    protected $mockHandler;

    public function setUp()
    {
        $this->mockHandler = new MockHandler();
        $handler = HandlerStack::create($this->mockHandler);
        $client = new Client(['handler' => $handler]);

        $this->guzzleHttpClient = new HttpClient($client);
    }

    /**
     * Test the call function of the GuzzleHttpClient class
     */
    public function testGetUrl()
    {
        $expected = [
            'merk' => 'dikke-bmw',
        ];

        $this->mockHandler->append(
            new Response(200, [], json_encode($expected))
        );

        $response = $this->guzzleHttpClient->getUrl('/voertuig/xx-xx-xx');

        $this->assertInstanceOf(ResponseInterface::class, $response);
        $this->assertSame($expected, json_decode($response->getBody()->getContents(), true));
    }

    public function testGetJson()
    {
        $expected = [
            'merk' => 'dikke-bmw',
        ];

        $response = new Response(200, [], json_encode($expected));
        $json = $this->guzzleHttpClient->getJson($response);

        $this->assertSame($json, json_encode($expected));
    }

    /**
     * @expectedException \MStroink\OverheidIo\Exception\NotFoundException
     */
    public function testGetUrlWith404Exception()
    {
        $this->mockHandler->append(new Response(404, [], json_encode([])));
        $this->guzzleHttpClient->getUrl('/voertuig/xx-xx-xx');
    }

    /**
     * @expectedException \MStroink\OverheidIo\Exception\NotFoundException
     * unfortunately overheid.io returns 500 when a resource is not found
     */
    public function testGetUrlWith500Exception()
    {
        $this->mockHandler->append(new Response(500, [], json_encode([])));
        $this->guzzleHttpClient->getUrl('/voertuig/xx-xx-xx');
    }

    /**
     * @expectedException \MStroink\OverheidIo\Exception\UnauthorizedException
     */
    public function testGetUrlWith401Exception()
    {
        $this->mockHandler->append(new Response(401, [], json_encode([])));
        $this->guzzleHttpClient->getUrl('/voertuig/xx-xx-xx');
    }

    /**
     * @expectedException \MStroink\OverheidIo\Exception\OverheidIoException
     */
    public function testGetUrlWithUnknownException()
    {
        $this->mockHandler->append(new Response(433, [], json_encode([])));
        $this->guzzleHttpClient->getUrl('/voertuig/xx-xx-xx');
    }
}
