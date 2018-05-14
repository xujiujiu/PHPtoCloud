<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>用户操作记录</title>
<link  href="../css/usercon.css" type="text/css" rel="stylesheet"/>
<link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
<link href="../css/rem_list.css" type="text/css" rel="stylesheet"/>
</head>

<body>
<div class="con" style="background:#EBF2F9;">
		<div class="top"><p>&nbsp;&nbsp;&nbsp;<i class="fa fa-tint"></i>&nbsp;<b>用户操作记录表</b>&nbsp;>>&nbsp;查看用户操作信息</p></div>    
</div>
<div class="con">
   <table  width="100%" align="center" cellpadding="0" cellspacing="0"  >
  	<tr class="biaoti" bgcolor="#3F89EC">
    	<td class="first" nowrap  align="center" ><font color="#FFFFFF"><strong>日志编号</strong></font></td>
      	<td nowrap  align="center"><font color="#FFFFFF"><strong>用户编号</strong></font></td>
      	<td nowrap="nowrap"  align="center"><font color="#FFFFFF"><strong>操作类型</strong></font></td>
      	<td nowrap="nowrap"  align="center"><font color="#FFFFFF"><strong>操作时间</strong></font></td>
     	 <td nowrap="nowrap"  align="center"><font color="#FFFFFF"><strong>操作IP</strong></font></td>
      	<td nowrap  align="center"><font color="#FFFFFF"><strong>用户名</strong></font></td>
 	 </tr>
     
 <?php 
	 	require_once("../conn/conn.php");//连接数据库
		
	 //分页
	 $pagesize = 20;//页面尺寸
	 //记录数据总数
	 $result2=mysql_query("select count(*) from rem_record");
	 $array=mysql_fetch_array($result2);
	 $numrows=$array[0];//获取数据数量
	 //echo $numrows;die;
	 $pages=ceil($numrows/$pagesize); //获得总页数
	 //获取page的值，假如不存在page，那么页数就是1。
	 $page=isset($_GET['page'])?intval($_GET['page']):1;
	 //假如传入的页数参数page 大于总页数 pages，则显示错误信息并返回到第一页
	 if($page>$pages || $page == 0){
       echo "<script language='javascript' > ";
	   echo 'alert("共有'.$pages.'页！请输入正确页数！");';
	   echo  "location.href='rem_record.php';"; 
	   echo "</script>";
       exit;
	 }
	 $offset=($page-1)*$pagesize;         //获取limit的第一个参数的值
	 $result3=mysql_query("select * from rem_record limit $offset,$pagesize");
	 //var_dump($result3);die;
	 $rem=mysql_fetch_assoc($result3);
	 //print_r($rem);die;
	 if($rem){
		 do{
			$result4=mysql_query("select rem_id from rem_inf where rem_name = '$rem[rem_name]'");
	 		$rem_id = mysql_fetch_array($result4);
	 ?>
     <tr>
       	<td class='first'><?php echo $rem['note_id']?></td>
        <td><?php echo $rem['rem_id']?></td>
      	<td><?php echo $rem['rem_op']?></td>
      	<td><?php echo $rem['op_date']?></td>
      	<td><?php echo $rem['rem_ip']?></td>
      	<td><?php echo $rem['rem_name']?></td>
     </tr>
     <?php $rem=mysql_fetch_assoc($result3);}while($rem);}
	 		
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
					echo "<a href='rem_record.php?page=".$first."'>&nbsp;&nbsp;首页&nbsp;&nbsp;</a> ";
					echo "<a href='rem_record.php?page=".$prev."'>上一页&nbsp;&nbsp;</a>";	
				}

				if ($page < $pages){
					echo "<a href='rem_record.php?page=".$next."'>&nbsp;&nbsp;下一页</a>"; 
					echo "<a href='rem_record.php?page=".$last."'>&nbsp;&nbsp;尾页</a> ";
				}
				mysql_free_result($result3); //释放结果集
			   mysql_close($conn); //关闭连接
            ?>
  		</div>
	</form>
</div>
</body>
</html>