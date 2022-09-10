<?php

namespace Defro\ColourLovers;

use Defro\ColourLovers\Exception\BadStatusCodeException;
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use Psr\Http\Message\ResponseInterface;
use Sabre\Xml\Service;

class Api
{
    /** @var Client  */
    private Client $client;

    /** @var string  */
    private string $endpointUri = 'http://www.colourlovers.com/api';

    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    public function getRandomPalette()
    {
        $uri = $this->endpointUri . '/palettes/random';

        $response = $this->client->get($uri);

        if ($response->getStatusCode() !== 200) {
            throw new BadStatusCodeException(
                sprintf('Could not connect to %s', $uri), $response->getStatusCode()
            );
        }

        return $this->formatResponse($response);
    }

    private function formatResponse(ResponseInterface $response)
    {
        $xml = $response->getBody()->getContents();
        $xml = simplexml_load_string($xml, \SimpleXMLElement::class, LIBXML_NOCDATA);
        $json = json_encode($xml);

        return json_decode($json, true);

    }
}