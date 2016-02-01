<?php
//所有页面引用check.php，不要忘了添加注销登录的链接
include_once 'check.php';
include_once 'connection.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>搜索页</title>
</head>
<body>
<?php
//获取搜索关键字
$name = trim($_POST['name']);
//检查是否为空
if($name==""){
echo"关键字不能为空";
exit;//结束程序
}

// SELECT Name,Company,Shangwu form info WHERE name like '%$searchname%';
// SELECT * form info WHERE company like '%$searchcompany%';

    //开始查询  先放宽条件
    $query = "SELECT * FROM info WHERE name LIKE '%$name%'";
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
            echo "<td>".$row[6]."</td>";  
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
    mysql_close($conn);  

?>

</body>
</html>