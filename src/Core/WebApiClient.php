<?php

namespace Kingdeephp\K3cloud\Core;

use Kingdeephp\K3cloud\Traits\HttpClientTraits;
use Kingdeephp\K3cloud\Core\Log\LoggerManager;

class WebApiClient
{
    use HttpClientTraits {
        HttpClientTraits::__construct as private __httpClientTraitsConstruct;
    }

    private array $config = [];

    public function __construct($config)
    {
        $this->__httpClientTraitsConstruct();
        $this->config = $config;
    }

    public function execute($url, $headers, $postData, $format)
    {
        $logId = strtoupper(md5(uniqid(rand(), true)));
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
            $sqlLogResult = LoggerManager::createMysqlLog($url, $headers, $postData, 'post', $this->config, $response);
            print_r($sqlLogResult);
            die;
            if (!empty($this->config['k3cloud_log'])) {
                list($usec, $sec) = explode(" ", microtime());
                LoggerManager::createDailyDriver($this->config['k3cloud_log']['name'], $this->config['k3cloud_log']['path'])
                    ->info('apiLog', [
                    'log_id' => $logId,
                    'request_time' => '时间：' . date('Y-m-d H:i:s') . "毫秒时间戳" . ((float)$usec + (float)$sec),
                    'request_url' => $url,
                    'request_header' => $headers,
                    'request_body' => $postData,
                    'response_status' => $response->getStatusCode(),
                    'response_header' => $response->getHeaders(),
                    'response_body' => json_decode($res, true),
                ]);
            }
        } catch (\Throwable $exception) {
            if (!empty($this->config['k3cloud_log'])) {
                LoggerManager::createDailyDriver($this->config['k3cloud_log']['name'], $this->config['k3cloud_log']['path'])
                    ->info('apiLog_exception', [
                    'log_id' => $logId,
                    'request_time' => date('Y-m-d H:i:s'),
                    'request_url' => $url,
                    'request_header' => $headers,
                    'request_body' => $postData,
                    'exception' => $exception->getMessage(),
                    'file' => $exception->getFile(),
                    'line' => $exception->getLine(),
                    'code' => $exception->getCode(),
                ]);
            }
            die;
        }
        return $format == 'string' ? $res : json_decode($res, true);
    }

    public function buildHeader($service_url, $config)
    {
        //$path_url = parse_url($service_url, PHP_URL_PATH);
        $path_url = str_replace('/', '%2F', $service_url);
        $time_stamp = time();    // 1643627187
        $nonce = $time_stamp;
        $arr = explode('_', $config['appid']);
        $client_id = $arr[0];
        $client_sec = $this->decodeAppSecret($arr[1]);
        $api_sign = 'POST\n' . $path_url . '\n\nx-api-nonce:' . $nonce . '\nx-api-timestamp:' . $time_stamp . '\n';
        $app_data = $config['acct_id'] . ',' . $config['username'] . ',' . ($this->config['lcid'] ?? 2052) . ',' . ($this->config['org_num'] ?? 0);
        return [
            'X-Api-Auth-Version' => '2.0',
            'X-Api-ClientID' => $client_id,
            'x-api-timestamp' => $time_stamp,
            'x-api-nonce' => $nonce,
            'x-api-signheaders' => 'x-api-timestamp,x-api-nonce',
            'X-Api-Signature' => $this->kd_HmacSHA256($api_sign, $client_sec),
            'X-Kd-Appkey' => $config['appid'],
            'X-Kd-Appdata' => base64_encode($app_data),
            'X-Kd-Signature' => $this->kd_HmacSHA256($config['appid'] . $app_data, $config['appsecret']),
        ];
    }

    function kd_HmacSHA256($content, $sign_key)
    {
        $signature = hash_hmac('sha256', $content, $sign_key, true);
        $sign_hex = bin2hex($signature);
        return base64_encode($sign_hex);
    }

    function decodeAppSecret($secret)
    {
        if (strlen($secret) != 32) {
            print('sec:' . $secret . ' is not 32 char' . PHP_EOL);
            return $secret;
        }
        // $xor_code = '0054s3974c62343787b09ca7d32e5debce72';      // example from official Python SDK
        $xor_code = '0054f397c6234378b09ca7d3e5debce7';             // example from official Java SDK
        $base64_decode = base64_decode($secret);
        $base64_xor = $base64_decode ^ $xor_code;
        //$base64_xor = $this->xor_code($base64_decode, $xor_code);
        return base64_encode($base64_xor);
    }

    function xor_code($string, $key)
    {
        for ($i = 0; $i < strlen($string); $i++) {
            $string[$i] = ($string[$i] ^ $key[$i]);
        }
        return $string;
    }

    /*
     *
     *返回字符串的毫秒数时间戳
     */
    private function geTotalMillisecond()
    {
        $time = explode(" ", microtime());
        $time = $time [1] . ($time [0] * 1000);
        $time2 = explode(".", $time);
        $time = $time2 [0];
        return $time;
    }
}
