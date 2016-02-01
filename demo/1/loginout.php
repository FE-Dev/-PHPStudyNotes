<?php
//注销登录
session_start();
$_SESSION['username']="";
echo "<script language='javascript'>location='index.php';</script>";
?>