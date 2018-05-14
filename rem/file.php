<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>云空间-文件分享</title>
</head>
<link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet" />
<link href="../css/remIndex.css" type="text/css"  rel="stylesheet"/>
</head>
<script language="javascript" src="../js/jquery-1.9.1.min.js"></script>
<script language="javascript" src="../js/rem.js"></script>
<script language="javascript">
	$(document).ready(function(e) {
        $(".daohang a").click(function(){
			$(this).addClass('nulse').siblings().removeClass('nulse');
		});
		/*$(".personal").hover(function(){
			$(this).find("div").stop()
        	.animate({ top: "210", opacity: 1 })
        	.css("display", "block")
		}, function() {
            $(this).find("div").stop()
        	.animate({ left: "0", opacity: 0 })
        });*/
		//版本更新------------------------
		$('.update').click(function(){
			alert('该版本已是最新版本！');
		});
		function down(){
			location.href ='down.php?id=<?php echo $fileId;?>&share=0&delet=0&down=1';
		}
    });
	
</script>
<style type="text/css">
.fileshare{
	margin:20px 0 20px 30%; 
	font-family:'楷体';
	font-size:36px;
	color:#666;
	text-shadow:rgba(0,0,0,0.5);
}
#share{
	width:960px;
	margin:0 auto;
	text-align:center;
}
#share div{
	margin-top:10px;
}
.shareform input{
	height:30px;
}
.shareInf{
	margin:20px 20px 0 -400px;
}
</style>
<?php
session_start();
require_once('../conn/conn.php');
date_default_timezone_set('PRC');
$showtime=date('Y-m-d H:i:s',time()); //获取时间
$fileId=$_GET[id];
 if($_SESSION[rem_name]){$remCheck=1;}else{$remCheck=0;};
 $fileSql=mysql_query("select * from file_inf where file_id='$fileId'");
 $file=mysql_fetch_assoc($fileSql);
?>
<body>
<div id="top">
	<ul class="logo">
		<li><img src="../images/logo.png"  /></li>
    	<li><p><b>云空间</b></p></li>
	</ul>
    <?php if($remCheck==1){?>
	<div class="daohang">
		<a href="remIndex.php" class="nulse">主页</a>
        <!--<a href="remIndex.php" >网盘</a>
        <a href="remIndex.php" >分享</a>-->
	</div>
    <?php }?>
     <ul class="right">
     <?php if($remCheck==1){?>
   		<li class="search">
    		<form name="search" method="post" action="rem_wangpan.php?searchFlag=1&pid=0&type_id=0" target="con">
    			<input class="text" type="text" name="search" placeholder="搜索你的文件" />
        		<input class="submit" type="submit" name="submit"  value="搜索"/>
        	</form>
    	</li>
        <?php }?>
        <li class="fengexian">|</li>
        <li><img src="../images/vip2.png" width="20" height="20" style="margin-top:15px;" /></li>
        <li class="personal">
			<span class="lead"><?php if($remCheck==1){echo $_SESSION[rem_name];}else{echo '<a href="../login/login.htm">请先登录</a>';}?>&nbsp;&nbsp;<font size="+1"><b>∨</b></font>&nbsp;</span>
            <?php if($remCheck==1){?>
       	    <div class="bin">
            	<div class="img"><img src="../images/sanjiao.png" width="12" /></div>
        		<ul>
           		  <li><a href="rem_inf.php" target="con">个人资料</a></li>
               	  <li><a href="buy.php" target="con">购买容量</a></li>
                  <hr style="height:1px;border:none;border-top:1px solid rgba(3,3,3,0.1);" />
           	 	  <li class="esc"><a href="#" onclick="remOut();">退出</a></li>
          		</ul>
            </div>
            <?php }?>
      	</li>
        <li class="fengexian">|</li>
        <li class="vip"><a href="vip.php" target="con">会员中心</a></li>
        <li class="fengexian">|</li>
        <li class="personal">
			<span class="lead">&nbsp;&nbsp;&nbsp;&nbsp;更多&nbsp;&nbsp;&nbsp;&nbsp;<font size="+1"><b>∨</b></font>&nbsp;</span>
			<div class="bin">
         		<div class="img"><img src="../images/sanjiao.png" width="12" /></div>
        		<ul>
           		  <li><a class="update">版本更新</a></li>
               	  <li><a href="message.php" target="con">帮助反馈</a></li>
           	 	  <li><a href="../conn/xy.php" target="new">服务协议</a></li>
                  <li><a href="../conn/xy.php" target="new">权利说明</a></li>
          		</ul>
			</div>
           
        </li>
    </ul>
