#!/usr/bin/env bash

### 项目安装脚本 ###
#
root=$(cd "$(dirname "$0")"; cd ..; pwd)
cd $root

echo "Initilize application: $root"

# 安装 composer
composer=`which composer`
if [ -z "$composer" ];  then
    composer=/usr/bin/composer
    echo "Preparing to install composer ..."
    curl -s http://getcomposer.org/installer | php
    mv composer.phar $composer
    echo "Composer has been successfully installed."
fi

# 需要清空的目录
rm_files=(
    storage/cache/*
    storage/views/*
)
for file in ${rm_files[@]}; do
    rm -rf $file
    echo "Remove Files: $file"
done

# 需要创建的目录
mk_dirs=(
    storage/cache
    storage/logs
    storage/views
    storage/sessions
)

# 创建目录并设定权限
for dir in ${mk_dirs[@]}; do
    if [ ! -d $dir ]; then
        mkdir -p $dir
        echo "Created Directory: $dir"
    fi
done

# 保持目录权限
chmod -R ugo+w storage
chmod -R +x claw bin