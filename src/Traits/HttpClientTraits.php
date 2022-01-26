<?php

namespace Kingdeephp\K3cloud\Traits;

use GuzzleHttp\Client;

trait HttpClientTraits
{
    private array $defaultHeaders = [
        'Accept' => 'application/json',
        'Content-Type' => 'application/json',
        'Accept-Charset' => 'utf-8',
        'User-Agent' => 'Kingdee/Php WebApi SDK 7.3 (compatible; MSIE 6.0; Windows NT 5.1;SV1)',
    ];

    private array $defaultGuzzleOption = [
        'http_errors' => false,
    ];

    private $httpClient;

    public function __construct()
    {
        $this->httpClient = new Client(['cookies' => true]);
    }
}