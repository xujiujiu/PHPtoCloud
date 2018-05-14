<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<link  href="../css/usercon.css" type="text/css" rel="stylesheet"/>
</head>

<body>
<?php
 session_start();
 require_once('../conn/conn.php'); //数据库连接
 function today(){
  $a=date("Y");
  $b=date("m");
  $c=date("d");
  return $a.'年'.$b.'月'.$c.'日';
  }//获取当前年月日
  $ip = $_SERVER["REMOTE_ADDR"];
  $sql = "select user_ip,user_opdate from user_record where user_name='$_SESSION[user_name]' order by user_opdate desc limit 1,1 ";
  $result = mysql_query($sql);//执行查询语句
 // var_dump($result);die;
  $array = mysql_fetch_array($result);//返回数据并生成数组
  $user_ip =$array['user_ip'];
  $user_update = $array['user_opdate'];
   
?>

	<div class="con">
		<div class="top"><p> &nbsp;&nbsp;&nbsp;<?php echo "<font color='#FF0000' size='+2'>".$_SESSION['user_name']."</font>"; ?>&nbsp;您好！欢迎来到云空间管理系统！</p></div>
        <ul id="home">
        	<li class="content">今天是&nbsp;<?php echo "<font color='#760528' >".today()."</font>";?></li>
        	<li class="content">您的登录ID是&nbsp;<?php echo "<font color='#760528' >".$_SESSION['user_name']."</font>"; ?></li>
            <li class="content">您的登录IP是&nbsp;<?php echo "<font color='#760528' >".$ip."</font>";?></li>
        	<li class="content">您上次登录时间是&nbsp;<?php echo "<font color='#760528' >".$user_update."</font>"; ?></li>
            <li class="content">您上次登录的IP是&nbsp;<?php echo "<font color='#760528' >".$user_ip."</font>"; ?></li>
        </ul>
	</div>
</body>
</html>