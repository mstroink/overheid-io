<?php
namespace MStroink\OverheidIo\Tests\Api;

use PHPUnit\Framework\TestCase;
use MStroink\OverheidIo\Http\HttpClientInterface;
use GuzzleHttp\Psr7\Response;
use MStroink\OverheidIo\Api\ApiAbstract;

abstract class ApiTestBase extends TestCase
{
    protected $baseUrl = ApiAbstract::BASE_URL;
    protected $clientMock;

    abstract public function getInstance();

    public function setUp()
    {
        $this->clientMock = $this->getMockBuilder(HttpClientInterface::class)->getMock();
    }

    public function testGet()
    {
        $data = ['data' => '123'];
        $response = new Response(200, [], json_encode($data));

        $this->clientMock
            ->expects($this->once())
            ->method('getUrl')
            ->with(
                $this->equalTo($this->baseUrl . '/' . $this->resource . '/abc'),
                $this->equalTo([])
            )
            ->will($this->returnValue($response));
        
        $this->clientMock
            ->expects($this->once())
            ->method('getJson')
            ->with($this->equalTo($response))
            ->will($this->returnValue(json_encode($data)));
        
        $result = $this->getInstance()->get('abc');

        $this->assertEquals($data, $result);
    }

    public function testSearch()
    {
        $data = [];
        $response = new Response(200, [], json_encode($data));

        $this->clientMock
            ->expects($this->once())
            ->method('getUrl')
            ->with(
                $this->equalTo($this->baseUrl . '/' . $this->resource),
                $this->equalTo([])
            )
            ->will($this->returnValue($response));
        
        $this->clientMock
            ->expects($this->once())
            ->method('getJson')
            ->with($this->equalTo($response))
            ->will($this->returnValue(json_encode($data)));

        $result = $this->getInstance()->search();

        $this->assertEquals($data, $result);
    }

    public function testSearchWithQeury()
    {
        $expected = [
            'size' => 20,
            'page' => 3,
            'ordering' => 'asc',
            'fields' => ['fieldname'],
            'filters' => ['postcode' => '9999AB'],
            'query' => 'd*size*',
            'queryfields' => ['straat']
        ];

        $api = $this->getInstance()
            ->limit(20)
            ->page(3)
            ->order('asc')
            ->fields(['fieldname'])
            ->filters(['postcode' => '9999AB'])
            ->query('d*size*')
            ->queryfields(['straat']);

        $this->clientMock
            ->expects($this->once())
            ->method('getUrl')
            ->with(
                $this->equalTo($this->baseUrl . '/' . $this->resource),
                $this->equalTo($expected)
            )
            ->will($this->returnValue(new Response()));

        $this->clientMock
            ->expects($this->once())
            ->method('getJson')
            ->will($this->returnValue(json_encode([])));

        $this->assertEquals($expected, $api->getQuery());

        $api->search();
    }
}
