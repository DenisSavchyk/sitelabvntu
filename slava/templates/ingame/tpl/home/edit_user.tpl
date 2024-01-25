<div class="col-lg-6">
	{if(is_worthy("g"))}
	<div class="block">
		<div class="block_head mb-3">
			Очистка / удаление
		</div>
		<div class="input-group">
			<div class="input-group-prepend">
				<button onclick="dell_user({id}, 1);" class="btn btn-outline-primary" type="button">Выполнить</button>
			</div>
			<select id="clear_type" class="form-control">
				<option value="2">Очистить активность пользователя</option>
				<option value="3">Удалить все сообщения из чата</option>
				<option value="4">Удалить все сообщения и темы с форума</option>
				<option value="5">Удалить все комментарии</option>
				<option value="1">Удалить пользователя</option>
			</select>
		</div>
	</div>
	{/if}
	<div class="block">
		<div class="block_head mb-3">
			Редактирование профиля
		</div>
		{if(!in_array("{id}", $admins))}
		<div class="form-group">
			<b>Группа</b>
			<div class="input-group">
				<div class="input-group-prepend">
					<button class="btn btn-outline-primary" type="button" onclick="admin_change_group({id});">Изменить</button>
				</div>
				<select id="user_group" class="form-control">
					{user_groups}
				</select>
			</div>
		</div>
		{/if}

		<div class="form-group">
			<b>Логин</b>
			<div class="input-group">
				<div class="input-group-prepend">
					<button class="btn btn-outline-primary" type="button" onclick="admin_change_login({id});">Изменить</button>
				</div>
				<input type="text" class="form-control" id="user_login" maxlength="30" autocomplete="off" value="{login}">
			</div>
			<div id="login_result"></div>
		</div>

		<div class="form-group">
			<b>Пароль</b>
			<div class="input-group">
				<div class="input-group-prepend">
					<button class="btn btn-outline-primary" type="button" onclick="admin_change_password({id});">Изменить</button>
				</div>
				<input type="text" class="form-control" id="user_password" maxlength="15" autocomplete="off" value="">
			</div>
			<div id="password_result"></div>
		</div>

		<div class="form-group">
			<b>Имя</b>
			<div class="input-group">
				<div class="input-group-prepend">
					<button class="btn btn-outline-primary" type="button" onclick="admin_change_name({id});">Изменить</button>
				</div>
				<input type="text" class="form-control" id="user_name" maxlength="15" autocomplete="off" value="{name}">
			</div>
		</div>

		<div class="form-group">
			<b>Ник на сервере</b>
			<div class="input-group">
				<div class="input-group-prepend">
					<button class="btn btn-outline-primary" type="button" onclick="admin_change_nick({id});">Изменить</button>
				</div>
				<input type="text" class="form-control" id="user_nick" maxlength="30" autocomplete="off" value="{nick}">
			</div>
		</div>

		<div class="form-group">
			<b>Steam ID</b>
			<div class="input-group">
				<div class="input-group-prepend">
					<button class="btn btn-outline-primary" type="button" onclick="admin_change_steam_id({id});">Изменить</button>
				</div>
				<input type="text" class="form-control" id="user_steam_id" maxlength="32" autocomplete="off" value="{steam_id}">
			</div>
		</div>

		<div class="form-group">
			<b>Дата рождения</b>
			<div class="input-group editing-date">
				<div class="input-group-prepend">
					<button class="btn btn-outline-primary" type="button" onclick="admin_change_birth({id});">Изменить</button>
				</div>
				<select class="form-control" id="birth_day">{birth_day}</select>
				<select class="form-control" id="birth_month">{birth_month}</select>
				<select class="form-control" id="birth_year">{birth_year}</select>
			</div>
		</div>

		<div class="form-group">
			<b>Скайп</b>
			<div class="input-group">
				<div class="input-group-prepend">
					<button class="btn btn-outline-primary" type="button" onclick="admin_change_skype({id});">Изменить</button>
				</div>
				<input type="text" class="form-control" id="user_skype" maxlength="32" autocomplete="off" value="{skype}" placeholder="Введите логин скайпа">
			</div>
		</div>

		<div class="form-group">
			<b>Телеграм</b>
			<div class="input-group">
				<div class="input-group-prepend">
					<button class="btn btn-outline-primary" type="button" onclick="admin_change_telegram({id});">Изменить</button>
				</div>
				<input type="text" class="form-control" id="user_telegram" maxlength="50" autocomplete="off" value="{telegram}" placeholder="Введите логин телеграма">
			</div>
		</div>

		<div class="form-group">
			<b>ID Вконтакте</b>
			<div class="input-group">
				<div class="input-group-prepend">
					<button class="btn btn-outline-primary" type="button" onclick="admin_change_vk({id});">Изменить</button>
				</div>
				<input type="text" class="form-control" id="user_vk" maxlength="15" autocomplete="off" value="{vk}" placeholder="Введите ID в Вконтакте">
			</div>
		</div>

		<div class="form-group">
			<b>ID Facebook</b>
			<div class="input-group">
				<div class="input-group-prepend">
					<button class="btn btn-outline-primary" type="button" onclick="admin_change_fb({id});">Изменить</button>
				</div>
				<input type="text" class="form-control" id="user_fb" maxlength="20" autocomplete="off" value="{fb}" placeholder="Введите ID в Facebook">
			</div>
		</div>

		<div class="form-group">
			<b>E-mail</b>
			<div class="input-group">
				<div class="input-group-prepend">
					<button class="btn btn-outline-primary" type="button" onclick="admin_change_email({id});">Изменить</button>
				</div>
				<input type="text" class="form-control" id="user_email" maxlength="255" autocomplete="off" value="{email}" placeholder="Введите email">
			</div>
			{if("{active}" == "0")}
			<div class="noty-block" id="activate_user">
				<p>E-mail не подтвержден, пользователь не активирован! <a href="#" onclick="admin_activate_user({id});">Активировать</a></p>
			</div>
			{/if}
		</div>

		<div class="form-group mb-1">
			<b>Аватар</b>
			<div class="row">
				<div class="col-3">
					<img id="avatar" src="../{avatar}" class="w-100 mb-1" alt="Аватар">
				</div>
				<div class="col-lg-6">
					<form enctype="multipart/form-data" id="edit_user_avatar_form">
						<input type="hidden" id="token" name="token" value="{token}">
						<input type="hidden" id="id" name="id" value="{id}">
						<input type="hidden" id="admin_change_avatar" name="admin_change_avatar" value="1">
						<input type="hidden" id="phpaction" name="phpaction" value="1">

						<div class="custom-file">
							<input type="file" class="custom-file-input" id="user_avatar" accept="image/*" name="user_avatar">
							<label class="custom-file-label" for="user_avatar">Выбрать...</label>
						</div>

						<div id="edit_user_avatar_result" class="mt-1"></div>
						<button class="btn btn-primary btn-sm mt-2" type="submit">Загрузить</button>
					</form>
				</div>
			</div>
		</div>
		<br>

		<div class="form-group mb-0">
			<b>Подпись</b>
			<textarea id="signature">{signature}</textarea>
			<input id="send_btn" class="btn btn-outline-primary mt-3 mb-0" type="button" onclick="admin_change_signature({id});" value="Отправить">
		</div>
	</div>

	<script>
		$(document).ready(function () {
			init_tinymce("signature", "lite", "{file_manager_theme}", "", "");
		});
		$("#edit_user_avatar_form").submit(function (event) {
			NProgress.start();
			event.preventDefault();
			var data = new FormData($('#edit_user_avatar_form')[0]);
			$.ajax({
				type: "POST",
				url: "../ajax/actions_z.php",
				data: data,
				contentType: false,
				processData: false,
			}).done(function (html) {
				$("#edit_user_avatar_result").empty();
				$("#edit_user_avatar_result").append(html);
				$('#edit_user_avatar_form')[0].reset();
				NProgress.done();
			});
		});
	</script>
