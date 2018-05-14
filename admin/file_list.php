<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>文件列表</title>
<link  href="../css/usercon.css" type="text/css" rel="stylesheet"/>
<link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
<link href="../css/rem_list.css" type="text/css" rel="stylesheet"/>
</head>
<script type='text/javascript' language='javascript'>
	function delConfirm(){
    	if(window.confirm('删除后无法恢复，确定删除吗？')){
             //alert('确定');
			 return true;
			 //location.href="file_list.php";
             
        }else{
             //alert('取消');
			location.href="file_list.php";
            return false;
        }
	}
</script>

<body>
<?php 
require_once('../conn/function.php');	  //屏蔽sql关键词
require_once("../conn/conn.php");//连接数据库
$pagesize = 20;//页面尺寸
//获取page的值，假如不存在page，那么页数就是1。
$page=isset($_GET['page'])?intval($_GET['page']):1;
$offset=($page-1)*$pagesize;         //获取limit的第一个参数的值


?>
<div class="con" style="background:#EBF2F9;">
		<div class="top"><p>&nbsp;&nbsp;&nbsp;<i class="fa fa-film"></i>&nbsp;<b>文件列表</b>&nbsp;>>&nbsp;删除，修改文件信息</p></div>
        <div class="search" >
       	  <form  name="search" method="post" action="">
            	文件名：<input name="file_name" type="text" class="file_name" id="file" size="15"/>&nbsp;
                类型：
            	<label for="select"></label>
                <select name="file_type" size="1"  class="file_type" id="file">
                  <option value="" selected="selected"></option>
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
                &nbsp;
                上传者：<input name="rem_name" type="text" class="rem_name" id="file" size="15"/>&nbsp;
                 &nbsp;<input type="submit" name="button" id="button" value="查找" />&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;<a href="file_up.php" onClick='changeAdminFlag('上传文件')'>上传文件</a>&nbsp;|&nbsp;<a href="file_list.php" onClick='changeAdminFlag('文件信息')'>查看文件</a>
       	  </form> 
        </div>     
