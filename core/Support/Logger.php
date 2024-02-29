<?php

namespace Core\support;

use Monolog\Handler\StreamHandler;
use Monolog\Level;

class Logger
{
    use Singleton;

    protected \Monolog\Logger $logger;

    protected function __construct()
    {
        $this->logger =  new \Monolog\Logger('name');
        $this->logger->pushHandler(new StreamHandler(ABSPATH.'/my.log', Level::Notice));
    }


    public static function notice(string $msg): void
    {
        $instance =  self::instance();
        $instance->logger->notice($msg);
    }
}
