<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>添加类型</title>
<link  href="../css/usercon.css" type="text/css" rel="stylesheet"/>
<link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
<link href="../css/rem_list.css" type="text/css" rel="stylesheet"/>
</head>
<body>
<div class="con" style="background:#EBF2F9;">
		<div class="top"><p>&nbsp;&nbsp;&nbsp;<i class="fa fa-user"></i>&nbsp;<b>添加类型</b>&nbsp;>>&nbsp;添加类型信息</p></div>
        <div class="edit" >
       	  <form  name="add" method="post" action="">
          	<ul class="editul">
            	<li class="first">
                     &nbsp;&nbsp;<a href="type_add.php" onClick='changeAdminFlag('添加类型')'>添加类型</a>
                     &nbsp;|&nbsp;<a href="type_list.php" onClick='changeAdminFlag('类型信息')'>查看类型</a>
                </li>
                <li>
                    类型名称：
                    <input type="text" name="type_name"  class="type_name" value=""/>
                </li>
                <li class="personal_inf">
                    类型说明：
                    <textarea name="type_inf" id="textarea" cols="15" rows="2" value=""></textarea>
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
$type_name = trim($_POST['type_name']);
$type_inf = $_POST['type_inf'];
$submitFlag = isset($_POST['submit']);
//var_dump($_POST);die;
if($submitFlag){
	//数据验证，empty()函数判断变量内容是否为空
	if (empty($type_name)){
		echo "<script language='javascript' > ";
		echo 'alert("数据输入不完整！");'; 
		echo "</script>";
		exit;
	}else{
		//创建数据库连接
		require_once('../conn/conn.php');
		//查询数据库，看填写的用户名是否存在
		$sql = "select * from type where type_name = '".$type_name."'";
		$result = mysql_query($sql);
		if($result && mysql_num_rows($result)>0){
			//弹出提示框并返回
			echo "<script language='javascript' > ";
			echo 'alert("该类型已存在，请换一个重试！");'; 
			echo "</script>";
		}else{
			$sql1 ="insert into type(type_name,type_inf) values";
			$sql1 .="('$type_name','$type_inf')";
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
				echo 'alert("添加类型成功！");'; 
				echo "</script>";
			}
			mysql_close($conn);
		}
	
	}
}
?>
</body>
</html>