<?php
	define("ZC_IN", true);
	define("POS", "lookback");
	define("TITLE", "找回密码");
	require 'include/header.inc.php';
	$rand = mt_rand(1, 10000);
?>
<div class="m-content">
	<div class="g-container">
		<form id="lookback">
			<div class="input-box">
				<label>填写注册邮箱：</label>
				<input id="email" type="text" name="email" placeholder="输入注册邮箱"/>
				<input class="u-submit" type="submit" value="发送邮件" id="sub" name="sub">
				<input type="hidden" name="send" value="1">
			</div>
			<div class="no-recived">
				<h2>一直没有收到邮件？</h2>
				<ul>
					<li>请先检查是否在垃圾邮箱中</li>
					<li>如果还未收到，请检查是否是网络问题，等待几分钟</li>
					<li>如果还未收到，请重新发送邮件</li>
					<li>如果仍未能解决，请联系站长kang_xjtu@163.com</li>
				</ul>
			</div>
		</form>
	</div>
</div>
<?php
	require 'include/footer.inc.php';
?>