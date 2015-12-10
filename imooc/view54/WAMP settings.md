# 自定义网站根目录

1. 在想存放网站文件的地方新建文件夹，命好名，如demo
2. 从系统托盘打开 Apache 配置文件 httpd.conf
3. 搜索 documentroot，把路径改成刚才自己新建的文件夹路径
4. 鼠标往下滚一点，找到<directory "d:/wamp/www/">，改为自定义路径
5. 重启服务
6. 打开 WAMP 安装目录，找wampmanager.ini,wampmanager.tpl两个文件
7. 两文件中搜 Menu.left，把对应的地方改一改，名字/路径
8. .tpl 改的是 ${w_wwwDirectory},${wwwDir}
9. 重启服务

# 多站点配置

1. 找到安装目录
2. /bin/apache/../conf/extra/httpd-vhosts.conf  #虚拟目录配置文件
3. 复制示例，想配置多少个文件就复制多少份
4. 只留下 documentroot、servername，其他删掉
5. documentroot是目录，servername是域名，随便输你想要的域名都可以，等会通过修改hosts文件重定向
6. 从系统托盘打开 Apache 的配置文件 httpd.conf
7. 找到 include conf/extra/httpd-vhosts.conf ，删掉前面的#，取消掉注释
8. 还是在 Apache 的配置文件里找到网站放置目录 <Directory "f:/">，这里默认在安装目录下，如果按照前面的修改过的话，就是自定义目录
9. 往下滚动，找到 Deny from all  Allow from 127.0.0.1
10. 改 deny from all 为allow from all，注释127.0.0.1那行
11. 修改完成，重启服务
12. 打开系统 hosts 文件，添加 127.0.0.1 xxx.com


# 自定义 Apache 端口号
1. 打开 Apache 配置文件，搜索 80
2. 改 listen 80
3. 改 servername localhost:80
4. 上面两个要一致。重启服务。

