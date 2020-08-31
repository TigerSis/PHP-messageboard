<?php
// 数据库信息
	$host='localhost';
	// 改为dbuser避免重名
	$dbuser='root';
	$pwd='';
	$dbname='phptest';
	
	// 连接数据库
	$db=new mysqli($host,$dbuser,$pwd,$dbname);
	$db->query("set names 'utf8'");
	
	// 数据库连接测试
	// if($db->connect_errno==0){
	// 	echo '数据库连接成功';
	// }else{
	// 	echo '数据库连接失败';
	// }
	if($db->connect_errno<>0){
		die('数据库连接失败');
	}
?>