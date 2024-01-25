{if($conf->vk_admin == 1 or $conf->vk_group == 1)}
	<div class="vk-widgets">
		{if($conf->vk_admin == 1)}
		<div class="block">
			<div class="block_head">
				{if(count($vk_admins) > 1)}Администраторы{else}Администраторы{/if}
			</div>
			<div id="top_users">
				{for($i=0; $i < count($vk_admins); $i++)}
					{if($conf->widgets_type == 1)}
					<a title="Перейти в профиль Вконтакте" target="_blank" href="https://vk.com/id{{$vk_admins[$i]}}" id="admin_widget{{$i}}">
						<img src="../files/avatars/no_avatar.jpg" alt="Админ">
						<div>
							<span style="float: left;">Загрузка...</span><br>
							<p>
								{if($i == 0)}
								Основатель проекта
								{/if}
								{if($i == 1)}
								Главный Администратор
								{/if}
								{if($i == 2)}
								Админ сервера AWP
								{/if}
								{if($i == 3)}
								Админ сервера Public
								{/if}
								{if($i == 4)}
								Админ сервера AWP
								{/if}
								{if($i == 5)}
								Админ сервера Public
								{/if}
							</p>
						</div>
					</a>
					<script>get_vk_profile_info('{{$vk_admins[$i]}}', '#admin_widget{{$i}} img', '#admin_widget{{$i}} span', '{{$vk_admins[$i]}}');</script>
					{else}
					<a title="Профиль в Facebook" target="_blank" id="admin_widget{{$i}}">
						<img src="../files/avatars/no_avatar.jpg" alt="">
						<span>Загрузка...</span>
					</a>
					<script> get_fb_profile_info('{{$vk_admins[$i]}}', '{{$vk_admins[$i]}}', '#admin_widget{{$i}}', '#admin_widget{{$i}} img', '#admin_widget{{$i}} span'); </script>
					{/if}
				{/for}
			</div>
		</div>
		{/if}

		{if($conf->vk_group == 1)}
			{if($conf->widgets_type == 1)}
				<script type="text/javascript" src="//vk.com/js/api/openapi.js?120"></script>
				{for($i=0; $i < count($vk_groups); $i++)}
					<div id="vk_groups{{$i}}" class="d-none d-lg-block"></div>
					<script> VK.Widgets.Group("vk_groups{{$i}}", {mode: 3, width: "auto", height: "400", color1: "#182C4F", color2: "#FFFFFF", color3: "#0C66FF"}, {{$vk_groups[$i]}}); </script>
				{/for}
			{else}
				<div id="fb-root"></div>
				<script>(function(d, s, id) {
					var js, fjs = d.getElementsByTagName(s)[0];
					if (d.getElementById(id)) return;
					js = d.createElement(s); js.id = id;
					js.src = 'https://connect.facebook.net/ru_RU/sdk.js#xfbml=1&version=v3.0&appId=2144044429185543&autoLogAppEvents=1';
					fjs.parentNode.insertBefore(js, fjs);
					}(document, 'script', 'facebook-jssdk'));
				</script>
				{for($i=0; $i < count($vk_groups); $i++)}
					<div class="block d-none d-lg-block p-0">
						<div class="fb-page" data-href="https://www.facebook.com/{{$vk_groups[$i]}}/" data-tabs="timeline" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="false">
							<blockquote cite="https://www.facebook.com/{{$vk_groups[$i]}}/" class="fb-xfbml-parse-ignore">
								<a href="https://www.facebook.com/{{$vk_groups[$i]}}/"><div class="loader"></div></a>
							</blockquote>
						</div>
					</div>
				{/for}
			{/if}
		{/if}
	</div>
{/if}

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