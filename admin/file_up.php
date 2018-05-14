<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>上传文件</title>
<link  href="../css/usercon.css" type="text/css" rel="stylesheet"/>
<link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
<link href="../css/rem_list.css" type="text/css" rel="stylesheet"/>
</head>

<body>
<div class="con" style="background:#EBF2F9;">
		<div class="top"><p>&nbsp;&nbsp;&nbsp;<i class="fa fa-film"></i>&nbsp;<b>文件管理</b>&nbsp;>>&nbsp;上传文件</p></div>
        <div class="file_up" >
        	<div><p><b>上传文件</b></p></div>
       		<form enctype="multipart/form-data" method="post" name="up" action="">
            	<!--<input type="hidden" name="max_file_size" value="1000000" /> -->
            	<input class='up button1' type="file" name="up" value="浏览..."/>
                <input class = 'up button2'type="submit" value="上传文件"/>
                <!--允许上传的文件类型为:<?php //echo implode(', ',$uptypes)?>-->
            </form>
        </div>     
</div>
<?php 
require_once("../conn/conn.php");
session_start();
date_default_timezone_set('PRC');
$updateTime=date('Y-m-d H:i:s',time()); //获取时间
//获取文件扩展名
//@param String $filename 要获取文件名的文件
function getFileExt($filename){
   	$info = pathinfo($filename);//pathinfo() 返回一个关联数组包含有 path 的信息。包括以下的数组单元：dirname，basename 和 extension。
   	return $info["extension"];//获取扩展名
}
if(is_uploaded_file($_FILES['up']['tmp_name'])){ //该函数可以用于确保恶意的用户无法欺骗脚本去访问本不能访问的文件
	$upload_name = $_FILES["up"]["name"]; //上传文件名
	$upload_tmp_name = $_FILES["up"]["tmp_name"];				//上传临时文件名
	
	$upload_target_dir = "../rem/upload";				//文件被上传到的目标目录
	$upload_target_path;			    //文件被上传到的最终路径
	$upload_filetype =  $_FILES["up"]["type"] ;				//上传文件类型
	//$allow_uploadedfile_type = array('jpeg','jpg','png','gif','docx','dot','doc','ppt','pps','pptx','mp2','avi','mpg','mpeg','mvb','rmvb','pdf','xlc','xlsx','xls','xlt','wav','mp3','zip','rar','txt','mp4','flv');;		//允许的上传文件类型
	$upload_file_size = $_FILES["up"]["size"];				//上传文件的大小
	//$allow_uploaded_maxsize=1000000000; 	//允许上传文件的最大值1G
	$md5file=md5_file($upload_tmp_name); 							//获取md5文件检验值
	$upload_final_name =$md5file.'.'.$upload_name;				//上传文件的最终文件（由md5值与文件名组成）
	$upload_fileTypeExt = getFileExt($upload_name);                  //获取文件扩展名
	$upload_target_path = $upload_target_dir."/".$upload_final_name;
	/*if(strlen($upload_name) >20){
		echo "<script language='javascript'>alert(文件名不得超过20字符，请重新上传)</script>";
		exit;
	}*/	
		
			//if($upload_file_size < $allow_uploaded_maxsize){
				if(!is_dir($upload_target_dir)){
					mkdir($upload_target_dir);
					chmod($upload_target_dir,0777);// 0777所有人有所有权限
				}
				if(!file_exists('$upload_target_path')){
					move_uploaded_file($upload_tmp_name,iconv('utf-8','gbk',$upload_target_path));//iconv解决上传出现文件名乱码问题,move_uploaded_file会覆盖重复名字的文件
				}else{
					file_put_contents('$upload_target_path',file_get_contents($upload_tmp_name),FILE_APPEND);
				}
				
				
					//更新数据库
					$fileType=in_array($upload_fileTypeExt,array('jpeg','jpg','png','gif'))?1:(in_array($upload_fileTypeExt,array('docx','dot','doc','ppt','pps','pptx','pdf','xlc','xlsx','xls','xlt','txt'))?2:(in_array($upload_fileTypeExt,array('avi','mpg','mpeg','mvb','rmvb','mp4','flv','mov'))?3:(in_array($upload_fileTypeExt,array('wav','mp3','mp2'))?4:5))); //判断type类型
					//echo $fileType;die;
					//上传文件信息
					$fileUpdate=mysql_query("insert into file_inf(md5file,file_name,type_id,upload_date,file_size,rem_name) values('$md5file','$upload_name','$fileType','$updateTime','$upload_file_size','$_SESSION[user_name]')");
					//$error=$_FILES['up']['error']==0?'上传成功':'上传失败';
					echo "<script language='javascript'>alert('上传成功');window.location.href='file_up.php';</script>";
					
				
			
		//}else{
			//echo "<script language='javascript'>alert('容量不足，请购买容量后上传!');<//script>";
		//}	
}
?>
</body>
</html>