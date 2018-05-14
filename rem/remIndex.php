<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="author" content="by九酒"  />
<meta name="revised" content="2015/11/20" />
<meta name="keywords" content="云空间文件管理"  />
<META NAME="Description" CONTENT="云空间文件管理" />
<title>云空间 网盘-全部文件</title>
<link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet" />
<link href="../css/remIndex.css" type="text/css"  rel="stylesheet"/>
</head>
<script language="javascript" src="../js/jquery-1.9.1.min.js"></script>
<script language="javascript" src="../js/rem.js"></script>
<script language="javascript">
	$(document).ready(function(e) {
        $(".daohang a").click(function(){
			$(this).addClass('nulse').siblings().removeClass('nulse');
		});
		/*$("li .personal").hover(function(){
			$(this).children(".bin").stop()
        	.animate({ top: "210", opacity: 1 })
        	.css("display", "block")
		}, function() {
            $(this).children(".bin").stop()
        	.animate({ left: "0", opacity: 0 })
			//.css("display", "none")
        });*/
		//版本更新------------------------
		$('.update').click(function(){
			alert('该版本已是最新版本！');
		});
	});	
</script>
<?php
session_start(); //注册session变量
//判断是否登陆
require_once('../conn/conn.php');
if(empty($_SESSION['rem_name'])){
	echo "<script type='text/javascript' language='javascript'>window.location.href='../login/login.htm';</script>";
	exit;


}
$remSql=mysql_query("select * from rem_inf where rem_name='$_SESSION[rem_name]' ");
$rem=mysql_fetch_assoc($remSql);
//var_dump($rem);die;
?>
<body>
<div id="top">
	<ul class="logo">
		<li><img src="../images/logo.png"  /></li>
    	<li><p><b>云空间</b></p></li>
	</ul>
	<div class="daohang">
		<a href="remCon.php" target="con" class="nulse">主页</a>
        <a href="rem_wangpan.php?searchFlag=0&pid=0&type_id=0" target="con">网盘</a>
        <a href="rem_share.php?id=<?php echo $rem['rem_id'];?>" target="con">分享</a>
	</div>
    <ul class="right">
   		<li class="search">
    		<form name="search" method="post" action="rem_wangpan.php?searchFlag=1&pid=0&type_id=0" target="con">
    			<input class="text" type="text" name="search" placeholder="搜索你的文件" />
        		<input class="submit" type="submit" name="submit"  value="搜索"/>
        	</form>
    	</li>
        <li class="fengexian">|</li>
        <li><img src="../images/vip2.png" width="20" height="20" style="margin-top:15px;" /></li>
        <li class="personal">
			<span class="lead"><?php echo $_SESSION[rem_name];?>&nbsp;&nbsp;<font size="+1"><b>∨</b></font>&nbsp;</span>
       	    <div class="bin">
            	<div class="img"><img src="../images/sanjiao.png" width="12" /></div>
        		<ul>
           		  <li><a href="rem_inf.php" target="con">个人资料</a></li>
               	  <li><a href="buy.php" target="con">购买容量</a></li>
                  <hr style="height:1px;border:none;border-top:1px solid rgba(3,3,3,0.1);" />
           	 	  <li class="esc"><a href="#" onclick="remOut();">退出</a></li>
          		</ul>
            </div>
      	</li>
        <li class="fengexian">|</li>
        <li class="vip"><a href="vip.php" target="con">会员中心</a></li>
        <li class="fengexian">|</li>
        <li class="personal">
			<span class="lead">&nbsp;&nbsp;&nbsp;&nbsp;更多&nbsp;&nbsp;&nbsp;&nbsp;<font size="+1"><b>∨</b></font>&nbsp;</span>
			<div class="bin">
         		<div class="img"><img src="../images/sanjiao.png" width="12" /></div>
        		<ul>
           		  <li><a class="update">版本更新</a></li>
               	  <li><a href="message.php" target="con">帮助反馈</a></li>
           	 	  <li><a href="../conn/xy.php" target="new">服务协议</a></li>
                  <li><a href="../conn/xy.php" target="new">权利说明</a></li>
          		</ul>
			</div>
           
        </li>
    </ul>
</div>
<div class="bottom">
	<iframe src="remLeft.php" name="left" scrolling="no" noresize="noresize" frameBorder="0" style="height:585px; width:17%;"></iframe>
	<iframe src="remCon.php" name="con" scrolling="yes"  noresize="noresize" frameBorder="0" style="height:585px; width:82%"></iframe>
</div>
</body>
</html>