</div>
<div id="share">
<?php if($file[share]==1){?>
<div style="text-align:left">
 	<p style="font-family:'楷体'; font-size:24px;">
 		<span>分享人：<b><?php echo $file[rem_name];?></b></span>
 	</p>
 	<p style=" color:#CCC;">
    	<span>分享时间：<?php echo $showtime;?></span>
        <span style="margin-left:40px;">下载数：<?php echo $file[download_count];?></span>
    </p>
</div>
<div>
	<div class="shareform">
    	<form name="" method="post" action="down.php?id=<?php echo $fileId;?>&share=0&delet=0&down=0&save=1" target="hidden_iframe">
    		<input class='' type="submit" name="saveShare" value="保存到我的网盘" />
			<input type="button" name="download" value="下载" onclick="location='down.php?id=<?php echo $fileId;?>&share=0&delet=0&down=1'"/>
		</form>
        <iframe name="hidden_iframe" style="display:none;"></iframe>
    </div>
    <br />
    <div class="shareInf">
    	<?php
				$style=explode(".","$file[file_name]");
				$style[1]=strtolower(end($style));//转为小写
			//print_r($style[1]);
			$styleCase=(($style[1]=='jpg')||($style[1]=='jpeg')||($style[1]=='png')||($style[1]=='gif'))?'img':((($style[1]=='doc')||($style[1]=='docx')||($style[1]=='dot'))?'doc':((($style[1]=='ppt')||($style[1]=='pps')||($style[1]=='pptx'))?'ppt':(($style[1]=='txt')?'txt':((($style[1]=='avi')||($style[1]=='mpg')||($style[1]=='mpeg')||($style[1]=='mvb')||($style[1]=='flv')||($style[1]=='rmvb'))?'mv':(($style[1]=='pdf')?'pdf':((($style[1]=='rar')||($style[1]=='zip'))?'rar':((($style[1]=='xlsx')||($style[1]=='xlc')||($style[1]=='xlm')||($style[1]=='xls')||($style[1]=='xlt'))?'exel':((($style[1]=='wav')||($style[1]=='mp2')||($style[1]=='mp3'))?'music':'other'))))))));
			//echo $styleCase;
			switch($styleCase)
			{
				case 'img':
					echo "<img src='../images/pic.png' height='50' />";
					break;
				case 'doc':
					echo "<img src='../images/doc.png' height='50'/>";
					break;
				case 'ppt':
					echo "<img src='../images/ppt.png' height='50'/>";
					break;	
				case 'pdf':
					echo "<img src='../images/pdf.png' height='50'/>";
					break;
				case 'music':
					echo "<img src='../images/music.png' height='50'/>";
					break;
				case 'mv':
					echo "<img src='../images/mv.png' height='50'/>";
					break;
				case 'rar':
					echo "<img src='../images/rar.png' height='50'/>";
					break;
				case 'txt':
					echo "<img src='../images/txt.png' height='50'/>";
					break;		
				case 'exel':
					echo "<img src='../images/exel.png' height='50'/>";
					break;
				case 'other':
					echo "<img src='../images/ot.png' height='50'/>";
					break;
				default;			
	
			}
			
        ?><br />
        <a><?php echo $file[file_name];?></a>
    </div>
</div>
<br />
<?php }else{?>
<p class="fileshare">分享已过时，请重新获取</p>
<?php }
	mysql_close($conn);
?>
 <!-- JiaThis Button BEGIN -->
<div class="jiathis_style">
	<span class="jiathis_txt">分享到：</span>
	<a class="jiathis_button_copy">复制网址</a>
	<a class="jiathis_button_qzone">QQ空间</a>
	<a class="jiathis_button_tqq">腾讯微博</a>
	<a class="jiathis_button_tsina">新浪微博</a>
    <a class="jiathis_button_weixin">微信</a>
	<!--<a href="http://www.jiathis.com/share" class="jiathis jiathis_txt jiathis_separator jtico jtico_jiathis" target="_blank">更多</a>-->
</div>
<script type="text/javascript" src="http://v3.jiathis.com/code/jia.js" charset="utf-8"></script>
<!-- JiaThis Button END -->
</div>
</body>
</html>