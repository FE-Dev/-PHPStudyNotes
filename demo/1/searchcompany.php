<?php
//所有页面引用check.php，不要忘了添加注销登录的链接
include_once 'check.php';
include_once 'connection.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>查询结果</title>
</head>
<body>
<?php
//获取搜索关键字
$company = trim($_POST['company']);
//检查是否为空
if($company==""){
echo"关键字不能为空";
exit;//结束程序
}

// SELECT Name,Company,Shangwu form info WHERE name like '%$searchname%';
// SELECT * form info WHERE company like '%$searchcompany%';
// 已实现：只显示10条，但还不能每天更新；只能查询自己的信息（ShareToChennel1=1），但不显示的也能查。
$session_id = $_SESSION["id"];
if ($session_id == "1") {
    //开始查询  
    $query = "SELECT * FROM info WHERE Company LIKE '%$company%'";
    //执行SQL语句  
    $result = mysql_query($query) or die("Error in query: $query. ".mysql_error());  
    //显示返回的记录集行数
    if(mysql_num_rows($result)>0){
        //如果返回的数据集行数大于0，则开始以表格的形式显示  
        echo "<table cellpadding=10 border=1>"; 
        echo "<tr>";  
        echo "<td>姓名</td>";
        echo "<td>公司名称</td>";
        echo "<td>公司地址</td>";
        echo "<td>联系方式</td>";
        echo "</tr>"; 
        while($row=mysql_fetch_row($result)){
            echo "<tr>";  
            echo "<td>".$row[1]."</td>";
            echo "<td>".$row[4]."</td>";
            echo "<td>".$row[5]."</td>";
            echo "<td>".$row[7]."</td>";
            echo "</tr>";  
        }  
        echo "</table>";  
        echo "<br>";
        echo "<a href='admin.php'>返回</a>";
    }  
    else{  
        echo "您无权查询该记录！";  
    }
    //释放记录集所占用的内存  
    mysql_free_result($result);
    //关闭该数据库连接  
    mysql_close($conn); 
}else {

    if ($session_id == "2") {
        $ShareToChannel = "ShareToChannel1";
    }else if ($session_id == "3") {
        $ShareToChannel = "ShareToChannel2";
    }else if ($session_id == "4") {
        $ShareToChannel = "ShareToChannel3";
    }else if ($session_id == "5") {
        $ShareToChannel = "ShareToChannel4";
    }else{  
        echo "用户不存在";
    }
    // 在开始查询之前判断用户是否查询超过10条。如果没有，继续查询并将查询记录写入；如果已经超过10条，则禁止查询，不记录。
    // 
    // 查询keywordcount
    // 当用户相同 userid='$session_id'
    // 在同一天 stime='$stime'
    // 获取记录数量 $num 
    //
    $stime=date("Y-m-d",time());

    $totalquery="SELECT * FROM keywordcount WHERE userid='$session_id' and stime='$stime'";
    $rs_totalquery=mysql_query($totalquery);
    $num = mysql_num_rows($rs_totalquery);
    // echo $num;
    // $row_company2 = mysql_fetch_array($rs_totalquery);
    if ($num<10) {
        //开始查询
        $query = "SELECT * FROM info WHERE Company='".trim($company)."' And $ShareToChannel ='1' ";
        //执行SQL语句  
        $result = mysql_query($query) or die("Error in query: $query. ".mysql_error());  
        //显示返回的记录集行数
        if(mysql_num_rows($result)>0){
            //如果返回的数据集行数大于0，则开始以表格的形式显示  
            echo "<table cellpadding=10 border=1>"; 
            echo "<tr>";  
            echo "<td>姓名</td>";
            echo "<td>公司名称</td>";
            echo "<td>公司地址</td>";
            echo "<td>联系方式</td>";
            echo "</tr>"; 
            while($row=mysql_fetch_row($result)){
                echo "<tr>";  
                echo "<td>".$row[1]."</td>";
                echo "<td>".$row[4]."</td>";
                echo "<td>".$row[5]."</td>";
                echo "<td>".$row[7]."</td>";
                echo "</tr>";  
            }  
            echo "</table>";  
            echo "<br>";
            echo "<a href='user.php'>返回</a>";

            // //将查询记录写进表
            // 取公司ID 
            $query_company = "SELECT * FROM info WHERE Company='".trim($company)."'";
            $rs_company = mysql_query($query_company) or die("Error in query: $query_company. ".mysql_error());
            $row_company=mysql_fetch_row($rs_company);
            $companyid=$row_company[0];
            // $stime=date("Y-m-d",time());

            $query_company2="SELECT * FROM keywordcount WHERE companyid='$companyid' and userid='$session_id' and stime='$stime'";  
            $rs_company2=mysql_query($query_company2);
            $num = mysql_num_rows($rs_company2);
            // $row_company2 = mysql_fetch_array($rs_company2);
                if ($num<1)  
                    {  
                        $sql = "insert into keywordcount (userid,companyid,stime) values ('$session_id','$companyid','$stime')";
                        mysql_query($sql);
                    }
        }  
        else{  
            echo "您无权查询该记录！";  
        }
    } else {
        echo "查询次数超限，今天不能再查询新纪录。<a href='user.php'>返回</a>。";
    }

    //释放记录集所占用的内存  
    //mysql_free_result($result);
    //关闭该数据库连接  
    mysql_close($conn);
}

?>

</body>
</html>