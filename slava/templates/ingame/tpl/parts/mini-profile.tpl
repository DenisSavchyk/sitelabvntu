{if(is_auth())}
<div class="block mini-profile">
	<div class="block_head">
		<a href="../profile?id={{$user->id}}">
			<img src="../{{$user->avatar}}" alt="{{$user->login}}">
		</a>
		<div>
			<p>Привет, <b>{{$user->login}}</b></p>
			<p>
				<span style="color: {{$users_groups[$user->rights]['color']}}">
					{{$users_groups[$user->rights]['name']}}
				</span>
			</p>
		</div>
	</div>
	<ul class="vertical-navigation">
		<li class="user-balance">
			<a href="../purse">
				<i class="far fa-wallet"></i>
				<div>
					<p>Баланс</p><br>
					<span id="balance">
							{{$user->shilings}}
						</span>
					<i class="far fa-ruble-sign"></i>

					<button class="btn btn-sm btn-primary">
						<i class="far fa-plus"></i>
					</button>
				</div>
			</a>
		</li>
		<li>
			<a href="../messages">
				<i class="far fa-envelope"></i>
				Сообщения
			</a>
		</li>
		<li>
			<a href="../my_stores">
				<i class="far fa-bookmark"></i>
				Мои привилегии
			</a>
		</li>
		<li>
			<a href="../settings">
				<i class="far fa-cog"></i>
				Настройки
			</a>
		</li>
	</ul>
</div>
{else}
<div class="block authorization">
	<form id="user_login">
		<input type="text" maxlength="30" class="form-control" id="user_loginn" placeholder="Логин">
		<input type="password" maxlength="15" class="form-control" id="user_password" placeholder="Пароль">

		<div class="row">
			<div class="col-6">
				<button type="submit" class="btn btn-primary btn-lg btn-block">Войти</button>
			</div>
			<div class="col-3">
				{if($auth_api->vk_api == 1)}
				<a class="btn btn-primary btn-lg btn-block" href="" id="vk_link" title="Войти через Вконтакте">
					<i class="fab fa-vk"></i>
				</a>
				<script>get_vk_auth_link();</script>
				{/if}
			</div>
			<div class="col-3">
				{if($auth_api->steam_api == 1)}
				<a class="btn btn-primary btn-lg btn-block" href="" id="steam_link" title="Войти через Steam">
					<i class="fab fa-steam-symbol"></i>
				</a>
				<script>get_steam_auth_link();</script>
				{/if}
			</div>
		</div>

		<div id="result" class="disp-n">{conf_mess}</div>
	</form>
	<script> send_form('#user_login', 'user_login();'); </script>

	<button class="btn btn-light btn-lg btn-block" data-toggle="modal" data-target="#registration">Создать профиль</button>
	<a href="../recovery" class="small">Забыли пароль?</a>
</div>
{/if}