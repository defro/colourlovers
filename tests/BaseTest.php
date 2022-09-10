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

    protected function colorAsserts($color)
    {
        $this->assertIsArray($color);
        $this->assertArrayHasKey('id', $color);
        $this->assertNotEmpty($color['id']);
        $this->assertArrayHasKey('title', $color);
        $this->assertNotEmpty($color['title']);
        $this->assertArrayHasKey('userName', $color);
        $this->assertNotEmpty($color['userName']);
        $this->assertArrayHasKey('numViews', $color);
        $this->assertArrayHasKey('numVotes', $color);
        $this->assertArrayHasKey('numComments', $color);
        $this->assertArrayHasKey('numHearts', $color);
        $this->assertArrayHasKey('rank', $color);
        $this->assertArrayHasKey('dateCreated', $color);
        $this->assertIsObject(\DateTimeImmutable::createFromFormat('Y-m-d H:i:s', $color['dateCreated']));
        $this->assertArrayHasKey('hex', $color);
        $this->assertNotEmpty($color['hex']);
        $this->assertArrayHasKey('description', $color);
        $this->assertNotEmpty($color['description']);

        $this->assertArrayHasKey('rgb', $color);
        $this->assertNotEmpty($color['rgb']);
        $this->assertArrayHasKey('red', $color['rgb']);
        $this->assertGreaterThanOrEqual(0, $color['rgb']['red']);
        $this->assertArrayHasKey('green', $color['rgb']);
        $this->assertGreaterThanOrEqual(0, $color['rgb']['green']);
        $this->assertArrayHasKey('blue', $color['rgb']);
        $this->assertGreaterThanOrEqual(0, $color['rgb']['blue']);

        $this->assertArrayHasKey('hsv', $color);
        $this->assertNotEmpty($color['hsv']);
        $this->assertArrayHasKey('hue', $color['hsv']);
        $this->assertGreaterThanOrEqual(0, $color['hsv']['hue']);
        $this->assertArrayHasKey('saturation', $color['hsv']);
        $this->assertGreaterThanOrEqual(0, $color['hsv']['saturation']);
        $this->assertArrayHasKey('value', $color['hsv']);
        $this->assertGreaterThanOrEqual(0, $color['hsv']['value']);

        $this->assertArrayHasKey('url', $color);
        $this->assertNotFalse(parse_url($color['url']));
        $this->assertArrayHasKey('imageUrl', $color);
        $this->assertNotFalse(parse_url($color['imageUrl']));
        $this->assertArrayHasKey('badgeUrl', $color);
        $this->assertNotFalse(parse_url($color['badgeUrl']));
        $this->assertArrayHasKey('apiUrl', $color);
        $this->assertNotFalse(parse_url($color['apiUrl']));
    }
}
