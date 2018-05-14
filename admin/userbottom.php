<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<style type="text/css">
body{ background-color:#fff;}
</style>
</head>

<body>
<?php
session_start(); //注册session变量
require_once("../conn/conn.php");//连接数据库
$sql = "select ID from user_record where user_name='$_SESSION[user_name]'";
  $result = mysql_query($sql);//执行查询语句
  $array = mysql_fetch_array($result);//返回数据并生成数组
  $user_id =$array['ID'];
?>
<table name="Trans" id="Trans" width="98%" height="24" border="0" cellpadding="0" cellspacing="0" style="BORDER-Top: #6298E1 1px solid;font-family:宋体;font-size:12px;color:#000000 ;">
  <tr>
    <td width="240" nowrap >管理员编号：<?php echo $user_id; ?></td>
    <td width="200" nowrap>管理员姓名：<?php echo "[".$_SESSION['user_name']."]"; ?></td>
    <td width="36" nowrap>位置：</td>
    <td width="120" nowrap>后台管理</td>
    <td align="right" nowrap id="DateTime">
      <script> 
         setInterval("DateTime.innerHTML=new Date().toLocaleString()+' 星期'+'日一二三四五六'.charAt(new Date().getDay());",1000);
      </script>
    </td>
  </tr>
</table>
</body>
</html>