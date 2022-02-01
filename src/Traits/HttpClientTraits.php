<?php

namespace Kingdeephp\K3cloud\Traits;

use GuzzleHttp\Client;

trait HttpClientTraits
{
    private array $defaultHeaders = [
        'Accept' => 'application/json',
        'Content-Type' => 'application/json',
        'Accept-Charset' => 'utf-8',
        'User-Agent' => 'Kingdee/Php WebApi SDK (compatible: K3Cloud 7.3+)',
    ];

    private array $defaultGuzzleOption = [
        'http_errors' => false,
    ];

    private Client $httpClient;

    public function __construct()
    {
        $this->httpClient = new Client(['cookies' => true]);
    }
}
