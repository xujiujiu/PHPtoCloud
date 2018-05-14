<?php
header("Content-Type:text/html; charset=utf-8");
require_once('../conn/conn.php');
session_start();
date_default_timezone_set('PRC');
$updateTime=date('Y-m-d H:i:s',time()); //获取时间
$folderId=$_GET['pid'];
$dirId=$_GET['id'];
//上传用户信息
$remIdsql=mysql_query("select * from rem_inf where rem_id='$dirId'");
$remId=mysql_fetch_assoc($remIdsql);
$filesizeFlag=mysql_query("select * from file_inf where rem_name='$_SESSION[rem_name]'");
		$Filesize=mysql_fetch_assoc($filesizeFlag);
		if($Filesize){
			$filesizes==0;
			do{
				$filesizes += $Filesize['file_size']; 
				$Filesize=mysql_fetch_assoc($filesizeFlag);
			}while($Filesize);
			
		}//echo $filesizes;die;

//print_r($_FILES['up']);die;
 //遍历目录下所有文件的md5值
/*function getAllFileMd5($dir){
	$hash = array();
	$dir = new RecursiveDirectoryIterator($dir);
	foreach(new RecursiveIteratorIterator($dir) as $file) {
		$filename=end(explode(DIRECTORY_SEPARATOR,iconv('gbk','utf-8',$file)));//DIRECTORY_SEPARATOR目录分隔符，是定义php的内置常量,可直接使用
		$key = $filename;
		$hash[$key]=md5_file($file);
}
return $hash;
}*/
//获取文件扩展名
//@param String $filename 要获取文件名的文件
function getFileExt($filename){
   	$info = pathinfo($filename);//pathinfo() 返回一个关联数组包含有 path 的信息。包括以下的数组单元：dirname，basename 和 extension。
   	return $info["extension"];//获取扩展名
}
if(is_uploaded_file($_FILES['up']['tmp_name'])){ //该函数可以用于确保恶意的用户无法欺骗脚本去访问本不能访问的文件
	$upload_name = $_FILES["up"]["name"]; //上传文件名
	$upload_tmp_name = $_FILES["up"]["tmp_name"];				//上传临时文件名
	
	$upload_target_dir = "upload";				//文件被上传到的目标目录
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
		if(!(($filesizes + $upload_file_size)>$allowSize)){
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
					$fileUpdate=mysql_query("insert into file_inf(md5file,file_name,type_id,upload_date,file_size,folder_id,rem_name) values('$md5file','$upload_name','$fileType','$updateTime','$upload_file_size','$folderId','$remId[rem_name]')");
					$error=$_FILES['up']['error']==0?'上传成功':'上传失败';
					echo "<script language='javascript'>alert('$error');window.location.href='rem_wangpan.php?searchFlag=0&pid=0&type_id=0';</script>";
					
				
			}else{
				
				echo "<script language='javascript'>alert('文件太大,上传失败!');</script>";
			}
		//}else{
			//echo "<script language='javascript'>alert('容量不足，请购买容量后上传!');<//script>";
		//}	
}
?>