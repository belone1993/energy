<?php
	if(!defined("ZC_IN"))
	{
		exit("illegal use!");
	}
?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title><?php echo TITLE;?></title>
	<link href="./img/icon.ico" rel="shortcut icon">
	<meta name="keywords" content="能量作坊，大学生，早餐、夜宵配送平台。" />
	<meta name="description" content="能量作坊是一个大学生早餐、夜宵配送平台，提供订单服务，送货上宿舍。" />
	<meta name="author" content="康东扬，kang_xjtu@163.com"/>
	<link href="./css/common.css" rel="stylesheet" type="text/css" />
</body>
</head>
<body class="<?php echo 'm-'.POS?>">	  
	<div class="m-header" >
		<div class="g-container">
			<h1 class="m-logo g-col-5">
				<a href = "./index.php">能量作坊</a>
			</h1>
			<ul class="m-nav g-col-14">
				<li class="g-col-2"><a class="<?php if(POS == 'index') echo 'active';?>" href = "./index.php">首页</a></li>
				<li class="g-col-2"><a class="<?php if(POS == 'menu') echo 'active';?>" href = "./menu.php">早餐</a></li>
				<li class="g-col-2"><a class="<?php if(POS == 'yexiao_menu') echo 'active';?>" href = "./yexiao_menu.php">夜宵</a></li>
				<li class="g-col-2"><a class="<?php if(POS == 'orderlist') echo 'active';?>" href = "./orderlist.php?pos=zc">订单</a></li>
				<li class="g-col-2"><a class="<?php if(POS == 'feedback') echo 'active';?>" href = "./feedback.php">意见反馈</a></li>
				<li class="g-col-2"><a class="<?php if(POS == 'kefu') echo 'active';?>" href = "./kefu.php">联系我们</a></li>
			</ul>
			<div class="m-usercenter g-col-5">
			<?php
				if(isset($_COOKIE['user'])) {
					echo '<a href="./usercenter.php?pos=data"/>个人中心</a>';
					echo '<a id="logout" href="javascript:void(0);"/>[安全退出]</a>';
				} else {
					echo '<a href = "./register.php?step=one" />注册</a>';
					echo '<a href = "./login.php" />登录</a>';
				}
			?>
			</div>
		</div>
	</div> 
	<ul class="m-elevator">
		<li class="weixin"><div class="weixin_pop"></div></li>
		<li class="feedback"><a href="./feedback.php"  target="_blank"></a></li>
		<li class="app"><div class="app_pop"></div></li>
		<li class="back_to_top"></li>
	</ul>