</div>
<div class="col-lg-6">
	<div class="block block-table">
		<div class="block_head">
			Информация
		</div>
		<div class="table-responsive mb-0">
			<table class="table table-striped table-bordered">
				<tr>
					<td width="45%;">Профиль</td>
					<td><a href="../profile?id={id}" target="_blank"><b>{login}</b></a></td>
				</tr>
				<tr>
					<td>Дата регистрации</td>
					<td>{regdate}</td>
				</tr>
				<tr>
					<td>Уведомления на почту</td>
					<td>
						{if('{email_notice}'=='1')}
						<p class="text-success mb-0">Включено</p>
						{else}
						<p class="text-danger mb-0">Выключено</p>
						{/if}
					</td>
				</tr>
				<tr>
					<td>Доступ к лс</td>
					<td>
						{if('{im}'=='1')}
						<p class="text-success mb-0">Всем</p>
						{else}
						<p class="text-danger mb-0">Только друзья</p>
						{/if}
					</td>
				</tr>
				<tr>
					<td>Приглашен</td>
					<td>
						{if('{invited}'=='0')}
						Не является рефералом
						{else}
						<a href="../profile?id={invited}" target="_blank"><b>{invited_login}</b></a>
						{/if}
					</td>
				</tr>
				<tr>
					<td>Прибыль с пользователя</td>
					<td><b>{shilings}</b></td>
				</tr>
				<tr>
					<td>Последний IP</td>
					<td>
						{if('{ip}'=='127.0.0.1')}
						Неизвестно
						{else}
						{ip}
						{/if}
					</td>
				</tr>
				{if('{ip}'!='127.0.0.1')}
				<tr>
					<td>Местоположение</td>
					<td id="place">
						Неизвестно
					</td>
					<script>
						$.getJSON('https://api.sypexgeo.net/json/{ip}', function (resp) {
							$('#place').html(resp.country.name_ru + ', ' + resp.region.name_ru + ', ' + resp.city.name_ru);
						});
					</script>
				</tr>
				{/if}
			</table>
		</div>
	</div>

	<div class="block">
		<div class="block_head">
			Другие аккаунты пользователя
		</div>

		{if('{multi_account}' == '0')}
		Профили не найдены
		{else}
		<div class="table-adaptive table-fused">
			{for($i=0; $i < count($multi_accounts); $i++)}
			{if($multi_accounts[$i][0] != 0)}
			<div class="table-row" id="multi-account-{{$multi_accounts[$i][0]}}">
				<div class="row">
					<div class="col-lg-5 with-description">
						<p>
							<a href="../edit_user?id={{$multi_accounts[$i][0]}}" target="_blank">{{$multi_accounts[$i][2]}}</a>
						</p>
						<span>
							Удалить:
							<span onclick="dell_multi_account_relation({id}, {{$multi_accounts[$i][0]}}); dell_block('multi-account-{{$multi_accounts[$i][0]}}');">связь</span>
							|
							<span onclick="dell_user({{$multi_accounts[$i][0]}}, 2, 1); dell_block('multi-account-{{$multi_accounts[$i][0]}}');">профиль</span>
						</span>
					</div>
					<div class="col-lg-7 with-icon with-description">
						<i class="far fa-dot-circle"></i>
						{if($multi_accounts[$i][1] == 1)}
						<p>IP</p>
						{/if}
						{if($multi_accounts[$i][1] == 2)}
						<p class="text-warning mb-0">ОС и информации браузера</p>
						{/if}
						{if($multi_accounts[$i][1] == 3)}
						<p class="text-danger mb-0">ОС, информации браузера и IP</p>
						{/if}
						<span>Совпадение по</span>
					</div>
				</div>
			</div>
			{/if}
			{/for}
		</div>
		{/if}
	</div>

	<div class="block">
		<div class="block_head">
			Денежные операции пользователя
		</div>
		<div id="operations" class="table-adaptive table-fused">
			<div class="loader"></div>
			<script>get_user_shilings_operations({id});</script>
		</div>
	</div>
</div>