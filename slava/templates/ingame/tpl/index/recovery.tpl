<div class="col-lg-9 order-is-first">
	<h2 class="mb-3">
		Восстановление пароля
	</h2>

	{if("{message}" == "")}
	<div class="block">
		<form id="send_new_pass" class="form-horizontal">
			<input type="text" maxlength="255" class="form-control" id="email_2" placeholder="Введите ваш e-mail">

			{if($conf->captcha != '2')}

			<div id="recaptcha_2" class="clearfix"></div>
			<script src="https://www.google.com/recaptcha/api.js?hl=ru&onload=onloadReCaptcha&render=explicit" async defer></script>

			<script>
				var recaptcha_2;
				var onloadReCaptcha = function() { recaptcha_2 = grecaptcha.render('recaptcha_2', {"sitekey":"{{$conf->captcha}}"}); }
			</script>
			{/if}
			<div id="result3" class="mt-1"></div>
			<button type="submit" class="btn btn-primary mt-2 mb-0">Выслать новый пароль</button>
		</form>
		<script> send_form('#send_new_pass', 'send_new_pass();'); </script>
	</div>
	{else}
	<div class="noty-block info">
		{message}
	</div>
	{/if}
</div>

<div class="col-lg-3 order-is-last">
	{include file="/parts/mini-profile.tpl"}
	{include file="/parts/sidebar.tpl"}
	{include file="/elements/vk_widgets.tpl"}
</div>