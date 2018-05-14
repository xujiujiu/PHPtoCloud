<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>添加管理员</title>
<link  href="../css/usercon.css" type="text/css" rel="stylesheet"/>
<link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
<link href="../css/rem_list.css" type="text/css" rel="stylesheet"/>
</head>
<body>
<div class="con" style="background:#EBF2F9;">
		<div class="top"><p>&nbsp;&nbsp;&nbsp;<i class="fa fa-th"></i>&nbsp;<b>添加管理员</b>&nbsp;>>&nbsp;添加管理员信息</p></div>
        <div class="edit" >
       	  <form  name="add" method="post" action="">
          	<ul class="editul">
            	<li class="first">
                     &nbsp;&nbsp;<a href="user_add.php" onClick='changeAdminFlag('添加管理员')'>添加管理员</a>
                     &nbsp;|&nbsp;<a href="user_list.php" onClick='changeAdminFlag('管理员信息')'>查看管理员</a>
                </li>
                <li>
                    账号：&nbsp;&nbsp;
                    <input type="text" name="user_name"  class="user_name" value=""/>
                </li>
                <li>
                    密码：&nbsp;&nbsp;
                    <input type="password" name="user_password"  class="user_password" value="" />
                </li>
                <li>
                    确认密码：
                    <input type="password" name="user_cpassword"  class="user_cpassword" value="" />
                </li>
                <li class="button">
                    <input type="reset" name="reset" id="button" value="重置" />
                    <input type="submit" name="submit" id="button" value="添加" />
                </li>
             </ul> 
             
           </form> 
        </div>     
</div>
<?php
//屏蔽sql关键词
require_once('../conn/function.php');
//trim()函数可以截去头尾的空白字符
$user_name = trim($_POST['user_name']);
$user_password = $_POST['user_password'];
$user_cpassword = $_POST['user_cpassword'];
$submitFlag = isset($_POST['submit']);
//var_dump($_POST);die;
if($submitFlag){
	//数据验证，empty()函数判断变量内容是否为空
	if (empty($user_name) || empty($user_password) || $user_cpassword != $user_password){
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
		} 

		//创建数据库连接
		require_once('../conn/conn.php');
		//查询数据库，看填写的用户名是否存在
		$sql = "select * from user where user_name = '".$user_name."'";
		$result = mysql_query($sql);
		if($result && mysql_num_rows($result)>0){
			//弹出提示框并返回
			echo "<script language='javascript' > ";
			echo 'alert("该账户名已存在，请换一个重试！");'; 
			echo "</script>";
		}else{
			//将用户信息插入数据库的user表
			date_default_timezone_set('PRC');
			$showtime=date('Y-m-d H:i:s',time());//获取当前时间
			$sql1 ="insert into user(user_name,user_password) values";
			$sql1 .="('$user_name','$user_password')";
			//var_dump($sql);die;
			$result1 = mysql_query($sql1);
			if(!$result1){
				mysql_free_result($result1); //释放结果集
				mysql_close($conn); //关闭连接
				echo "<script language='javascript' > ";
				echo 'alert("数据记录插入失败！");';
				echo "</script>";
				exit;
			}else{
				echo "<script language='javascript' > ";
				echo 'alert("添加管理员成功！");'; 
				echo "</script>";
			}
			mysql_close($conn);
		}
	
	}
}
?>
</body>
</html>