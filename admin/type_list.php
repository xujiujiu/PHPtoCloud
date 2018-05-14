<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>类型列表</title>
<link  href="../css/usercon.css" type="text/css" rel="stylesheet"/>
<link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
<link href="../css/rem_list.css" type="text/css" rel="stylesheet"/>
</head>
<script type='text/javascript' language='javascript'>
	function delConfirm(){
    	if(window.confirm('删除后无法恢复，确定删除吗？')){
             //alert('确定');
			 return true;
			 //location.href="rem_list.php";
             
        }else{
             //alert('取消');
			location.href="type_list.php";
            return false;
        }
	}
</script>

<body>
<?php 
require_once("../conn/conn.php");//连接数据库
$pagesize = 20;//页面尺寸
//获取page的值，假如不存在page，那么页数就是1。
$page=isset($_GET['page'])?intval($_GET['page']):1;
$offset=($page-1)*$pagesize;         //获取limit的第一个参数的值


?>
<div class="con" style="background:#EBF2F9;">
		<div class="top"><p>&nbsp;&nbsp;&nbsp;<i class="fa fa-th"></i>&nbsp;<b>类型列表</b>&nbsp;>>&nbsp;删除，修改类型信息</p></div>
        <div class="search" >
       	  <form class="search" name="search" method="post" action="">
            	类型编号：<input type="text" name="type_id" id="type" class="type_id" size="15"/>&nbsp;
                类型名称：<input type="text" name="type_name" id="type" class="type_name" size="15"/>&nbsp;
                 &nbsp;<input type="submit" name="button" id="button" value="查找" />&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;<a href="type_add.php" onClick='changeAdminFlag('添加类型')'>添加类型</a>&nbsp;|&nbsp;<a href="type_list.php" onClick='changeAdminFlag('类型信息')'>查看类型</a>
        	</form> 
        </div>     
</div>
<div class="con">
   <table  width="100%" align="center" cellpadding="0" cellspacing="0"  >
  	<tr class="biaoti" bgcolor="#3F89EC">
    	<td class="first" nowrap  align="center" ><font color="#FFFFFF"><strong>类型编号</strong></font></td>
      	<td nowrap  align="center"><font color="#FFFFFF"><strong>类型名称</strong></font></td>
        <td nowrap  align="center"><font color="#FFFFFF"><strong>类型说明</strong></font></td>
        <td nowrap  align="center"><font color="#FFFFFF"><strong>类型文件数</strong></font></td>
      	<td nowrap  align="center"><font color="#FFFFFF"><strong>修改</strong></font></td>
 	 </tr>
     
     <?php 
	 	
		$type_id = trim($_POST['type_id']);
		$type_name = trim($_POST['type_name']);
		$buttonFlag = isset($_POST['button']);
		//var_dump($buttonFlag);die;
		if($buttonFlag){
			if(empty($type_id)&&empty($type_name)){
				echo "<script language='javascript' > ";
				echo "alert('请输入类型编号或者类型名称！');"; 
				echo  "location.href='type_list.php';";
				echo "</script>";
			}else{
				$sql="select * from type where type_id = '$type_id' or type_name = '$type_name'";
				$result = mysql_query($sql);//执行查询语句
				//var_dump($result);die;
				if($result && mysql_num_rows($result)>0){
					$search = mysql_fetch_array($result);
					$result2=mysql_query("select count(*) from type where type_id = '$search[type_id]' or type_name = '$search[type_name]'");
					$array=mysql_fetch_array($result2);
	 				$numrows=$array[0];//获取数据数量
	 				$result3=mysql_query("select * from type where type_id = '$search[type_id]' or type_name = '$search[type_name]' limit $offset,$pagesize");
					$type = mysql_fetch_assoc($result3);//返回数据并生成数组
					
				}else{
					echo "<script language='javascript' > ";
					echo "alert('该类型不存在！');"; 
					echo  "location.href='type_list.php';";
					echo "</script>";
				}
			}
		}else{
	 		$result2=mysql_query("select count(*) from type");
			$array=mysql_fetch_array($result2);
	 		$numrows=$array[0];//获取数据数量
	 		$result3=mysql_query("select * from type limit $offset,$pagesize");
			$type=mysql_fetch_assoc($result3);
	 	}	
	 $pages=ceil($numrows/$pagesize); //获得总页数
	 //假如传入的页数参数page 大于总页数 pages，则显示错误信息并返回到第一页
	 if($pages>0){
	 	if($page>$pages || $page == 0){
       	echo "<script language='javascript' > ";
	  	echo 'alert("共有'.$pages.'页！请输入正确页数！");';
	  	echo  "location.href='type_list.php';"; 
	   	echo "</script>";
      	exit;
	 	}
	 }
	 if($type){
		 do{
		    $result4=mysql_query("select * from file_inf where type_id = '$type[type_id]'");
	 		$filenum1 = mysql_num_rows($result4);
			//echo $filenum1;die;
	 ?>
     <tr>
       	<td class='first'><font color="#666"><?php echo $type['type_id']?></font></td>
        <td><font color="#666"><?php echo $type['type_name']?></font></td>
        <td><font color="#666"><?php echo $type['type_inf']?></font></td>
        <td><font color="#666"><?php echo $filenum1?></font></td>
      	<td><a href="type_edit.php?Action=edit&id=<?php echo $type['type_id'];?>" onClick='changeAdminFlag('修改类型')'>修改</a></td>
     </tr>
     <?php $type=mysql_fetch_assoc($result3);}while($type);}
	 		
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
					echo "<a href='type_list.php?page=".$first."'>&nbsp;&nbsp;首页&nbsp;&nbsp;</a> ";
					echo "<a href='type_list.php?page=".$prev."'>上一页&nbsp;&nbsp;</a>";	
				}

				if ($page < $pages){
					echo "<a href='type_list.php?page=".$next."'>&nbsp;&nbsp;下一页</a>"; 
					echo "<a href='type_list.php?page=".$last."'>&nbsp;&nbsp;尾页</a> ";
				}
			   //mysql_free_result($result3); //释放结果集
			   mysql_close($conn); //关闭连接
            ?>
  		</div>
	</form>
</div>
</body>
</html>