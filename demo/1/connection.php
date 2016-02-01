<?php
//数据库链接文件
	$host='localhost';//数据库服务器
	$user='root';//数据库用户名
	$password='';//数据库密码
	$database='www5';//数据库名
	$conn=@mysql_connect($host,$user,$password) or die('数据库连接失败！');
	// 解决中文乱码
	mysql_query("SET NAMES UTF8");
	mysql_query("set character_set_client=utf8"); 
	mysql_query("set character_set_results=utf8");
	@mysql_select_db($database) or die('没有找到数据库！');

	// session_start(); 
	ini_set('session.save_path','/tmp/');
	//保存一天
	$lifeTime = 1 * 3600;
	setcookie(session_name(), session_id(), time() + $lifeTime, "/");
?>