</div>
<div class="con">
   <table  width="100%" align="center" cellpadding="0" cellspacing="0"  >
  	<tr class="biaoti" bgcolor="#3F89EC">
    	<td class="first" nowrap  align="center" ><font color="#FFFFFF"><strong>文件编号</strong></font></td>
      	<td nowrap  align="center"><font color="#FFFFFF"><strong>文件名</strong></font></td>
      	<td nowrap  align="center"><font color="#FFFFFF"><strong>文件类型</strong></font></td>
      	<td nowrap  align="center"><font color="#FFFFFF"><strong>上传时间</strong></font></td>
     	 <td nowrap  align="center"><font color="#FFFFFF"><strong>文件大小</strong></font></td>
      	<td nowrap  align="center"><font color="#FFFFFF"><strong>分享</strong></font></td>
        <td nowrap  align="center"><font color="#FFFFFF"><strong>下载次数</strong></font></td>
        <td nowrap  align="center"><font color="#FFFFFF"><strong>上传者</strong></font></td>
        <td nowrap  align="center"><font color="#FFFFFF"><strong>下载</strong></font></td>
      	<td nowrap  align="center"><font color="#FFFFFF"><strong>修改</strong></font></td>
      	<td nowrap  align="center"><font color="#FFFFFF"><strong>删除</strong></font></td>
 	 </tr>
     
     <?php 
	 	
		$file_name = trim($_POST['file_name']);
		$file_type= $_POST['file_type'];
		$author=trim($_POST['rem_name']);
		//echo $file_type;die;
		$buttonFlag = isset($_POST['button']);
		//var_dump($buttonFlag);die;
		if($buttonFlag){
			if(empty($file_name)&&empty($file_type)&&empty($author)){
				echo "<script language='javascript' > ";
				echo "alert('请输入您要查找的信息！');"; 
				//echo  "location.href='file_list.php';";
				echo "</script>";
			}else{
				$sql="select * from file_inf where true";
						if($file_name != ''){
							$sql .= " and file_name like '%".$file_name."%'";
						}
						if($file_type != ''){
							$sql .= " and type_id='$file_type'";
						}
						if($author != ''){
							$sql .= " and rem_name = '$author'";
						}
				$result = mysql_query($sql);//执行查询语句
				if($result && mysql_num_rows($result)>0){
					$sql1='select count(*) from file_inf where true';
						if($file_name != ''){
							$sql1 .= " and file_name like '%".$file_name."%'";
						}
						if($file_type != ''){
							$sql1 .= " and type_id='$file_type'";
						}
						if($author != ''){
							$sql1 .= " and rem_name = '$author'";
						}
					$result2=mysql_query($sql1);
					$array=mysql_fetch_array($result2);
	 				$numrows=$array[0];//获取数据数量
					//echo $numrows;die;	
					$sql .=" limit $offset,$pagesize";
				    $result3=mysql_query($sql);
					$file=mysql_fetch_assoc($result3);//返回数据并生成数组
					//print_r($file);die;
       
				}else{
					echo "<script language='javascript' > ";
					echo "alert('该文件不存在！');"; 
					echo  "location.href='file_list.php';";
					echo "</script>";
				}
			}
		}else{
	 		$result2=mysql_query("select count(*) from file_inf");
			$array=mysql_fetch_array($result2);
	 		$numrows=$array[0];//获取数据数量
	 		$result3=mysql_query("select * from file_inf limit $offset,$pagesize");
			$file=mysql_fetch_assoc($result3);
		 
	 	}	
	 $pages=ceil($numrows/$pagesize); //获得总页数
	 //假如传入的页数参数page 大于总页数 pages，则显示错误信息并返回到第一页
	 if($pages>0){
	 	if($page>$pages || $page == 0){
       	echo "<script language='javascript' > ";
	  	echo 'alert("共有'.$pages.'页！请输入正确页数！");';
	  	echo  "location.href='file_list.php';"; 
	   	echo "</script>";
      	exit;
	 	}
	 }
	 if($file){
		 do{ 
		 	$result1=mysql_query("select type_name from type where type_id='$file[type_id]'");
			$Type = mysql_fetch_array($result1);
			//print_r($type_name);die;
	 ?>
     <tr>
       	<td class='first'><font color="#666"><?php echo $file['file_id']?></font></td>
        <td><font color="#666"><?php echo $file['file_name']?></font></td>
      	<td><font color="#666"><?php echo $Type['type_name'] ?></font></td>
      	<td><font color="#666"><?php echo $file['upload_date']?></font></td>
      	<td><font color="#666"><?php echo $file['file_size']?></font></td>
        <td> <input type='checkbox' value='<?php echo $search['share']?>' <?php if($file['share']==1){echo 'checked';}?> disabled="disabled" /></td> <!--disabled="disabled"设置只读状态-->
        <td><font color="#666"><?php echo $file['download_count'] ?></font></td>
        <td><font color="#666"><?php echo $file['rem_name'] ?></font></td>
		<?php 
			$userCheckSql=mysql_query("select * from user where user_name='$file[rem_name]'");
			if(mysql_num_rows($userCheckSql)>0){
				$userCheck=1;
			}
			else{$userCheck=0;}
		?>
        <td><a href="file_download.php?Action=edit&id=<?php echo $file['file_id'];?>&share=<?php echo $file['share'];?>&userCheck=<?php echo $userCheck;?>" onClick='changeAdminFlag('下载文件')'>下载</a></td>
      	<td><a href="file_edit.php?Action=edit&id=<?php echo $file['file_id'];?>" onClick='changeAdminFlag('修改文件')'>修改</a></td>
      	<td><a href="file_edit.php?Action=del&id=<?php echo $file['file_id'];?>" onclick='return delConfirm();'>删除</a></td>
     </tr>
     <?php 
	 		$file=mysql_fetch_assoc($result3);}while($file);}
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
					echo "<a href='file_list.php?page=".$first."'>&nbsp;&nbsp;首页&nbsp;&nbsp;</a> ";
					echo "<a href='file_list.php?page=".$prev."'>上一页&nbsp;&nbsp;</a>";	
				}

				if ($page < $pages){
					echo "<a href='file_list.php?page=".$next."'>&nbsp;&nbsp;下一页</a>"; 
					echo "<a href='file_list.php?page=".$last."'>&nbsp;&nbsp;尾页</a> ";
				}
				mysql_free_result($result3); //释放结果集
			   mysql_close($conn); //关闭连接
            ?>
  		</div>
	</form>
</div>
</body>
</html>