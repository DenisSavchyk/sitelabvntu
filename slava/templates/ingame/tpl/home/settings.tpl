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

			<ul class="nav vertical-navigation with-icons">
				<li>
					<a data-toggle="tab" href="#account">
						<i class="far fa-star"></i>
						Аккаунт
					</a>
				</li>
				<li>
					<a data-toggle="tab" href="#contacts">
						<i class="far fa-bookmark"></i>
						Контакты и аккаунты
					</a>
				</li>
				<li>
					<a data-toggle="tab" href="#privacy">
						<i class="far fa-lock"></i>
						Приватность
					</a>
				</li>
				{if('{referral_program}' == '1')}
				<li>
					<a data-toggle="tab" href="#referral_program">
						<i class="far fa-user-friends"></i>
						Пригласи друга
					</a>
				</li>
				{/if}
			</ul>
		</div>

		<div class="col-lg-9 profile-settings">
			<div class="tab-content">
				<div class="tab-pane fade" id="account">
					<div class="row">
						<div class="col-lg-6">
							<h2>Общая информация</h2>

							<div class="block">
								<label for="user_login" class="custom-input with-title with-button">
									<button type="button" onclick="edit_user_login();">
										<i class="far fa-pencil"></i>
									</button>
									<input id="user_login" maxlength="15" autocomplete="off" value="{login}" type="text" placeholder=" ">
									<span>Логин</span>
									<small id="edit_user_login_result"></small>
								</label>

								<label for="user_name" class="custom-input with-title with-button">
									<button type="button" onclick="edit_user_name();">
										<i class="far fa-pencil"></i>
									</button>
									<input id="user_name" maxlength="30" autocomplete="off" value="{name}" type="text" placeholder=" ">
									<span>Ваше имя</span>
									<small id="edit_user_name_result"></small>
								</label>

								<small class="input-title">Дата рождения</small>
								<div class="row edit-date">
									<div class="col-3">
										<label for="birth_day" class="custom-select with-title">
											<select id="birth_day">{birth_day}</select>
											<span>День</span>
										</label>
									</div>
									<div class="col-3">
										<label for="birth_month" class="custom-select with-title">
											<select id="birth_month">{birth_month}</select>
											<span>День</span>
										</label>
									</div>
									<div class="col-3">
										<label for="birth_year" class="custom-select with-title">
											<select id="birth_year">{birth_year}</select>
											<span>День</span>
										</label>
									</div>
									<div class="col-3">
										<button type="button" class="btn btn-sm" onclick="edit_user_birth();">
											<i class="far fa-pencil"></i>
										</button>
									</div>
									<div class="col-12">
										<small id="edit_user_birth_result" class="input-title"></small>
									</div>
								</div>

								<small class="input-title">Подпись</small>
								<textarea id="signature">{signature}</textarea>
								<div id="edit_signature_result" class="input-title mt-1"></div>
								<button type="button" class="btn btn-sm mt-2 mb-0" onclick="edit_signature();">
									Изменить подпись
								</button>
							</div>

							<h2>Серверная информация</h2>
							<div class="block">
								<label for="user_nick" class="custom-input with-title with-button">
									<button type="button" onclick="edit_user_nick();">
										<i class="far fa-pencil"></i>
									</button>
									<input id="user_nick" maxlength="30" autocomplete="off" value="{nick}" type="text" placeholder=" ">
									<span>Ник на сервере</span>
									<small id="edit_user_nick_result"></small>
								</label>

								<label for="user_steam_id" class="custom-input with-title with-button mb-0">
									<button type="button" onclick="edit_user_steam_id();">
										<i class="far fa-pencil"></i>
									</button>
									<input id="user_steam_id" maxlength="32" autocomplete="off" value="{steam_id}" type="text" placeholder=" ">
									<span>Steam ID</span>
									<small id="edit_user_steam_id_result"></small>
								</label>
							</div>
						</div>
						<div class="col-lg-6">
							<h2>Аватар</h2>
							<div class="block">
								<div class="row edit-avatar">
									<div class="col-4">
										<img id="avatar" src="{avatar}" alt="Ваш аватар">
									</div>
									<div class="col-8">
										<form enctype="multipart/form-data" id="edit_user_avatar_form">
											<input type="hidden" id="token" name="token" value="{token}">
											<input type="hidden" id="edit_user_avatar" name="edit_user_avatar" value="1">
											<input type="hidden" id="phpaction" name="phpaction" value="1">

											<div class="custom-file mb-0">
												<input type="file" class="custom-file-input" id="user_avatar" accept="image/*" name="user_avatar">
												<label class="custom-file-label" for="user_avatar">Выбрать...</label>
											</div>

											<small class="input-title mt-1" id="edit_user_avatar_result"></small>
											<input class="btn btn-sm mt-2 mb-0" type="submit" value="Загрузить">

										</form>
									</div>
								</div>
							</div>
							<script>

							</script>
							<h2>Безопасность</h2>
							<div class="block">
								{if($user->password == 'none')}
								<label for="first_user_password" class="custom-input with-title">
									<input id="first_user_password" maxlength="15" autocomplete="off" type="password" placeholder=" ">
									<span>Новый пароль</span>
								</label>

								<label for="first_user_password2" class="custom-input with-title">
									<input id="first_user_password2" maxlength="15" autocomplete="off" type="password" placeholder=" ">
									<span>Повторите новый пароль</span>
								</label>

								<small class="input-title mt-1" id="edit_first_user_password_result"></small>
								<button class="btn btn-sm mt-2 mb-0" type="button" onclick="edit_first_user_password();">Изменить</button>
								{else}

								<label for="user_old_password" class="custom-input with-title">
									<input id="user_old_password" maxlength="15" autocomplete="off" type="password" placeholder=" ">
									<span>Текущий пароль</span>
								</label>

								<label for="user_password" class="custom-input with-title">
									<input id="user_password" maxlength="15" autocomplete="off" type="password" placeholder=" ">
									<span>Новый пароль</span>
								</label>

								<label for="user_password2" class="custom-input with-title mb-0">
									<input id="user_password2" maxlength="15" autocomplete="off" type="password" placeholder=" ">
									<span>Повторите новый пароль</span>
								</label>

								<small class="input-title mt-1" id="edit_user_password_result"></small>
								<button class="btn btn-sm mt-2 mb-0" type="button" onclick="edit_user_password();">Изменить</button>
								{/if}
							</div>
						</div>
					</div>
				</div>
				<div class="tab-pane fade" id="contacts">
					<div class="row">
						<div class="col-lg-6">
							<h2>Контакты</h2>
							<div class="block">
								<label for="user_skype" class="custom-input with-title with-button">
									<button type="button" onclick="edit_user_skype();">
										<i class="far fa-pencil"></i>
									</button>
									<input id="user_skype" maxlength="32" autocomplete="off" value="{skype}" type="text" placeholder=" ">
									<span>Skype</span>
									<small id="edit_user_skype_result"></small>
								</label>

								<label for="user_telegram" class="custom-input with-title with-button mb-0">
									<button type="button" onclick="edit_user_telegram();">
										<i class="far fa-pencil"></i>
									</button>
									<input id="user_telegram" maxlength="50" autocomplete="off" value="{telegram}" type="text" placeholder=" ">
									<span>Telegram</span>
									<small id="edit_user_telegram_result"></small>
								</label>
							</div>
						</div>
						<div class="col-lg-6 edit-social">
							<h2>Вконтакте</h2>
							<div class="block" id="vk_area">
								{if($auth_api->vk_api == '2')}
								<label for="user_vk" class="custom-input with-title with-button mb-0">
									<button type="button" onclick="edit_user_vk();">
										<i class="far fa-pencil"></i>
									</button>
									<input id="user_vk" maxlength="30" autocomplete="off" value="{vk}" type="text" placeholder=" ">
									<span>ID в Вконтакте</span>
									<small id="edit_user_vk_result"></small>
								</label>
								{else}
									{if($user->vk_api == '0')}
									<p>Если Ваш профиль будет прикреплен к аккаунту VK, то Вы сможете авторизовываться на сайте в один клик по кнопке "Войти через VK".</p>
									<a class="btn btn-sm" id="vk_link" href="">Прикрепить профиль к VK</a><br>
									<script>attach_user_vk();</script>
									{else}
									<div class="noty-block info">
										<a target="_blank" href="https://vk.com/{vk}" id="vk_user">
											<img src="../files/avatars/no_avatar.jpg" alt="">
											<span>Загрузка...</span>
										</a>
										<script>get_vk_profile_info('{vk_api}', '#vk_user img', '#vk_user span', '{vk}');</script>
									</div>
									<small class="input-title mt-1" id="unset_vk_result"></small>
									<button class="btn btn-sm mt-2 mb-0" type="button" onclick="unset_vk();">Открепить профиль</button>
									{/if}
									{conf_mess}
								{/if}
							</div>

							{if($auth_api->steam_api != '2')}
							<h2>Steam</h2>
							<div class="block" id="steam_area">
								{if('{steam_api}' == '0')}
								<p>Если Ваш профиль будет прикреплен к аккаунту Steam, то Вы сможете авторизовываться на сайте в один клик по кнопке "Войти через Steam".</p>
								<a class="btn btn-sm mb-0" id="steam_link" href="">Прикрепить профиль к Steam</a><br>
								<script>attach_user_steam();</script>
								{else}
								<div class="noty-block info">
									<a target="_blank" href="https://steamcommunity.com/profiles/{steam_api}/" id="steam_user">
										<img src="../files/avatars/no_avatar.jpg" alt="">
										<span>Загрузка...</span>
									</a>
									<script>get_user_steam_info('{steam_api}');</script>
								</div>
								<small class="input-title mt-1" id="unset_steam_result"></small>
								<button class="btn btn-sm mt-2 mb-0" type="button" onclick="unset_steam();">Открепить профиль</button>
								{/if}
								{conf_mess2}
							</div>
							{/if}

							<h2>Facebook</h2>
							<div class="block" id="fb_area">
								<label for="user_fb" class="custom-input with-title with-button">
									<button type="button" onclick="edit_user_fb();">
										<i class="far fa-pencil"></i>
									</button>
									<input id="user_fb" maxlength="20" autocomplete="off" value="{fb}" type="text" placeholder=" ">
									<span>ID в Facebook</span>
									<small id="edit_user_fb_result"></small>
								</label>

								{if($auth_api->fb_api == '1')}
									{if($user->fb_api == '0')}
									<p>Если Ваш профиль будет прикреплен к аккаунту Facebook, то Вы сможете авторизовываться на сайте в один клик по кнопке "Войти через Facebook".</p>
									<a class="btn btn-sm mb-0" id="fb_link" href="">Прикрепить профиль к Facebook</a><br>
									<script>attach_user_fb();</script>
									{else}
									<div class="noty-block info">
										<a target="_blank" href="#" id="fb_user">
											<img src="../files/avatars/no_avatar.jpg" alt="">
											<span>Загрузка...</span>
										</a>
										<script> get_fb_profile_info('{fb_api}', '{fb}', '#fb_user', '#fb_user img', '#fb_user span'); </script>
									</div>
									<small class="input-title mt-1" id="unset_fb_result"></small>
									<button class="btn btn-sm mt-2 mb-0" type="button" onclick="unset_fb();">Открепить профиль</button>
									{/if}
									{conf_mess3}
								{/if}
							</div>
						</div>
					</div>
				</div>
				<div class="tab-pane fade" id="privacy">
					<h2>Приватность</h2>

					<div class="block edit-privacy">
						<p>Кто может писать мне личные сообщения?</p>
						<div class="custom-control custom-radio custom-control-inline" onclick="on_im(1);">
							<input type="radio" class="custom-control-input" id="im_radio_1" name="im_radio" {if('{im_radio_1}' == 'active')} checked {/if}>
							<label class="custom-control-label" for="im_radio_1">Все пользователи</label>
						</div>
						<div class="custom-control custom-radio custom-control-inline" onclick="on_im(2);">
							<input type="radio" class="custom-control-input" id="im_radio_2" name="im_radio" {if('{im_radio_2}' == 'active')} checked {/if}>
							<label class="custom-control-label" for="im_radio_2">Только друзья</label>
						</div>

						<p class="mt-3">Дублировать ли уведомления на почту?</p>
						<div class="custom-control custom-radio custom-control-inline" onclick="on_email_notice(1);">
							<input type="radio" class="custom-control-input" id="notice_radio_1" name="notice_radio" {if('{notice_radio_1}' == 'active')} checked {/if}>
							<label class="custom-control-label" for="notice_radio_1">Дублировать</label>
						</div>
						<div class="custom-control custom-radio custom-control-inline" onclick="on_email_notice(2);">
							<input type="radio" class="custom-control-input" id="notice_radio_2" name="notice_radio" {if('{notice_radio_2}' == 'active')} checked {/if}>
							<label class="custom-control-label" for="notice_radio_2">Уведомлять только на сайте</label>
						</div>

						<p class="mt-3">Привязать cookies к IP адресу?</p>
						<div class="custom-control custom-radio custom-control-inline" onclick="on_ip_protect(1);">
							<input type="radio" class="custom-control-input" id="protect_radio_1" name="protect_radio" {if('{protect_radio_1}' == 'active')} checked {/if}>
							<label class="custom-control-label" for="protect_radio_1">Включено</label>
						</div>
						<div class="custom-control custom-radio custom-control-inline mb-0" onclick="on_ip_protect(2);">
							<input type="radio" class="custom-control-input" id="protect_radio_2" name="protect_radio" {if('{protect_radio_2}' == 'active')} checked {/if}>
							<label class="custom-control-label" for="protect_radio_2">Выключено</label>
						</div>
					</div>
				</div>
				<div class="tab-pane fade" id="referral_program">
					{if('{referral_program}' == '1')}
					<div class="noty-block info">
						<h2>
							Пригласи друга
						</h2>
						Пользователи, зарегистрированные на сайте по вашей ссылке, будут приносить Вам пассивный доход. При пополнении баланса Вашим другом, Вы будете получать целых <b>{referral_percent}%</b> от суммы его пополнения.
					</div>

					<div class="row">
						<div class="col-lg-6">
							<h2>Ссылка для приглашений</h2>

							<div class="block">
								<label for="user_fb" class="custom-input with-title mb-0">
									<input id="user_fb" maxlength="50" type="text" placeholder=" " disabled>
									<span>{referral_link}</span>
								</label>
							</div>
						</div>
						<div class="col-lg-3">
							<h2>Приглашенные</h2>

							<button class="btn btn-primary w-100" data-target="#referrals" data-toggle="modal" onclick="get_referrals();">Посмотреть</button>
						</div>
						<div class="col-lg-3">
							<h2>Моя прибыль</h2>

							<button class="btn btn-primary w-100" data-target="#profit" data-toggle="modal" onclick="get_ref_profit();">Посмотреть</button>
						</div>
					</div>

					<script>$('#referrals').modal('hide');</script>
					<div id="referrals" class="modal fade">
						<div class="modal-dialog modal-lg">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">×</span>
									</button>
									<h4 class="modal-title">Список приглашенных друзей</h4>
								</div>
								<div class="modal-body">
									<div class="table-responsive mb-0">
										<table class="table table-bordered">
											<thead>
											<tr>
												<td>#</td>
												<td>Приглашенный друг</td>
												<td>Дата регистрации</td>
												<td>Прибыль</td>
											</tr>
											</thead>
											<tbody id="referrals_body">
											<tr>
												<td colspan="10">
													<div class="loader"></div>
												</td>
											</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
					<script>$('#profit').modal('hide');</script>
					<div id="profit" class="modal fade">
						<div class="modal-dialog modal-lg">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">×</span>
									</button>
									<h4 class="modal-title">Моя рибыль</h4>
								</div>
								<div class="modal-body">
									<div class="table-responsive mb-0">
										<table class="table table-bordered">
											<thead>
											<tr>
												<td>#</td>
												<td>Приглашенный друг</td>
												<td>Полученная сумма</td>
												<td>Дата зачисления</td>
											</tr>
											</thead>
											<tbody id="profit_body">
											<tr>
												<td colspan="10">
													<div class="loader"></div>
												</td>
											</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
					{/if}
				</div>
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
					url: "ajax/actions_a.php",
					data: data,
					contentType: false,
					processData: false,
				}).done(function (html) {
					$("#edit_user_avatar_result").empty();
					$("#edit_user_avatar_result").append(html);
					$('#edit_user_avatar_form')[0].reset();
				});
				NProgress.done();
			});
		</script>

		<script>
			var anchor = window.location.hash.substr(1);

			if(anchor != "account" && anchor != "contacts" && anchor != "privacy" && anchor != "referral_program") {
				anchor = "account";
			}

			$("a[href='#"+anchor+"']").addClass("active");
			$("#"+anchor).addClass("active");
			$("#"+anchor).addClass("show");
		</script>