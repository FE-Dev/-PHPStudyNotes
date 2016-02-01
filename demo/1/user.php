<?php
//所有页面引用check.php，不要忘了添加注销登录的链接
include_once 'check.php';
include_once 'connection.php';
if ($_SESSION["uid"]=="1") {
	echo "<script language='javascript'>location='admin.php';</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>用户界面</title>
</head>
<body>
	<?php
		// $username=$_POST['username'];
		// $userpass=$_POST['userpass'];
		// 因为在登陆页已经判断管理员和普通用户了，所以下面的判断没必要了
			// $session_id = $_SESSION["id"];
			// $sql="select * from user where id='$session_id'";
			// $query=mysql_query($sql);
			// $row=mysql_fetch_array($query);
			// if ($row['uid']=="1"){
			// 	echo "uid:".$row['uid'].",";
			// 	echo "管理员:".$_SESSION['username']."，欢迎你！<a href='loginout.php'>注销登录</a>";
			// }
			// else {
			// 	echo "uid:".$row['uid'].",";
			// 	echo "用户:".$_SESSION['username']."，欢迎你！<a href='loginout.php'>注销登录</a>";
			// }
		echo "用户:".$_SESSION['username']."，欢迎你！<a href='loginout.php'>注销登录</a>";
	?>
<br><br>
<form action='searchcompany.php' method='post' name="searchcompany"><input type="text" name="company" /><input type='submit' value='查询' /></form>
<br>
<?php
	$session_id = $_SESSION["id"];
	if ($session_id == "2") {
		$ShareToChannel = "ShareToChannel1";
	}else if ($session_id == "3") {
		$ShareToChannel = "ShareToChannel2";
	}else if ($session_id == "4") {
		$ShareToChannel = "ShareToChannel3";
	}else if ($session_id == "5") {
		$ShareToChannel = "ShareToChannel4";
	}

	//开始查询
    $query = "SELECT * FROM info where $ShareToChannel = '1' order by id";
    //执行SQL语句  
    $result = mysql_query($query) or die("Error in query: $query. ".mysql_error());  
    //显示返回的记录集行数
    if(mysql_num_rows($result)>0){  
        //如果返回的数据集行数大于0，则开始以表格的形式显示
        //只显示公司名。先不做每天显示10条，做不出。1、怎么限制每天只能查10条---限制只显示10条（ok） and  每天更新；2、怎么限制只能查自己的(已在searchcompany实现)
        echo "<table cellpadding=10 border=1>"; 
        echo "<tr>";  
        echo "<td>公司</td>";   
        echo "</tr>"; 
		for ($i=1; $i<=mysql_num_rows($result); $i++) { 
			$row=mysql_fetch_row($result);
			echo "<tr>";  
			echo "<td>".$row[4]."</td>";  
			echo "</tr>";
		}
        // 原循环
        // while($row=mysql_fetch_row($result)){
        //     echo "<tr>";  
        //     echo "<td>".$row[3]."</td>";  
        //     echo "</tr>";
        // }
        echo "</table>";
    }  
    else{  
        echo "记录未找到！";  
    }  
    //释放记录集所占用的内存  
    mysql_free_result($result);
    //关闭该数据库连接  
    mysql_close($conn);
?>
</body>
</html>