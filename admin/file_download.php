<?php 
header("Content-type:text/html;charset=utf-8"); 
require_once('../conn/conn.php');
session_start();
date_default_timezone_set('PRC');
$showtime=date('Y-m-d H:i:s',time()); //获取时间
$ip = $_SERVER["REMOTE_ADDR"]; //获取ip
$file_id=$_GET['id'];
$share=$_GET['share'];
$userCheck=$_GET['userCheck'];
$fileFlagSql= mysql_query("select * from file_inf where file_id='$file_id'");
$file = mysql_fetch_assoc($fileFlagSql);
//$remSql=mysql_query("select * from rem_inf where rem_name='$_SESSION[rem_name]'");
//$rem=mysql_fetch_assoc($remSql);
//var_dump($file);die;
//下载--------------------------------------------------
if($share==1||$userCheck==1){
	$file_final_name=$file[md5file].'.'.$file['file_name'];
	//用以解决中文不能显示出来的问题 
	$file_final_name= iconv('utf-8','gbk',$file_final_name); 

	$file_sub_path="../rem/upload/"; 
	$file_path=$file_sub_path.$file_final_name; 
	//echo $file_path;die;
	//首先要判断给定的文件存在与否 
	if(!file_exists($file_path)){ 
	echo "没有该文件"; 
	return ; 
	} 
	$fp=fopen($file_path,"r");
	//var_dump($fp);die; 
	$file_size=filesize($file_path); 
	//下载文件需要用到的头 
	header("Content-type: application/octet-stream"); 
	header("Accept-Ranges: bytes"); 
	header("Accept-Length:".$file_size); 
	header("Content-Disposition: attachment; filename=".$file_final_name); 
	$buffer=1024; 
	$file_count=0; 
	//向浏览器返回数据 
	while(!feof($fp) && $file_count<$file_size){ 
	$file_con=fread($fp,$buffer); 
	$file_count+=$buffer; 
	echo $file_con; 
	} 
	fclose($fp); 
	$updataSql=mysql_query("update file_inf set download_count = download_count+1 where file_id='$file_id'");
	$recordSql=mysql_query("insert into user_record(user_operation,user_opdate,user_ip,user_name) values('下载文件".$file['file_name']."','$showtime','$ip','$_SESSION[user_name]')");
}else{
	echo "<script language='javascript' > ";
	  	echo 'alert("该文件未被分享，属于个人文件，无法下载!");';
	  	echo  "location.href='file_list.php';"; 
	   	echo "</script>";
      	exit;
}
?>