<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html"; charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<base href = "<?php echo base_url();?>"/> 
<link href="./public/css/user_info.css" rel="stylesheet" type="text/css" />
<script src="./public/js/jquery-min.js">
</script>
<script src="./public/js/user_info.js" ></script>
</head>
<body>
	<?php
		foreach ($row as $user) {
			$name = $user['name'];
			switch ($user["groups"]) {
				case 1:
					$group =  "厂长";
					break;
				case 2:
					$group =  "后台组";
					break;
				default:
					$group =  "位置";
					break;
			}
			switch ($user["sex"]) {
				case '1':
					$sex = "男";
					break;
				case '0':
					$sex = "女";
					break;
				default:
					$sex = "未知";
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
			echo "<div class='box'>
				<div class='top'>
					<div class='border'>
						<img class='head' src='./public/images/avatar/avatar.jpg'></img>
					</div>
					<div class='username'>$name</div>
				</div>
				<div class='info_cell'>组别:<div class='oval'>$group</div></div>
				<div class='info_cell'>性别:<div class='oval'>$sex</div></div>
				<div class='info_cell'>状态:<div class='oval'>$status</div></div>
			</div>";
		}
	?>

	
</body>
</html>