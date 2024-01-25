<script>
	$(".monitoring").remove();
	$("#hidden-menu").addClass("with-border");
</script>
</div>
</div>

<div class="container">
	<div class="row mt-5">
		{if('{dell}' != '1')}
		<div class="col-lg-3">
			<div class="detailed-profile mb-5">
				<div>
					<a class="avatar" href="../profile?id={profile_id}">
						<img src="../{avatar}" alt="{login}">
					</a>
					<div>
						<span>{login}</span>
						<span style="color: {group_color}">{group}</span>
					</div>
					{if(is_auth() && '{profile_id}' == $_SESSION['id'])}
					<a href="../settings" tooltip="yes" title="Настройки профиля">
						<i class="far fa-cog"></i>
					</a>
					{/if}
				</div>

				<div class="money-info-block">
					<div>
						<i class="far fa-wallet"></i>
						<p>Баланс</p>
						<span id="money"></span>
					</div>
					<div>
						<i class="far fa-percent"></i>
						<p>Скидка</p>
						<span id="proc"></span>
					</div>
				</div>

				<table>
					<tr>
						<td>
							<i class="far fa-comment-alt"></i>
						</td>
						<td>
							<span>{answers}</span>
							<p>Постов на форуме</p>
						</td>
					</tr>
					<tr>
						<td>
							<i class="far fa-heart"></i>
						</td>
						<td>
							<span>{thanks}</span>
							<p>Лайков</p>
						</td>
					</tr>
					<tr>
						<td>
							<i class="far fa-star"></i>
						</td>
						<td>
							<span>{reit}</span>
							<p>Рейтинг</p>
						</td>
					</tr>
					<tr>
						<td>
							<i class="far fa-calendar"></i>
						</td>
						<td>
							<span>{last_activity}</span>
							<p>Последний вход</p>
						</td>
					</tr>
				</table>

				<ul>
					{menu}
				</ul>
				{if(is_auth() && '{profile_id}' == $_SESSION['id'])}
				<a href="../exit" class="go-exit">
					<i class="far fa-sign-out"></i> Выход
				</a>
				{/if}
				<script>
					var user_balance = $(".detailed-profile ul > li span#money").text();
					var user_percent = $(".detailed-profile ul > li span#proc").text();
					if (user_balance != '' && user_percent != '') {
						$(".money-info-block #money").html(user_balance + "Р");
						$(".money-info-block #proc").html(user_percent + "%");
					} else {
						$(".money-info-block").remove();
					}

					$(".detailed-profile ul > li").has(".icon-user").remove();
					$(".detailed-profile ul > li").has(".icon-bank").remove();
					$(".detailed-profile ul > li").has(".icon-marker").remove();
				</script>
			</div>
		</div>

		<div class="col-lg-9 profile-page">
			<ul class="profile-top-menu nav mb-4">
				{if(is_auth() && '{profile_id}' == $_SESSION['id'])}
				<li>
					<a class="active" href="../profile?id={{$user->id}}">Профиль</a>
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
					<a href="../notifications">Уведомления</a>
				</li>
				{else}
				<li>
					<a class="active" data-toggle="tab" href="#information">Профиль</a>
				</li>
				<li>
					<a data-toggle="tab" href="#friends">Друзья</a>
				</li>
				<li>
					<a data-toggle="tab" href="#admins">Привилегии</a>
				</li>
				{/if}
			</ul>

			<div class="tab-content">
				<div class="tab-pane show active" id="information">
					<div class="row">
						<div class="col-lg-7">
							<h2>Общая информация</h2>

							<div class="block">
								<table class="profile-table">
									<tr>
										<td>
											<i>ID</i>
										</td>
										<td>
											<p>{profile_id}</p>
											<span>Номер профиля</span>
										</td>
									</tr>
									<tr>
										<td>
											<i>И</i>
										</td>
										<td>
											<p>{name}</p>
											<span>Имя</span>
										</td>
									</tr>
									<tr>
										<td>
											<i>Н</i>
										</td>
										<td>
											<p>{nick}</p>
											<span>Ник</span>
										</td>
									</tr>
									<tr>
										<td>
											<i class="far fa-calendar-check"></i>
										</td>
										<td>
											<p>{birth}</p>
											<span>Дата рождения</span>
										</td>
									</tr>
									<tr>
										<td>
											<i class="far fa-calendar-day"></i>
										</td>
										<td>
											<p>{regdate}</p>
											<span>Дата регистрации</span>
										</td>
									</tr>
									<tr>
										<td>
											<i class="far fa-comments"></i>
										</td>
										<td>
											<p>
												{if('{topic_id}' == '0')}Пользователь не просматривал
												форум{else}<a title="Перейти в тему" href="forum/topic?id={topic_id}">{topic_name}</a>{/if}
											</p>
											<span>Последняя тема</span>
										</td>
									</tr>
								</table>
							</div>

							<h2>Сообщения на форуме</h2>
							<div class="block">
								<div id="last_activity">
									{func Widgets:user_forum_activity('{profile_id}', '3')}
								</div>
							</div>
						</div>
						<div class="col-lg-5">
							{if(('{skype}' != '' && '{skype}' != '---') || '{telegram}' != '' || '{vk}' != '---' || '{steam_api}' != '0' || '{fb}' != '0')}
							<h2>Контакты</h2>
							<div class="block">
								<table class="profile-table">
									{if('{skype}' != '' && '{skype}' != '---')}
									<tr>
										<td>
											<i class="fab fa-skype"></i>
										</td>
										<td>
											<p>
												<a title="Добавить в скайп" href="skype:{skype}?add">{skype}</a>
											</p>
											<span>Скайп</span>
										</td>
									</tr>
									{/if}
									{if('{telegram}' != '')}
									<tr>
										<td>
											<i class="fab fa-telegram-plane"></i>
										</td>
										<td>
											<p>
												<a title="Написать в телеграм" target="_blank" href="https://telegram.me/{telegram}">@{telegram}</a>
											</p>
											<span>Телеграм</span>
										</td>
									</tr>
									{/if}
									{if('{vk}' != '---')}
									<tr>
										<td>
											<i class="fab fa-vk"></i>
										</td>
										<td>
											<p>
												<a title="Перейти в профиль Вконтакте" target="_blank" href="https://vk.com/{vk}" id="vk_user">
													<img src="../files/avatars/no_avatar.jpg" alt="">
													<span>Загрузка...</span>
												</a>
											</p>
											<span>Вконтакте</span>
											<script>get_vk_profile_info('{vk_api}', '#vk_user img', '#vk_user span', '{vk}');</script>
										</td>
									</tr>
									{/if}
									{if('{steam_api}' != '0')}
									<tr>
										<td>
											<i class="fab fa-steam-symbol"></i>
										</td>
										<td>
											<p>
												<a title="Перейти в профиль Steam" target="_blank" href="https://steamcommunity.com/profiles/{steam_api}/" id="steam_user">
													<img src="../files/avatars/no_avatar.jpg" alt="">
													<span>Загрузка...</span>
												</a>
											</p>
											<span>Steam</span>
											<script>get_user_steam_info('{steam_api}');</script>
										</td>
									</tr>
									{/if}
									{if('{fb}' != '0')}
									<tr>
										<td>
											<i class="fab fa-facebook-f"></i>
										</td>
										<td>
											<p>
												<a title="Профиль в Facebook" target="_blank" id="fb_user">
													<img src="../files/avatars/no_avatar.jpg" alt="">
													<span>Загрузка...</span>
												</a>
											</p>
											<span>Facebook</span>
											<script> get_fb_profile_info('{fb_api}', '{fb}', '#fb_user', '#fb_user img', '#fb_user span'); </script>
										</td>
									</tr>
									{/if}
								</table>
							</div>
							{/if}

							<h2>Заявки на разбан</h2>
							<div class="block">
								<div id="mybans">
									{func Widgets:user_bans('{profile_id}', '100')}
								</div>
							</div>
							<button class="btn btn-light btn-sm" onclick="$('#mybans > div').each(function(){$(this).fadeIn();});$('#show_all_bans').fadeOut();" id="show_all_bans">Отобразить все</button>
						</div>
					</div>
				</div>
				<div class="tab-pane" id="friends">
					<div class="row">
						{friends}
					</div>
				</div>
				<div class="tab-pane" id="admins">
					<div class="table-adaptive">
						{func Widgets:user_admins('{profile_id}')}
					</div>
				</div>
			</div>
		</div>
		{else}
		<h2>Пользователь удален</h2>
		{/if}