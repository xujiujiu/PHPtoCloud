<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>数据库操作</title>

</head>
<link  href="../css/usercon.css" type="text/css" rel="stylesheet"/>
<link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
<link href="../css/rem_list.css" type="text/css" rel="stylesheet"/>
<script language="javascript" src="../js/jquery-1.9.1.min.js"></script>
<body>
<div class="con" style="background:#EBF2F9;">
		<div class="top"><p>&nbsp;&nbsp;&nbsp;<i class="fa fa-user"></i>&nbsp;<b>数据库管理</b>&nbsp;>>&nbsp;数据库备份，压缩，恢复</p></div>  
        <div class="search">
        	<a href="date_manage.php" onClick='changeAdminFlag("数据库操作")'>栏目首页</a>
            <font color="#0000FF">&nbsp;|&nbsp;</font>
            网站数据库：<a href="date_manage.php?Action=DataBackup" onClick='changeAdminFlag("数据库备份")'>备份</a>
            
            &nbsp;&nbsp;<a href="date_manage.php?Action=DataResume" onClick='changeAdminFlag("恢复数据库")'>恢复</a>
            <font color="#0000FF">&nbsp;|&nbsp;</font>
        </div>
</div>

<?php
require_once('../conn/conn.php');//连接数据库
function DataManage(){
	$Action=$_REQUEST['Action'];
  switch($Action){
    case "DataBackup":
	  DataBackup();
	  break;
    case "DataResume":
	  DataResume();
	  break;
	default:
	  Main();
  }
}

//备份-----------------------------------------------------------------------------
function DataBackup(){
   ///////////////////////////////////////////////////////////////////////////////////////////// 
/* 

程序功能：mysql数据库备份功能 
作者：唐小刚 
说明： 
本程序主要是从mysqladmin中提取出来，并作出一定的调整，希望对大家在用php编程时备份数据有一定帮助. 

*/ 

	global $DBname;
	global $conn;
	global $DB;
$filename=date("Y-m-d_H-i-s")."-".$DBname.".sql"; 
//echo $DBname;
file_put_contents($filename, "");
header("Content-disposition:attachment;filename=".$filename);//所保存的文件名 
header("Content-type:application/octet-stream"); 
header("Pragma:no-cache"); 
header("Expires:0");

//备份数据 
$i = 0; 
$crlf="\r\n";  
mysql_query("SET NAMES 'utf8'"); 
$tables =mysql_list_tables($DBname,$conn); 
$num_tables = @mysql_numrows($tables); 
//echo $num_tables;die;
file_put_contents($filename, "");
file_put_contents($filename, "'-- filename='.$filename",FILE_APPEND); 

while($i < $num_tables) 
{ 
$table=mysql_tablename($tables,$i); 
file_put_contents($filename, $crlf,FILE_APPEND); ; 
 $MysqlContent= get_table_structure($DBname, $table, $crlf).";$crlf$crlf".get_table_content($DBname, $table, $crlf); 
//echo $MysqlContent;die;
file_put_contents($filename, $MysqlContent,FILE_APPEND);
$i++; 
} 

/*新增的获得详细表结构*/ 
function get_table_structure($db,$table,$crlf) 
{ 
global $drop; 

$schema_create = ""; 
if(!empty($drop)){ $schema_create .= "DROP TABLE IF EXISTS `$table`;$crlf";} 
$result =mysql_db_query($db, "SHOW CREATE TABLE $table"); 
$row=mysql_fetch_array($result); 
$schema_create .= $crlf."-- ".$row[0].$crlf; 
$schema_create .= $row[1].$crlf; 
return $schema_create; 
} 
//获得表内容 
function get_table_content($db, $table, $crlf) 
{ 
$schema_create = ""; 
$temp = ""; 
$result = mysql_db_query($db, "SELECT * FROM $table"); 
$i = 0; 
while($row = mysql_fetch_row($result)){ 
	$schema_insert = "INSERT INTO `$table` VALUES ("; 
	for($j=0; $j<mysql_num_fields($result);$j++) 
	{ 
		if(!isset($row[$j])){ $schema_insert .= " NULL,"; }
		elseif($row[$j] != ""){$schema_insert .= " '".addslashes($row[$j])."',";} 
		else {$schema_insert .= " '',";} 
	} 
	$schema_insert = ereg_replace(",$", "",$schema_insert); 
	$schema_insert .= ");$crlf"; 
	$temp = $temp.$schema_insert ; 
	$i++; 
} 
return $temp; 
} 
//////////////////////////////////////////////////////////////////////////////////////////////////

  /*ob_start();//打开输出缓冲区，所有的输出信息不在直接发送到浏览器，而是保存在输出缓冲区里面,可选得回调函数用于处理输出结果信息。
  $dumpfname = $dbname . "_" . date("Y-m-d_H-i-s").".sql";
  $command = "E:\\wamp\\bin\\mysql\\mysql5.6.17\\bin\\mysqldump --add-drop-table --host=$host--user=$DBuser ";
  if ($DBpassword) $command.= "--password=". $DBpassword ." ";
  $command.= $DBname;
  $command.= " > " . $dumpfname;
  system($command);
  $dump = ob_get_contents();
  ob_end_clean();
  header('Content-Description: File Transfer');
  header('Content-Type: application/octet-stream');
  header('Content-Disposition: attachment; filename='.basename($DBname . "_" . date("Y-m-d_H-i-s").".sql"));
  flush();
  echo $dump;
  exit();*/

  /*$q1=mysql_query("show tables"); 
  while($t=mysql_fetch_array($q1)){     
  	$table=$t[0];      
	$q2=mysql_query("show create table `$table`");     
	$sql=mysql_fetch_array($q2);      
	$mysql.=$sql['Create Table'].";\r\n";      
	$q3=mysql_query("select * from `$table`");     
	while($data=mysql_fetch_assoc($q3)){         
		$keys=array_keys($data);          
		$keys=array_map('addslashes',$keys);         
		$keys=join('`,`',$keys);         
		$keys="`".$keys."`";          
		$vals=array_values($data);          
		$vals=array_map('addslashes',$vals);         
		$vals=join("','",$vals);         
		$vals="'".$vals."'";          
		$mysql.="insert into `$table`($keys) values($vals);\r\n";     
	} 
   }   
   $filename="uploads/mysql_bak/".$dbname.date('Ymjgi').".sql";  //存放路径，默认存放到项目最外层  $fp = fopen($filename,'w'); fputs($fp,$mysql); fclose($fp); 
	echo "数据备份成功";*/
}
function Main(){
	echo "<table width='100%' border='0' cellpadding='0' cellspacing='0' bgcolor='#6298E1'><tr><td height='24' nowrap  bgcolor='#EBF2F9' style='text-align:left;'>";
	echo "<br />
			操作说明：<br/>　　
			·数据库操作步骤为[备份&nbsp;→&nbsp;恢复]<br>　
		　	·操作前最好先[<font color='#330099'>备份</font>]数据库，正在使用中的数据库不能被压缩<BR>　　	
		    ·恢复数据库时将会覆盖当前使用中的数据库<br>　　
			·管理员登录日志可做查看<br />
			<br />
			";
			
	echo "</td></tr></table>";
}
?>
<div class="con">
	<?php 
	DataManage(); 
	?>
</div>
</body> 
<script src="../js/userleft.js"></script>
</html>