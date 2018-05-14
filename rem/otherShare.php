<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>他人分享</title>
<style type="text/css">
*{
	margin:0;padding:0;
}
a{
	text-decoration:none;
}
body{
	margin:60px 20px 0 30px;
}
.shareInf{
	border:#ccc solid 1px;
	padding:10px 10px 10px 10px;
	margin-bottom:10px;
}
.topic a{
	font-family:'楷体';
	font-size:20px;
	
	color:#036;
}
.size{
	margin-left:1em;
}
.size a:hover{
	text-decoration:underline;
}
.inf{
	font-family:'楷体';
	font-size:18px;
	color:#999;
	margin-top:5px;
}
.inf a{
	color:#999;
}
</style>
</head>

<body>
<?php
	require_once('../conn/conn.php');
	session_start();
	$type_id=$_GET['type_id'];
	$remCheck=$_GET['shareid'];
	//$remId = $_GET['remId'];
	$remSql=mysql_query("select * from rem_inf where rem_id='$remCheck' ");
	$rem=mysql_fetch_assoc($remSql);
	//var_dump($rem);
	$pagesize = 3;//页面尺寸
	//获取page的值，假如不存在page，那么页数就是1。
	$page=isset($_GET['page'])?intval($_GET['page']):1;
	$offset=($page-1)*$pagesize;         //获取limit的第一个参数的值
	//echo $offset,$pagesize;
	if($remCheck == 0){
		if($type_id==''){
			$shareFlag=mysql_query("select * from file_inf where share=1 limit $offset,$pagesize");
			//var_dump($shareFlag);die;
			$share=mysql_fetch_assoc($shareFlag);
			//var_dump($share);die;
			$countFlag=mysql_query('select count(*) from file_inf where share=1');
			$count=mysql_fetch_array($countFlag);
			$countNum=$count[0];
		}else{
			$shareFlag=mysql_query("select * from file_inf where share=1 and type_id='$type_id' limit $offset,$pagesize");
			$share=mysql_fetch_assoc($shareFlag);
			$countFlag=mysql_query("select count(*) from file_inf where share=1 and type_id='$type_id'");
			$count=mysql_fetch_array($countFlag);
			$countNum=$count[0];
		}
	}else{
		if($type_id==''){
			$shareFlag=mysql_query("select * from file_inf where share=1 and rem_name='$rem[rem_name]' limit $offset,$pagesize");
			//var_dump($shareFlag);die;
			$share=mysql_fetch_assoc($shareFlag);
			//var_dump($share);die;
			$countFlag=mysql_query("select count(*) from file_inf where share=1 and rem_name='$rem[rem_name]'");
			$count=mysql_fetch_array($countFlag);
			$countNum=$count[0];
		}else{
			$shareFlag=mysql_query("select * from file_inf where share=1 and rem_name='$rem[rem_name]' and type_id='$type_id' limit $offset,$pagesize");
			$share=mysql_fetch_assoc($shareFlag);
			$countFlag=mysql_query("select count(*) from file_inf where share=1 and rem_name='$rem[rem_name]' and type_id='$type_id'");
			$count=mysql_fetch_array($countFlag);
			$countNum=$count[0];
		}
		
	}
	if($countNum==0){
		echo "<div style='margin:40% 0 0 30%; font-size:36px; color:#ccc'>暂无分享</div>";
	}else{
	 	$pages=ceil($countNum/$pagesize); //获得总页数
	 
	 	//假如传入的页数参数page 大于总页数 pages，则显示错误信息并返回到第一页
	 	if($pages>0){
	 		if($page>$pages || $page == 0){
       		echo "<script language='javascript' > ";
	  		echo 'alert("共有'.$pages.'页！请输入正确页数！");';
	   		echo "</script>";
      		exit;
	 		}
		}
		if($share){
			do{
?>
<div class="shareInf">
	<div class="topic">
    	<?php 
			
			$remSql1=mysql_query("select * from rem_inf where rem_name='$share[rem_name]'");
			$rem1=mysql_fetch_assoc($remSql1);
			
			//var_dump($rem1);
			$style=explode(".","$share[file_name]");
			$style[1]=strtolower(end($style));//转为小写
			//$style[1]=strtolower(preg_replace('/(.)([A-Z])/', '', $style[1]));//匹配大写并转成小写
			//echo strtolower(preg_replace('/(.)([A-Z])/', '', 'weadguogd'));;die;
			//print_r($style[1]);
			$styleCase=(($style[1]=='jpg')||($style[1]=='jpeg')||($style[1]=='png')||($style[1]=='gif'))?'img':((($style[1]=='doc')||($style[1]=='docx')||($style[1]=='dot'))?'doc':((($style[1]=='ppt')||($style[1]=='pps')||($style[1]=='pptx'))?'ppt':(($style[1]=='txt')?'txt':((($style[1]=='avi')||($style[1]=='mpg')||($style[1]=='mpeg')||($style[1]=='mvb')||($style[1]=='flv')||($style[1]=='rmvb'))?'mv':(($style[1]=='pdf')?'pdf':((($style[1]=='rar')||($style[1]=='zip'))?'rar':((($style[1]=='xla')||($style[1]=='xlc')||($style[1]=='xlm')||($style[1]=='xls')||($style[1]=='xlt'))?'exel':((($style[1]=='wav')||($style[1]=='mp2')||($style[1]=='mp3'))?'music':'other'))))))));
			//echo $styleCase;
			switch($styleCase)
			{
				case 'img':
					echo "<img src='../images/pic.png' width='23' />";
					break;
				case 'doc':
					echo "<img src='../images/doc.png' width='23'/>";
					break;
				case 'ppt':
					echo "<img src='../images/ppt.png' width='23'/>";
					break;	
				case 'pdf':
					echo "<img src='../images/pdf.png' width='23'/>";
					break;
				case 'music':
					echo "<img src='../images/music.png' width='23'/>";
					break;
				case 'mv':
					echo "<img src='../images/mv.png' width='23'/>";
					break;
				case 'rar':
					echo "<img src='../images/rar.png' width='23'/>";
					break;	
				case 'exel':
					echo "<img src='../images/exel.png' width='23'/>";
					break;
				case 'txt':
					echo "<img src='../images/txt.png' height='18'/>";
					break;
				case 'other':
					echo "<img src='../images/ot.png' width='23'/>";
					break;
				default;			
	
			}
			
		?>
    	<a href="file.php?id=<?php echo $share[file_id];?>" target="new"><?php echo $share[file_name];?></a>
        <span style="float:right;mergin-right:20px;">下载数：<?php echo $share[download_count];?></span>
    </div>
    <div class="size">
    	<span>详情：<?php 
			if($share[file_size]>1000&&$share[file_size]<=1000000){
				echo sprintf("%.2f",$share[file_size]/1000).'kb';
			}elseif($share[file_size]<=1000){
				echo sprintf("%.2f",$share[file_size]).'b';
			}elseif($share[file_size]>1000000){
				echo sprintf("%.2f",$share[file_size]/1000000).'M';
			}
		?>
		</span>&nbsp;&nbsp;&nbsp;&nbsp;
        <span>类型：
			<?php
				$typeFlag=mysql_query("select type_name from type where type_id='$share[type_id]'");
				$type=mysql_fetch_array($typeFlag);
				echo $type[0];
        	?>
        </span>
        <span style="float:right;mergin-right:20px;"><a href="down.php?id=<?php echo $share[file_id];?>&share=0&delet=0&down=1">下载</a></span>
    </div>
    <div class="inf">
    	<span style="float:left"><img src="../images/icon1.png" width="18" height="18"  /></span>
        <span style="float:left" class="name"><a href="#"><?php echo $share[rem_name];?></a></span>	        <!--href="rem_share.php?id='<?php //echo $rem1[rem_id];?>'" target="con"(查看他人分享内容)-->
        <span style="float:right" class="time"><?php echo $share[upload_date];?></span>
    </div>
    <br />
</div>
<?php
			$share=mysql_fetch_assoc($shareFlag);	
			}while($share);
		}
?>
	
	<form class="page" method="get" action="">
  		<div align="center" style="color:#999; font-size:12px;">
        	每页<strong> <?php echo $pagesize;?> </strong>条　
        	总记录:<strong><?php echo $countNum;?></strong> 　			
            总页数:<strong><?php echo $pages;?></strong> 　
        	目前页数:<input type="text" name="page" class="textpage" size="3"  style="height:12px;width:30px;" />
            <?php
			//判断首页与尾页
				$first=1;
				$prev=$page-1;
				$next=$page+1;
				$last=$pages;
				if($type_id==''){
					if ($page > 1){
						echo "<a href='otherShare.php?shareid=".$remCheck."&page=".$first."'>&nbsp;&nbsp;首页&nbsp;&nbsp;</a> ";
						echo "<a href='otherShare.php?shareid=".$remCheck."&page=".$prev."'>上一页&nbsp;&nbsp;</a>";	
					}

					if ($page < $pages){
						echo "<a href='otherShare.php?shareid=".$remCheck."&page=".$next."'>&nbsp;&nbsp;下一页</a>"; 
						echo "<a href='otherShare.php?shareid=".$remCheck."&page=".$last."'>&nbsp;&nbsp;尾页</a> ";
					}
				}else{
					if ($page > 1){
						echo "<a href='otherShare.php?shareid=".$remCheck."&type_id=".$type_id."&page=".$first."'>&nbsp;&nbsp;首页&nbsp;&nbsp;</a> ";
						echo "<a href='otherShare.php?shareid=".$remCheck."&type_id=".$type_id."&page=".$prev."'>上一页&nbsp;&nbsp;</a>";	
					}

					if ($page < $pages){
						echo "<a href='otherShare.php?shareid=".$remCheck."&type_id=".$type_id."&page=".$next."'>&nbsp;&nbsp;下一页</a>"; 
						echo "<a href='otherShare.php?shareid=".$remCheck."&type_id=".$type_id."&page=".$last."'>&nbsp;&nbsp;尾页</a> ";
					}
				}
			   mysql_close($conn); //关闭连接
	 }
	 	?>
  		</div>
	</form>
  
</body>
</html>