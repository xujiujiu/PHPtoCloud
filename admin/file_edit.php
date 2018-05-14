<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>修改文件</title>
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
	$sql="select * from file_inf LEFT JOIN type ON file_inf.type_id=type.type_id where file_id='$_GET[id]'";
	$result=mysql_query($sql);
	$file=mysql_fetch_assoc($result);
//修改文件信息
if($_GET[Action]==edit){
?>
	<div class="con" style="background:#EBF2F9;">
		<div class="top"><p>&nbsp;&nbsp;&nbsp;<i class="fa fa-film"></i>&nbsp;<b>文件列表</b>&nbsp;>>&nbsp;删除，修改文件信息</p></div>
        <div class="edit" >
       	  <form  name="edit" method="post" action="" onsubmit="return editConfirm();">
          		
            	<ul class="editul">
                    <li class="first">
                     	&nbsp;&nbsp;<a href="file_up.php" onClick='changeAdminFlag('上传文件')'>上传文件</a>
                        &nbsp;|&nbsp;<a href="file_list.php" onClick='changeAdminFlag('文件信息')'>查看文件</a>
                    </li>
                	<li>
                    	文件编号：
                        <input type="text" name="file_id"  class="file_id" value="<?php echo $file[file_id]?>" disabled="disabled"/>
                    </li>
                	<li>
                    	文件名称：
                        <input type="text" name="file_name"  class="file_name" value="<?php echo $file[file_name]?>" />
                    </li>
                    <li>
                    	文件类型：
                    	  <label for="select"></label>
                    	  <select name="file_type" size="1"  class="file_type" >
                          	<option value="<?php echo $file[type_id]?>" selected="selected"><?php echo $file[type_name];?></option>
                          	<?php
				  			//获取文件类型
				  			$result5=mysql_query("select * from type");
							$type = mysql_fetch_assoc($result5);
							if($type){
								do{
                  			?>
                  			<option value="<?php echo $type[type_id]?>"><?php echo $type[type_name]?></option>
                  			<?php 
								$type = mysql_fetch_assoc($result5);}while($type);}
				  			?>
                		</select>
                  	    
                    </li>
                    <li class="button">
                        <input type="reset" name="reset" id="button" value="重置" />
                    	<input type="submit" name="submit" id="button" value="修改"  />
                    </li>
                </ul>
             </form> 
                    <?php
						$file_id = trim($_POST['file_id']);
						$file_name = $_POST['file_name'];
						$file_type = $_POST['file_type'];
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
								location.href="file_edit.php?Action=edit&id=<?php echo $_GET[id];?>";
                			 	return false;
             				}
						}
					</script>
                    <?PHP
					 
					  //echo $edit;die;
					  if($submitFlag){
						
							if (empty($file_name)){
								echo "<script language='javascript' > ";
								echo 'alert("数据输入不完整！");'; 
								echo "</script>";
								exit;
							}else{
								//查询数据库，看填写的用户名是否存在
								$sql4 = "select * from file_inf where file_name = '".$file_name."'";
								$result4 = mysql_query($sql4);
								if($result4 && mysql_num_rows($result4)>0&&$file_name!=$file['file_name']){
									//弹出提示框并返回
									echo "<script language='javascript' > ";
									echo 'alert("该文件名已存在，请换一个重试！");'; 
									echo "</script>";
								}else{
									//将信息插入数据库的file表
									//更新文件表
									$sql1 ="update file_inf set type_id='$file_type',file_name='$file_name' where file_id='$_GET[id]'";
									//添加到记录表
									$sql2 = "insert into user_record(user_ip,user_name,user_opdate,user_operation) values('$ip','$_SESSION[user_name]','$showtime','修改文件信息')";
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
										echo "location.href='file_edit.php?Action=edit&id=$_GET[id]'";
										echo "</script>";
									}
								}
							}
						mysql_free_result($result); //释放结果集
						//mysql_close($conn); //关闭连接
					  }

                    ?>
        	
        </div>     
	</div>
<?php
//删除成员信息
}elseif($_GET[Action]==del){
	//echo $_GET[onclick];die;
	//if($_GET[onclick]){
		//删除文件表记录
		$sql6="delete from file_inf where file_id='$_GET[id]'";
		//添加到记录表
		$sql7 = "insert into user_record(user_ip,user_name,user_opdate,user_operation) values('$ip','$_SESSION[user_name]','$showtime','删除文件".$file[file_name]."')";
		$result6 = mysql_query($sql6);
		$result7 = mysql_query($sql7);
		//var_dump($result6);die;
		if(!($result6&&$result7)){
			echo "<script language='javascript' > ";
			echo 'alert("数据记录失败！");'; 
			//echo "windows.location.href='rem_list.php";
			echo "</script>";
			exit;
		}else{
			echo "<script language='javascript' > ";
			echo 'alert("删除成功");'; 
			echo "document.location = 'file_list.php'";
			echo "</script>";

		}
    }
//}
mysql_close($conn); //关闭连接
?>
</body>
</html>