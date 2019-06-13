<?php
namespace MStroink\OverheidIo\Tests\Api;

use MStroink\OverheidIo\Api\Kvk;
use GuzzleHttp\Psr7\Response;

class KvkTest extends ApiTestBase
{
    protected $resource = 'openkvk';

    public function getInstance()
    {
        return new Kvk($this->clientMock);
    }

    public function testSuggest()
    {
        $searchString = 'valken';
        $data = ['handelsnaam' => [0 => ['text' => 'valken']]];
        $response = new Response(200, [], json_encode($data));

        $this->clientMock
            ->expects($this->once())
            ->method('getUrl')
            ->with(
                $this->equalTo($this->baseUrl . '/suggest/' . $this->resource . '/' . $searchString),
                $this->equalTo(['fields' => ['handelsnaam']])
            )
            ->will($this->returnValue($response));
        
        $this->clientMock
            ->expects($this->once())
            ->method('getJson')
            ->with($this->equalTo($response))
            ->will($this->returnValue(json_encode($data)));

        $result = $this->getInstance()
            ->fields(['handelsnaam'])
            ->suggest($searchString);

        $this->assertEquals($data, $result);
    }
}
