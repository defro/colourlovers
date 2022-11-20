<?php

namespace Defro\ColourLovers\Tests;

use Defro\ColourLovers\Api;
use Defro\ColourLovers\Exception\BadStatusCodeException;
use GuzzleHttp\Client;

class GetRandomPaletteTest extends BaseTest
{
    public function testGetRandomPalette()
    {
        $result = $this->api->getRandomPalette();

        $this->assertIsArray($result);
        $this->assertArrayHasKey('@attributes', $result);
        $this->assertIsArray($result['@attributes']);
        $this->assertArrayHasKey('numResults', $result['@attributes']);
        $this->assertNotEmpty($result['@attributes']['numResults']);
        //$this->assertIsInt($result['@attributes']['numResults']);
        $this->assertArrayHasKey('totalResults', $result['@attributes']);
        $this->assertNotEmpty($result['@attributes']['totalResults']);
        //$this->assertIsInt($result['@attributes']['totalResults']);
        $this->assertArrayHasKey('palette', $result);

        $this->paletteAsserts($result['palette']);
    }

    public function testGetRandomPaletteBadStatusCode()
    {
        $client = $this->createMock(Client::class);
        $api = new Api($client);
        $this->expectException(BadStatusCodeException::class);
        $api->getRandomPalette();
    }
}
