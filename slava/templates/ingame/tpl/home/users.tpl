<div class="col-lg-9 order-is-first">
	<h2 class="mb-3">Пользователи</h2>
	<div class="block">
		<div class="input-search">
			<i class="fas fa-search" onclick="search_login({start})"></i>
			<label for="search_login" class="custom-input with-title">
				<input id="search_login" autocomplete="off" type="text" placeholder="&nbsp">
				<span>Введите логин пользователя</span>
			</label>
			<label for="groups" class="custom-select with-title">
				<select id="groups" onchange="group_change();">{groups}</select>
				<span>Группа</span>
			</label>
		</div>
	</div>

	<div id="users" class="row">
		{func GetData:users("{start}", "{group}", "{limit}")}
	</div>

	<script>
		set_enter('#search_login', 'search_login({start})');

		function group_change() {
			var group = $('#groups').val();
			location.href = 'users?group='+group+'&page=1';
		}
	</script>

	<div id="pagination2">{pagination}</div>
</div>

<div class="col-lg-3 order-is-last">
	{include file="/parts/mini-profile.tpl"}
	{include file="/parts/sidebar.tpl"}
	{include file="/elements/vk_widgets.tpl"}
</div>