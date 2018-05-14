<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="author" content="by九酒"  />
<meta name="revised" content="2015/10/20" />
<meta name="keywords" content="文件管理系统"  />
<META NAME="Description" CONTENT="文件管理系统" />
<title>云空间管理系统后台</title>
</head>
<script language="javascript" src="../js/userleft.js"></script>
<body>
<link href="../css/usertop.css" rel="stylesheet" type="text/css" />
 <?php session_start(); //注册session变量
 ?>
<!--页头设置-->
<div class="bg">
  <img src="../images/top_1.png" style="width:100%" />
</div>
<ul class="logo">
 	<li><img src="../images/logo.png"  style="height:100px;"/></li>
    <li class="title"><span>|</span>云空间管理系统后台</li>
	<li class="dt">
    	<li class="right1">欢迎&nbsp;<?php echo "<font color='#FF0000' size='+1'>".$_SESSION['user_name']."</font>"; ?>&nbsp;来到云空间管理系统</li>
		<li class="right2">退出系统&nbsp;<input class="dl" type="button" value="退出"  onclick="checkOut()"/></li>		
    </li>
</ul>


</body>
</html>