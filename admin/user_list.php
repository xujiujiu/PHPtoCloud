<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>管理员列表</title>
<link  href="../css/usercon.css" type="text/css" rel="stylesheet"/>
<link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
<link href="../css/rem_list.css" type="text/css" rel="stylesheet"/>
</head>
<script type='text/javascript' language='javascript'>
	function delConfirm(){
    	if(window.confirm('删除后无法恢复，确定删除吗？')){
             //alert('确定');
			 return true;
			 //location.href="user_list.php";
             
        }else{
             //alert('取消');
			location.href="user_list.php";
            return false;
        }
	}
</script>

<body>
<?php 
require_once("../conn/conn.php");//连接数据库
session_start();
$pagesize = 20;//页面尺寸
//获取page的值，假如不存在page，那么页数就是1。
$page=isset($_GET['page'])?intval($_GET['page']):1;
$offset=($page-1)*$pagesize;         //获取limit的第一个参数的值


?>
<div class="con" style="background:#EBF2F9;">
		<div class="top"><p>&nbsp;&nbsp;&nbsp;<i class="fa fa-user"></i>&nbsp;<b>管理员列表</b>&nbsp;>>&nbsp;删除，修改管理员信息</p></div>
        <div class="search" >
       	  <form class="search" name="search" method="post" action="">
            	编号：<input type="text" name="user_id" id="user" class="user_id" size="15"/>&nbsp;
                账号：<input type="text" name="user_name" id="user" class="user_name" size="15"/>&nbsp;
                 &nbsp;<input type="submit" name="button" id="button" value="查找" />&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;<a href="user_add.php" onClick='changeAdminFlag('添加管理员')'>添加管理员</a>&nbsp;|&nbsp;<a href="user_list.php" onClick='changeAdminFlag('管理员信息')'>查看管理员</a>
        	</form> 
        </div>     
</div>
<div class="con">
   <table  width="100%" align="center" cellpadding="0" cellspacing="0"  >
  	<tr class="biaoti" bgcolor="#3F89EC">
    	<td class="first" nowrap  align="center" ><font color="#FFFFFF"><strong>管理员编号</strong></font></td>
      	<td nowrap  align="center"><font color="#FFFFFF"><strong>管理员账号</strong></font></td>
      	<td nowrap  align="center"><font color="#FFFFFF"><strong>登录次数</strong></font></td>
        <td nowrap  align="center"><font color="#FFFFFF"><strong>上传文件数</strong></font></td>
      	<td nowrap  align="center"><font color="#FFFFFF"><strong>修改</strong></font></td>
      	<td nowrap  align="center"><font color="#FFFFFF"><strong>删除</strong></font></td>
 	 </tr>
     
     <?php 
	 	
		$user_id = trim($_POST['user_id']);
		$user_name = trim($_POST['user_name']);
		$buttonFlag = isset($_POST['button']);
		//var_dump($buttonFlag);die;
		if($buttonFlag){
			if(empty($user_id)&&empty($user_name)){
				echo "<script language='javascript' > ";
				echo "alert('请输入管理员编号或者管理员账户名！');"; 
				echo  "location.href='user_list.php';";
				echo "</script>";
			}else{
				$sql="select * from user where true";
					if($user_id != ''){$sql .=" and ID = '$user_id'";}
					if($user_name !=''){$sql .= " and user_name = '$user_name'";}
				$result = mysql_query($sql);//执行查询语句
				//var_dump($result);die;
				if($result && mysql_num_rows($result)>0){
					//$search = mysql_fetch_array($result);
					$sql1="select count(*) from user where true";
						if($user_id != ''){$sql1 .=" and ID = '$user_id'";}
						if($user_name !=''){$sql1 .= " and user_name = '$user_name'";}
					$result2=mysql_query($sql1);
					//var_dump($result2);die;
					$array=mysql_fetch_array($result2);
	 				$numrows=$array[0];//获取数据数量
					$sql .=" limit $offset,$pagesize";
	 				$result3=mysql_query($sql);
					$user = mysql_fetch_assoc($result3);//返回数据并生成数组
					
				}else{
					echo "<script language='javascript' > ";
					echo "alert('该管理员不存在！');"; 
					echo  "location.href='user_list.php';";
					echo "</script>";
				}
			}
		}else{
	 	$result2=mysql_query("select count(*) from user");
		//var_dump($result2);die;
		$array=mysql_fetch_array($result2);
	 	$numrows=$array[0];//获取数据数量
		//echo $numrows;die;
	 	$result3=mysql_query("select * from user limit $offset,$pagesize");
		$user=mysql_fetch_assoc($result3);
		 
	 	}	
	    $pages=ceil($numrows/$pagesize); //获得总页数
	 
	 //假如传入的页数参数page 大于总页数 pages，则显示错误信息并返回到第一页
	 if($pages>0){
	 	if($page>$pages || $page == 0){
       	echo "<script language='javascript' > ";
	  	echo 'alert("共有'.$pages.'页！请输入正确页数！");';
	  	echo  "location.href='user_list.php';"; 
	   	echo "</script>";
      	exit;
	 	}
	 }
	 if($user){
		 do{
		    $result4=mysql_query("select * from file_inf where rem_name = '$user[user_name]'");
	 		$filenum1 = mysql_num_rows($result4);
			//echo $filenum1;die;
	 ?>
     <tr>
       	<td class='first'><font color="#666"><?php echo $user['ID']?></font></td>
        <td><font color="#666"><?php echo $user['user_name']?></font></td>
      	<td><font color="#666"><?php echo $user['user_logincount']?></font></td>
        <td><font color="#666"><?php echo $filenum1?></font></td>
      	<td><a href="user_edit.php?Action=edit&id=<?php echo $user['ID'];?>" onClick='changeAdminFlag('修改管理员')'>修改</a></td>
        <?php if($user['user_name']!=$_SESSION['user_name']){?>
      	<td><a href="user_edit.php?Action=del&id=<?php echo $user['ID'];?>" onclick='return delConfirm();'>删除</a></td>
        <?php }else{?>
        <td><a>不可删除</a></td>
        <?php }?>
     </tr>
     <?php $user=mysql_fetch_assoc($result3);}while($user);}
	 		
	 ?>
     </table>
    <form class="page" method="get" action="">
  		<div align="center">
        	每页显示<strong> <?php echo $pagesize;?> </strong>条　
        	总记录:<strong><?php echo $numrows;?></strong> 　			
            总页数:<strong><?php echo $pages;?></strong> 　
        	目前页数:<input type="text" name="page" class="textpage" size="3"  style="height:20px;width:40px;" />
            <?php
			//判断首页与尾页
				$first=1;
				$prev=$page-1;
				$next=$page+1;
				$last=$pages;
				if ($page > 1){
					echo "<a href='user_list.php?page=".$first."'>&nbsp;&nbsp;首页&nbsp;&nbsp;</a> ";
					echo "<a href='user_list.php?page=".$prev."'>上一页&nbsp;&nbsp;</a>";	
				}

				if ($page < $pages){
					echo "<a href='user_list.php?page=".$next."'>&nbsp;&nbsp;下一页</a>"; 
					echo "<a href='user_list.php?page=".$last."'>&nbsp;&nbsp;尾页</a> ";
				}
				mysql_free_result($result3); //释放结果集
			   mysql_close($conn); //关闭连接
            ?>
  		</div>
	</form>
</div>
</body>
</html>