#!/usr/bin/env bash

# 获取 php 的位置
php=`which php`

# php 版本检测
check=$($php -r "echo version_compare(PHP_VERSION, '5.6.0') >= 0 ? 'yes' : 'no';")
if [ $check != "yes" ]; then
    echo "Please use php 5.6.0 or above version! ($php)"
    exit 0
fi

# 待守护的命令列表
commands=(
    # "$php claw my:task"
)

# 进入工作目录
root=$(cd "$(dirname "$0")"; cd ../; pwd)
cd $root

# 创建日志文件目录
logdir=$root/storage/logs/`date +%Y%m%d`
logfile=$logdir/daemon-service.log

if [ ! -d $logdir ]; then
    mkdir -p $logdir
    chmod ugo+w $logdir
fi

start() {
    for ((i = 0; i < ${#commands[@]}; i++)) ; do
        cmd=${commands[$i]}
        pid=$(pgrep -f "$cmd")
        if [ "$pid" ] ; then
            echo -e "$cmd ($pid)  \033[33;49;2m[ RUNNING ]\033[39;49;0m"
        else
            $cmd >> /dev/null &
            echo -e "$cmd  \033[32;49;2m[ STARTED ]\033[39;49;0m"
            echo -e "$(date +'%Y-%m-%d %H:%M:%S') $cmd started." >> $logfile
        fi
    done

    return 0
}

stop() {
    for ((i = 0; i < ${#commands[@]}; i++)) ; do
        cmd=${commands[$i]}
        pid=$(pgrep -f "$cmd")
        if [ "$pid" ] ; then
            kill -15 $pid
            echo -e "$cmd ($pid)  \033[31;49;2m[ KILLED ] \033[39;49;0m"
            echo -e "$(date +'%Y-%m-%d %H:%M:%S') $cmd killed." >> $logfile
        else
            echo -e "$cmd  \033[37;49;2m[ NONE ]\033[39;49;0m"
        fi
    done
}

status() {
    echo "Process status list:"
    for ((i = 0; i < ${#commands[@]}; i++)) ; do
        cmd=${commands[$i]}
        pid=$(pgrep -f "$cmd")
        if [ "$pid" ] ; then
            echo -e "$cmd ($pid)  \033[33;49;2m[ RUNNING ]\033[39;49;0m"
        else
            echo -e "$cmd  \033[37;49;2m[ NONE ]\033[39;49;0m"
        fi
    done
}


case "$1" in
    start)
        start
        ;;

    stop)
        stop
        ;;

    status)
        status
        ;;

    restart)
        stop && start
        ;;

    *)
        echo -e "Usage: $0 [start|stop|status|restart]\n"
        status
        ;;
esac

exit $?