<?php
header("Content-type:text/html; charset=utf-8");
//屏蔽sql关键词
require_once('../conn/function.php');
//trim()函数可以截去头尾的空白字符
$rem_name = trim($_POST['rem_id']);//rem_id是表单中name的值
$rem_password = $_POST['rem_password'];
$rem_cpassword = $_POST['rem_cpassword'];
$rem_sex =$_POST["sex"];
$rem_email = trim($_POST['rem_email']);
//var_dump($_POST);die;
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
		echo 'alert("密码必须在6到30个字符之间！");'; 
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
		echo 'alert("该用户名已经被注册，请换一个重试！");'; 
		echo "window.location.href='regidter.htm';";
		echo "</script>";
	}else{
		if($checkIllegalWord==0){
		//将用户信息插入数据库的rem_inf表
			date_default_timezone_set('PRC');
			$showtime=date('Y-m-d H:i:s',time());//获取当前时间
			//echo $rem_name,$rem_password, $rem_email,$showtime,$rem_sex;

			$sql ="insert into rem_inf(rem_name,rem_password,rem_email,login_time,rem_sex) values";
			$sql .="('$rem_name','".md5($rem_password)."','$rem_email','$showtime','$rem_sex')";
			//var_dump($sql);die;
			$result = mysql_query($sql);
			if(!$result){
				//mysql_free_result($result); //释放结果集
				mysql_close($conn); //关闭连接
				echo "<script language='javascript' > ";
				echo 'alert("数据记录插入失败！");';
				echo "</script>";
				exit;
			}else{
				echo "<script language='javascript' > ";
				echo 'alert("您已注册成功，请登录！");'; 
				echo "window.location.href='login.htm';";
				echo "</script>";
			}
		}
		mysql_close($conn);
	}
	
}

?>