$(function(){
	
	var oForm = $('#reg'),
		oInputs = oForm.find('input'),
		oTipBox = oForm.find('.error-tip').eq(0),
		oSub = $('.u-submit').eq(0),
		validateFns = [],
		validateTips = [],
		oCodeImg = $('#code'),
		oRefresh = $('.refresh').eq(0),
		oResend = $('#resend');
	//有data-pattern的input
	for(var i = 0; i < 2; i++){
		validateTips.push(oInputs.eq(i).attr('error-tip'))
		validateFns[i] = (function(i){
			return function(){
				var reg = oInputs.eq(i).attr('data-pattern'),
					value = oInputs.eq(i).val().trim();
				reg = new RegExp(reg);
				return reg.test(value);
			}
		})(i);
	}
	//再次输入密码
	validateFns[2] = function(){
		return oInputs.eq(1).val().trim() === oInputs.eq(2).val().trim();
	}
	validateTips[2] = '两次密码输入不一致！'
	//验证码
	validateFns[3] = function(){
		return $.cookie('checkchar').toUpperCase() == oInputs.eq(3).val().trim().toUpperCase()
	}
	validateTips[3] = '验证码输入不正确'
	//重新输入把错误信息去掉
	oInputs.on('keyup', function(){
		oTipBox.html('');
	})
	//提交按钮
	oSub.on('click', function(){
		var isOk = $(this).attr('data-disabled');
		if ( isOk == 'true' ) {
			return false;
		}
		$(this).attr('data-disabled', 'true').val('输入校验中...');
		//刷新验证码
		refreshCode();
		//逐个校验
		for ( var i = 0; i < 4; i++ ) {
			if (!validateFns[i]()) {
				$(this).attr('data-disabled', 'false').val('立即注册');
				showError(validateTips[i]);
				oInputs.eq(i).val('').focus();
				return false;
			}
		}
		//正则校验通过后校验邮箱是否已经注册
		$.ajax({
			type: 'POST',
			url: './member/check.php',
			data: 'email='+ oInputs.eq(0).val().trim(),
			success: function( response, status, xhr ) {
				if ( response != '0' ) {
					showError('该邮箱已经被注册过了');
					oSub.attr('data-disabled', 'false').val('立即注册');
				} else {
					oSub.val('正在注册中...');
					pass();
				}
			},
			error: function () {
				showError('网络出现问题，请重新注册');
				oSub.attr('data-disabled', 'false').val('立即注册');
			}
		})
		//阻止默认行为
		return false;
	})
	//错误提示函数
	function showError(tip) {
		oTipBox.html(tip);
		oInputs.eq(3).val('');
	}
	//刷新验证码
	function refreshCode(){
		var src = oCodeImg.attr('src'),
			aStr = src.split('?');
			src = aStr[0] + '?' + Math.random();
		oCodeImg.attr('src', src);
	}
	oRefresh.on('click', refreshCode);
	//通过函数
	function pass(){
		$.cookie('email', oInputs.eq(0).val(), {expires: 7, path: '/'});
		$.ajax({
			type: "post",
			url: './member/send.php',
			data: $('#reg').serialize(),
			success: function(text,status,xhr){
				if(text == '0'){
					showError('发送邮件失败！请重新点击注册按钮！');
					oSub.attr('data-disabled', 'false').val('立即注册');
				}else if(text == 1){
					location.href="register.php?step=two";
				}
			},
			error: function () {
				showError('网络出现问题，请重新注册');
				oSub.attr('data-disabled', 'false').val('立即注册');
			}
		});
	}
	//重新发送邮件
	oResend.on('click', function(){
		if(confirm("确定要重新发送吗?") == true){     
 			$.ajax({
				type:'post',
				url:'./member/resend.php',
				success:function(text,status,xhr){	
					if(text == '0'){
						alert('发送邮件失败！请重新发送！');
					}else if(text == 1){
						alert('发送成功！');
						location.href="register.php?step=two";
					}
				},
				error: function(){
					alert('发送邮件失败！请重新发送！');
				}	
			})  
 		} 
	})
	//步骤三自动跳转
	if(/three/.test(location.search)){
		var oSeconds = $('.second').eq(0),
			num = 3;
		setInterval(function(){
			num -= 1;
			oSeconds.html(num);
			if(num == 0){
				location.href = 'login.php';
			}
		}, 1000)
	}
})
