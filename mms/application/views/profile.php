<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html"; charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<base href = "<?php echo base_url();?>"/> 
<link href="./public/css/profile.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="./public/css/font-awesome.min.css">
<link rel="stylesheet" href="./public/css/font-awesome.css">
<script src="./public/js/jquery-min.js">
</script>
<script src="./public/js/profile.js" ></script>
</head>


<body>
<div id="background">
	<?php print_r($row);?>
	<div id="container">
		<div class="header">
			<a class="back" href="./index.php/user">返回</a>
			<div class="info">
				<img class="head" src="./public/images/avatar/avatar.jpg"></img>
				<div class="username">
					<div class="name">王迪</div>
					<div class="description">凡人皆有一死</div>
				</div>
			</div>
		</div>
		<div id="nav">
			<div class="sidebar">
				<div class="nav_cell active">详细信息</div>
				<div class="nav_cell">个人简介</div>
				<div class="nav_cell">作品介绍</div>
				<div class="nav_cell">给他留言</div>
				<div class="nav_cell">设置</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>