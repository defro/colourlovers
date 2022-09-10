<?php

namespace Defro\ColourLovers;

use Defro\ColourLovers\Exception\BadStatusCodeException;
use GuzzleHttp\Client;

class Api
{
    /** @var string  */
    private string $endpointUri = 'http://www.colourlovers.com/api';

    public function __construct(private Client $client)
    {
    }

    public function getRandomPalette()
    {
        $uri = $this->endpointUri . '/palettes/random';

        return $this->response($uri);
    }

    private function formatResponse(ResponseInterface $response)
    {
        $response = $this->client->get($uri);

        if ($response->getStatusCode() !== 200) {
            throw new BadStatusCodeException(
                sprintf('Could not connect to %s', $uri), $response->getStatusCode()
            );
        }

        $xml = $response->getBody()->getContents();
        $xml = simplexml_load_string($xml, \SimpleXMLElement::class, LIBXML_NOCDATA);
        $json = json_encode($xml);

        return json_decode($json, true);
    }
}