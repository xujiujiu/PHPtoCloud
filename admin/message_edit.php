
 <?php
 	header("Content-type:text/html;charset=utf-8"); 
	session_start();
	require_once('../conn/conn.php');
 	date_default_timezone_set('PRC');
	$showtime=date('Y-m-d H:i:s',time()); //获取时间
 	$delete=$_GET[del];
	$reply=$_GET[reply];
	$id=$_GET[id];
	$reply_inf=$_POST[replyCon];
	if($delete==1){
		$deleteSql=mysql_query("delete from message where id='$id'");
		if($deleteSql){
			echo "<script language='javascript' > ";
			echo "alert('删除成功！');"; 
			echo  "location.href='reply.php';";
			echo "</script>";
		}
	}
	if($reply==1){
		if(empty($reply_inf)){
			echo "<script language='javascript' > ";
				echo "alert('请输入回复内容！');"; 
				echo  "location.href='reply.php';";
				echo "</script>";
		}else{
			$replySql=mysql_query("update message set reply_id='$_SESSION[user_name]',reply_inf='$reply_inf',reply_check=1,reply_time='$showtime' where id=$id");
			if($replySql){
				echo "<script language='javascript' > ";
				echo "alert('回复成功！');"; 
				echo  "location.href='reply.php';";
				echo "</script>";
			}
		}
	}
?>
