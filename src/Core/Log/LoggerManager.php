<?php

namespace Kingdeephp\K3cloud\Core\Log;

use Monolog\Handler\RotatingFileHandler;
use Monolog\ErrorHandler;
use Monolog\Logger;

class LoggerManager
{
    public array $config = [];

    public static function createDailyDriver($name, $path, $level = 'info', $days = 14)
    {
        // print_r($config);die;
        $log = new Logger($name);
        $path = $path . '/' . $name . '.log';

        return $log->pushHandler(new RotatingFileHandler(
            $path,
            $days,
            $level
        ));
    }
}
