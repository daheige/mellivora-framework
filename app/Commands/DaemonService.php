<?php

namespace App\Commands;

abstract class DaemonService extends Command
{

    /**
     * 每次循环处理订单的间隔时间
     *
     * @var integer
     */
    protected $intervalSecs = 10;

    /**
     * 最大内存使用限制，单位 bytes，默认 100mb
     * 大于该值则进程自动结束，等待重启
     *
     * @var integer
     */
    protected $maxMemoryLimit = 100 * 1024 * 1024;

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if (method_exists($this, 'init')) {
            $this->init();
        }

        // 循环处理 worker
        while (true) {
            if ($this->runWorker() === false) {
                // 暂无待处理的数据，进入休眠状态
                sleep($this->intervalSecs);
            }

            // 内存占用检测
            $memoryUsage = memory_get_usage(true);
            if ($memoryUsage > $this->maxMemoryLimit) {
                $this->getLogger()->critical(sprintf(
                    'Occupied memory exceeds the limit size %s, actually occupies %s',
                    $this->formatBytes($this->maxMemoryLimit),
                    $this->formatBytes($memoryUsage)));

                break;
            }
        }
    }

    /**
     * 执行脚本工作，如果返回 false 则脚本进入睡眠状态
     *
     * @return boolean
     */
    abstract public function runWorker();
}
