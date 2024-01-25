<div class="col-lg-9 order-is-first">
	<div id="main-slider" class="carousel slide" data-ride="carousel">
	<div class="carousel-inner">
		<?php for($i=0; $i < count($slider); $i++): ?>
		<div class="carousel-item <?php if($i==0): ?>active<?php endif; ?>">
			<img class="d-block w-100" src="<?php echo $slider[$i]['image']; ?>" alt="<?php echo $slider[$i]['title']; ?>">
			<div class="carousel-caption">
				<h1>
					<?php if(!empty($slider[$i]['link'])): ?><a href="<?php echo $slider[$i]['link']; ?>" target="_blank"><?php endif; ?>
						<?php echo $slider[$i]['title']; ?>
						<?php if(!empty($slider[$i]['link'])): ?></a><?php endif; ?>
				</h1>
				<?php if(!empty($slider[$i]['link'])): ?>
				<a href="<?php echo $slider[$i]['link']; ?>" class="px-4 btn btn-lg btn-dark" target="_blank">
					Подробнее &nbsp
					<i class="fas fa-arrow-right" style="font-size: 90%"></i>
				</a>
				<?php endif; ?>
			</div>
			<div class="he"></div>
		</div>
		<?php endfor; ?>
	</div>
	<a class="carousel-control-prev" href="#main-slider" role="button" data-slide="prev">
		<i class="fas fa-arrow-left"></i>
	</a>
	<a class="carousel-control-next" href="#main-slider" role="button" data-slide="next">
		<i class="fas fa-arrow-right"></i>
	</a>
</div>
	

	<?php if($conf->show_news != '0'): ?>
	<h2 class="mb-3 float-left">
		Новости
	</h2>
	<a class="btn btn-light btn-sm float-right" href="../news/">
		<i class="far fa-bookmark"></i>
		К новостям
	</a>
	<div class="clearfix"></div>
	<div id="new_news" class="row">
		<?php if (class_exists("Widgets")) { $CE = new Widgets($pdo, $tpl); if(method_exists($CE, "last_news")) { $tpl->show($CE->last_news($conf->show_news)); } unset($CE); } ?>
	</div>
	<?php endif; ?>

	<div class="block site-stats">
	<div id="site_stats">
		<script>get_site_stats(1);</script>
	</div>

	<strong>
		Сейчас на сайте
		<span id="users_online_number"></span>
	</strong>
	<div id="online_users">
		<?php if (class_exists("Widgets")) { $CE = new Widgets($pdo, $tpl); if(method_exists($CE, "online_users")) { $tpl->show($CE->online_users()); } unset($CE); } ?>
	</div>

	<strong>
		Сегодня нас посетили
		<span id="count_of_last_onl_us"></span>
	</strong>
	<div id="load_last_online">
		<?php if (class_exists("Widgets")) { $CE = new Widgets($pdo, $tpl); if(method_exists($CE, "were_online")) { $tpl->show($CE->were_online()); } unset($CE); } ?>
	</div>
</div>
</div>
<div class="disp-n" id="auth-result">{conf_mess}</div>
<script>
    var conf_mess = $("#auth-result > p").text();

    if(conf_mess != '') {
        var conf_mess_style = $("#auth-result > p").attr("class");

        if(conf_mess_style.indexOf("danger") > 0) {
            conf_mess_style = 'error';
        } else {
            conf_mess_style = 'success';
        }

        show_noty('Down', 'error', conf_mess, 10000);
    }
</script>
<div class="col-lg-3 order-is-last">
	<?php if(is_auth()): ?>
<div class="block mini-profile">
	<div class="block_head">
		<a href="../profile?id=<?php echo $user->id; ?>">
			<img src="../<?php echo $user->avatar; ?>" alt="<?php echo $user->login; ?>">
		</a>
		<div>
			<p>Привет, <b><?php echo $user->login; ?></b></p>
			<p>
				<span style="color: <?php echo $users_groups[$user->rights]['color']; ?>">
					<?php echo $users_groups[$user->rights]['name']; ?>
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
							<?php echo $user->shilings; ?>
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
<?php else: ?>
<div class="block authorization">
	<form id="user_login">
		<input type="text" maxlength="30" class="form-control" id="user_loginn" placeholder="Логин">
		<input type="password" maxlength="15" class="form-control" id="user_password" placeholder="Пароль">

		<div class="row">
			<div class="col-6">
				<button type="submit" class="btn btn-primary btn-lg btn-block">Войти</button>
			</div>
			<div class="col-3">
				<?php if($auth_api->vk_api == 1): ?>
				<a class="btn btn-primary btn-lg btn-block" href="" id="vk_link" title="Войти через Вконтакте">
					<i class="fab fa-vk"></i>
				</a>
				<script>get_vk_auth_link();</script>
				<?php endif; ?>
			</div>
			<div class="col-3">
				<?php if($auth_api->steam_api == 1): ?>
				<a class="btn btn-primary btn-lg btn-block" href="" id="steam_link" title="Войти через Steam">
					<i class="fab fa-steam-symbol"></i>
				</a>
				<script>get_steam_auth_link();</script>
				<?php endif; ?>
			</div>
		</div>

		<div id="result" class="disp-n">{conf_mess}</div>
	</form>
	<script> send_form('#user_login', 'user_login();'); </script>

	<button class="btn btn-light btn-lg btn-block" data-toggle="modal" data-target="#registration">Создать профиль</button>
	<a href="../recovery" class="small">Забыли пароль?</a>
</div>
<?php endif; ?>
	<div id="case_banner">
	<!---<script>get_case_banner();</script>--->
</div>

