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
					<a href="../messages">Сообщения</a>
				</li>
				<li>
					<a class="active" href="../notifications">Уведомления</a>
				</li>
			</ul>

			<div class="disp-n" id="notifications_line">
				<h2 class="mb-3 float-left">
					Уведомления
				</h2>
				<button onclick="dell_notifications();" class="btn btn-light btn-sm float-right">
					<i class="far fa-trash"></i>
					Удалить все
				</button>

				<div class="clearfix"></div>

				<div id="notifications">
					{func GetData:notifications("{start}", "{limit}")}
				</div>
			</div>

			<div id="pagination2">{pagination}</div>
		</div>