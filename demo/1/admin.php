<?php
//所有页面引用check.php，不要忘了添加注销登录的链接
include_once 'check.php';
include_once 'connection.php';
if ($_SESSION["uid"]=="0") {
	echo "<script language='javascript'>location='user.php';</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>管理员界面</title>
	<script type="text/javascript" src="js/DatePicker/WdatePicker.js"></script>
</head>
<body>
<?php
	echo "管理员:".$_SESSION['username']."，欢迎你！<a href='loginout.php'>注销登录</a>";
	// $query_user = "SELECT id,username FROM user";
	// //执行SQL语句  
	// $result_user = mysql_query($query_user) or die("Error in query: $query_user. ".mysql_error());
	// $row_user=mysql_fetch_row($result_user);
	// $usersearchresult="用户 ".$row_user[2]." 自 ".$timefrom." 至 ".$timeto." 共查询了 ".mysql_num_rows($result)." 条记录。";
	// echo $usersearchresult;
	// echo "<br>";
	// echo "<table cellpadding=10 border=1>"; 
	// echo "<tr>";  
	// echo "<td>ID</td>";
	// echo "<td>名</td>";
	// echo "</tr>"; 
	// while($row_user=mysql_fetch_row($result_user)){
	//     echo "<tr>";  
	//     echo "<td>".$row_user[0]."</td>";
	//     echo "<td>".$row_user[1]."</td>";
	//     echo "</tr>";  
	// }
	// echo "</table>";
	// echo "<br>";
	// echo $row_user[0];
	// echo "<br>";
	// echo $row_user[1];
	// echo "<br>";
	// echo mysql_num_rows($result_user);//记录行数
	// echo $row_user[2];
	// echo "<br>";
	// echo $row_user[3];
?>
<br><br>
<form method="post" name="search">
选择用户：
<select name="select" id="select_user">
<?php
	$query_select_user = "SELECT id,username FROM user";
	//执行SQL语句  
	$result_select_user = mysql_query($query_select_user) or die("Error in query: $query_select_user. ".mysql_error());
	$row_select_user=mysql_fetch_row($result_select_user);
	while($row_select_user=mysql_fetch_row($result_select_user)){
		echo "<option value ='".$row_select_user[0]."'>".$row_select_user[1]."</option>";
	}
?>
</select>
选择时间：
<input type="text" onclick="WdatePicker()" id="from" name="from" class="Wdate"> 至 <input type="text" onclick="WdatePicker()" id="to" name="to" class="Wdate">&nbsp;<input type="submit" value="查 询" class="submit">
</form>
<br>

<?php

	//获取搜索关键字
	@$select_user = trim($_POST['select']);
	@$timefrom = trim($_POST['from']);
	@$timeto = trim($_POST['to']);
	//检查是否为空
	// if($select_user==""){
	// echo"关键字不能为空";
	// exit;//结束程序
	// }

	// $session_id = $_SESSION["id"];
    //开始查询  
	$query = "SELECT * FROM keywordcount WHERE userid='".$select_user."' and stime BETWEEN '".$timefrom."' AND '".$timeto."'";
   //$query = "SELECT * FROM keywordcount WHERE userid='$select_user' and stime BETWEEN '$timefrom' AND '$timeto'";
    //执行SQL语句  
    $result = mysql_query($query) or die("Error in query: $query. ".mysql_error());

    //根据 userid 取 username
    //放在 if 外边，当 if<0 时也可以用
    $total_query = "SELECT * FROM user WHERE id='$select_user'";
    //执行SQL语句
    $total_result = mysql_query($total_query) or die("Error in query: $total_query. ".mysql_error());
    $total_row=mysql_fetch_row($total_result);

    if(mysql_num_rows($result)>0){
        
        $total_search="用户 ".$total_row[2]." 自 ".$timefrom." 至 ".$timeto." 共查询了 ".mysql_num_rows($result)." 条记录。";
        echo $total_search;
        echo "<br><br>";

        //获取 keywordcount 中公司的id
        while($row_cid=mysql_fetch_row($result)){
        	$cid=$row_cid[2];
        	// echo $cid;
        	// echo "<br>";
        	$data[]=$cid;
        }
        //将 while 里的数组赋值给$date数组，以便在外部调用。
        // print_r($data);//打印输出，看结构
        // echo "<br />";

        //遍历的一些方法，foreach,while等
        // $row_cid = mysql_fetch_row($result); 
        // // foreach ($row_cid as $cid){ 
        // //   echo "This company id is $cid! <br />"; 
        // // } 
        // while(list($key,$val)= each($row_cid)) { 
        //   echo "This Site url is $val.<br />"; 
        // }

		echo "<table cellpadding=10 border=1>"; 
        echo "<tr>";
        echo "<td>用户</td>";
        echo "<td>姓名</td>";
        echo "<td>公司名称</td>";
        echo "<td>公司地址</td>";
        echo "<td>联系方式</td>";
        echo "</tr>";
        foreach ($data as $c){
        	$query1 = "SELECT * FROM info WHERE id='".$c."'";
        	$result1 = mysql_query($query1) or die("Error in query: $query. ".mysql_error());
        	while($row=mysql_fetch_row($result1)){
        	    echo "<tr>";
        	    echo "<td>".$total_row[2]."</td>";
        	    echo "<td>".$row[1]."</td>";
        	    echo "<td>".$row[4]."</td>";
        	    echo "<td>".$row[5]."</td>";
        	    echo "<td>".$row[7]."</td>";
        	    echo "</tr>";  
        	}
        }
        echo "</table>";
    }
    else{  
        echo "该时段用户 ".$total_row[2]." 无查询记录！";  
    }
    //释放记录集所占用的内存  
    mysql_free_result($result);
    //关闭该数据库连接  
    mysql_close($conn); 
?>
</body>
</html>