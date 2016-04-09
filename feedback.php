<?php
	define("ZC_IN", true);
	define("POS", "feedback");
	define("TITLE", "意见反馈");
	require 'include/header.inc.php';
?>
<div class="m-content">
	<div class="g-container">
		<form id="feedback"> 
			<div class="tip">
				<h1>征集令：</h1>
				<p>花上1分钟写上你想要吃的早餐或者夜宵以及所在商家，说不定就能让自己心仪的食品放在网站上，作为吃货，梦想还是有的，万一实现了呢？</p>
			</div>
			<div class="content">
				<textarea class="text" name="text_content"></textarea>
			</div>
			<div class="checkcode">
				<input type="text" name="checkcode" id="checkcode" placeholder="验证码"/>
				<div>
					<img id="code" src="./include/code.inc.php?<?php echo mt_rand(1, 10000); ?>" />
				</div>
				<a href="javascript:void(0);" class="refresh">看不清，点击刷新</a>
			</div>
			<div class="sub">
				<?php
					if(!isset($_COOKIE['user'])){
						echo '<input class="m-submit disabled" type="submit" value="需要登录才能反馈" data-disabled="true"/>';
					}else{
						echo '<input class="m-submit" type="submit" value="提交反馈"/>';
					}
				?>
			</div>
		</form>
	</div>
</div>
<?php 
	require 'include/footer.inc.php';
?>