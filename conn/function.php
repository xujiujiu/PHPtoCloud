<?php
header("Content-type:text/html; charset=utf-8");
function checkIllegalWord(){
	//定义不允许提交的sql命令和关键词
	$words = array();
	$words[] = "add";
	$words[] = "count";
	$words[] = "create";
	$words[] = "delete";
	$words[] = "drop";
	$words[] = "from";
	$words[] = "grant";
	$words[] = "insert";
	$words[] = "select";
	$words[] = "truncate";
	$words[] = "update";
	$words[] = "use";
	$words[] = "--";
	//判断提交的数据中是否存在以上关键词，$_request中含有所有提交数据
	foreach($_REQUEST as $strGot){
		$strGot = strtolower($strGot);//转为小写
		foreach($words as $word){
			if(strstr($strGot, $word)){
				echo "<script type='text/javascript' language='javascript'>";
				echo "alert ('您输入的内容含有非法字符！');";
				echo "</script>";
				$checkIllegalword=1;
			}else{
				$checkIllegalword=0;
			}
		}
	}//foreach 根据数组中每个元素来循环代码块
}
checkIllegalWord();
?>