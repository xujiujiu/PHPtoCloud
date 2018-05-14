<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>修改成员</title>
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
	$sql="select * from rem_inf where rem_id='$_GET[id]'";
	$result=mysql_query($sql);
	$rem=mysql_fetch_assoc($result);
//修改成员信息
if($_GET[Action]==edit){
?>
	<div class="con" style="background:#EBF2F9;">
		<div class="top"><p>&nbsp;&nbsp;&nbsp;<i class="fa fa-user"></i>&nbsp;<b>成员列表</b>&nbsp;>>&nbsp;删除，修改成员信息</p></div>
        <div class="edit" >
       	  <form  name="edit" method="post" action="" onsubmit="return editConfirm();">
          		
            	<ul class="editul">
                    <li class="first">
                     	&nbsp;&nbsp;<a href="rem_add.php" onClick='changeAdminFlag('添加成员')'>添加成员</a>
                        &nbsp;|&nbsp;<a href="rem_list.php" onClick='changeAdminFlag('成员信息')'>查看成员</a>
                    </li>
                	<li>
                    	账号：&nbsp;&nbsp;
                        <input type="text" name="rem_name"  class="rem_name" value="<?php echo $rem[rem_name]?>" disabled="disabled"/>
                    </li>
                	<li>
                    	密码：&nbsp;&nbsp;
                        <input type="password" name="rem_password"  class="rem_password" value="<?php echo $rem[rem_password]?>"  disabled="disabled"/>
                    </li>
                	<li class="editsex">
                    	性别：&nbsp;&nbsp;
                        <input  type="radio"  name="sex" value="男" <?php if($rem['rem_sex']=='男') echo " checked"; ?>/>男
     	     		 	<input  type="radio"   name="sex" value="女"<?php if($rem['rem_sex']=='女') echo " checked"; ?>/>女
                    </li>
                    <li>
                    	邮箱：&nbsp;&nbsp;
                        <input class="rem_email" type="text"  name="rem_email" value="<?php echo $rem[rem_email]?>" />
                    </li>
                  <li class="personal_inf">
                    	个性签名：
                    	  <textarea name="personal_inf" id="textarea" cols="19" rows="2"><?php echo $rem[personal_inf]?></textarea>
                    </li>
                    <li class="button">
                        <input type="reset" name="reset" id="button" value="重置" />
                    	<input type="submit" name="submit" id="button" value="修改"  />
                    </li>
                </ul>
             </form> 
                    <?php
						$rem_name = trim($_POST['rem_name']);
						$rem_password = $_POST['rem_password'];
						$rem_sex =$_POST["sex"];
						$rem_email = trim($_POST['rem_email']);
						$personal_inf = $_POST['personal_inf'];
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
								location.href="rem_edit.php?Action=edit&id=<?php echo $_GET[id];?>";
                			 	return false;
             				}
						}
					</script>
                    <?PHP
					 
					  //echo $edit;die;
					  if($submitFlag){
							
							//与客户端验证email时相同的正则表达式
								$pattern = "/^([0-9A-Za-z\\-_\\.]+)@([0-9a-z]+\\.[a-z]{2,3}(\\.[a-z]{2})?)$/i";
								if(!preg_match($pattern, $rem_email)){
									echo "<script language='javascript' > ";
									echo 'alert("Email格式不合法！");'; 
									echo "</script>";
									exit;
								}
								if(strlen($personal_inf) < 0 ||strlen($personal_inf)>50){
									echo "<script language='javascript' > ";
									echo 'alert("个签不得超过50个字符！");'; 
									echo "</script>";
									exit;
								} 
									//更新成员表
									$sql1 ="update rem_inf set rem_email='$rem_email',rem_sex='$rem_sex',personal_inf='$personal_inf' where rem_id='$_GET[id]'";
									//添加到记录表
									$sql2 = "insert into user_record(user_ip,user_name,user_opdate,user_operation) values('$ip','$_SESSION[user_name]','$showtime','修改成员[".$rem_name."]信息')";
									//更新文件表
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
										echo "location.href='rem_edit.php?Action=edit&id=$_GET[id]'";
										echo "</script>";
									}
								
						
						mysql_free_result($result); //释放结果集
					  }
                    ?>
        	
        </div>     
	</div>
<?php
//删除成员信息
}elseif($_GET[Action]==del){
	//echo $_GET[onclick];die;
	//if($_GET[onclick]){
		//删除成员表数据
		$sql5="delete from rem_inf where rem_id='$_GET[id]'";
		//删除文件表记录
		$sql6="delete from file_inf where rem_name='$rem[rem_name]'";
		//添加到记录表
		$sql7 = "insert into user_record(user_ip,user_name,user_opdate,user_operation) values('$ip','$_SESSION[user_name]','$showtime','删除成员[".$rem['rem_name']."]信息')";
		$result5 = mysql_query($sql5);
		$result6 = mysql_query($sql6);
		$result7 = mysql_query($sql7);
		//var_dump($result6);die;
		if(!($result5&&$result6&&$result7)){
			echo "<script language='javascript' > ";
			echo 'alert("数据记录失败！");'; 
			//echo "windows.location.href='rem_list.php";
			echo "</script>";
			exit;
		}else{

			//echo "删除成功！";
			echo "<script language='javascript' > ";
			echo 'alert("删除成功");'; 
			echo "document.location = 'rem_list.php'";
			echo "</script>";

		}
    }
//}
mysql_close($conn); //关闭连接
?>
</body>
</html>