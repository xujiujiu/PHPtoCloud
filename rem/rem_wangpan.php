<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>我的网盘</title>
</head>
<style type="text/css">
*{
	margin:0;padding:0;
}
a{
	text-decoration:none;
}
.file_up{
	padding:10px 0 10px 20px;
	/*height:40px;*/
}
.file_up #progress{
	height:20px;
	line-height:30px;
	vertical-align:middle;
	width:100px;
	float:right;
	margin-right:70%;
	border:0px #333 solid;
}
#bar{
	width:0%;
	height:100%;
	background:#06F;
}
.path{
	position:relative;
	padding-left:20px;
	height:26px;
	line-height:26px;
	color:#666;
	font-family:'楷体';
	font-size:16px;
}
.file .top{
	background-color:#fff;
	width:98%;
	height:40px;
	line-height:40px;
	margin-left:20px;
	border:1px solid #999;
}
.top .nav div{
	display:block;
	float:left;
	height:40px;
	line-height:40px;
	padding-left:20px;
	border-left:1px solid #CCC;
}

.top .nav div:hover{
	background-color:#F0F8FD;
	}
.operate:hover{
	display:block;
}
.fileInf{
	width:98%;
	height:40px;
	line-height:40px;
	margin-left:20px;
	border-bottom:1px solid #ccc;
}
.fileInf div{
	display:block;
	float:left;
	height:40px;
	line-height:40px;
	padding-left:20px;
}
.fileInf div:hover{
	background-color:#F0F8FD;
}
.new{
	display:none;
}
</style>
<script language="javascript" type="text/javascript" src="../js/jquery-1.9.1.min.js"></script>
<script language="javascript" type="text/javascript">
	//文件上传-------------------------------------------
	function UpFileClick(){
		$(".filesUp").show(function(){
			$(".cancelUp").click(function(){
				$(".filesUp").hide();
			});
		});
	}
	//新建文件夹--------------------------------------------
	function newFolder(){
		//$(".editFlag").click(function(){
			//alert(1);
			
			$(".new").show(function(){
				$(".cancel").click(function(){
					$(".new").hide();
				});
			});
			
		//});
	}

//上传文件缓存进度条
/*function ajaxUp(){
	var ifname='upFile' + math.radom();
	$('<iframe name="' + ifname + '"></iframe>').appendTo($('body'));
	$('form:first').attr('target',ifname);
	$('#progress').html('<img src="../images/loading.gif"/>');	
}*/

/*var xhr=new XMLHttpRequest();
//concole.log(xhr);return;
var clock = null;
var upFile=document.getElementsByName('upFile')[0].files[0];
//concole.log(upFile);return;
var FileSizes = <?php //echo $filesizes;?>;
var AllowSize = <?php //echo $allowSize;?>;
function fire(){
	if ((upFile.size + FileSizes )> AllowSize){
		alert('容量不足，请购买后上传');
	}else{
	clock = window.setInterval(sendfile,1000);//一秒执行一次
	}
}
//闭包计数器
var sendfile =(function(){
	const LENGTH = 10 *1024 *1024;//每次切割10m
	var sta=0;
	var end = sta + LENGTH;
	var sending = false;//标志正在上传中
	var blob = null;
	var fd=null;
	//百分比
	var percent=0;
	//匿名函数
	
	return (function(){
		if(sending==true){
			return;
		}
		
		//如果sta >upFile.size就结束
		if(sta>upFile.size){
			clearInterval(clock);
			return;
		}
		blob =upFile.slice(sta,end);
		fd=new FormData();
		fd.append('part',blob);
		up(fd);
		sta=end;
		end=sta + LENGTH;
		sending = false;//上传完了
		percent = 100 * end/upFile.size;
		if(percent < 100){
			document.getElementById('bar').style.width=percent + '%';
			document.getElementById('progress').style.border ='2px';
		}
		
		if(percent > 100){
			percent =100;
		}
		if(percent == 100){
			alert('上传成功');
			location.href='rem_wangpan.php?searchFlag=0&pid=0&type_id=0';
		}
	});
})();
function up(fd){
	xhr.open('POST','up.php?id=<?php //echo $rem[rem_id]?>&pid=<?php //echo $pid;?>',false);
	xhr.send(fd);
}*/
</script>
<?php 
	require_once('../conn/conn.php');
	require_once('../conn/function.php');
	session_start();
	$pid=$_GET[pid];
	$searchFlag=$_GET[searchFlag];
	$type_id=$_GET[type_id];
	$folder_id=$_GET[folder_id];
	$searchKey=$_POST[search];
	date_default_timezone_set('PRC');
	$showtime=date('Y-m-d H:i:s',time()); //获取时间
	$ip = $_SERVER["REMOTE_ADDR"]; //获取ip
	$remSqlFlag=mysql_query("select * from rem_inf where rem_name='$_SESSION[rem_name]'");
	$rem=mysql_fetch_assoc($remSqlFlag);
	//echo $rem[rem_id];
	
		
	
