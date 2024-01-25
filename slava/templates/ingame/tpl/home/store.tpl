<div class="col-lg-9 order-is-first">
	<h2 class="mb-3">
		Магазин привилегий
	</h2>

	<div class="block">
		{if('{servers}' == '0')}
		Услуг не найдено
		{else}
		<div class="row">
			{if('{discount}' != '0')}
			<div class="col-lg-12">
				<div class="noty-block success">
					<h4>Внимание! Действует скидка!</h4>
					На все услуги действует скидка в размере {discount}%
				</div>
			</div>
			{/if}
			<div class="col-lg-6" id="buy_service_area">
				<script>
					function local_change_serv() {
						var server = $('#store_server option:selected').val();
						get_services(server);
						get_server_store(server);
					}

					function local_change_service() {
						var service = $('#store_services option:selected').val();
						get_tarifs(service);
					}

					function local_change_type() {
						var type = $('#store_type option:selected').val();
						change_store_bind_type(type);
					}
				</script>

				<label for="birth_day" class="custom-select with-title">
					<select id="store_server" onchange="local_change_serv();">{servers}</select>
					<span>Выберите сервер</span>
				</label>

				<label for="birth_day" class="custom-select with-title">
					<select id="store_services" onchange="local_change_service();"></select>
					<span>Выберите услугу</span>
				</label>

				<label for="birth_day" class="custom-select with-title">
					<select id="store_tarifs"></select>
					<span>Выберите тариф</span>
				</label>

				<label for="birth_day" class="custom-select with-title">
					<select id="store_type" onchange="local_change_type();">
						<option value="0">Выбрать...</option>
						<option value="1">Ник + пароль</option>
						<option value="2">STEAM ID</option>
						<option value="3">STEAM ID + пароль</option>
					</select>
					<span>Выберите тип привязки</span>
				</label>

				<input type="text" class="form-control disp-n" maxlength="32" id="player_nick" placeholder="" value="{nick}">
				<input type="text" class="form-control disp-n" maxlength="32" id="player_steam_id" placeholder="Введите свой STEAM ID" value="{steam_id}">
				<input type="text" class="form-control disp-n" maxlength="32" id="player_pass" placeholder="Придумайте пароль">

				{if(is_auth())}
				<div class="custom-control custom-checkbox">
					<input type="checkbox" data-status="2" class="custom-control-input" id="store_checbox">
					<label class="custom-control-label" onclick="on_buying();" for="store_checbox">Я ознакомлен с
						<a target="_blank" href="../rules">правилами</a> проекта и согласен с ними</label>
				</div>

				<div id="buy_result" class="mt-3"></div>
				<div id="button" class="mt-3">
					<button id="store_buy_btn" class="btn btn-primary disabled">Купить</button>
					<button id="store_answer_btn" class="btn btn-outline-primary disp-n">Нет</button>
				</div>
				{else}
				<div class="noty-block error">
					<p>Авторизуйтесь, чтобы приобрести услугу</p>
				</div>
				{/if}
			</div>
			<div class="col-lg-6">
				<div class="with_code noty-block info mb-0">
					<h5>
						Информация о услуге
					</h5>
					<div id="store_service_info"></div>
				</div>
				<div id="store_server_info" class="d-none"></div>
				<script>local_change_serv();</script>
			</div>
		</div>
		{/if}
	</div>
</div>

<div class="col-lg-3 order-is-last">
	{include file="/parts/mini-profile.tpl"}
  
  {if("{{$steam_group_link}}" != "")}
		<a target="_blank" class="our-steam-group" href="/">
		<span>Магазин</span>
		<i class="fas fa-shopping-basket"></i>
	</a>
	<a target="_blank" class="our-steam-group" href="/">
		<span>Мы ВКонтакте</span>
		<i class="fab fa-vk"></i>
	</a>
{/if}
</div>