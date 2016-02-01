<?php
//所有页面引用check.php，不要忘了添加注销登录的链接
include_once 'check.php';
include_once 'connection.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>main-管理主页面</title>
</head>
<body>
	<!-- 管理员，欢迎你！<a href='loginout.php'>注销登录</a> -->
	<?php
	//验证登陆信息
	// session_start();
		$sql="select * from user";
		$query=mysql_query($sql);
		$row=mysql_fetch_array($query);
		if ($row['uid']=="1"){
			echo "管理员，欢迎你！<a href='loginout.php'>注销登录</a>";
		}
		else {
			echo "用户，欢迎你！<a href='loginout.php'>注销登录</a>";
		}

	?>

<!-- 	<?php
	// $con = mysql_connect("localhost","root","");
	if (!$conn)
	  {
	  die('数据库连接失败: ' . mysql_error());
	  }
	  else
	  {
	  mysql_query("SET NAMES UTF8");
	  mysql_query("set character_set_client=utf8");
	  mysql_query("set character_set_results=utf8");
	  mysql_select_db("demosql", $conn);
	  $result = mysql_query("SELECT * FROM info");
	  $rowinfo = mysql_fetch_array($result);
	  //在表格中输出显示结果
	  echo "<table border='1'>
	<tr>
	<th>name</th>
	<th>company</th>
	</tr>";
	  while(!$rowinfo)
	  {
	 echo "<tr>";
	 echo "<td>" . $rowinfo['name'] . "</td>";
	 echo "<td>" . $rowinfo['company'] . "</td>";
	 echo "</tr>";
	  }
	  echo "</table>";
	}
	mysql_close($conn);
	?> -->
<br>
	<?php  
		//开始查询  
	    $query = "SELECT * FROM info";  
	    //执行SQL语句  
	    $result = mysql_query($query) or die("Error in query: $query. ".mysql_error());  
	    //显示返回的记录集行数  
	    if(mysql_num_rows($result)>0){  
	        //如果返回的数据集行数大于0，则开始以表格的形式显示  
	        echo "<table cellpadding=10 border=1>"; 
	        echo "<tr>";  
	        echo "<td>姓名</td>";  
	        echo "<td>公司</td>";  
	        echo "<td>联系方式</td>";  
	        echo "</tr>"; 
	        while($row=mysql_fetch_row($result)){
	            echo "<tr>";  
	            echo "<td>".$row[0]."</td>";  
	            echo "<td>".$row[3]."</td>";  
	            echo "<td>"."<form action='form_action.asp' method='get'><input type='submit' value='显示' /></form>"."</td>";  
	            echo "</tr>";  
	        }  
	        echo "</table>";  
	    }  
	    else{  
	        echo "记录未找到！";  
	    }  
	    //释放记录集所占用的内存  
	    mysql_free_result($result);  
	    //关闭该数据库连接  
	    mysql_close($connection);  
	?>

</body>
</html>