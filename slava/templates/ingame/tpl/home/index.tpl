<div class="col-lg-9 order-is-first">
	<div class="block with-button disp-n" id="notifications_line">
		<div class="block_head mb-3">
			Уведомления
			<button onclick="hide_notifications();" class="btn btn-light btn-block-head btn-sm">Скрыть все</button>
		</div> 
		<div id="notifications">
			{notifications}
		</div>
	</div>

	{include file="/parts/slider.tpl"}
	{**{include file="/elements/chat.tpl"}**}

	{if($conf->show_news != '0')}
	<h2 class="mb-3 float-left">
		Новости
	</h2>
	<a class="btn btn-light btn-sm float-right" href="../news/">
		<i class="far fa-bookmark"></i>
		К новостям
	</a>
	<div class="clearfix"></div>
	<div id="new_news" class="row">
		{func Widgets:last_news($conf->show_news)}
	</div>
	{/if}

	{if($conf->show_events != '0')}
	<div class="block">
		<div class="block_head">
			Последние события проекта
		</div> 
		<div id="events">
			{func EventsRibbon:get_events(0, 0, $conf->show_events)}
		</div>
	</div>
	{/if}

	{include file="/parts/site_stats.tpl"}
</div>

<div class="col-lg-3 order-is-last">
	{include file="/parts/mini-profile.tpl"}
	{include file="/parts/sidebar.tpl"}
	{include file="/elements/vk_widgets.tpl"}
</div>