$(function(){

	var oInputs = $('input'),
		oSub = $('.u-submit').eq(0),
		oSelect = $('select').eq(0),
		validateFns = [],
		validateTips = [],
		reg = {};
	reg.phone = /^(13[0-9]|14[5|7]|15[0|1|2|3|5|6|7|8|9]|18[0|1|2|3|5|6|7|8|9])\d{8}$/;
	reg.passwrod = /^[0-9a-zA-Z]{6,20}$/;
	if ( /data/.test(location.search) ) {
		/* 修改资料 */
			//默认选中的书院
		var value = oSelect.attr('data-selected');
		oSelect.val(value);
			//验证函数
		validateTips[0] = '宿舍楼不能为空！';		
		validateTips[1] = '房间号不能为空！';		
		validateTips[2] = '姓名不能为空！';		
		validateTips[3] = '请输入有效格式的手机号码！';
		for ( var i = 0; i < 3; i++ ) {
			validateFns[i] = (function (i) {
				return function () {
					return !!oInputs.eq(i).val().trim();
				}
			})(i)
		}
		validateFns[3] = function () {
			return reg.phone.test(oInputs.eq(3).val().trim());
		}
		//通过处理函数
		var pass = function () {
			if ( confirm('确定修改资料？') ) {
				$.ajax({
					type: 'post',
					url: './member/changedata.php',
					data: $('#data').serialize(),
					beforeSend: function(){
						oSub.val('资料修改中');		
					},
					success: function( text, status, xhr ) {
						oSub.attr('data-disabled', 'false').val('确定修改');		
						if( text == 1 ) {
							alert('修改成功');
						} else {
							alert('修改失败');
						}
						location.reload();
					},
					error: function(){
						alert('网络出现问题，请重新修改');
						oSub.attr('data-disabled', 'false').val('确定修改');	
					}
				});
			}
		}
	} else {
		/* 修改密码 */
		 	//验证函数
		validateTips[0] = validateTips[1] = '密码由6-20位字母或者数字组成';
		validateTips[2] = '密码两次输入不一致';
		for ( var i = 0; i < 2; i++ ) {
			validateFns[i] = (function(i){
				return function(){
					return reg.passwrod.test(oInputs.eq(i).val().trim());
				}
			})(i)
		}
		validateFns[2] = function(){
			return oInputs.eq(1).val().trim() === oInputs.eq(2).val().trim();
		}
			//通过处理函数
		var pass = function () {
			if ( confirm('确定修改密码？') ) {
			
				$.ajax({
					type: 'post',
					url: './member/changepwd.php',
					data: $('#password').serialize(),
					beforeSend: function () {
						oSub.val('密码修改中');
					},
					success: function ( text, status, xhr ) {

						oSub.attr('data-disabled', 'false').val('确定修改');

						if ( text == '3') {

							alert('旧密码错误！');

						} else if ( text == '4' ) {

							$.cookie('user', 'user', { expires: -1, path: '/' });
							alert('修改成功！请重新登录');
							location.href = './login.php';

						} else {
							alert('修改失败，请重试！');
						}

					},
					error: function () {
						oSub.attr('data-disabled', 'false').val('确定修改');
						alert('修改失败，请重试！');
					}
				});
			
			}
		}
	}
	oSub.on('click', function(){
		//屏蔽重复提交
		if( $(this).attr('data-disabled') == 'true' ) {
			return false;
		}
		$(this).attr('data-disabled', 'true');
		//校验
		for ( var i = 0, len = validateFns.length; i < len; i++ ) {
			if( !validateFns[i]() ) {
				alert(validateTips[i]);
				oInputs.eq(i).val('').focus();
				$(this).attr('data-disabled', 'false');
				return false;
			}
		}
		pass();
		return false;
	})
})
