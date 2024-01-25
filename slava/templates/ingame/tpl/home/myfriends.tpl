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
					<a class="active" data-toggle="tab" href="#friends-tab" onclick="load_friends('{id}')">
						<i class="fas fa-users"></i> Друзья
					</a>
				</li>
				<li>
					<a data-toggle="tab" href="#unfriends-tab" onclick="load_friend_requests('un')">
						<i class="fas fa-user-plus"></i> Исходящие заявки
					</a>
				</li>
				<li>
					<a data-toggle="tab" href="#infriends-tab" onclick="load_friend_requests('in')">
						<i class="fas fa-user-check"></i>
						Входящие заявки
						<span id="col_infriends"></span>
					</a>
				</li>
			</ul>
		</div>

		<div class="col-lg-9 profile-page">
			<ul class="profile-top-menu mb-4">
				<li>
					<a href="../profile?id={{$user->id}}">Профиль</a>
				</li>
				<li>
					<a class="active" href="../friends">Друзья</a>
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
			</ul>

			<div class="tab-content">
				<div class="tab-pane fade show active" id="friends-tab">
					<div class="row" id="friends">
						<div class="loader"></div>
					</div>
				</div>
				<div class="tab-pane fade" id="unfriends-tab">
					<div class="row" id="unfriends">
						<div class="loader"></div>
					</div>
				</div>
				<div class="tab-pane fade" id="infriends-tab">
					<div class="row" id="infriends">
						<div class="loader"></div>
					</div>
				</div>
			</div>

			<script>
				load_friends("{id}");
				load_col_infriends();
			</script>
		</div>
