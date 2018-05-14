<?php
	//连接数据库
	//error_reporting(E_ALL ^ E_DEPRECATED);
	function conn(){
	global $host;
	global $DBuser;
	global $DBpassword;
	global $DBname;
	global $conn;
	global $DB;
	global $allowSize;
	
	$host='localhost';
	$DBuser='wjgl';
	$DBpassword='wjgl';
	$DBname='wenjianguanli';
	$conn= mysql_connect($host,$DBuser,$DBpassword) or die('Could not connet:'.odbc_error());
	//echo 'Connected successfully'
	$DB=mysql_select_db($DBname,$conn) or die('Could not select database');
	$allowSize=10000000000;
	
	}
	echo conn();
	mysql_query("set names utf8");
?>