?>

<body>

<div id="hide">
		<div class="file_up" >
        	<!--<div><p><b>上传文件</b></p></div>-->
       		<form  id="upload-form" enctype="multipart/form-data" method="post" name="upform" action="up.php?id=<?php echo $rem[rem_id]?>&pid=<?php echo $pid;?>"  >
            	<!--<input type="hidden" name="<?php// echo ini_get('session.upload_progress.name');?>" value="test" />-->
               <input type="button" value="上传文件" onclick="up.click();" name="submitUp" class="btn_mouseout"  style="width: 70px; height: 30px;"/>
            	<input class='button' type="file" id="idFile" name="up"  onchange="this.form.submit();" value="上传文件" style="display:none"/>
               <!-- <input type="submit"  name="fup" value="上传文件" style="display:none"/>-->
                <input type="button" value="新建文件夹" name="floder" style="margin-left:10px;width: 80px; height: 30px;" onclick="javascript:newFolder();"/>
                <div id="progress">
           		<div id="bar"></div>	
           	</div>
            
            </form>
           
		</div> 
        <?php 
			//获取分类信息
			$typeFlag=mysql_query("select * from type where type_id='$type_id'");
			$type=mysql_fetch_assoc($typeFlag);
			//获取文件信息
			$fileFlagSql="select * from file_inf where rem_name='$_SESSION[rem_name]'";
			if($pid!=0){
				$fileFlagSql .=" and folder_id=$pid";
			}
			if($searchKey!=''){
				$fileFlagSql .=" and file_name like '%".$searchKey."%.%'";
			}
			if($type_id!=0){
				$fileFlagSql .=" and type_id='$type_id'";
			}
			$fileFlag=mysql_query($fileFlagSql);
			$file=mysql_fetch_assoc($fileFlag);
			//获取文件夹信息
			$folderFlagSql="select * from folder_inf where rem_name='$_SESSION[rem_name]' and pid=$pid";
			if($searchKey!=''){
				$folderFlagSql .=" and name like '%".$searchKey."%'";
			}
			$folderFlag=mysql_query($folderFlagSql);
			$folder=mysql_fetch_assoc($folderFlag);
			//遍历分类
			//$typeIdFlag=mysql_query("select * from type");
			//$typeId=mysql_fetch_assoc($typeIdFlag);
		?>
        <!--分割线-->
<hr style="border:none; border-top:1px solid #ccc;" />
        <!--路径-->
