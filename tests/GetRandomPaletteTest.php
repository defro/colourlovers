<?php

namespace Defro\ColourLovers\Tests;

use Defro\ColourLovers\Api;
use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;

class GetRandomPaletteTest extends TestCase
{
    public function testGetRandomPalette()
    {
        $api = new Api(new Client());
        $result = $api->getRandomPalette();

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
        $this->assertIsArray($result['palette']);
        $this->assertArrayHasKey('id', $result['palette']);
        $this->assertNotEmpty($result['palette']['id']);
        //$this->assertIsInt($result['@attributes']['totalResults']);
        $this->assertArrayHasKey('colors', $result['palette']);
        $this->assertNotEmpty($result['palette']['colors']);
        $this->assertArrayHasKey('hex', $result['palette']['colors']);
        $this->assertNotEmpty($result['palette']['colors']['hex']);
        foreach ($result['palette']['colors']['hex'] as $hex) {
            $this->assertNotEmpty($hex);
            $this->assertMatchesRegularExpression('/^[0-9A-Fa-f]{6}$/', $hex);
        }
    }

    /*
    public function testGetRandomPaletteBadStatusCode()
    {
        $client = $this->createMock(Client::class);
        $api = new Api($client);
        $result = $api->getRandomPalette();
    }
    */
}
