<?php

namespace kingdeephp\k3cloud\Core;

use kingdeephp\k3cloud\Traits\HttpClientTraits;

class WebApiClient
{
    use HttpClientTraits;

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

        }
        return $format == 'string' ? $res : json_decode($res, true);
    }
}