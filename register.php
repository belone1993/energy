<?php
	define("ZC_IN", true);
	define("POS", "register");
	define("TITLE", "注册");
	require 'include/header.inc.php';
	require 'include/fun.inc.php';
	//检验是否为非法途径进入注册页面
	if(!isset($_GET['step'])){
		echo '<script>location.href="register.php?step=one";</script>';
	}elseif($_GET['step'] != 'one' and $_GET['step'] != 'two' and $_GET['step'] != 'three'){
		echo '<script>location.href="register.php?step=one";</script>';
	}
?>

<div class="m-content">
	<div class="g-container">
		<ul class="step">
			<li class="g-col-8 one <?php if($_GET['step'] == 'one') echo 'active';?>">1. 填写信息</li>
			<li class="g-col-8 two <?php if($_GET['step'] == 'two') echo 'active';?>">2. 邮箱激活</li>
			<li class="g-col-8 three <?php if($_GET['step'] == 'three') echo 'active';?>">3. 注册成功</li>
		</ul>
		<div class="step-one dialog">
<?php
	$uniqid = uniqidStr();
	$rand = mt_rand(1, 10000);
	if($_GET['step'] == 'one'){
?>	
			<form method="post" action="register.php?step=two" name='reg' id="reg">
				<div id="error-tip" class="error-tip"></div>
				<div class="one-line">
					<label for="email">电子邮箱：</label>
					<input class="check-item" type="text"  id="email" name="email" placeholder="输入可用的邮箱" autocomplete="off"
						   data-pattern="^[\w-\.]+@(?:[\w-]+\.)+[a-z]{2,6}$" error-tip="请输入正确格式的邮箱"/>
					<span class='tip'>输入有效邮箱，这将作为登录邮箱，及找回密码时使用</span>
				</div>
				<div class="one-line">
					<label for="pwd">登录密码：</label>
					<input class="check-item"  id="pwd" type="password" name="pwd" placeholder="输入密码" autocomplete="off"
						   data-pattern="^[0-9a-zA-Z]{6,20}$" error-tip="请输入正确格式的密码"/>
					<span class='tip'>密码6-20位，只能由字母，数字组成，不能有空格</span>
				</div>
				<div class="one-line">
					<label for="pwd2">确认密码：</label>
					<input class="check-item" id="pwd2" type="password" name="pwd2" placeholder="再次输入同样的密码" autocomplete="off"
						   error-tip="两次输入密码不一致"/>
					<span class='tip'>再次输入同样的密码</span>
				</div>
				<div class="one-line">
					<label for="checkcode">验证码：</label>
					<input class="check-item" id="checkcode" type="text" name="checkcode" placeholder="输入验证码" autocomplete="off"
						   error-tip="验证码输入错误"/>
					<img id="code" src="./include/code.inc.php?<?php echo $rand;?>" alt="请点击刷新"/>
					<a class="refresh" href='javascript:void(0);'>看不清，点击刷新一下</a>
				</div>
				<div class="agree">
					<span>点击"立即注册"按钮即视为同意</span>
					<a class="rule-link" href="rule.php" target="blank">《能量作坊服务协议》</a>
				</div>
				<div class="one-line">
					<input class="u-submit" type="submit" name="sub" value="立即注册">
				</div>
				<input type="hidden" name="uniqid" value="<?php echo $uniqid;?>" />
				<input type="hidden" name="send" value="1" />
			</form>	 
<?php 
	}
?>
		</div>
		<div class="step-two">
<?php 
	if($_GET['step'] == 'two'){
		if(isset($_COOKIE['email'])){	

			$email = $_COOKIE['email'];
			$mail = explode('@', $email);
			$mail = 'http://mail.'.$mail[1];
?>
			<h2>验证邮件发送成功</h2>
			<div class="mail-content">
				<span>帐号激活邮件已经发送至你的</span>
				<a href="<?php echo $mail; ?>" target="_blank"><?php echo $_COOKIE['email']; ?></a>
				<span>邮箱，请您登录邮箱并点击邮件中的链接，继续完成注册。</span>
			</div>
			<div class="no-recived">
				<h3>一直没有收到邮件？</h3>
				<ul class="situation">
					<li>请先检查是否在垃圾邮箱中</li>
					<li>如果还未收到，请<a id="resend" href="javascript:void(0);">重新发送</a></li>
					<li>如果重新发送还未收到，请更换邮箱重新注册</li>
					<li>如果仍未能解决，请联系站长kang_xjtu@163.com</li>
				</ul>
			</div>
<?php }} ?>
		</div>
<?php
	if($_GET['step'] == 'three'){
?>
		<div class="step-three">
			<h2>注册成功</h2>
			<p>
				<span>页面将在</span>
				<span class="second">3</span>
				<span>秒后跳转,如果没有跳转，请点击</span>
				<a href="login.php">登录</a>
			</p>
<?php	}	?>  
		</div>		
    </div>
</div>
 
 <?php 
 	require 'include/footer.inc.php';
 ?>
