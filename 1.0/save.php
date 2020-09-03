<!-- <?php error_reporting(~E_NOTICE)?> -->
<?php
	include('connect.php');
	
	// var_dump($_FILES['img']);
	// $_FILES的error状态码不等于4表示文件未上传
	$file=$_FILES['img'];
	if($file['error']==4){
		die ('未选择文件!');
	}else{
		if($file['error']==0){
			echo('文件上传成功');
			$ext=pathinfo($file['name'],PATHINFO_EXTENSION);
			var_dump($ext);
			if($ext!='jpg'&&$ext!='png'&&$ext!='gif'&&$ext!='jpeg'){
			die('上传格式有误')	;
			}
			// 限定上传文件大小2M,单位B
			if($file["size"]>2048*1024){
				die('上传文件过大');
			}
			
			$filename=uniqid().".png";
			// 上传的临时文件转存（原文件位置，转存位置）
			if($ext=='gif'){
				$filename=uniqid().'.gif';
			}else{
				$filename=uniqid().'.png';
			}
			
			move_uploaded_file($file["tmp_name"],"upload/{$filename}");
			
		}else{
			die('文件上传失败!');
		}
	}
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
	$is=$db->query("INSERT INTO `msg`( `content`, `user`, `time`,`pic`) VALUES ('留言:{$cont}','{$user}','$time','$filename')");
	
	
	// 入库后刷新跳转header回主页
	header('location:index.php');
?>