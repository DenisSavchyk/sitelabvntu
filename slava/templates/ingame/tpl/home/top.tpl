<div class="container-fluid wapper">
	<div class="content">
		<div class="header">
			<div class="container">
				<button class="menu-trigger btn btn-sm btn-light d-block d-lg-none collapsed" type="button" data-toggle="collapse" data-target="#hidden-menu"></button>

				<a class="logo" href="../">
					<h1>
						{{$logo_name}}
					</h1>
				</a>

				{include file="/parts/navigation.tpl"}

				<ul class="collapsible-menu user-menu">
					<li class="balance">
						<span id="balance">{balance}</span>
						<i class="far fa-ruble-sign"></i>
						<a href="../purse" class="btn btn-primary">
							<i class="fas fa-plus"></i>
						</a>
					</li>
					<li>
						<a href="../notifications" class="btn btn-light">
							<i class="far fa-bell"></i>
						</a>
					</li>
					<li>
						<a href="../messages" class="btn btn-light">
							<i class="far fa-envelope"></i>
						</a>
					</li>
					<li class="collapsible">
						<a href="">
							<img src="../{avatar}" alt="{login}">
							<i class="fas fa-angle-down"></i>
							<script>check_news();</script>
							<div id="check_mess"></div>

							{if('{tickets}' > '0' || '{bans}' > '0')}
							<i class="point"></i>
							{/if}
						</a>
						<ul>
							<li>
								<a href="../profile?id={user_id}">Мой профиль</a>
							</li>
							<li>
								<a href="../messages">Сообщения</a>
							</li>
							<li>
								<a href="../friends">Друзья</a>
							</li>
							<li>
								<a href="../settings">Настройки</a>
							</li>
							<li>
								<a href="../purse">Баланс: руб.</a>
							</li>
							<li>
								<a href="../notifications">Уведомления</a>
							</li>
							<li>
								<a href="../my_stores">Услуги</a>
							</li>
							{if('{tickets}' > '0')}
							<li>
								<a href="../support/all_tickets">Открытые тикеты: +{tickets}</a>
							</li>
							{/if}
							{if('{bans}' > '0')}
							<li>
								<a href="../bans/index">Заявки на разбан: +{bans}</a>
							</li>
							{/if}
							{if(is_admin_id())}
							<li>
								<a href="../admin" target="_blank">Админ центр</a>
							</li>
							{/if}
							<li>
								<a href="../exit">Выход</a>
							</li>
						</ul>
					</li>
				</ul>
			</div>
		</div>
		<div class="header-menu collapse d-none d-lg-block" id="hidden-menu">
			<div class="container">
				<ul class="collapsible-menu">
					{menu}
				</ul>
			</div>
		</div>

		<div class="monitoring">
			<div class="container">
				<div class="info-line">
					<span>Наши сервера</span>
				</div>
				<div class="monitoring-line owl-carousel" id="servers"></div>
				<script>get_servers2();</script>
			</div>
		</div>

		<div class="container">
			<div class="row">