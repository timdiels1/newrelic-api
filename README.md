# New Relic API v2 client library for PHP

Copyright (c) 2017 [Tim Diels](https://github.com/timdiels1).

## Documentation

- [Installation](#installation)
- [Usage](#usage)
- [Endpoints](#endpoints)

### Installation

The wrapper is available on Packagist ([timdiels1/newrelic-api](http://packagist.org/packages/timdiels1/newrelic-api))
and can be installed using [Composer](http://getcomposer.org/):

```bash
composer require timdiels1/newrelic-api
```

### Usage

You will need an [Admin or REST API key from New Relic](https://docs.newrelic.com/docs/apis/rest-api-v2/requirements/new-relic-rest-api-v2-getting-started#api_key) to use the wrapper. The wrapper can either be used by instantiating endpoints directly.

```
use timdiels1\NewRelicApi\NewRelic;

$baseUrl = 'https://api.newrelic.com/v2/';
$apiKey = 'thisisnotrealyouwillneedanapikey';

$client = new Newrelic($baseUrl, $apiKey);
$isAvailable = $client->isAvailable();
```

### Endpoints

 * isAvailable()
 * getServers()
 
Other calls can be made by manually building a request using buildRequest and then calling it:

```
$response = $client->buildRequest($url, $method, $data);
```