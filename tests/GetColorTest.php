<?php

namespace Defro\ColourLovers\Tests;

use Defro\ColourLovers\Api;
use Defro\ColourLovers\Exception\BadStatusCodeException;
use GuzzleHttp\Client;

class GetColorTest extends BaseTest
{
    public function testGetColor()
    {
        $palette = $this->api->getRandomPalette();
        $colors = $palette['palette']['colors']['hex'];
        $result = $this->api->getColor($colors[array_rand($colors)]);

        $this->assertIsArray($result);
        $this->assertArrayHasKey('@attributes', $result);
        $this->assertIsArray($result['@attributes']);
        $this->assertArrayHasKey('numResults', $result['@attributes']);
        $this->assertEquals(1, $result['@attributes']['numResults']);
        $this->assertArrayHasKey('totalResults', $result['@attributes']);
        $this->assertNotEmpty($result['@attributes']['totalResults']);
        //$this->assertIsInt($result['@attributes']['totalResults']);
        $this->assertArrayHasKey('color', $result);

        $this->colorAsserts($result['color']);
    }

    public function testGetRandomPaletteBadStatusCode()
    {
        $client = $this->createMock(Client::class);
        $api = new Api($client);
        $this->expectException(BadStatusCodeException::class);
        $api->getRandomPalette();
    }
}
