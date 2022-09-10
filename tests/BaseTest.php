<?php

namespace Defro\ColourLovers\Tests;

use Defro\ColourLovers\Api;
use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;

class BaseTest extends TestCase
{
    protected Api $api;

    public function setUp(): void
    {
        parent::setUp();

        $this->api = new Api(new Client());
    }

    public function testTrue()
    {
        $this->assertTrue(true);
    }

    protected function paletteAsserts($palette)
    {
        $this->assertIsArray($palette);
        $this->assertArrayHasKey('id', $palette);
        $this->assertNotEmpty($palette['id']);
        $this->assertArrayHasKey('colors', $palette);
        $this->assertNotEmpty($palette['colors']);
        $this->assertArrayHasKey('hex', $palette['colors']);
        $this->assertNotEmpty($palette['colors']['hex']);
        foreach ($palette['colors']['hex'] as $hex) {
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
