<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>修改管理员</title>
<link  href="../css/usercon.css" type="text/css" rel="stylesheet"/>
<link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
<link href="../css/rem_list.css" type="text/css" rel="stylesheet"/>
</head>
<body>
<?php

	session_start();
	date_default_timezone_set('PRC');
	$showtime=date('Y-m-d H:i:s',time());//获取当前时间
	$ip = $_SERVER["REMOTE_ADDR"]; //获取ip
	//屏蔽sql关键词
	require_once('../conn/function.php');
	require_once('../conn/conn.php');
	$sql="select * from user where ID='$_GET[id]'";
	$result=mysql_query($sql);
	$user=mysql_fetch_assoc($result);
//修改管理员信息
if($_GET[Action]==edit){
?>
	<div class="con" style="background:#EBF2F9;">
		<div class="top"><p>&nbsp;&nbsp;&nbsp;<i class="fa fa-user"></i>&nbsp;<b>管理员列表</b>&nbsp;>>&nbsp;删除，修改管理员信息</p></div>
        <div class="edit" >
       	  <form  name="edit" method="post" action="" onsubmit="return editConfirm();">
          		
            	<ul class="editul">
                    <li class="first">
                     	&nbsp;&nbsp;<a href="user_add.php" onClick='changeAdminFlag('添加管理员')'>添加管理员</a>
                        &nbsp;|&nbsp;<a href="user_list.php" onClick='changeAdminFlag('管理员信息')'>查看管理员</a>
                    </li>
                	<li>
                    	账号：&nbsp;&nbsp;
                        <input type="text" name="user_name"  class="user_name" value="<?php echo $user[user_name]?>" disabled="disabled"/>
                    </li>
                	<li>
                    	密码：&nbsp;&nbsp;
                        <input type="password" name="user_password"  class="user_password" value="<?php echo $user[user_password]?>" />
                    </li>
                    <li class="button">
                        <input type="reset" name="reset" id="button" value="重置" />
                    	<input type="submit" name="submit" id="button" value="修改"  />
                    </li>
                </ul>
             </form> 
                    <?php
						$user_name = trim($_POST['user_name']);
						$user_password = $_POST['user_password'];
						$submitFlag = isset($_POST['submit']);
							
					?>
                    <!--确定取消对话框-->
               		<script type='text/javascript' language='javascript'>
						 function editConfirm(){
    						if(window.confirm('修改后无法恢复，确定修改吗？')){
                 				//alert('确定');
                 				return true;
              				}else{
                			 	//alert('取消');
								location.href="user_edit.php?Action=edit&id=<?php echo $_GET[id];?>";
                			 	return false;
             				}
						}
					</script>
                    <?PHP
					 
					  //echo $edit;die;
					  if($submitFlag){
						
							if ( empty($user_password)){
								echo "<script language='javascript' > ";
								echo 'alert("数据输入不完整！");'; 
								echo "</script>";
								exit;
							}else{
							//密码长度判断
								if(strlen($user_password) < 4 ||strlen($user_password)>20){
									echo "<script language='javascript' > ";
									echo 'alert("密码必须在4到20个字符之间！");'; 
									echo "</script>";
									exit;
								}else{
									//将用户信息插入数据库的user_inf表
									//更新管理员表
									$sql1 ="update user set user_password='".md5($user_password)."' where ID='$_GET[id]'";
									//添加到记录表
									$sql2 = "insert into user_record(user_ip,user_name,user_opdate,user_operation) values('$ip','$_SESSION[user_name]','$showtime','修改管理员[".$user_name."]信息')";
									$result1 = mysql_query($sql1);
									$result2 = mysql_query($sql2);
									if(!($result1&&$result2)){
										echo "<script language='javascript' > ";
										echo 'alert("数据记录插入失败");'; 
										echo "</script>";
										exit;
									}else{
										echo "<script language='javascript' > ";
										echo 'alert("修改成功");'; 
										echo "location.href='user_edit.php?Action=edit&id=$user[ID]'";
										echo "</script>";
									}
								}
							}
						mysql_free_result($result); //释放结果集
					  }
                    ?>
        	
        </div>     
	</div>
<?php
//删除管理员信息
}elseif($_GET[Action]==del){
	//echo $_GET[onclick];die;
	//if($_GET[onclick]){
		//删除管理员表数据
		$sql5="delete from user where ID='$_GET[id]'";
		//删除文件表记录
		$sql6="delete from file_inf where rem_name='$user[user_name]'";
		//添加到记录表
		$sql7 = "insert into user_record(user_ip,user_name,user_opdate,user_operation) values('$ip','$_SESSION[user_name]','$showtime','删除管理员[".$user['user_name']."]信息')";
		$result5 = mysql_query($sql5);
		$result6 = mysql_query($sql6);
		$result7 = mysql_query($sql7);
		//var_dump($result6);die;
		if(!($result5&&$result6&&$result7)){
			echo "<script language='javascript' > ";
			echo 'alert("数据记录失败！");'; 
			//echo "windows.location.href='user_list.php";
			echo "</script>";
			exit;
		}else{

			//echo "删除成功！";
			echo "<script language='javascript' > ";
			echo 'alert("删除成功");'; 
			echo "document.location = 'user_list.php'";
			echo "</script>";

		}
    }
//}
mysql_close($conn); //关闭连接
?>
</body>
</html>