<!--<div class="block" id="birthday_boys">
	<div class="block_head">
		Дни рождения
	</div>
	<div id="online_users">
		<?php if (class_exists("Widgets")) { $CE = new Widgets($pdo, $tpl); if(method_exists($CE, "birthday_boys")) { $tpl->show($CE->birthday_boys()); } unset($CE); } ?>
	</div>
</div>-->
<div class="block">
  <div class="block_head">
    Розыгрыш
  </div>
  <div id="sortition"> <script>get_sortition_lite();</script> </div>
</div>
<div class="block">
	<div class="block_head">
		Топ пользователей
	</div>
	<div id="top_users">
		<?php if (class_exists("Widgets")) { $CE = new Widgets($pdo, $tpl); if(method_exists($CE, "top_users")) { $tpl->show($CE->top_users('6')); } unset($CE); } ?>
	</div>
</div>

<div class="block">
	<div class="block_head">
		Последние темы
	</div>
	<div id="last_activity">
		<?php if (class_exists("Widgets")) { $CE = new Widgets($pdo, $tpl); if(method_exists($CE, "last_forum_activity")) { $tpl->show($CE->last_forum_activity('5')); } unset($CE); } ?>
	</div>
</div>
	<?php if($conf->vk_admin == 1 or $conf->vk_group == 1): ?>
	<div class="vk-widgets">
		<?php if($conf->vk_admin == 1): ?>
		<div class="block">
			<div class="block_head">
				<?php if(count($vk_admins) > 1): ?>Администраторы<?php else: ?>Администраторы<?php endif; ?>
			</div>
			<div id="top_users">
				<?php for($i=0; $i < count($vk_admins); $i++): ?>
					<?php if($conf->widgets_type == 1): ?>
					<a title="Перейти в профиль Вконтакте" target="_blank" href="https://vk.com/id<?php echo $vk_admins[$i]; ?>" id="admin_widget<?php echo $i; ?>">
						<img src="../files/avatars/no_avatar.jpg" alt="Админ">
						<div>
							<span style="float: left;">Загрузка...</span><br>
							<p>
								<?php if($i == 0): ?>
								Основатель проекта
								<?php endif; ?>
								<?php if($i == 1): ?>
								Главный Администратор
								<?php endif; ?>
								<?php if($i == 2): ?>
								Админ сервера AWP
								<?php endif; ?>
								<?php if($i == 3): ?>
								Админ сервера Public
								<?php endif; ?>
								<?php if($i == 4): ?>
								Админ сервера AWP
								<?php endif; ?>
								<?php if($i == 5): ?>
								Админ сервера Public
								<?php endif; ?>
							</p>
						</div>
					</a>
					<script>get_vk_profile_info('<?php echo $vk_admins[$i]; ?>', '#admin_widget<?php echo $i; ?> img', '#admin_widget<?php echo $i; ?> span', '<?php echo $vk_admins[$i]; ?>');</script>
					<?php else: ?>
					<a title="Профиль в Facebook" target="_blank" id="admin_widget<?php echo $i; ?>">
						<img src="../files/avatars/no_avatar.jpg" alt="">
						<span>Загрузка...</span>
					</a>
					<script> get_fb_profile_info('<?php echo $vk_admins[$i]; ?>', '<?php echo $vk_admins[$i]; ?>', '#admin_widget<?php echo $i; ?>', '#admin_widget<?php echo $i; ?> img', '#admin_widget<?php echo $i; ?> span'); </script>
					<?php endif; ?>
				<?php endfor; ?>
			</div>
		</div>
		<?php endif; ?>

		<?php if($conf->vk_group == 1): ?>
			<?php if($conf->widgets_type == 1): ?>
				<script type="text/javascript" src="//vk.com/js/api/openapi.js?120"></script>
				<?php for($i=0; $i < count($vk_groups); $i++): ?>
					<div id="vk_groups<?php echo $i; ?>" class="d-none d-lg-block"></div>
					<script> VK.Widgets.Group("vk_groups<?php echo $i; ?>", {mode: 3, width: "auto", height: "400", color1: "#182C4F", color2: "#FFFFFF", color3: "#0C66FF"}, <?php echo $vk_groups[$i]; ?>); </script>
				<?php endfor; ?>
			<?php else: ?>
				<div id="fb-root"></div>
				<script>(function(d, s, id) {
					var js, fjs = d.getElementsByTagName(s)[0];
					if (d.getElementById(id)) return;
					js = d.createElement(s); js.id = id;
					js.src = 'https://connect.facebook.net/ru_RU/sdk.js#xfbml=1&version=v3.0&appId=2144044429185543&autoLogAppEvents=1';
					fjs.parentNode.insertBefore(js, fjs);
					}(document, 'script', 'facebook-jssdk'));
				</script>
				<?php for($i=0; $i < count($vk_groups); $i++): ?>
					<div class="block d-none d-lg-block p-0">
						<div class="fb-page" data-href="https://www.facebook.com/<?php echo $vk_groups[$i]; ?>/" data-tabs="timeline" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="false">
							<blockquote cite="https://www.facebook.com/<?php echo $vk_groups[$i]; ?>/" class="fb-xfbml-parse-ignore">
								<a href="https://www.facebook.com/<?php echo $vk_groups[$i]; ?>/"><div class="loader"></div></a>
							</blockquote>
						</div>
					</div>
				<?php endfor; ?>
			<?php endif; ?>
		<?php endif; ?>
	</div>
<?php endif; ?>

<?php if("<?php echo $steam_group_link; ?>" != ""): ?>
		<a target="_blank" class="our-steam-group" href="/">
		<span>Магазин</span>
		<i class="fas fa-shopping-basket"></i>
	</a>
	<a target="_blank" class="our-steam-group" href="/">
		<span>Мы ВКонтакте</span>
		<i class="fab fa-vk"></i>
	</a>
<?php endif; ?>
</div>