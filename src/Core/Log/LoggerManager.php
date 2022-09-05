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

    public static function createMysqlLog($url, $headers, $postData, $method, $config, object $httpResponse)
    {
        $host = $config['mysql_log']['host'] ?? '127.0.0.1';
        $port = $config['mysql_log']['port'] ?? 3306;
        $dbName = $config['mysql_log']['database'] ?? '';
        $user = $config['mysql_log']['username'] ?? 'root';
        $pass = $config['mysql_log']['password'] ?? '';
        $charset = $config['mysql_log']['charset'] ?? 'utf8';
        $table = $config['mysql_log']['table'] ?? '`tb_log`.tb_log_api_access';

        header('content-type:text/html;charset=' . $charset);

        $body = $httpResponse->getBody();
        if ($body->isSeekable()) {
            $body->rewind();
        }

        $insertSql = "INSERT INTO {$table} set ";
        $insertSql .= "request_ts = '" . date('Y-m-d H:i:s') . "',";
        $insertSql .= "request_ip = '" . ($_SERVER['REMOTE_ADDR'] ?? '') . "',";
        $insertSql .= "request_mac = '',";
        $insertSql .= "path = '{$url}',";
        $insertSql .= "method = '{$method}',";
        $insertSql .= "request_header = '" . json_encode($headers) . "',";
        $insertSql .= "request_body = '" . json_encode($postData) . "',";
        $insertSql .= "response_status =  '" . json_encode($httpResponse->getStatusCode()) . "',";
        $insertSql .= "response_header = '" . json_encode($httpResponse->getHeaders()) . "',";
        $insertSql .= "response_body = " . json_encode($httpResponse->getBody()->getContents());

        // print_r($insertSql);
        // die;
        // return $insertSql;

        try {
            //查询
            $db = new PDO('mysql:host=' . $host . ';port:' . $port . ';dbname=' . $dbName, $user, $pass);
            $db->beginTransaction();
            $data = $db->query('SELECT * FROM `tb_log`.`tb_log_api_access` ORDER BY `id` DESC LIMIT 1;');
            foreach ($data as $row) {
                print_r($row);
            }


            var_dump($data);
            // $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // $result = $db->query($insertSql);
            // print_r($result);
            // die;
            // $db->commit();
            // $db = null;
        } catch (\PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
        // print_r($data);
        //     die;
    }
}