<div class="path" >
            <span style="position:absolute;">
				<?php 
					//路径
					if($searchFlag==0){
						if($pid==0){
							switch($type_id)
							{
								
								case 0:
									echo '全部文件';
									break;
								case $type[type_id]:
									echo "全部$type[type_name]";
									break;
								default;
							}
						}else{
							//获取文件夹路径名
							$folderNavFlag=mysql_query("select name from folder_inf where rem_name='$_SESSION[rem_name]' and id='$pid'");
							$folderNav=mysql_fetch_assoc($folderNavFlag);
							echo "<a href='rem_wangpan.php?searchFlag=0&pid=0&type_id=0'>全部文件</a>"." > "."$folderNav[name]";
						}
					}else{
						if($searchKey==''){
							echo "<script type='text/javascript' language='javascript'>";
							echo "alert ('请输入您要查询的关键词！');";
							echo "location.href='rem_wangpan.php?pid=0&searchFlag=0&type_id=0'";
							echo "</script>";
						}else{
							echo  "<a href='rem_wangpan.php?searchFlag=0&pid=0&type_id=0'>全部文件</a>"." > "."搜索：'$searchKey'";
						}
					}
				?>
            </span>
            <span style="margin-left:88%; position:absolute;">已全部加载</span>
        </div>
        <div class="file">
			<div class="file top">
           	 	<div class="nav">
            		<div style="width:49%;border:none;">文件名</div>
                	<div style="width:23%">大小</div>
                	<div style="width:22%">修改日期</div>
                </div>
          	</div>
          	<!--新建文件夹-->
          	<div class="fileInf new">
          		<div style="width:49%;border:none;">
                	<form name="new" method="post" action="">
                    	<img src='../images/floder.png' height='18' />
                    	<input type="text" name="newFoldertext" value=""/>
                        <input type="submit" name="submit1" value="新建" />
                        <input class="cancel"type="button" name="cancel" value="取消" />
                    </form>
                    <?php
						$newFolderName=trim($_POST['newFoldertext']);
						//echo $newFolderName;die;
						$newFolderButton=isset($_POST['submit1']);
						//echo $newFolderButton;die;
						if($newFolderButton){
							if(empty($newFolderName)){
								echo "<script type='text/javascript' language='javascript'>";
								echo "alert ('请输入文件夹名！');";
								echo "</script>";
							}else{
								if($checkIllegalWord==0){
									$newFolderCheckSql=mysql_query("select * from folder_inf where rem_name='$_SESSION[rem_name]' and pid='$pid' and name='$newFolderName'");
									if($newFolderCheckSql&&mysql_num_rows($newFolderCheckSql)>0){
										echo "<script type='text/javascript' language='javascript'>";
										echo "alert ('该文件夹名已存在，请重新输入');";
										echo "</script>";
									}else{
									
										//插入数据
										$newFolderSql=mysql_query("insert into folder_inf(name,pid,rem_name,creat_time) value('$newFolderName','$pid','$_SESSION[rem_name]','$showtime') ");
										//var_dump($newFolderSql);die;
										if($newFolderSql){
											echo "<script type='text/javascript' language='javascript'>";
											echo "alert ('新建文件成功');";
											echo "location.href='rem_wangpan.php?pid=0&searchFlag=0&type_id=0';";
											echo "</script>";}
									}
								}
							}
							
						}
						//var_dump(checkIllegalWord());die;
                    ?>
                </div>
                <div style="width:23%">-</div>
                <div style="width:22%"><?php echo $showtime;?></div>
          	</div>
          	<?php 
		  	
			//遍历文件夹
			if($folder){
				do{
			?>
            <div class="fileInf">
          		<div style="width:49%;border:none;">
                	<a href="rem_wangpan.php?search=0&type_id=0&pid=<?php echo $folder[id];?>" ><p style=" overflow:hidden;"><?php echo "<img src='../images/floder.png' height='18' />".' '."<font color='#000'>".$folder[name]."</font>";?></p></a>
                 	
                </div>
                <div style="width:23%">-</div>
                <div style="width:22%"><?php echo $folder[creat_time];?></div>
           	</div>
            <?php
				$folder=mysql_fetch_assoc($folderFlag);
				}while($folder);
			}
			//遍历文件
			if($file){
				do{
			?>
            <div class="fileInf">
          		<div style="width:49%; font-size:14px;">
					<?php 
						//获取文件格式并输出图片
						$style=explode(".","$file[file_name]");
						$style[1]=strtolower(end($style));//转为小写
			//print_r($style[1]);
			$styleCase=(($style[1]=='jpg')||($style[1]=='jpeg')||($style[1]=='png')||($style[1]=='gif'))?'img':((($style[1]=='doc')||($style[1]=='docx')||($style[1]=='dot'))?'doc':((($style[1]=='ppt')||($style[1]=='pps')||($style[1]=='pptx'))?'ppt':(($style[1]=='txt')?'txt':((($style[1]=='avi')||($style[1]=='mpg')||($style[1]=='mpeg')||($style[1]=='mvb')||($style[1]=='flv')||($style[1]=='rmvb'))?'mv':(($style[1]=='pdf')?'pdf':((($style[1]=='rar')||($style[1]=='zip'))?'rar':((($style[1]=='xlsx')||($style[1]=='xlc')||($style[1]=='xlm')||($style[1]=='xls')||($style[1]=='xlt'))?'exel':((($style[1]=='wav')||($style[1]=='mp2')||($style[1]=='mp3'))?'music':'other'))))))));
			//echo $styleCase;
			switch($styleCase)
			{
				case 'img':
					echo "<img src='../images/pic.png' height='18' />";
					break;
				case 'doc':
					echo "<img src='../images/doc.png' height='18'/>";
					break;
				case 'ppt':
					echo "<img src='../images/ppt.png' height='18'/>";
					break;	
				case 'pdf':
					echo "<img src='../images/pdf.png' height='18'/>";
					break;
				case 'music':
					echo "<img src='../images/music.png' height='18'/>";
					break;
				case 'mv':
					echo "<img src='../images/mv.png' height='18'/>";
					break;
				case 'rar':
					echo "<img src='../images/rar.png' height='18'/>";
					break;
				case 'txt':
					echo "<img src='../images/txt.png' height='18'/>";
					break;		
				case 'exel':
					echo "<img src='../images/exel.png' height='18'/>";
					break;
				case 'other':
					echo "<img src='../images/ot.png' height='18'/>";
					break;
				default;			
	
			}
			
					?>
    				<a href="file.php?id=<?php echo $file[file_id];?>" style="color:#000;width:70%;" target="new"><?php echo $file[file_name];?></a>
                    <div class="operate" style="float:right;">
                    	<a href="down.php?id=<?php echo $file[file_id];?>&share=1&delet=0&down=0">分享</a>
                    	<a href="down.php?id=<?php echo $file[file_id];?>&share=0&delet=0&down=1">下载</a>
                    	<a href="down.php?id=<?php echo $file[file_id];?>&share=0&delet=1&down=0">删除</a>
                    </div>
                </div>
                <div style="width:23%">
					<?php 
						if($file[file_size]>1000&&$file[file_size]<=1000000){
							echo sprintf("%.2f",$file[file_size]/1000).'kb';
						}elseif($file[file_size]<=1000){
							echo sprintf("%.2f",$file[file_size]).'b';
						}elseif($file[file_size]>1000000){
							echo sprintf("%.2f",$file[file_size]/1000000).'M';
						}
					?>
                </div>
                <div style="width:22%"><?php echo $file[upload_date]?></div>
           	</div>
            <?php	
				$file=mysql_fetch_assoc($fileFlag);	
				}while($file);
			}
			if($searchFlag==1&&mysql_num_rows($fileFlag)<1&&mysql_num_rows($folderFlag)<1){
				echo "<p style='margin:0 auto; margin-top:20px; font-size:36px; color=#ccc'>"."暂无相关文件"."</p>";
			}
		  ?>
            
		</div>
</div>
<?php
mysql_close($conn);
?>
</body>

</html>