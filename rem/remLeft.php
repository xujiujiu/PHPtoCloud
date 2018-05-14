<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>文件类型</title>
<link href="../css/remIndex.css" type="text/css"  rel="stylesheet"/>
<link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet" />
</head>
<style type="text/css">
body{
	background:#120870;
}

</style>
<script language="javascript" src="../js/jquery-1.9.1.min.js"></script>
<script language="javascript">
	$(document).ready(function() {
        $(".left li").click(function(){
			$(this).addClass('filefirst');
			$(this).siblings().removeClass('filefirst');
			
		});
		
    });
</script>
<?php
	session_start();
	require_once('../conn/conn.php');//连接数据库
	set_time_limit(0); //0为无限制
	$remSql=mysql_query("select * from rem_inf where rem_name='$_SESSION[rem_name]' ");
	$rem=mysql_fetch_assoc($remSql);
	$sql="select * from type";
	$result = mysql_query($sql);
	$type = mysql_fetch_assoc($result);
	$sql1="select file_size from file_inf where rem_name='$_SESSION[rem_name]'";
	$sizeFlag = mysql_query($sql1);
	$filesize = mysql_fetch_assoc($sizeFlag);
	//var_dump($filesize);die;
	if($filesize){
		$filesizes==0;
		do{
			$filesizes += $filesize[file_size]; 
			$filesize = mysql_fetch_assoc($sizeFlag);
		}while($filesize);
	}
	
	$Sizes =sprintf("%.2f", ($filesizes/1000000000));
	//mysql_free_result($sizeFlag);
?>
<body>
<ul class="left">
	<li><a href="rem_wangpan.php?pid=0&searchFlag=0&type_id=0" target="con">全部文件&nbsp;&nbsp;<i class="fa fa-folder-open" style="font-size:24px;"></i></a></li>
<?php
	if($type){
		do{
?>
	<li><a href="rem_wangpan.php?type_id=<?php echo $type[type_id]; ?>&pid=0&searchFlag=0" target="con"><?php echo $type[type_name];?></a></li>
<?php $type = mysql_fetch_assoc($result);}while($type);}
?>
	<hr style="height:1px; width:90%; margin-left:5%; margin-top:3px;border:none;border-top:1px solid #004;" />
	<li><a href="rem_share.php?id=<?php echo $rem['rem_id'];?>" target="con">我的分享&nbsp;&nbsp;<i class="fa fa-share"></i></a></li>
    <hr style="height:1px;width:90%;margin-left:5%;margin-top:3px;border:none;border-top:1px solid #004;" />
   <!-- <li><a href="rem_recycle.php" target="con">回收站&nbsp;&nbsp;&nbsp;<i class="fa fa-recycle" ></i></a></li>-->
</ul>
<div class="percent">
	<span class="bar" style="width:<?php echo $Sizes*100/($allowSize/1000000000);?>%;"></span>
    <span class="text"><?php echo $Sizes.'G'."/".($allowSize/1000000000).'G';?></span>
</div>
<div class="buyText"><a href="buy.php" target="con">购买容量</a></div>
<?php mysql_close($conn);?>
</body>
</html>