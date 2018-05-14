<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>后台导航</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/userleft.css" media="screen" type="text/css" />
</head>
<script src='../js/jquery-1.9.1.min.js'></script>
<body>
<?php
 session_start();
?>
<div style="text-align:center;clear:both">
<!--<script src="/gg_bd_ad_720x90.js" type="text/javascript"></script>-->
<!--<script src="/follow.js" type="text/javascript"></script>-->
</div>
	<!-- Contenedor -->
	<ul id="accordion" class="accordion">
        <li>
			<div class="linktop">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;系统管理导航</div>
		</li>
		<li>
			<div class="link"><i class="fa fa-user"></i>成员管理<i class="fa fa-chevron-down"></i></div>
			<ul class="submenu">
				<li><a href="rem_list.php" target="con" onClick='changeAdminFlag("成员列表")'>成员列表</a></li>
				<li><a href="rem_add.php" target="con" onClick='changeAdminFlag("添加成员")'>添加成员</a></li>
			</ul>
		</li>
		<li>
			<div class="link"><i class="fa fa-user"></i>管理员管理<i class="fa fa-chevron-down"></i></div>
			<ul class="submenu">
				<li><a href="user_list.php" target="con" onClick='changeAdminFlag("管理员列表")'>管理员列表</a></li>
				<li><a href="user_add.php" target="con" onClick='changeAdminFlag("添加管理员")'>添加管理员</a></li>
			</ul>
		</li>
		<li>
			<div class="link"><i class="fa fa-film"></i>文件管理<i class="fa fa-chevron-down"></i></div>
			<ul class="submenu">
				<li><a href="file_list.php" target="con" onClick='changeAdminFlag("文件列表")'>文件列表</a></li><!--修改/删除/下载-->
				<!--<li><a href="file_check.php" target="con" onClick='changeAdminFlag("文件审核")'>文件审核</a></li>-->
                <li><a href="file_up.php" target="con" onClick='changeAdminFlag("文件上传")'>文件上传</a></li>
			</ul>
		</li>
		<li><div class="link"><i class="fa fa-th"></i>分类管理<i class="fa fa-chevron-down"></i></div>
			<ul class="submenu">
				<li><a href="type_list.php" target="con" onClick='changeAdminFlag("分类列表")'>分类列表</a></li>
				<li><a href="type_add.php" target="con" onClick='changeAdminFlag("添加分类")'>添加分类</a></li>
			</ul>
		</li>
        <li><div class="link"><i class="fa fa-folder"></i>文件夹管理<i class="fa fa-chevron-down"></i></div>
			<ul class="submenu">
				<li><a href="folder_list.php" target="con" onClick='changeAdminFlag("分类列表")'>分类列表</a></li>
			</ul>
		</li>
         <li><div class="link"><i class="fa fa-edit"></i>留言建议<i class="fa fa-chevron-down"></i></div>
			<ul class="submenu">
				<li><a href="reply.php" target="con" onClick='changeAdminFlag("留言板")'>留言板</a></li>
			</ul>
		</li>
        <li><div class="link"><i class="fa fa-tint"></i>系统安全<i class="fa fa-chevron-down"></i></div>
			<ul class="submenu">
				<li><a href="rem_record.php" target="con" onClick='changeAdminFlag("用户操作记录")'>用户操作记录</a></li>
                <li><a href="user_record.php" target="con" onClick='changeAdminFlag("管理员操作记录")'>管理员操作记录</a></li>
                <!--<li><a href="date_manage.php" target="con" onClick='changeAdminFlag("数据库操作")'>数据库操作</a></li>-->
			</ul>
		</li>
        <li><div class="link"><i class="fa fa-home"></i><a href="usercon.php" target="con" onClick='changeAdminFlag("管理主页")'>返回主页</a></div>
		</li>
 		<li><div class="link"><i class="fa fa-rotate-left"></i><a href="javascript:AdminOut()">切换账户</a></div>
		</li>
        <li><div class="link">云空间系统管理员</div>
		</li>
        <li><div class="link">设计：电信学院</div>
		</li>
        <li><div class="link">当前用户:
				<?php echo "<font color='#3F89EC' size='+1'>".$_SESSION['user_name']."</font>"; ?>
            </div>
		</li>
	</ul>

  <script src="../js/userleft.js"></script>

</body>

</html>