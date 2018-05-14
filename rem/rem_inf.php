<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>个人资料</title>
</head>
<style type="text/css">
*{ margin:0;padding:0;}
h2{
	margin:30px 0 20px 32%;
	}
#edit{
	width:80%;
}
table tr{
	height:30px;
	line-height:30px;
}
table .inf{
	text-indent:2em ;/*首行缩进*/
	}
.editFlag{
	margin:0 0 20px 90%;
	height: 30px;
	width: 80px;
	border:none;
	border:1px solid #eee;
	font-family:"微软雅黑";
	text-align:center;
	border-radius:5px;
	background-color:#fbfafe;
}
.editFlag input:hover{
	background-color:#F8F7FC;
}
.hide .edit{
	display:none;
}
.show .edit{
	width:80%;
	display:block;
}
.edit{
	background-color:#fbfafe;
	width:60%;
	margin:0 auto;
	margin-top:20px;
	margin-bottom:20px;
	padding:10px 0 10px 20px;
	border-radius:5px;
	border:1px solid #CCC;
}
.edit table{
	margin-left:30%;
}
</style>
<script language="javascript" src="../js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" language="javascript">
	function editFlag(obj)
      {
      //var obj_parent=obj.parentNode;
      var obj_parent=obj.parentElement
     
      if(obj_parent.className=="show")
      {
		  //alert(1);
        obj_parent.className="hide";
      }
      else
      {
        obj_parent.className="show";
      }
     
    }
	function editConfirm(){
    	if(window.confirm('修改后无法恢复，确定修改吗？')){
                 				//alert('确定');
            return true;
        }else{
                			 	//alert('取消');
			location.href="rem_inf.php";
            return false;
        }
	}
</script>

<body>
<?php 
	require_once('../conn/conn.php');
	session_start();
	date_default_timezone_set('PRC');
	$showtime=date('Y-m-d H:i:s',time()); //获取时间
	$ip = $_SERVER["REMOTE_ADDR"]; //获取ip
	$remFlag=mysql_query("select * from rem_inf where rem_name='$_SESSION[rem_name]'");
	$rem=mysql_fetch_assoc($remFlag);
	//var_dump($rem);die;
	$folderFlag=mysql_query("select count(*) from folder_inf where rem_name='$_SESSION[rem_name]'");
	$foldernum=mysql_fetch_array($folderFlag);
	$fileFlag=mysql_query("select * from file_inf where rem_name='$_SESSION[rem_name]'");
	$file=mysql_fetch_assoc($fileFlag);
	$filenumFlag=mysql_query("select count(*) from file_inf where rem_name='$_SESSION[rem_name]'");
	$filenum=mysql_fetch_array($filenumFlag);
	//$filecount = $filenum[0];
	if($file){
		$filesizes==0;
		do{
			$filesizes += $file[file_size]; 
			$file=mysql_fetch_assoc($fileFlag);
		}while($file);
	}
	
	$Sizes =sprintf("%.2f", ($filesizes/1000000000));
