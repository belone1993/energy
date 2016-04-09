$(function(){
	var oEmail = $('#email'),
		oSub = $('#sub'),
		oForm = $('#lookback'),
		emailReg = /^[\w-\.]+@(?:[\w-]+\.)+[a-z]{2,6}$/;

	oSub.on('click', function () {
		
		if ( oSub.attr('data-disabled') == 'true') {
			return false;
		}
		if ( !emailReg.test(oEmail.val().trim()) ) {
			alert('请输入有效格式的邮箱');
			oEmail.val('').focus();
			return false;
		}
		oSub.attr('data-disabled', 'true').val('发送邮件中...');

		$.ajax({
			type: "post",
			url: './member/sendpwd.php',
			data: oForm.serialize(),
			success:function(text,status,xhr){
				oSub.attr('data-disabled', 'false').val('发送邮件');
				if ( text == '0' ) {
					alert('发送邮件失败！请重新发送！');
					return false;
				} else if( text == 1 ) {
					alert('邮件发送成功！');
					location.reload();
				} else {
					alert('该邮箱没有注册！');
				}
			},
			error: function(){
				alert('发送邮件失败！请重新发送！');
				oSub.attr('data-disabled', 'false').val('发送邮件');
			}
		});
		return false;
	})
})
