<?php

namespace Kingdeephp\K3cloud\Core\Log;

use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;
use PDO;

class LoggerManager
{
    public static function createDailyDriver($name, $path, $level = 'info', $days = 14)
    {
        $log = new Logger($name);
        $path = $path . '/' . $name . '.log';

        return $log->pushHandler(new RotatingFileHandler(
            $path,
            $days,
            $level
        ));
    }

    public static function createMysqlLog($url, $headers, $postData, $method, $config, object $httpResponse): bool
    {
        if (
            empty($config['mysql_log']['host'])
            || empty($config['mysql_log']['port'])
            || empty($config['mysql_log']['database'])
            || empty($config['mysql_log']['username'])
            || empty($config['mysql_log']['password'])
            || empty($config['mysql_log']['table'])
        ) {
            return true;
        }

        $config['mysql_log']['table'] = $config['mysql_log']['database'] . "." . $config['mysql_log']['table'];

        $host = $config['mysql_log']['host'] ?? '127.0.0.1';
        $port = $config['mysql_log']['port'] ?? 3306;
        $dbName = $config['mysql_log']['database'] ?? '';
        $user = $config['mysql_log']['username'] ?? 'root';
        $pass = $config['mysql_log']['password'] ?? '';
        $table = $config['mysql_log']['table'] ?? '';

        $body = $httpResponse->getBody();
        //判断内容是否被消费
        if ($body->isSeekable()) {
            $body->rewind();
        }

        $timeConsume = 0;
        if (!empty($_SERVER['REQUEST_TIME'])) {
            $requestTs = $_SERVER['REQUEST_TIME'];
            $timeConsume = (time() - $requestTs) * 1000;
        }

        $request_ts = date('Y-m-d H:i:s');
        $request_ip = $_SERVER['REMOTE_ADDR'] ?? '';
        $path = addslashes($url) ?? '';
        $request_header = addslashes(json_encode($headers)) ?? '[]';
        $request_body = addslashes(json_encode($postData)) ?? '[]';
        $response_status = $httpResponse->getStatusCode() ?? 0;
        $response_header = addslashes(json_encode($httpResponse->getHeaders())) ?? '[]';
        $response_body = $httpResponse->getBody()->getContents() ?? '';
        $httpResponse->getBody()->rewind();

        if (empty(json_decode($response_body, true))) {
            $response_body = json_encode([$response_body]);
        }

        $response_body = addslashes($response_body);

        $insertSql = "INSERT INTO {$table} set ";
        $insertSql .= "request_ts = '" . $request_ts . "',";
        $insertSql .= "request_ip = '" . $request_ip . "',";
        $insertSql .= "path = '" . $path . "',";
        $insertSql .= "method = '{$method}',";
        $insertSql .= "request_header = '" . $request_header . "',";
        $insertSql .= "request_body = '" . $request_body . "',";
        $insertSql .= "time_consume = '" . $timeConsume . "',";
        $insertSql .= "response_status =  '" . $response_status . "',";
        $insertSql .= "response_header = '" . $response_header . "',";
        $insertSql .= "response_body = '" . $response_body . "';";

        try {
            $db = new PDO('mysql:host=' . $host . ';port:' . $port . ';dbname=' . $dbName, $user, $pass);
            $db->exec($insertSql);
        } catch (\PDOException $e) {
            //todo error log
            // print "sqlError!: " . $e->getMessage();
        }

        return true;
    }
}
