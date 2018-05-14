<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>主页</title>
</head>
<link href="../css/remCon.css" type="text/css"  rel="stylesheet" />
<script language="javascript" src="../js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" language="javascript">
	$(document).ready(function(){
		$(".editFlag").click(function(){
			//alert(1);
			$(".infShow").hide();
			$(".edit").show(function(){
				$(".cancel").click(function(){
					$(".infShow").show();
					$(".edit").hide();
				});
			});
			
		});
		
	});
	
	
	//刷新页面
	function personalEdit(){
		//if(document.getElementsByClassName("submit").isclick==1){
			parent.location.reload();
		//}
		
	}
	
	$(document).ready(function(e) {
        $(".sign a").click(function(){
			//console.log(1);
			//alert(1);
			$(this).addClass('first').siblings().removeClass('first');
		});
    });
	
	
</script>

<body>
<?php session_start();?>
<div id="rem">
	<div class="name"><b><?php echo $_SESSION['rem_name'];?></b></div>
    <div class="personal">
    	<form action="" method="post">
    		<div class="editFlag"><input type="button" value="编辑个签" style="width: 70px; height: 30px;"/></div>
			<?php 
				require_once("../conn/conn.php");//连接数据库
				$sql="select * from rem_inf where rem_name='$_SESSION[rem_name]'";
				$remFlag=mysql_query($sql);
				//var_dump($remFlag);die;
				$rem=mysql_fetch_assoc($remFlag);
			?>
            <div class="infShow">&nbsp;<?php if($rem['personal_inf']==''){echo '请编辑您的信息';}else{echo $rem['personal_inf'];}?></div>
            <div class="edit">
            	<input name="personal" type="text" class="text" value="<?php if($rem['personal_inf']==''){echo '请编辑您的信息';}else{echo $rem['personal_inf'];}?>"  size="40"/>
                <input class='submit' name="submit" type="submit" value="提交"  onclick="return personalEdit();" style="width: 70px; height: 30px;"/>
                <input class="cancel" type="button" value="取消" style="width: 70px; height: 30px;" />
            </div>
        </form>
        <?php 
			$personal_inf=$_POST['personal'];
			$submitFlag=isset($_POST['submit']);
			//echo $personal_inf;die;
			if($submitFlag){
				if(strlen($personal_inf)>50){
					echo "<script language='javascript' > ";
					echo 'alert("个性签名不得超过50字");'; 
					echo "</script>";
				}else{
					$sql1="update rem_inf set personal_inf='$personal_inf' where rem_name='$_SESSION[rem_name]' ";
					$updateFlag=mysql_query($sql1);
					//var_dump($updateFlag);die;
					//if($updateFlag){
						echo "<script language='javascript' > ";
						echo "location.href='remCon.php";
						echo "</script>";
						exit;
					//}else{
						//echo "<script language='javascript' > ";
						//echo 'alert("数据记录插入失败");'; 
						//echo "<//script>";
						//exit;
					//}
				}
			}
		?>
	</div>
</div>
<?php 
	$remSql=mysql_query("select * from rem_inf where rem_name='$_SESSION[rem_name]' ");
	$rem=mysql_fetch_assoc($remSql);
	$filenumFlag = mysql_query("select count(*) from file_inf where rem_name= '$_SESSION[rem_name]'"); 
	$array=mysql_fetch_array($filenumFlag);
	$filenum = $array[0];
	$sharenumFlag = mysql_query("select count(*) from file_inf where rem_name = '$_SESSION[rem_name]' and share = 1 "); 
	$array1=mysql_fetch_array($sharenumFlag);
	$sharenum = $array1[0];
	$downFlag = mysql_query("select * from file_inf where rem_name= '$_SESSION[rem_name]'"); 
	$file=mysql_fetch_assoc($downFlag);
	if($file){
		$downnums==0;
		do{
			$downnums+= $file['download_count']; 
			$file=mysql_fetch_assoc($downFlag);
		}while($file);
	}
?>
<div class="file">
	<div class="tb">
		<ul>
    		<li>文件</li>
        	<li><a href="rem_wangpan.php?searchFlag=0&pid=0&type_id=0"><?php echo $filenum;?></a></li>
   		</ul>
        <ul>
        	<li>分享</li>
       	 	<li><a href="rem_share.php?id=<?php echo $rem[rem_id];?>"><?php echo $sharenum;?></a></li>
        </ul>
        <ul>
        	<li>下载</li>
        	<li><a><?php echo $downnums;?></a></li>
        </ul>
  	</div>
	<div class="img"><img src="../images/sanjiao1.png" width="20" /></div>
    <div class="share">
    	<div class="sign">
            	<a href="otherShare.php?shareid=0" target="share" class="first">全部</a>
            	<?php
					set_time_limit(0); //0为无限制
					$sql2="select * from type";
					$result = mysql_query($sql2);
					$type = mysql_fetch_assoc($result);
					if($type){
						do{
				?>
					<a href="otherShare.php?shareid=0s&type_id=<?php echo $type[type_id]; ?>" target="share"><?php echo $type[type_name];?></a>
                <?php $type = mysql_fetch_assoc($result);}while($type);}?>
        </div>
        <div>
        <iframe src="otherShare.php?shareid=0" name="share" scrolling="no" noresize="noresize" frameBorder="0" style="height:450px; width:100%; border:#CCC 1px solid;margin-top:-50px;background-color:#FFF;  position:relative;"></iframe>
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