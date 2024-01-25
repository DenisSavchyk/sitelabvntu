{*
<div class="col-lg-9 order-is-first">
	<div class="block block-search">
		<div class="block_head">
			Друзья {login}
		</div>
		<div class="input-search">
			<i class="fas fa-search" onclick="search_friend({id})"></i>
			<input type="text" class="form-control" id="search_login" placeholder="Введите логин друга">
			<script> set_enter('#search_login', 'search_friend({id})'); </script>
		</div>
		<div id="friends">
			<div class="loader"></div>
			<script>load_friends("{id}");</script>
		</div>
	</div>
</div>
*}