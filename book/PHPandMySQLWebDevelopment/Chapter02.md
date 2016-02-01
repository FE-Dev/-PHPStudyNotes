### 46页

	// open file for appending
	@ $fp = fopen("$DOCUMENT_ROOT/../orders/orders.txt", 'ab');

`$DOCUMENT_ROOT/../`指向站点根目录，win 下 PHP 一键安装包通常是 www 目录。  
另外需要给文件夹设置权限，否则没有读写权限的话第 72 行会报错。  
再然后，不知道` fopen() `有没有创建文件夹的能力？测试的时候需要自己先创建 orders 文件夹，不然还是错。

