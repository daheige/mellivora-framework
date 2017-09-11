<?php

namespace App\Commands;

use Mellivora\Console\Command as MellivoraCommand;
use Psr\Log\NullLogger;

abstract class Command extends MellivoraCommand
{
    /**
     * 日志记录器
     *
     * @var \Monolog\Logger
     */
    protected $logger;

    /**
     * 获取当前的 logger
     *
     * @return \Monolog\Logger
     */
    public function getLogger()
    {
        if (!$this->logger) {
            $this->logger = new NullLogger;
        }

        return $this->logger;
    }
}
