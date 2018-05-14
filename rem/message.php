<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>信息反馈</title>
</head>
<style type="text/css">
*{margin:0;padding:0;}
body{
	/*background-color:#CCC;*/
}
.messageButton{
	margin:20px 0 0 20px;
}
.hide .message{
	display:none;
}
.show .message{
	display:block;
}
.message{
	background-color:#eee;
	width:60%;
	margin:0 auto;
	margin-top:20px;
	box-shadow:0 0 5px rgba(f,f,f,0.5);
	-moz-box-shadow:0 0 5px rgba(f,f,f,0.5);
	-ms-box-shadow:0 0 5px rgba(f,f,f,0.5);
	-o-box-shadow:0 0 5px rgba(f,f,f,0.5);
	-webkit-box-shadow:0 0 5px rgba(f,f,f,0.5);
}
.message form{
	margin-left:80px;
	font-family:'楷体';
	font-size:24px;
	
}
.message input{
	font-family:'楷体';
	font-size:18px;
	margin:20px 0 20px 0;
}
.list{
	margin:20px 0 0 20px;
	border:#069 solid 2px;
	border-radius:5px;
}
p{
	margin-top:10px;
	margin-left:20px;
	margin-bottom:-10px;
	font-family:'楷体';
	font-size:36px;
	color:#069;
}
</style>
<link href="../css/rem_list.css" type="text/css" rel="stylesheet"/>
<script language="javascript" src="../js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" language="javascript">
	function messageFlag(obj)
      {
      //var obj_parent=obj.parentNode;
      var obj_parent=obj.parentElement
     
      if(obj_parent.className=="show")
      {
		  //alert(1);
        obj_parent.className="hide";
      }
      else
      {
        obj_parent.className="show";
      }
     
    }
</script>
<body>
<?php
	session_start(); //注册session变量
	require_once("../conn/conn.php");
	//屏蔽sql关键词
	require_once('../conn/function.php');
	date_default_timezone_set('PRC');
	$showtime=date('Y-m-d H:i:s',time()); //获取时间
	$topic=$_POST['topic'];
	$content = $_POST['content'];
	$buttonFlag=isset($_POST['submit']);
	if($_SESSION[rem_name]){$remCheck=1;}else{$remCheck=0;}
?>
<?php if($remCheck==1){?>
<div class="hide">
	<input class="messageButton" type="button" value="我要留言" onclick="javascript:messageFlag(this)"/>
	<div class="message">
 	 	<form name="message" method="post" action="">
			标题：<input name="topic" type="text" class="topic" size="20"/><br />
   	    	内容：<textarea name="content" cols="30" rows="5" class="content" style="font-family:'楷体';font-size:18px;"></textarea><br />
    		<input name="重置" type="reset" value="重置"/>
    		<input name="submit" type="submit" value="提交" />
		</form>
	</div>
</div>
<?php
	if($buttonFlag){
		if(empty($topic)||empty($content)){
			echo "<script language='javascript' > ";
			echo "alert('信息输入不完整，请重新输入！')";
			echo "</script>";
			exit;
		}else{
			$sql="insert into message(message_id,message_topic,message_inf,message_time) value('$_SESSION[rem_name]','$topic','$content','$showtime')";
			$subFlag=mysql_query($sql);
			if(!$subFlag){
				echo "<script language='javascript' > ";
				echo "alert('数据输入错误！')";
				echo "</script>";
				exit;
			}
		}
	}
?>

<?php
	$sql1="select * from message where message_id='$_SESSION[rem_name]'";
	$mesFlag=mysql_query($sql1);
	$message=mysql_fetch_assoc($mesFlag);
	if($message){
		do{
?>
<div class="con" style="border:none;width:60%;margin:20px 0 0 20px;border-top:#3F89EC solid 2px;border-right:#3F89EC solid 2px;border-radius:5px;">
 <table  width="100%" align="center" cellpadding="0" cellspacing="0">
   <tr style=" height:30px; line-height:30px;text-indent:1em; background-color:#EBF2F9;">
     <td style="text-align:left;"><b>主题：</b>[<?php echo $message[message_topic];?>]</td>
     <td style="text-align:left;"><b>发布人：</b>[<?php echo $message[message_id];?>]</p></td>
     <td style="text-align:right;">
     	<span style="float:left;">发表时间：<?php echo $message[message_time];?></span>
        <span  style="width:50px;height:30px;"><?php if($message[reply_check]==1){echo "<font color='#aaa'>"."已回复"."</font>";}else{echo "<font color='red'>".'未回复'."</font>";}?></span>
        <!--<form method="post" name="<?php echo $message[id];?>" action="message_edit.php?id=<?php echo $message[id];?>&del=1" onsubmit="return delCon();">
        <input type="submit" name="delete" value="删除" style="width:50px;height:30px;"/>
        </form>-->
     </td>
     </tr>
   <tr style="text-align:left; height:30px; line-height:30px;text-indent:2em ">
     <td colspan="3" style="text-align:left;"><?php echo $message[message_inf];?></td>
   </tr>
   <tr style="text-align:left; height:30px; line-height:30px;text-indent:1em ">
     <td colspan="3" style="text-align:left;"><b>回复内容：</b><?php if(empty($message[reply_inf])){echo '暂无回复';}else{echo $message[reply_inf];} ?></td>
   </tr>
   <tr style=" height:30px; line-height:30px;text-indent:1em;">
     <td colspan="2" style="text-align:left;"><b>回复人：</b>[<?php if(empty($message[reply_id])){echo '无';}else{echo $message[reply_id];} ?>]</td>
     <td style="text-align:right;">回复时间：[<?php echo $message[reply_time];?>]</p></td>
   </tr>
   <!--<tr style="text-align:left; height:30px; line-height:30px;text-indent:2em ">
     <td colspan="3" style="text-align:left;">
     <form method="post" name="<?php echo $message[id];?>" action="message_edit.php?id=<?php echo $message[id];?>&reply=1">
   			<label name="textarea"></label>
        	<textarea name="replyCon" cols="50" rows="3" id="replyCon"></textarea>
       	 	<input type="submit" name="submit" value="回复" />
        </form>
     </td>
   </tr>-->
 </table>
 
</div>
<br />
<?php
			$message=mysql_fetch_assoc($mesFlag);
		}while($message);
	}
?>

<?php }else{?>
<p>您还未登陆</p>
<p>请登录后留言</p>
<?php }
	mysql_close($conn);
?>
</body>
</html>