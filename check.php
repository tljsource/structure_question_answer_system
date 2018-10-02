<!DOCTYPE html>
<html>
<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<?php
$start = microtime(true);
include "config/dbconnect.php";

set_time_limit(0); //运行时间持续到程序运行结束为止
error_reporting( E_ALL&~E_NOTICE );

$username=$_POST['username']; 
$password=$_POST['password']; 

if($username == "") { 
  echo "用户名不能为空<br>"; 
  echo"<a href='login.php'>返回</a>";  
} elseif($password == "") { 
  //echo "请填写密码<br><a href='login.php'>返回</a>"; 
  echo"<script type='text/javascript'>alert('请填写密码');location='login.php';</script>";     
} else {  
  $sql="select * from user where username='$username'";
              
  $result=mysqli_query($link,$sql);
  $colum=mysqli_fetch_array($result); 

  echo "<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />";
  if(($colum['username'] == $username) && ($colum['password'] == $password)) { 
    $end = microtime(true);
    $time = $end - $start;
    echo"<script type='text/javascript'>alert('登录成功');location='index.php?time=$time';</script>"; 
  } else {
    //echo "密码错误<br>"; 
    echo"<script type='text/javascript'>alert('密码错误');location='login.php';</script>"; 
    //echo "<a href='login.php'>返回</a>";
  }
}
  
?>
</body>
</html>

