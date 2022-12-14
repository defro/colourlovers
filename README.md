# ColourLovers API

[![Latest Version](https://img.shields.io/github/release/defro/colourlovers.svg?style=flat-square)](https://github.com/defro/colourlovers/releases)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)
[![Build Status](https://img.shields.io/travis/defro/colourlovers/master.svg?style=flat-square)](https://travis-ci.org/defro/colourlovers)
[![SymfonyInsight](https://insight.symfony.com/projects/7391765a-59d0-48e9-a53e-cb80b636592e/mini.svg)](https://insight.symfony.com/projects/bb6b7848-7e7a-4e9f-a25b-397369caeef5)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/defro/colourlovers/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/defro/colourlovers/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/defro/colourlovers/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/defro/colourlovers/?branch=master)
[![StyleCI](https://styleci.io/repos/156726302/shield)](https://styleci.io/repos/156726302)
[![Total Downloads](https://img.shields.io/packagist/dt/defro/colourlovers.svg?style=flat-square)](https://packagist.org/packages/defro/colourlovers)
[![Donate](https://img.shields.io/badge/Donate-PayPal-green.svg)](https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=MSER6KJHQM9NS)

This package can get quotes and their authors using [Colour Lovers API](http://www.colourlovers.com/api).

Here's a quick example:

```php
$client = new \GuzzleHttp\Client();
$colourLovers = new \Defro\ColourLovers\Api($client);
$randomPalette = $colourLovers
    ->getRandomPalette();

var_dump($randomPalette);
```

## Documentation

Read how to install, use this package, customize it on [documentation page](https://defro.github.io/colourlovers/).

## License

The MIT License (MIT). Please see [license file](LICENSE) for more information.
