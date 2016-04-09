$(function(){

	var	oCodeImg = $('#code'),
		oCodeIpt = $('#checkcode'),
		oTextAera = $('.text').eq(0),
		oSub = $('.m-submit').eq(0),
		oRefresh = $('.refresh').eq(0),
		oForm = $('#feedback');

	//刷新验证码
	function refreshCode(){
		var src = oCodeImg.attr('src'),
			aStr = src.split('?');
			src = aStr[0] + '?' + Math.random();
		oCodeImg.attr('src', src);
	}
	oRefresh.on('click', refreshCode);
	//点击提交
	oSub.on('click', function(){
		if($(this).hasClass('disabled')){
			return false;
		}
		$(this).addClass('disabled');
		//刷新验证码
		refreshCode();
		//验证内容是否为空
		if(!oTextAera.val().trim()){
			alert('内容不能为空！');
			oTextAera.val('');
			oTextAera.focus();
			$(this).removeClass('disabled');
			return false;
		}
		//验证码是否正确
		if(oCodeIpt.val().trim().toUpperCase() != $.cookie('checkchar').toUpperCase()){
			alert('验证码填写错误！');
			oCodeIpt.val('');
			oCodeIpt.focus();
			$(this).removeClass('disabled');
			return false;
		}
		//提交处理
		if(confirm('确定提交反馈？')){
			
			$.ajax({
				type: 'post',
				url: './member/updatefeedback.php',
				data: oForm.serialize(),
				success:function(text,status,xhr){
					oSub.removeClass('disabled');
					if ( text == 1 ) {
						alert('反馈成功，感谢合作！');
						oCodeIpt.val('');
						oTextAera.val('');
					} else {
						alert('反馈失败，请重新提交！');
					}
				},
				error: function(){
					oSub.removeClass('disabled');
					alert('网络出现问题，请重新提交！');
				}
			});

		}
		return false;
	})
})
