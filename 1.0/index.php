<?php error_reporting(~E_NOTICE)?>
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
				font-size: 3vw;
				background: beige;
			}
			a{
				text-decoration: none;
				text-align: center;
			}
			
		#leave,#sign{
				float: right;
				clear: both;
				font-size: 2vw;
				width: 6vw;
				background: limegreen;
				margin: 1vw;
				line-height: 4vw;
			}
			#login{
				float: right;
				font-size: 2vw;
				width: 6vw;
				background: limegreen;
				margin: 1vw;
				line-height: 4vw;
			}
			#leave{
				display: none;
			}
			form{
				width: 90%;
				height: 60vw;
				clear: both;
				margin: 0 auto;
				display: flex;
				flex-direction: column;
				justify-content: space-around;
				align-items: center;
				font-weight: bold;
			}
			form div span{
				width: 13vw;
				display: inline-block;
				text-align: right;
			}
			textarea {
				resize: none;
				/* 顶部对齐 */
				vertical-align: top;
				width: 55vw;
				height: 26vw;
			}

			textarea,input {
				margin-left: 1vw;
			}
			
			[type='text'],[type="file"]{
				width: 55vw;
				height: 4vw;
			}
			[type="file"]{
				font-size: 2vw;
			}
			[type='submit'] {
				width: 15vw;
				height: 5vw;
				font-size: 2.5vw;
			}
			.pagenum{
				background: #87CEFA;
				margin-left: 1vw;
				padding: 0.5vw 1.1vw;
				color: darkblue;
			}
			#nowpage{
				background: #FA8072;
			}
			.top{
				background: lightskyblue;
				margin-top: 8vw;
				line-height: 10vw;
				padding: 0 3vw;
			}
			.date{
				float: right;
			}
			.bottom {
				background: khaki;
				margin-bottom: 8vw;
				position: relative;
				padding: 3vw;
			}
			.bottom img{
				height: 30vw;
				margin-top: 2vw;
			}
			.del{
				position: absolute;
				right: 2vw;
				bottom: 2vw;
				font-size: 3vw;
			}
			a:hover{
				color: white;
			}
			.page{
				display: none;
			}
		</style>
	</head>
	<body>
		<a href="sign.php" id="sign">注册</a>
		<a href="login.php" id="login">登录</a>
		<a href="leave.php" id="leave">退出</a>
		<form action="save.php" method="post" enctype="multipart/form-data">
			<div><span>留言:</span><textarea rows="8" cols="30" name="txt"></textarea></div>
			<div><span>用户名:</span><input type="text" name="user" /></div>
			<div><span>附加图片:</span><input type="file" name="img"></div>
			<div><input type="submit" value="发布留言" /></div>
		</form>

		
		<!-- 留言分页 -->
		<div class="page">
			<?php
			include('connect.php');
			// 使用COUNT(*)计算数据总量
			$sql="SELECT COUNT(*) FROM `msg`";
			$countResult=$db->query($sql);
			$row=$countResult->fetch_array(MYSQLI_ASSOC);
			
			
			$dataTotal=$row['COUNT(*)'];
			$pageNum=4;
			// 向上取整
			$maxPage=ceil($dataTotal/$pageNum);
			
			// isset检查变量是否已设置并且非null
			if(isset($_GET['page'])){
				$page=$_GET['page'];
			}else{
			// index.php页面加载时,自动定位page=1
				$page=1;
			}
			
			// 不同页面数据的偏移量
			$passBy=($page-1)*$pageNum;
			
			// 查看留言
			include('show.php');
			foreach($rows as $data){ ?>
				<div class="top">
					<span><?php echo $data['user']; ?></span>
					<span class="date"><?php echo date('Y-m-d H:i:s',$data['time']); ?></span>
				</div>
				<div class="bottom"><?php echo $data['content']; ?>
				<br>
				<!-- 图片显示区域 -->
				<?php 
				// 判断是否有图片,有图再上传
					if($data['pic']!=null){ 
						echo "<img src='upload/{$data['pic']}'>";
					}
				?>
				<a href="delete.php?id=<?php echo $data['id']; ?>" class="del">删除</a>
				</div>
			<?php }
		
			// 为了给当前页码数加一个样式
			for($i=1;$i<=$maxPage;$i++){
				// 使用$_GET获取当前页码
				if($i==$page){
					// 为当前页码添加class
				echo "<a id='nowpage' class='pagenum' href='index.php?page={$i}'>{$i}</a>";
				}else{
					echo "<a class='pagenum' href='index.php?page={$i}'>{$i}</a>";
				}
			}
			// 登录后显示留言
			session_start();
			if($_SESSION['loginCode']=='1'){
				echo "<style> 
						.page,#leave{
							display:block;
						}
						#login,#sign {
							display:none;
						}
					</style>";
			}
		?>
		</div>
		
	</body>
</html>