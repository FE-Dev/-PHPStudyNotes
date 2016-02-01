<?php
//验证登陆信息
session_start();
//数据库链接文件
include_once 'connection.php';

//if($_POST['submit']){
	$username=$_POST['username'];
	$userpass=$_POST['userpass'];
	$userpass=md5($userpass);
	// $sql="select * from user ";
	// $sql="select * From user where username='".trim($username)."' And userpass='".trim($userpass)."'";
	$sql="select * From user where username='".trim($username)."'";
	$query=mysql_query($sql);
	$row=mysql_fetch_array($query);
	if (!empty($row)) {
		if ($row['username']==$username){
			if ($row['userpass']==$userpass){
				$_SESSION["id"]=$row["id"];
				$_SESSION["uid"]=$row["uid"];
				$_SESSION['username']=$username;
				$uid=$row["uid"];
				if ($uid=="1") {
					echo "<script language='javascript'>location='admin.php';</script>";
				} else {
					echo "<script language='javascript'>location='user.php';</script>";
				}
			}
			else {
				echo "<script language='javascript'>alert('密码错误！');location='index.php';</script>";
			}
		}
		else {
			echo "<script language='javascript'>alert('用户名不存在！');location='index.php';</script>";
		}
	}
	else { 
		echo "<script language='javascript'>alert('用户名、密码不能为空或者密码错误,请重新输入!');window.location.href='index.php';</script>"; 
	}
?>