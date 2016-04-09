<?php
	define("ZC_IN", true);
	define("POS", "login");
	define("TITLE", "登录");
	require 'include/header.inc.php';
	$rand = mt_rand(1, 10000);
	$rand_num = mt_rand(1, 7);
?>
<div class="m-content">
	<div class="g-container">
		<div class="img-box g-col-15">
			<img src="./img/login/<?php echo $rand_num;?>.jpg" >
		</div>
		<div class="dialog g-col-8">
			<h1>用户登录</h1>
			<form class="login" name="login" method="post" action="login.php?status=on">
				<div class="one-line">
					<input type="text"  id="email" name="email" placeholder="输入可用的邮箱" autocomplete="off"/>
				</div>
				<div class="one-line">
					<input type="password" name="pwd" id="pwd" placeholder="登录密码" autocomplete="off"/>
				</div>
				<div class="one-line">
					<input class="checkcode" type="text" name="checkcode" placeholder="验证码" />
					<img class="code" src="./include/code.inc.php?<?php echo $rand; ?>" />
					<a href="javascript:void(0);" class="refresh">看不清，点击刷新</a>
				</div>
				<div class="auto-login">
					<input type="checkbox" name="save" value="1" id="save">下次自动登录
				</div>
				<div class="one-line">
					<input class="m-submit" type="submit" name="sub" value="立即登录" />
				</div>
				<div class="link">
					<a href="register.php?step=one">注册帐号</a>
					<span>|</span>
					<a href="lookback.php">找回密码</a>
				</div>
			</form>
		</div>
		
	</div>
</div>
<?php 
 	require 'include/footer.inc.php';
?>