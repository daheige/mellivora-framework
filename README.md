# 项目说明

## 项目初始化

该项目使用了 Mellivora 框架 ，其基础为 Slim3，结合了 laravel 5.4 + Symfony 3.3 的部分组件及特性，自主开发完成。

该项目的最低运行环境为 php5.6，建议使用 php7.1+ 版本以获得更好的性能。

### 获取代码
``` bash
cd /workspace
git clone git@github.com:zhouyl/mellivora-framework.git my.host.com
cd my.host.com
composer install
bash bin/app-init.sh
```

### 配置 nginx

```
server {
    listen       80;

    server_name  my.host.com;
    root         /workspace/my.host.com/public;
    charset      utf-8;
    index        index.php index.html index.htm;

    location / {
        try_files $uri $uri/ /index.php$is_args$args;
    }

    location ~ \.php$ {
        try_files $uri =404;
        fastcgi_pass   unix:/dev/shm/php7.1.sock;
        fastcgi_index  index.php;
        include        fastcgi_params;
        fastcgi_split_path_info ^(.+\.php)(/.+)$;
        fastcgi_param  PATH_INFO $fastcgi_path_info;
        fastcgi_param  PATH_TRANSLATED $document_root$fastcgi_path_info;
    }

    location ~ \.(gif|jpg|jpeg|png|bmp|swf|ico|js|css)$ {
        expires      30d;
        access_log   off;
    }

    location ~ /\.ht {
        deny all;
    }

    access_log  /var/log/nginx/my.host.com.log  main;
}

```

### 目录结构

```
.
├── claw                   Claw 命令行工具
├── app
│   ├── Commands           命令行脚本
│   ├── Controllers        MVC 控制器
│   ├── Middlewares        自定义项目中间件
│   ├── Models             数据库模型类
│   └── Providers          自定义项目服务提供者
├── bin
│   ├── app-init.sh        项目初始化脚本
│   └── daemon-service.sh  守护进程管理脚本
├── config
│   ├── production         生产环境配置
│   └── testing            测试环境配置
├── database
│   ├── migrations         数据库迁移脚本
│   └── seeds              数据库填充脚本
├── docs                   文档目录
├── public                 Web 根目录
├── resources
│   ├── lang               语言包
│   └── views              项目视图文件
├── storage
│   ├── cache              文件缓存
│   ├── logs               日志文件
│   ├── sessions           文件 session
│   └── views              Blade 视图编译缓存
└── vendor                 Composer 第三方库
```
