<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>修改类型</title>
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
	$sql="select * from type where type_id='$_GET[id]'";
	$result=mysql_query($sql);
	$type=mysql_fetch_assoc($result);
//修改类型信息
if($_GET[Action]==edit){
?>
	<div class="con" style="background:#EBF2F9;">
		<div class="top"><p>&nbsp;&nbsp;&nbsp;<i class="fa fa-th"></i>&nbsp;<b>类型列表</b>&nbsp;>>&nbsp;删除，修改类型信息</p></div>
        <div class="edit" >
       	  <form  name="edit" method="post" action="" onsubmit="return editConfirm();">
          		
            	<ul class="editul">
                    <li class="first">
                     	&nbsp;&nbsp;<a href="type_add.php" onClick='changeAdminFlag('添加类型')'>添加类型</a>
                        &nbsp;|&nbsp;<a href="type_list.php" onClick='changeAdminFlag('类型信息')'>查看类型</a>
                    </li>
                	<li>
                    	类型编号：
                        <input type="text" name="type_id"  class="type_id" value="<?php echo $type[type_id]?>" disabled="disabled"/>
                    </li>
                	<li>
                    	类型名称：
                        <input type="text" name="type_name"  class="type_name" value="<?php echo $type[type_name]?>" />
                    </li>
                    <li class="personal_inf">
                    	类型说明：
                    	  <textarea name="type_inf" id="textarea" cols="15" rows="2"><?php echo $type[type_inf]?></textarea>
                    </li>
                    <li class="button">
                        <input type="reset" name="reset" id="button" value="重置" />
                    	<input type="submit" name="submit" id="button" value="修改"  />
                    </li>
                </ul>
             </form> 
                    <?php
						$type_id = trim($_POST['type_id']);
						$type_name = $_POST['type_name'];
						$type_inf = $_POST['type_inf'];
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
								location.href="type_edit.php?Action=edit&id=<?php echo $_GET[id];?>";
                			 	return false;
             				}
						}
					</script>
                    <?PHP
					 
					  //echo $edit;die;
					  if($submitFlag){
						
							if (empty($type_name)){
								echo "<script language='javascript' > ";
								echo 'alert("数据输入不完整！");'; 
								echo "</script>";
								exit;
							}else{
								//查询数据库，看填写的用户名是否存在
								$sql4 = "select * from type where type_name = '".$type_name."'";
								$result4 = mysql_query($sql4);
								if($result4 && mysql_num_rows($result4)>0&&$type_name!=$type['type_name']){
									//弹出提示框并返回
									echo "<script language='javascript' > ";
									echo 'alert("该类型名已存在，请换一个重试！");'; 
									echo "</script>";
								}else{
									//将信息插入数据库的type表
									//更新类型表
									$sql1 ="update type set type_inf='$type_inf',type_name='$type_name' where type_id='$_GET[id]'";
									//添加到记录表
									$sql2 = "insert into user_record(user_ip,user_name,user_opdate,user_operation) values('$ip','$_SESSION[user_name]','$showtime','修改类型信息')";
									$result1 = mysql_query($sql1);
									//var_dump($result1);die;
									$result2 = mysql_query($sql2);
									if(!($result1&&$result2)){
										echo "<script language='javascript' > ";
										echo 'alert("数据记录插入失败");'; 
										echo "</script>";
										exit;
									}else{
										echo "<script language='javascript' > ";
										echo 'alert("修改成功");'; 
										echo "location.href='type_edit.php?Action=edit&id=$_GET[id]'";
										echo "</script>";
									}
								}
							}
						mysql_free_result($result); //释放结果集
						mysql_close($conn); //关闭连接
					  }
}
                    ?>
        	
        </div>     
	</div>
</body>
</html>