<?php 
	include('connect.php');
	$id=$_GET['id'];
	// 自动删除指定ID号的sql数据
	$sql="DELETE FROM `msg` WHERE `id`={$id}";
	$db->query($sql);
	
	header('location:index.php');
	
?>