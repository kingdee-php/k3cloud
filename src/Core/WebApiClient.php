<?php

namespace Kingdeephp\K3cloud\Core;

use GuzzleHttp\Cookie\CookieJar;
use GuzzleHttp\Cookie\SetCookie;
use Kingdeephp\K3cloud\Traits\HttpClientTraits;

class WebApiClient
{
    use HttpClientTraits;

    public $cookieJar;

    public function execute($url, $headers, $postData, $format)
    {
        $headers = $this->defaultHeaders + $headers;
        try {
            $response = $this->httpClient->post(
                $url,
                $this->defaultGuzzleOption + [
                    'headers' => $headers,
                    'json' => $postData
                ]
            );
            $res = $response->getBody()->getContents();
        } catch (\Throwable $exception) {
            print_r($exception->getMessage());
            die;
        }
        return $format == 'string' ? $res : json_decode($res, true);
    }
}