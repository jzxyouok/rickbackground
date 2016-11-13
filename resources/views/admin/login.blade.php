<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Rick后台模板 —— 登录</title>
	<meta name="description" content="Rick后台模板 —— 登录">
	<meta name="keywords" content="index">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="renderer" content="webkit">
	<meta http-equiv="Cache-Control" content="no-siteapp"/>
	<link rel="icon" type="image/png" href="/assets/i/favicon.png">
	<link rel="apple-touch-icon-precomposed" href="/assets/i/i/app-icon72x72@2x.png">
	<meta name="apple-mobile-web-app-title" content="Amaze UI"/>
	<link rel="stylesheet" href="/assets/css/amazeui.min.css"/>
	<link rel="stylesheet" href="/assets/css/admin.css">
	<link rel="stylesheet" href="/assets/css/app.css">
</head>

<body data-type="login">

<div class="am-g myapp-login">
	<div class="myapp-login-logo-block  tpl-login-max">
		<div class="myapp-login-logo-text">
			<div class="myapp-login-logo-text">
				Rick 后台模板<span> 登录</span> <i class="am-icon-skyatlas"></i>

			</div>
		</div>
		<!--
		<div class="login-font">
			<i>登录 </i> 或 <span> 注册</span>
		</div>
		-->
		<div class="am-u-sm-10 login-am-center">
			<form class="am-form" action="/admin/login" method="POST">
				<fieldset>
					<div class="am-form-group">
						<input type="text" class="" id="doc-ipt-email-1"
							   placeholder="输入账号" required name="account">
					</div>
					<div class="am-form-group">
						<input type="password" class="" id="doc-ipt-pwd-1"
							   placeholder="输入密码" required name="password">
					</div>
					<input type="hidden" value="{{ csrf_token() }}" name="_token">
					<p>
						<button type="submit" class="am-btn am-btn-default" id="login-btn">
							登录
						</button>
					</p>
				</fieldset>
			</form>
		</div>
	</div>
</div>
<script src="/assets/js/jquery.min.js"></script>
<script src="/assets/js/amazeui.min.js"></script>
<script src="/assets/js/app.js"></script>
<script src="/assets/js/tools/md5.js"></script>
<script src="/assets/js/layer/layer.js"></script>
<script>
	$('.am-form').on('submit', function () {
		changeLoginBtnStatus(false, '登录中...');
		var $pwd = $(this).find("input[name='password']");
		var pwd = $pwd.val();
		$pwd.val(hex_md5(pwd));
		var data = $(this).serialize();
		$.post('/admin/login', data, function (ret) {
			if (ret.result == 'SUCCESS') {
				layer.msg('登录成功');
				setTimeout(function () {
					location.href = '/admin';
				}, 1500);
			} else {
				layer.msg('账号或密码错误');
				setTimeout(function () {
					$pwd.val('');
					changeLoginBtnStatus(true, '登录');
				}, 1500);
			}
		}, 'json');
		return false;
	});

	/**
	 * 更改登录按钮状态
	 * @param status true 表示正常, false表示登录中，不可用
	 */
	function changeLoginBtnStatus(status, text) {
		var $btn = $('#login-btn');
		if (status) {
			$btn.removeAttr('disabled');
			$btn.html(text);
		} else {
			$btn.attr('disabled', 'disabled');
			$btn.html("<span class='am-icon-spinner am-icon-spin'></span> " + text);
		}
	}
</script>
</body>
</html>