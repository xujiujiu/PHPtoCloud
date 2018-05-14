<?php
//数据库连接
require_once('../conn/conn.php');
session_start(); //注册session变量
//加载防止sql 注入漏洞检查的代码
require_once('../conn/function.php');
$user_name = $_POST['user_name'];
$user_password = $_POST['user_password'];
$errmsg = '';
if(!empty($user_name)){
	if(empty($user_password)){
		echo "数据输入不完整！";
	}else{
		if(empty($errmsg)){
			//$errmsg为空说明前面的验证通过
				//查询数据库，看用户名与密码是否正确
				$sql = "select * from user where user_name='$user_name' and user_password='".md5($user_password)."'";
				$result = mysql_query($sql);
				if($result && mysql_num_rows($result)>0){
					//更新登陆信息
					date_default_timezone_set('PRC');
					$showtime=date('Y-m-d H:i:s',time()); //获取时间
					$ip = $_SERVER["REMOTE_ADDR"]; //获取ip
					$sql_one = "update user set user_logincount =user_logincount+1 where user_name='$user_name'";
					$sql_two = "insert into user_record(user_ip,user_name,user_opdate) values('$ip','$user_name','$showtime')";
					//var_dump($sql_two);die;
					$result1 = mysql_query($sql_one);
					$result2 = mysql_query($sql_two);
					//var_dump($result2);die;
					if(!($result1 && $result2)){
						echo "数据插入失败";
					}else{
						echo "<script language='javascript' > ";
						echo 'alert("登录成功！");'; 
						echo "window.location.href='user_index.php';"; //进去后台管理系统
						echo "</script>"; 
					$_SESSION['login'] = 'true'; //标记登陆状态true为已经登陆
			    	$_SESSION['user_name'] = $user_name; //记录该用户信息
					}
				
				}else{
					echo "<script language='javascript' > ";
					echo 'alert("账号或者密码不正确，请重新登陆!");'; 
					echo "window.location.href='user_login.htm';";
					echo "</script>"; 
				}
				mysql_free_result($result); //释放结果集
				mysql_close($conn); //关闭数据库
			
		}
	}
}

?>