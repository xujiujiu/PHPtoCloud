<?php
session_start(); //注册session变量
//加载防止sql 注入漏洞检查的代码
require_once('../conn/function.php');
$rem_name = $_POST['rem_name'];
$rem_password = $_POST['rem_password'];
//设置一个错误消息变量，以便判断是否有错，在客户端显示错误消息，其初始值为空
//echo $rem_name,$rem_password;
$errmsg = '';
if (!empty($rem_name)){
	//用户填写数据才能执行数据库操作
	if(empty($rem_name)){
		$errmsg='数据输入不完整！';
	}
	if(empty($errmsg)){
		//$errmsg为空说明前面的验证通过
		//数据库连接
		require_once('../conn/conn.php');
		//检查数据库连接
		if(mysqli_connect_errno()){
			$errmsg ='数据库连接失败！';
		}else{
			//查询数据库，看用户名与密码是否正确
			
			$sql = "select * from rem_inf where rem_name='$rem_name' and rem_password='".md5($rem_password)."'";
			$result = mysql_query($sql);
			if($result && mysql_num_rows($result)>0){
				//$errmsg = '登陆成功！';
				//更新登陆信息
				date_default_timezone_set('PRC');
				$showtime=date('Y-m-d H:i:s',time()); //获取时间
				$ip = $_SERVER["REMOTE_ADDR"]; //获取ip
				//echo $ip;die;
				$sql_one = "update rem_inf set lastlogin_time='$showtime',login_count =login_count+1 where rem_name='$rem_name'";
				$sql_two = "insert into rem_record(rem_ip,rem_name,op_date) values('$ip','$rem_name','$showtime')";
				$result1 = mysql_query($sql_one);
				$result2 = mysql_query($sql_two);
				if(!($result1 && $result2)){
					echo "<script language='javascript' > ";
					echo 'alert("数据记录插入失败");'; 
					echo "</script>";
				}else{
					echo "<script language='javascript' > ";
					echo 'alert("登录成功！");'; 
					echo "window.location.href='../rem/remIndex.php';";
					echo "</script>"; 
					$_SESSION['login'] = 'true'; //标记登陆状态true为已经登陆
			    	$_SESSION['rem_name'] = $rem_name; //记录该用户信息
				}
				
			}else{
				echo "<script language='javascript' > ";
				echo 'alert("用户名或者密码不正确，请重新登陆!");'; 
				echo "window.location.href='login.htm';";
				echo "</script>"; 
			}
			mysql_free_result($result); //释放结果集
			mysql_close($conn); //关闭数据库
		}
	}
}


?>