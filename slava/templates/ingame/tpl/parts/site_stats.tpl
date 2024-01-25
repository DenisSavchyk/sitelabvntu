<div class="block site-stats">
	<div id="site_stats">
		<script>get_site_stats(1);</script>
	</div>

	<strong>
		Сейчас на сайте
		<span id="users_online_number"></span>
	</strong>
	<div id="online_users">
		{func Widgets:online_users()}
	</div>

	<strong>
		Сегодня нас посетили
		<span id="count_of_last_onl_us"></span>
	</strong>
	<div id="load_last_online">
		{func Widgets:were_online()}
	</div>
</div>