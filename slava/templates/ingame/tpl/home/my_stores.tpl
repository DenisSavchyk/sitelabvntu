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
					<a class="active" href="../my_stores">Привилегии</a>
				</li>
				<li>
					<a href="../purse">Кошелек</a>
				</li>
				<li>
					<a href="../messages">Сообщения</a>
				</li>
				<li>
					<a href="../notifications">Уведомления</a>
				</li>
			</ul>

			<div class="noty-block primary">
				<h5>
					Мои привилегии
				</h5>
				<p>
					Здесь вы можете посмотреть свои привилегии, продлить и отредактировать их. <br>
					Если вы не знаете как активировать привилегию, ознакомьтесь с FAQ
				</p>
			</div>

			<div id="my_stores" class="table-adaptive">
				<div class="loader"></div>
				<script>get_user_srotes();</script>
			</div>

			<script>
				function local_change_admin_type(id) {
					var type = $('#store_type_'+id+' option:selected').val();
					change_admin_bind_type(type, id);
				}
			</script>
		</div>