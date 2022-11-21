<?php

namespace Defro\ColourLovers;

use Defro\ColourLovers\Enum\Format;
use Defro\ColourLovers\Exception\BadStatusCodeException;
use Defro\ColourLovers\Exception\ColourLoversException;
use GuzzleHttp\Client;

class Api
{
    /** @var string */
    private string $endpointUri = 'http://www.colourlovers.com/api';

    /** @var Format */
    private Format $format = Format::xml;

    /** @var string */
    private string $jsonCallback;

    /**
     * @param Client $client
     */
    public function __construct(private Client $client)
    {
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws BadStatusCodeException
     *
     * @return array
     */
    public function getRandomPalette(): array
    {
        $data = [
            'format' => $this->format,
        ];
        if (!empty($this->jsonCallback)) {
            $data['jsonCallback'] = $this->jsonCallback;
        }
        $uri = $this->endpointUri.'/palettes/random?'.http_build_query($data);

        return $this->response($uri);
    }

    /**
     * @param string $hex
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws BadStatusCodeException
     *
     * @return array
     */
    public function getColor(string $hex): array
    {
        $data = [
            'format' => $this->format,
        ];
        if (!empty($this->jsonCallback)) {
            $data['jsonCallback'] = $this->jsonCallback;
        }
        $uri = $this->endpointUri.'/color/'.$hex.'?'.http_build_query($data);

        return $this->response($uri);
    }

    /**
     * @param int $id
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws BadStatusCodeException
     *
     * @return array
     */
    public function getPaletteById(int $id): array
    {
        $data = [
            'format' => $this->format,
        ];
        if (!empty($this->jsonCallback)) {
            $data['jsonCallback'] = $this->jsonCallback;
        }
        $uri = $this->endpointUri.'/palette/'.$id.'?'.http_build_query($data);

        return $this->response($uri);
    }

    /**
     * @param string $uri
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws BadStatusCodeException
     *
     * @return array
     */
    private function response(string $uri): array
    {
        $response = $this->client->get($uri);

        if ($response->getStatusCode() !== 200) {
            throw new BadStatusCodeException(
                sprintf('Could not connect to %s', $uri),
                $response->getStatusCode()
            );
        }

        $contents = $response->getBody()->getContents();

        if ($this->format === Format::xml) {
            $xml = simplexml_load_string($contents, \SimpleXMLElement::class, LIBXML_NOCDATA);
            $json = json_encode($xml);
        } elseif ($this->format === Format::json) {
            $json = $contents;
        } else {
            throw new ColourLoversException(sprintf('Unknown format "%s".', $this->format->name));
        }

        return json_decode($json, true);
    }
}
