$(function(){

	var oCodeImg = $('.code').eq(0),
		oRereshCode = $('.refresh').eq(0),
		oSub = $('.m-submit').eq(0),
		oEmailInput = $('#email'),
		oPassWordInput = $('#pwd'),
		oCodeInput = $('.checkcode').eq(0),
		oForm = $('.login').eq(0);
	/**
	 * 刷新验证码
	 */
	function refreshCode(){
		var src = oCodeImg.attr('src'),
			aStr = src.split('?');
			src = aStr[0] + '?' + Math.random();
		oCodeImg.attr('src', src);
	}
	//点击看不清刷新
	oRereshCode.on('click', function(e){
		refreshCode();
	})
	//表单校验
	function validateForm(){
		//检验邮箱是否为空
		var emailReg = /^[\w-\.]+@(?:[\w-]+\.)+[a-z]{2,6}$/,
			value = $.trim(oEmailInput.val());
		if(!emailReg.test(value)) {
			alert('请输入正确格式的邮箱');
			refreshCode();
			oEmailInput.focus();
			return false;
		}
		value = $.trim(oPassWordInput.val());
		//检验密码是否为空
		if(!value) {
			alert('密码不能为空');
			refreshCode();
			oPassWordInput.focus();
			return false;
		}
		value = $.trim(oCodeInput.val()).toUpperCase();
		//检验验证码
		if(value != $.cookie('checkchar').toUpperCase()){
			alert('验证码不正确');
			refreshCode();
			oCodeInput.val('');
			oCodeInput.focus();
			return false;
		}
		return true;
	}
	//单击提交
	oSub.on('click', function(e){
		//防止多次提交
		var isDisabled = oSub.attr('data-disabled');
		if(isDisabled == 'true'){
			return;
		}
		var flag = validateForm();
		if(flag){
			//表单验证过关开始处理
			$.ajax({
				type: 'post',
				url: './member/check_login.php',
				data: oForm.serialize(),
				beforeSend: function(){
					oSub.attr('data-disabled', 'true');
					oSub.val('正在登录中...');
				},
				success: function(text, status, xhr){
					//消除多次提交防止
					oSub.attr('data-disabled', 'false');
					oSub.val('立即登录');

					switch(text){
						
						case '0':
							alert('密码错误！');
							refreshCode();
							oCodeInput.val('');
							oPassWordInput.val('');
							oPassWordInput.focus();
							break;
						case '1':
							location.href="index.php";
							break;
						case '2':
							$.cookie('email', oEmailInput.val(), {expires: 7, path: '/'});
							$.ajax({
								type:'post',
								url:'./member/resend.php',
								success: function(text,status,xhr){	
									if(text == 1){
										alert('该帐号未激活！请登录邮箱激活账号！');
										location.href="register.php?step=two";
									}
								}	
							}) ; 	
							break;	
						default:
							alert('登录失败！可能是由于网络原因，请检查后重新登录。');
							break;	
					}
				},
				error: function(){
					//消除多次提交防止
					oSub.attr('data-disabled', 'false');
					oSub.val('立即登录');
					alert('网络出现问题，请重新登录');
				}
			});
		}
		return false;
	})
})
