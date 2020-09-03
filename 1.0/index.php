<?php error_reporting(~E_NOTICE)?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title></title>
		<style type="text/css">
			body{
				font-size: 5vw;
				background: whitesmoke;
			}
			textarea {
				resize: none;
				vertical-align: top;
				width: 70vw;
			}

			textarea,input {
				margin-left: 5vw;
			}
			
			.top{
				background: lightskyblue;
				margin-top: 10vw;
			}
			.bottom{
				background: khaki;
			}
			[type='text'] {
				width: 50vw;
			}
			[type='submit'] {
				width: 20vw;
			}
			.date{
				float: right;
			}
			
			a{
				background: #87CEFA;
				margin-left: 3vw;
				text-decoration: none;
				padding: 0.5vw 1.5vw;
			}
			a:hover{
				background: limegreen;
			}
			.bottom {
				margin-bottom: 10vw;
			}
			.nowpage{
				background: #FA8072;
			}
			.bottom img{
				height: 30vw;
				margin-top: 2vw;
			}
		</style>
	</head>
	<body>
		<form action="save.php" method="post" enctype="multipart/form-data">
			留言:<textarea rows="8" cols="30" name="txt"></textarea>
			<br><br>
			用户名:<input type="text" name="user" />
			<br><br>
			附加图片:<input type="file" name="img">
			<br><br>
			<input type="submit" value="发布留言" />
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
				</div>
			<?php }
		
			// 为了给当前页码数加一个样式
			for($i=1;$i<=$maxPage;$i++){
				// 使用$_GET获取当前页码
				if($i==$page){
					// 为当前页码添加class
				echo "<a class='nowpage' href='index.php?page={$i}'>{$i}</a>";
				}else{
					echo "<a href='index.php?page={$i}'>{$i}</a>";
				}
			}
		?>
		</div>
		
	</body>
</html>