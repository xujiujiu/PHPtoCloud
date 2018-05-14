<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
</head>
<link href="../css/remCon.css" type="text/css"  rel="stylesheet" />
<body>
<script language="javascript" src="../js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" language="javascript">

	$(document).ready(function(e) {
        $(".sign a").click(function(){
			//console.log(1);
			//alert(1);
			$(this).addClass('first').siblings().removeClass('first');
		});
    });
	
	
</script>
<?php 
	require_once('../conn/conn.php');
	session_start();
	$remId=$_GET['id'];
	//echo $remId;die;
	$remSql=mysql_query("select * from rem_inf where rem_id= '$remId'");
	$rem=mysql_fetch_assoc($remSql);
	//var_dump($rem);die;
	$filenumFlag = mysql_query("select count(*) from file_inf where rem_name= '$rem[rem_name]'");
	$sharenumFlag = mysql_query("select count(*) from file_inf where  rem_name= '$rem[rem_name]' and share = 1 "); 
	$downFlag = mysql_query("select * from file_inf where  rem_name= '$rem[rem_name]'");
	

	$array=mysql_fetch_array($filenumFlag);
	$filenum = $array[0]; 
	$array1=mysql_fetch_array($sharenumFlag);
	$sharenum = $array1[0];
	$file=mysql_fetch_assoc($downFlag);
	if($file){
		$downnums==0;
		do{
			$downnums+= $file['download_count']; 
			$file=mysql_fetch_assoc($downFlag);
		}while($file);
	}
?>
<div id="rem">
	<div class="name"><b><?php echo $rem['rem_name'];?></b></div>
    <div class="personal">
     </div>
</div>
<div class="file" style="margin-top:-30px;">
	<div class="tb" style="width:150px;margin-left:70px;">
        <ul>
        	<li>分享</li>
       	 	<li><a href="#"><?php echo $sharenum;?></a></li>
        </ul>
        <ul>
        	<li>下载</li>
        	<li><a><?php echo $downnums;?></a></li>
        </ul>
  	</div>
	<div class="img"><img src="../images/sanjiao1.png" width="20" /></div>
    <div class="share">
    	<div class="sign">
            	<a href="otherShare.php?shareid=<?php echo $remId?>" target="share" class="first">全部</a>
            	<?php
					set_time_limit(0); //0为无限制
					$sql2="select * from type";
					$result = mysql_query($sql2);
					$type = mysql_fetch_assoc($result);
					if($type){
						do{
				?>
					<a href="otherShare.php?shareid=<?php echo $remId?>&type_id=<?php echo $type[type_id]; ?>" target="share"><?php echo $type[type_name];?></a>
                <?php $type = mysql_fetch_assoc($result);}while($type);}?>
        </div>
        <div>
        <iframe src="otherShare.php?shareid=<?php echo $remId?>" name="share" scrolling="no" noresize="noresize" frameBorder="0" style="height:450px; width:100%; border:#CCC 1px solid;margin-top:-50px;background-color:#FFF;  position:relative;"></iframe>
        </div>
  </div>
</div>
<div class="extend">
<iframe src="extend.php" name="extend" scrolling="yes" noresize="noresize" frameBorder="0" style="width:100%;
	height:570px;"></iframe>
<div>
<?php 
	mysql_close($conn);
?>
</body>
</html>