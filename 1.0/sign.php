<!-- <?php error_reporting(~E_NOTICE)?> -->
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title></title>
		<style type="text/css">
			*{
				margin: 0;
				padding: 0;
			}
			body{
				font-size: 3.5vw;
			}
			#box{
				width: 70%;
				height: 60vw;
				background: skyblue;
				display: flex;
				flex-direction: column;
				justify-content: space-around;
				align-items: center;
				margin: 20vw auto;
			}
			div{
				margin: 0 auto;
				position: relative;
			}
			span{
				display: inline-block;
				width: 15vw;
				text-align: end;
				margin-right: 2vw;
			}
			[type="text"][type="password"]{
				width: 40vw;
			}
			[type="submit"]{
				position: absolute;
				left: 18vw;
				background: whitesmoke;
				border: 1vw solid whitesmoke;
			}
			[type="submit"]:hover{
				cursor: pointer;
				transform: scale(1.15);
			}
		</style>
	</head>
	<body>
		<form action="#" method="post" id="box">
			<div><span>用户名:</span><input type="text" name="user"></div>
			<div><span>密码:</span><input type="password" name="pwd"></div>
			<div id="e"><input type="submit" value="注册"/></div>
		</form>
	</body>
</html>
<?php
	// 账号验证
	include('connect.php');
	
	$user=$_POST['user'];
	$pwd=$_POST['pwd'];
	
	if($user!='' && $pwd!=''){
		// 查询数据库中是否有匹配的数据条目
		$sql="INSERT INTO `login`(`sql-user`, `sql-pwd`) VALUES ('$user','$pwd')";
		$is=$db->query($sql);
		// 跳转回主页
		header('location:index.php');
	}
?>
			

	