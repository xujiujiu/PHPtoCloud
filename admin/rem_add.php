<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>添加成员</title>
<link  href="../css/usercon.css" type="text/css" rel="stylesheet"/>
<link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
<link href="../css/rem_list.css" type="text/css" rel="stylesheet"/>
</head>
<body>
<div class="con" style="background:#EBF2F9;">
		<div class="top"><p>&nbsp;&nbsp;&nbsp;<i class="fa fa-user"></i>&nbsp;<b>添加账号</b>&nbsp;>>&nbsp;添加成员信息</p></div>
        <div class="edit" >
       	  <form  name="add" method="post" action="">
          	<ul class="editul">
            	<li class="first">
                     &nbsp;&nbsp;<a href="rem_add.php" onClick='changeAdminFlag('添加成员')'>添加成员</a>
                     &nbsp;|&nbsp;<a href="rem_list.php" onClick='changeAdminFlag('成员信息')'>查看成员</a>
                </li>
                <li>
                    账号：&nbsp;&nbsp;
                    <input type="text" name="rem_name"  class="rem_name" value=""/>
                </li>
                <li>
                    密码：&nbsp;&nbsp;
                    <input type="password" name="rem_password"  class="rem_password" value="" />
                </li>
                <li>
                    确认密码：
                    <input type="password" name="rem_cpassword"  class="rem_cpassword" value="" />
                </li>
                <li class="editsex">
                    性别：&nbsp;&nbsp;&nbsp;
                    <input  type="radio"  name="sex" value="男"  checked="checked"/>男
     	     		<input  type="radio"   name="sex" value="女"/>女
                </li>
                <li>
                    邮箱：&nbsp;&nbsp;
                    <input class="rem_email" type="text"  name="rem_email" value="" />
                </li>
                <li class="personal_inf">
                    个性签名：
                    <textarea name="personal_inf" id="textarea" cols="15" rows="2" value=""></textarea>
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
$rem_name = trim($_POST['rem_name']);
$rem_password = $_POST['rem_password'];
$rem_cpassword = $_POST['rem_cpassword'];
$rem_sex =$_POST["sex"];
$rem_email = trim($_POST['rem_email']);
$personal_inf = $_POST['personal_inf'];
$submitFlag = isset($_POST['submit']);
//var_dump($_POST);die;
if($submitFlag){
	//数据验证，empty()函数判断变量内容是否为空
	if (empty($rem_name) || empty($rem_password) || $rem_cpassword != $rem_password){
		echo "<script language='javascript' > ";
		echo 'alert("数据输入不完整！");'; 
		echo "</script>";
		exit;
	}else{
		//密码长度判断
		if(strlen($rem_password) < 6 ||strlen($rem_password)>20){
			echo "<script language='javascript' > ";
			echo 'alert("密码必须在6到20个字符之间！");'; 
			echo "</script>";
			exit;
		} 
		if(strlen($personal_inf) < 0 ||strlen($personal_inf)>50){
			echo "<script language='javascript' > ";
			echo 'alert("个签不得超过50个字符！");'; 
			echo "</script>";
			exit;
		} 
		//与客户端验证email时相同的正则表达式
		$pattern = "/^([0-9A-Za-z\\-_\\.]+)@([0-9a-z]+\\.[a-z]{2,3}(\\.[a-z]{2})?)$/i";
		if(!preg_match($pattern, $rem_email)){
			echo "<script language='javascript' > ";
			echo 'alert("Email格式不合法！");'; 
			echo "</script>";
			exit;
		}
		//创建数据库连接
		require_once('../conn/conn.php');
		//查询数据库，看填写的用户名是否存在
		$sql = "select * from rem_inf where rem_name = '".$rem_name."'";
		$result = mysql_query($sql);
		if($result && mysql_num_rows($result)>0){
			//弹出提示框并返回
			echo "<script language='javascript' > ";
			echo 'alert("该用户名已存在，请换一个重试！");'; 
			echo "</script>";
		}else{
			//将用户信息插入数据库的rem_inf表
			date_default_timezone_set('PRC');
			$showtime=date('Y-m-d H:i:s',time());//获取当前时间
			//echo $rem_name,$rem_password, $rem_email,$showtime,$rem_sex;

			$sql1 ="insert into rem_inf(rem_name,rem_password,rem_email,login_time,rem_sex,personal_inf) values";
			$sql1 .="('$rem_name','$rem_password','$rem_email','$showtime','$rem_sex','$personal_inf')";
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
				echo 'alert("添加成员成功！");'; 
				echo "</script>";
			}
			mysql_close($conn);
		}
	
	}
}
?>
</body>
</html>