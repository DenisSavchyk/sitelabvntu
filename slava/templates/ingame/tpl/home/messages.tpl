<script>
	$(".monitoring").remove();
	$("#hidden-menu").addClass("with-border");
</script>
</div>
</div>

<div class="container">
	<div class="row mt-5">
		<div class="col-lg-3">
			{include file="/parts/detailed-profile.tpl"}

			<div class="block">
				<div class="block_head">
					Друзья
				</div>
				<div id="companions">
					<div class="loader mt-4"></div>
				</div>
			</div>
		</div>

		<div class="col-lg-9 profile-page">
			<ul class="profile-top-menu mb-4">
				<li>
					<a href="../profile?id={{$user->id}}">Профиль</a>
				</li>
				<li>
					<a href="../friends">Друзья</a>
				</li>
				<li>
					<a href="../my_stores">Привилегии</a>
				</li>
				<li>
					<a href="../purse">Кошелек</a>
				</li>
				<li>
					<a class="active" href="../messages">Сообщения</a>
				</li>
				<li>
					<a href="../notifications">Уведомления</a>
				</li>
			</ul>

			<div id="messages_sound_player"></div>
			<div class="block dialogs with-button">
				<div class="block_head">
					Диалоги
					<button id="back_btn" class="disp-n btn btn-primary btn-block-head btn-sm" onclick="load_dialogs();">К диалогам</button>
				</div>
				<div id="place_for_messages">
					<div class="loader mt-4"></div>
				</div>
			</div>
		</div>

		<script>
			var pm_interval;
			var check_mess;
			{load_dialogs}
			load_companions();
		</script>