<?php

namespace Kingdeephp\K3cloud\Core\Log;

use Monolog\Handler\RotatingFileHandler;
use Monolog\ErrorHandler;
use Monolog\Logger;
use PDO;
use GuzzleHttp\Psr7\Request;

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
            || empty($config['mysql_log']['charset'])
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
        $charset = $config['mysql_log']['charset'] ?? 'utf8';
        $table = $config['mysql_log']['table'] ?? '';

        header('content-type:text/html;charset=' . $charset);
        $body = $httpResponse->getBody();
        //判断内容是否被消费
        if ($body->isSeekable()) {
            $body->rewind();
        }

        $timeConsume = 0;
        $_SERVER['REQUEST_TIME'] = time() - 2;
        if (!empty($_SERVER['REQUEST_TIME'])) {
            $requestTs = $_SERVER['REQUEST_TIME'];
            $timeConsume = (time() - $requestTs) * 1000;
        }

        $insertSql = "INSERT INTO {$table} set ";
        $insertSql .= "request_ts = '" . date('Y-m-d H:i:s') . "',";
        $insertSql .= "request_ip = '" . ($_SERVER['REMOTE_ADDR'] ?? '') . "',";
        $insertSql .= "request_mac = '',";
        $insertSql .= "path = '" . addslashes($url) . "',";
        $insertSql .= "method = '{$method}',";
        $insertSql .= "request_header = '" . addslashes(json_encode($headers)) . "',";
        $insertSql .= "request_body = '" . addslashes(json_encode($postData)) . "',";
        $insertSql .= "time_consume = '" . $timeConsume . "',";
        $insertSql .= "response_status =  '" . json_encode($httpResponse->getStatusCode()) . "',";
        $insertSql .= "response_header = '" . addslashes(json_encode($httpResponse->getHeaders())) . "',";
        $insertSql .= "response_body = '" . addslashes($httpResponse->getBody()->getContents()) . "';";

        try {
            $db = new PDO('mysql:host=' . $host . ';port:' . $port . ';dbname=' . $dbName, $user, $pass);
            $db->exec($insertSql);
        } catch (\PDOException $e) {
            //todo error log
            print "sqlError!: " . $e->getMessage();
        }

        return true;
    }
}
