<!DOCTYPE html>
<?php
	if(isset($row)){
		$user = $row;
		$userid = $user["userid"];
		$name = $user["name"];
		$motto = $user["motto"];
		$sex = $user["sex"]?"男":"女";
		$description = $user["description"];
		$avatar = $user["avatar"];
		$qq = $user["qq"];
		$phone = $user["phone"];
		$email = $user["email"];
		switch ($user["groups"]) {
			case 1:
				$group =  "厂长";
				break;
			case 2:
				$group =  "后台组";
				break;
			default:
				$group =  "未知";
				break;
		}
		switch ($user["status"]) {
			case '1':
				$status =  "团队中";
				break;
			case '2':
				$status = "已毕业";
				break;
			default:
				$status = "离开";
		}
	}else{
		return;
	}
	if(isset($session) && $session["userid"] == $userid){
		$login = true;
	}else{
		$login = false;
	}
?>
<html>
<head>
	<title><?php echo $name."--".$group;?></title>
	<meta http-equiv="Content-Type" content="text/html"; charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
	<base href = "<?php echo base_url();?>"/> 
	<link href="./public/css/profile.css" rel="stylesheet" type="text/css" />
	<script src="./public/js/jquery-min.js">
	</script>
	
	<script>
		var userid = <?php echo $userid;?>;
	</script>
	<script src="./public/js/profile.js" ></script>
</head>


<body>
<div id="background">
	<div id="container">
		<div class="header">
			<a class="back" href="./index.php/user">返回</a>
			<div class="info">
				<img class="head" src="./public/images/avatar/<?php echo $avatar;?>.jpg"></img>
				<div class="username">
					<div class="name"><?php echo $name;?></div>
					<div class="description"><?php echo $motto;?></div>
				</div>
			</div>
		</div>
		<div id="nav">
			<div class="sidebar">
				<div class="nav_cell active" data-target="infomation">详细信息</div>
				<div class="nav_cell" data-target="description">个人简介</div>
				<div class="nav_cell" data-target="achievment">作品介绍</div>
				<?php
					if(!$login){
						echo '<div class="nav_cell" data-target="message">给他留言</div>';
					}else{
						echo '<div class="nav_cell" data-target="check_message">查看留言</div>
								<div class="nav_cell" data-target="setting">设置</div>';
					}
				?>
			</div>
		</div>
		<div id="content">
			<div class="tab show" id="infomation">
				<ul>
					<li><span>性别:</span> <?php echo $name;?></li>
					<li><span>组别:</span> <?php echo $group;?></li>
					<li><span>邮箱地址:</span> <?php echo $email;?></li>
					<li><span>联系电话:</span> <?php echo $phone;?></li>
					<li><span>qq:</span> <?php echo $qq;?></li>
					<li><span>目前状态:</span> <?php echo $status;?></li>
				</ul>
			</div>
			<div class="tab" id="description">
				<h1></h1>
				<p><?php echo $description;?></p>
			</div>
			<div class="tab" id="achievment">
				暂无信息
			</div>
			<div class="tab" id="message">
				<input type="text" placeholder="您的联系邮箱">
				<textarea></textarea>
			</div>
			<div class="tab" id="check_message">
				留言:
			</div>
			<div class="tab" id="setting">
				<a class="btn" href="./index.php/user/do_logout">退出登录</a>
				<div class="form_control">
					<label for="c_name">姓名</label><input type="text" id="c_name" value="<?php echo $name;?>"/>
				</div>
				<div class="form_control">
					<label for="c_motto">motto</label><input type="text" id="c_motto" value="<?php echo $motto;?>"/>
				</div>
				<div class="form_control">
					<label for="c_sex">性别</label><input type="text" id="c_sex" value="<?php echo $sex;?>"/>
				</div>
				<div class="form_control">
					<label for="c_email">邮箱</label><input type="text" id="c_email" value="<?php echo $email;?>"/>
				</div>
				<div class="form_control">
					<label for="c_description">个人简介</label><input type="text" id="c_description" value="<?php echo $description;?>"/>
				</div>
				<div class="form_control">
					<label for="c_qq">qq</label><input type="text" id="c_qq" value="<?php echo $qq;?>"/>
				</div>
				<div class="line"></div>
				<div class="form_control">
					<label for="c_password">密码</label><input type="password" id="c_password"/>
				</div>
				<div class="form_control">
					<label for="c_password_confirm">确认密码</label><input type="password" id="c_password_confirm"/>
				</div>
				<div id="change_info" class="btn">确认修改</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>