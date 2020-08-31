<?php

	include('connect.php');
	
	// 接收前台POST传递来的数据
	$cont=$_POST['txt'];
	$user=$_POST['user'];
	
	include('input.php');
	
	// 创建对象实例化这个类
	$inp=new input();
	
	// 测试留言内容
	$is=$inp->testData($cont);
	if($is==false){
		die('留言内容不合规');
	}
	// 测试留言用户名
	$is=$inp->testData($user);
	if($is==false){
		die('用户名不合规');
	}
	// else{
	// 	echo('提交正确');
	// }
	
	// 系统内置的time()时间函数
	$time=time();
	// 留言内容入库
	
	

	$is=$db->query("INSERT INTO `msg`( `content`, `user`, `time`) VALUES ('{$cont}','{$user}','$time')");
	
	// 利用query()方法返回值判断
	// if($is==true) {
	// 	echo 'SQL语句执行成功!';
	// }else{
	// 	echo 'SQL语句执行失败!';
	// }
	// 入库后刷新跳转header回主页
	header('location:index.php');
?>