?>
<h2 style="font-family:'楷体';">个人资料</h2>
<div id="edit">
	<div class="hide">
    	<input class="editFlag" type="button" value="编辑资料"  onclick="javascript:editFlag(this)"/>
    	<div class="edit">
			<form method="post" action="" onsubmit="return editConfirm();">
            	<table align="center">
                	<tr>
                    	<td>账&nbsp;&nbsp;号：&nbsp;</td>
                        <td>
                        	<input type="text" value="<?php echo $rem[rem_name];?>" name="rem_name" disabled="disabled"/>
                            <font color="#FF0000">*</font><span style="font-size:14px; color:#CCC;">&nbsp;账号不可修改</span>
                        </td>
                    </tr>
        			<tr>
                		<td>密&nbsp;&nbsp;码：&nbsp;</td>
                        <td>
                        	<input type="password" value="<?php echo $rem[rem_password];?>" name="password" />
                        	<font color="#FF0000">*</font><span style="font-size:14px; color:#CCC;">&nbsp;必须大于6字符，小于20字符</span>
                        </td>
                    </tr>
                    <tr>
        				<td>确认密码：</td>
                        <td>
                        	<input type="password" value="<?php echo $rem[rem_password];?>" name="cpassword" /><font color="#FF0000">*</font>
                        </td>
                    </tr>
                    <tr>
        				<td>性&nbsp;&nbsp;别：</td>
                        <td><input  type="radio" name="sex" class="sex"value="男" <?php if($rem[rem_sex]=='男'){echo 'checked';}?> style="margin:0 20px 0 20px;"/>男
     	    				<input  type="radio" name="sex" class="sex"value="女" <?php if($rem[rem_sex]=='女'){echo 'checked';}?> style="margin:0 20px 0 20px;"/>女
                        </td>
                    </tr>
                    <tr>
        				<td>邮&nbsp;&nbsp;箱：</td>
                        <td><input type="text" value="<?php echo $rem[rem_email];?>" name="email" /></td>
                    </tr>
                    <tr>
        				<td>个性签名：</td>
                        <td><textarea name="personal_inf" cols="19" rows="2"><?php echo $rem[personal_inf]?></textarea></td>
                    </tr>
        			<tr>
                		<td>
                        	<input type="submit" value="确定" name="submit" style="margin:0 20px 0 20px; width:70px; height:30px;" />
                        </td>
                        <td>
        					<input type="button" value="取消" name="cancel" style="margin:0 20px 0 20px; width:70px; height:30px;"/>
                        </td>
                	</tr>
                </table>
     		</form>
   	 	</div>
 	</div>
    <?php
		$rem_name=trim($_POST['rem_name']);
		$rem_password=$_POST['password'];
		$rem_cpassword=$_POST['cpassword'];
		$rem_sex =$_POST["sex"];
		$rem_email = trim($_POST['email']);
		$personal_inf = $_POST['personal_inf'];
		$submitFlag = isset($_POST['submit']);
		if($submitFlag){
			if($rem_password == $rem[rem_password]){
				echo "<script language='javascript' > ";
				echo 'alert("请输入新密码！");'; 
				echo "location.href='rem_inf.php'";
				echo "</script>";
				exit;
			}
			if(empty($rem_password)||$rem_cpassword != $rem_password){
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
				//$ceshi=preg_match($pattern, $rem_email);
				//var_dump($ceshi);die;
				if(!preg_match($pattern, $rem_email)){
					echo "<script language='javascript' > ";
					echo 'alert("Email格式不合法！");'; 
					echo "</script>";
					exit;
				}
				if($rem_name!=$_SESSION[rem_name]){
					$checkFlag=mysql_query("select * from rem_inf where rem_name='$rem_name' ");
					$check=mysql_num_rows($checkFlag);
					if($checkFlag&&$check>0){
						echo "<script language='javascript' > ";
						echo 'alert("该账号已存在，请换一个重试！");'; 
						echo "</script>";
						exit;
					}
				}
				//更新信息表
				$reminfFlag=mysql_query("update rem_inf set rem_password='".md5($rem_password)."',rem_email='$rem_email',rem_sex='$rem_sex',personal_inf='$personal_inf' where rem_id='$rem[rem_id]'");
				//添加到记录表
				$recordFlag = "insert into rem_record(rem_ip,rem_name,op_date,rem_op) values('$ip','$_SESSION[rem_name]','$showtime','修改$rem[rem_id]信息')";
				if(!($reminfFlag&&$recordFlag)){
					echo "<script language='javascript' > ";
					echo 'alert("数据记录插入失败");'; 
					echo "</script>";
					exit;
				}else{
					echo "<script language='javascript' > ";
					echo 'alert("修改成功");'; 
					echo "location.href='rem_inf.php'";
					echo "</script>";
				}
			}
		}
		
    ?>
  <div class="show">
  	<table width="100%" >
      <tr>
        <td width="12%" align="center" valign="middle">账&nbsp;&nbsp;号：</td>
        <td width="38%" bgcolor="#fbfafe" class='inf'><?php echo $rem[rem_name];?></td>
        <td width="12%" align="center" valign="middle">性&nbsp;&nbsp;别：</td>
        <td width="38%" bgcolor="#fbfafe"  class='inf'><?php echo $rem[rem_sex];?></td>
      </tr>
      <tr>
        <td align="center" valign="middle">邮&nbsp;&nbsp;箱：</td>
        <td bgcolor="#fbfafe"  class='inf'><?php echo $rem[rem_email];?></td>
        <td align="center" valign="middle">会员状态：</td>
        <td bgcolor="#fbfafe"  class='inf'><?php if($rem[vip]==0){echo '否';}else{echo '是';};?></td>
      </tr>
      <tr>
        <td align="center" valign="middle">个性签名：</td>
        <td colspan="3" bgcolor="#fbfafe"  class='inf'><?php echo $rem[personal_inf];?></td>
      </tr>
      <tr>
        <td align="center" valign="middle">登录时间：</td>
        <td bgcolor="#fbfafe"  class='inf'><?php echo $rem[lastlogin_time];?></td>
        <td align="center" valign="middle">登 陆 I P：</td>
        <td bgcolor="#fbfafe"  class='inf'><?php echo $ip;?></td>
      </tr>
      <tr>
        <td align="center" valign="middle">注册时间：</td>
        <td bgcolor="#fbfafe"  class='inf'><?php echo $rem[login_time];?></td>
        <td align="center" valign="middle">允许容量：</td>
        <td bgcolor="#fbfafe"  class='inf'><?php echo sprintf("%.2f", ($allowSize/1000000000)).'G';?></td>
      </tr>
      <tr>
        <td align="center" valign="middle">使用容量：</td>
        <td bgcolor="#fbfafe"  class='inf'><?php echo $Sizes.'G';?></td>
        <td align="center" valign="middle">剩余容量：</td>
        <td bgcolor="#fbfafe"  class='inf'><?php echo sprintf("%.2f", (($allowSize-$filesizes)/1000000000)).'G';?></td>
      </tr>
      <tr>
      	<td align="center" valign="middle">已经上传：</td>
      	<td bgcolor="#fbfafe"  class='inf'><?php echo $filenum[0].'个';?></td>
      	<td align="center" valign="middle">创建目录：</td>
      	<td bgcolor="#fbfafe"  class='inf'><?php echo $foldernum[0].'个';?></td>
      </tr>
      <tr>
      	<td align="center" valign="middle">好友状态：</td>
      	<td bgcolor="#fbfafe"  class='inf'>拒绝加入好友</td>
      	<td align="center" valign="middle">好友个数：</td>
      	<td bgcolor="#fbfafe"  class='inf'>0个</td>
      </tr>
  	</table>
  </div>
</div>
<?php 
	mysql_close($conn);
?>
</body>
</html>