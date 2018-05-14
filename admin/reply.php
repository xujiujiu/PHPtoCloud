<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>留言反馈</title>
</head>
<link  href="../css/usercon.css" type="text/css" rel="stylesheet"/>
<link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
<link href="../css/rem_list.css" type="text/css" rel="stylesheet"/>
<style type="text/css">
	td{color:#000;font-family:'楷体';}
</style>
<body>
<?php 
session_start();
require_once("../conn/conn.php");//连接数据库
$pagesize = 5;//页面尺寸
//获取page的值，假如不存在page，那么页数就是1。
$page=isset($_GET['page'])?intval($_GET['page']):1;
$offset=($page-1)*$pagesize;         //获取limit的第一个参数的值

?>
<div class="con" style="background:#EBF2F9;">
		<div class="top"><p>&nbsp;&nbsp;&nbsp;<i class="fa fa-edit"></i>&nbsp;<b>留言板管理</b>&nbsp;>>&nbsp;处理、查找留言板信息</p></div>
        <div class="search" >
       	  <form class="search" name="search" method="post" action="">
            	主题：&nbsp;<input type="text" name="topic" id="topic" class="topic" size="15"/>&nbsp;
                关键词：<input type="text" name="content_key" id="content_key" class="content_key" size="15"/>&nbsp;
                 &nbsp;<input type="submit" name="button" id="button" value="查找" />&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;
       	  </form> 
        </div>     
</div>
  <?php 
	 	
		$topic = trim($_POST['topic']);
		$content_key = trim($_POST['content_key']);
		$buttonFlag = isset($_POST['button']);
		//var_dump($buttonFlag);die;
		if($buttonFlag){
			if(empty($topic)&&empty($content_key)){
				echo "<script language='javascript' > ";
				echo "alert('请输入关键词！');"; 
				echo  "location.href='reply.php';";
				echo "</script>";
			}else{
				$sql="select * from message where true";
					if($topic!= ''){$sql .=" and message_topic = '$topic'";}
					if($content_key !=''){$sql .= " and message_inf like '%$content_key%'";}
				$result = mysql_query($sql);//执行查询语句
				//var_dump($result);die;
				if($result && mysql_num_rows($result)>0){
					//$search = mysql_fetch_array($result);
					$sql1="select count(*) from message where true";
						if($topic != ''){$sql1 .=" and message_topic = '$topic'";}
						if($content_key !=''){$sql1 .= " and message_inf like '%$content_key%'";}
					$result2=mysql_query($sql1);
					//var_dump($result2);die;
					$array=mysql_fetch_array($result2);
	 				$numrows=$array[0];//获取数据数量
					$sql .=" limit $offset,$pagesize";
	 				$result3=mysql_query($sql);
					$message = mysql_fetch_assoc($result3);//返回数据并生成数组
					
				}else{
					echo "<script language='javascript' > ";
					echo "alert('该信息不存在！');"; 
					echo  "location.href='reply.php';";
					echo "</script>";
				}
			}
		}else{
	 	$result2=mysql_query("select count(*) from message");
		//var_dump($result2);die;
		$array=mysql_fetch_array($result2);
	 	$numrows=$array[0];//获取数据数量
		//echo $numrows;die;
	 	$result3=mysql_query("select * from message order by reply_check desc limit $offset,$pagesize");
		$message=mysql_fetch_assoc($result3);
		 
	 	}	
	    $pages=ceil($numrows/$pagesize); //获得总页数
	 
	 //假如传入的页数参数page 大于总页数 pages，则显示错误信息并返回到第一页
	 if($pages>0){
	 	if($page>$pages || $page == 0){
       	echo "<script language='javascript' > ";
	  	echo 'alert("共有'.$pages.'页！请输入正确页数！");';
	  	echo  "location.href='user_list.php';"; 
	   	echo "</script>";
      	exit;
	 	}
	 }
	 if($message){
		 do{
		    //$result4=mysql_query("select * from file_inf where rem_name = '$user[user_name]'");
	 		//$filenum1 = mysql_num_rows($result4);
			//echo $filenum1;die;
?>
 <div class="con" style="border-bottom:none; border-left:none; width:60%;margin-left:20%;">
 <table  width="100%" align="center" cellpadding="0" cellspacing="0" >
   <tr style=" height:30px; line-height:30px;text-indent:1em; background-color:#EBF2F9;">
     <td style="text-align:left;"><b>主题：</b>[<?php echo $message[message_topic];?>]</td>
     <td style="text-align:left;"><b>发布人：</b>[<?php echo $message[message_id];?>]</p></td>
     <td style="text-align:right;">
     	<span style="float:left;">发表时间：<?php echo $message[message_time];?></span>
        <form method="post" name="<?php echo $message[id];?>" action="message_edit.php?id=<?php echo $message[id];?>&del=1" onsubmit="return delCon();">
        <input type="submit" name="delete" value="删除" style="width:50px;height:30px;"/>
        </form>
     </td>
     </tr>
   <tr style="text-align:left; height:30px; line-height:30px;text-indent:2em ">
     <td colspan="3" style="text-align:left;"><?php echo $message[message_inf];?></td>
   </tr>
   <?php if($message[reply_check]==1){?>
   <tr style="text-align:left; height:30px; line-height:30px;text-indent:1em ">
     <td colspan="3" style="text-align:left;"><b>回复内容：</b><?php echo $message[reply_inf];?></td>
   </tr>
   <tr style=" height:30px; line-height:30px;text-indent:1em;">
     <td colspan="2" style="text-align:left;"><b>回复人：</b>[<?php echo $message[reply_id];?>]</td>
     <td style="text-align:right;">回复时间：[<?php echo $message[reply_time];?>]</p></td>
   </tr>
   <?php }else{?>
   <tr style="text-align:left; height:30px; line-height:30px;text-indent:2em ">
     <td colspan="3" style="text-align:left;">
     <form method="post" name="<?php echo $message[id];?>" action="message_edit.php?id=<?php echo $message[id];?>&reply=1">
   			<label name="textarea"></label>
        	<textarea name="replyCon" cols="50" rows="3" id="replyCon"></textarea>
       	 	<input type="submit" name="submit" value="回复" />
        </form></td>
   </tr>
   <?php }?>
 </table>
 
</div>
<br />
  <?php
			$message=mysql_fetch_assoc($result3);
		 }while($message);
	 }
?>
<form class="page" method="get" action="">
  		<div align="center">
        	每页显示<strong> <?php echo $pagesize;?> </strong>条　
        	总记录:<strong><?php echo $numrows;?></strong> 　			
            总页数:<strong><?php echo $pages;?></strong> 　
        	目前页数:<input type="text" name="page" class="textpage" size="3"  style="height:20px;width:40px;" />
            <?php
			//判断首页与尾页
				$first=1;
				$prev=$page-1;
				$next=$page+1;
				$last=$pages;
				if ($page > 1){
					echo "<a href='user_list.php?page=".$first."'>&nbsp;&nbsp;首页&nbsp;&nbsp;</a> ";
					echo "<a href='user_list.php?page=".$prev."'>上一页&nbsp;&nbsp;</a>";	
				}

				if ($page < $pages){
					echo "<a href='user_list.php?page=".$next."'>&nbsp;&nbsp;下一页</a>"; 
					echo "<a href='user_list.php?page=".$last."'>&nbsp;&nbsp;尾页</a> ";
				}
				mysql_free_result($result3); //释放结果集
			   mysql_close($conn); //关闭连接
            ?>
  </div>
</form>
</body>
<script language="javascript" src="../js/check_data.js"></script>
<script type="text/javascript" language="javascript">
//删除数据--------------------------
	function delCon(){
    	if(window.confirm('删除后无法恢复，确定删除吗？')){
             return;
             
        }else{
             //alert('取消');
			location.href="reply.php";
            return false;
        }
	}
	/*function replyMessage(el){
		this.el = el || {};
		document.getElementsByClassName(el).show();
		
	}*/
</script>
</html>