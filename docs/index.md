---
layout: default
---

This library writing in PHP make request easier to make API request to ColourLovers API.

# Installation

Use Composer to install this package as a requirement like this :
```bash
composer require defro/colourlovers
```

# Usage

## Initialization
```php
$client = new \GuzzleHttp\Client();
$api = new \Defro\Google\ColourLovers\Api($client);
```

## Get random palette
```php
$palette = $api->getRandomPalette();
```

## Get color by hexadecimal
```php
$imgUrl = $api->getColor('FFFFFF');
```

## Get palette by ID
```php
$imgUrl = $api->getPaletteById(414237);
```

# Run it locally in a Docker container

You can run example script and unit tests in included Docker container, [read how to do it](./docker.md).
