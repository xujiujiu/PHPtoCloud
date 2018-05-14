<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="author" content="by九酒"  />
<meta name="revised" content="2015/10/20" />
<meta name="keywords" content="文件管理系统"  />
<META NAME="Description" CONTENT="文件管理系统" />
<title>云空间管理系统后台</title>
<style type="text/css">
*{margin:0;padding:0;}
/*.body{ 	background:url(../images/top_2.jpg);
		background-repeat:no-repeat;	
}*/
/*frameset{background-color:#EBF2F9;}*/
</style>
</head>

<?php
session_start(); //注册session变量
//判断是否登陆
if(empty($_SESSION['user_name'])){
	echo "<script type='text/javascript' language='javascript'>window.location.href='user_login.htm';</script>";
	exit;
}
?>
<!--框架-->
<?php
//header("location:usertop.php");
?>
<frameset class="body" rows="135px,700px" cols="*" framespacing="0" frameborder="no" border="0">
	<frame src="usertop.php" name="top" scrolling="no" noresize="noresize"/>
    <frameset cols="270px,1000px" frameborder="no" framespacing="0" border="0">
		<frame src="userleft.php" name="left" scrolling="no" noresize="noresize"/>
        <frameset rows="600px,40px" cols="*" style="border:2px solid #09C;"frameborder="no" framespacing="0" border="0">
    		<frame src="usercon.php" name="con" scrolling="yes"  noresize="noresize"/>
            <frame src="userbottom.php" name="bottom" scrolling="no" noresize="noresize" />
        </frameset>
	</frameset>
    <noframes>
		<body>您的浏览器无法处理框架！</body>
	</noframes>

</frameset>


<!--<iframe  name="leftframe" class="leftframe" src="usertop.php" style="width:100%; height:120px;" frameBorder="0" noResize scrolling="no"></iframe>
<iframe  name="leftframe" class="leftframe" src="userleft.php" style="height:700px; width:20%;" frameBorder="0" noResize scrolling="no"></iframe>
<iframe  name="topframe" class="topframe"  src="usercon.php" style="height:700px; width:77%;" frameBorder="0" noResize scrolling="no"> </iframe>-->
</html>