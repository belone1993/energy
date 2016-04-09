<?php
	define('ZC_IN',true);
	require '../include/fun.inc.php';
	require '../include/config.inc.php';
	$query = "select * from zc_user where email='$_POST[email]'";
	$result = _mysql($query, 'count');
	if($result == 0){
		exit('2');
	}
	if(isset($_POST['send']))
	{
		ini_set("magic_quotes_runtime",0);
		require '../phpmailer/class.phpmailer.php';
		try {
			$mail = new PHPMailer(true);
			$mail->IsSMTP();
			$mail->CharSet='UTF-8'; //设置邮件的字符编码，这很重要，不然中文乱码
			$mail->SMTPAuth = true; //开启认证
			$mail->Port = 25;
			$mail->Host = "smtp.163.com";
			$mail->Username = "suixinweb@163.com";
			$mail->Password = "dongyang102229";
			//$mail->IsSendmail(); //如果没有sendmail组件就注释掉，否则出现“Could not execute: /var/qmail/bin/sendmail ”的错误提示
			$mail->AddReplyTo("nengliangzuofang@163.com","能量作坊");//回复地址
			$mail->From = "suixinweb@163.com";
			$mail->FromName = "能量作坊";
			$to = $_POST['email'];
			$yuming = $dir;
			$mail->AddAddress($to);
			$mail->Subject = "[能量作坊]密码找回";
			$my_url = $yuming."member/comfirmchange.php?email=$to&operat=ok";
			
			$content = <<<end
<div style="background:#d0d0d0;padding:40px;text-align:left;">
	<div style="height:420px;width:580px;margin:0 auto;padding:10px;color:#333;background-color:#fff;border:0px solid #aaa;border-radius:5px;-webkit-box-shadow:3px 3px 10px #999;-moz-box-shadow:3px 3px 10px #999;box-shadow:3px 3px 10px #999;font-family:Verdana, sans-serif; ">
		<div style="height:23px;background:url({$yuming}/img/send_email_bg.png) repeat-x 0 0;">
		</div>
		<div>
			<p class="salutation" style="font-weight:bold;">
				亲爱的用户，您好:
			</p>
			 <p>请点击以下链接，找回【能量作坊】帐号密码：<br>
				<a href='{$my_url}' >{$my_url}</a><br><br>如果这不是您发送的邮件请忽略，很抱歉打扰您，请原谅。
			</p>
			<div style="padding:40px 0 0;">
				<img src="{$yuming}img/logo_icon.jpg" style="float:left; width:60px;height:60px;border:1px solid #eee;margin-right:10px;">
				<div style="margin:0 0 0 54px;">
					<p style="margin:0 0 10px;">康东扬</p>
					<p style="font-size:12px;margin:0;line-height:1.2;">
						能量作坊网络总工程师&&总负责人<br>
						邮箱:674647202@qq.com
					</p>
				</div>
			</div>
		</div>
	</div>
</div>
end;
			$mail->Body = $content;
			$mail->WordWrap = 80; // 设置每行字符串的长度
			//$mail->AddAttachment("f:/test.png"); //可以添加附件
			$mail->IsHTML(true);
			$mail->Send();
			
			echo '1';
		} catch (phpmailerException $e) {
			echo '0';
		}
	}else{
		echo '0';
	}
	
	
	
	
	
?>
