<?php
	include('connect.php');
	// 查找数据
	$sql="SELECT * FROM `msg` ORDER BY `id` DESC LIMIT {$passBy},{$pageNum}";
	
	$reslut=$db->query($sql);
	// 将每条查询结果存储在二维数组中
	$rows=[];
	while($row=$reslut->fetch_array(MYSQLI_ASSOC)){
		$rows[]=$row;
	}
?>