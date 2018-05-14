 
<?php 
header("Content-type:text/html;charset=utf-8"); 
require_once('../conn/conn.php');
session_start();
date_default_timezone_set('PRC');
$showtime=date('Y-m-d H:i:s',time()); //获取时间
$file_id=$_GET[id];
$shareCheck = $_GET[share];
$deletCheck = $_GET[delet];
$downCheck = $_GET[down];
$saveCheck =$_GET[save];
$fileFlagSql= mysql_query("select * from file_inf where file_id='$file_id'");
$file = mysql_fetch_assoc($fileFlagSql);
$remSql=mysql_query("select * from rem_inf where rem_name='$_SESSION[rem_name]'");
$rem=mysql_fetch_assoc($remSql);
//var_dump($file);die;
//下载--------------------------------------------------
if($downCheck==1){$file_final_name=$file[md5file].'.'.$file[file_name];
	//用以解决中文不能显示出来的问题 
	$file_final_name= iconv('utf-8','gbk',$file_final_name); 

	$file_sub_path="upload/"; 
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
}
//删除------------------------------------------------
if($deletCheck==1){
	$delet=mysql_query("delete from file_inf where file_id='$file_id'");
	if($delet){
		echo "<script language='javascript'>alert('删除成功');location.href='rem_wangpan.php?pid=0&searchFlag=0&type_id=0'</script>";
	}
}
//分享-------------------------------------------
if($shareCheck==1){
	$path=explode('/',$_SERVER["REQUEST_URI"]);
	$Newpatharray=array_pop($path);
	$Newpath=implode('/',$path);
	$ShareLink='http://'.$_SERVER['SERVER_NAME'].$Newpath.'/file.php?id='.$file_id.'&rem='.$rem[rem_id];
	$shareSql=mysql_query("update file_inf set share = 1 where file_id= '$file_id'");
	if($shareSql){
	echo "<script language='javascript' type='text/javascript' src='../js/jquery-1.9.1.min.js'></script>";
	echo "<script language='javascript'>var link=prompt('分享成功！\\n获取分享链接:','$ShareLink');";
	echo "if(link){";
	/*echo "try{
if(window.clipboardData) {
    window.clipboardData.setData('Text', '$ShareLink');
} else if(window.netscape) {
    netscape.security.PrivilegeManager.enablePrivilege('UniversalXPConnect');
    var clip = Components.classes['@mozilla.org/widget/clipboard;1'].createInstance(Components.interfaces.nsIClipboard);
    if(!clip) return;
    var trans = Components.classes['@mozilla.org/widget/transferable;1'].createInstance(Components.interfaces.nsITransferable);
    if(!trans) return;
    trans.addDataFlavor('text/unicode');
    var str = new Object();
    var len = new Object();
    var str = Components.classes['@mozilla.org/supports-string;1'].createInstance(Components.interfaces.nsISupportsString);
    var copytext = _sTxt;
    str.data = copytext;
    trans.setTransferData('text/unicode', str, copytext.length*2);
    var clipid = Components.interfaces.nsIClipboard;
    if (!clip) return false;
    clip.setData(trans, null, clipid.kGlobalClipboard);
}
}catch(e){};}";*/
	echo "if(window.clipboardData){window.clipboardData.setData('text','$ShareLink');alert('复制成功！');}else{alert('该版本不支持系统复制，请手动复制');location.reload();}}else{location.href='rem_wangpan.php?pid=0&searchFlag=0&type_id=0'}";
	echo "location.href='rem_wangpan.php?pid=0&searchFlag=0&type_id=0';</script>";
	$shareSql=mysql_query("updata file_inf set share = 1 where file_id= '$file_id'");
	}
}
//保存到网盘============================================
if($saveCheck==1){
	if($_SESSION['rem_name']){
		if($_SESSION['rem_name']!=$file[rem_name])
			$saveSql=mysql_query("insert into file_inf(md5file,file_name,type_id,upload_date,file_size,rem_name) value('$file[md5file]','$file[file_name]','$file[type_id]','$showtime','$file[file_size]','$_SESSION[rem_name]') ");
			if($saveSql){
				echo "<script language='javascript'>alert('保存成功！');</script>";
		}else{
			echo "<script language='javascript'>alert('保存成功！');</script>";
		}
	}else{
		echo "<script language='javascript'>alert('请先登录！');</script>";
	}
}
?> 
