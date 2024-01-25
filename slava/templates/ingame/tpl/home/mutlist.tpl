{if(is_worthy_specifically("s", {server}) && '{empty}' != '1')}
	<script src="{site_host}templates/admin/js/timepicker/timepicker.js"></script>
	<script src="{site_host}templates/admin/js/timepicker/jquery-ui-timepicker-addon.js"></script>
	<script src="{site_host}templates/admin/js/timepicker/jquery-ui-timepicker-addon-i18n.min.js"></script>
	<script src="{site_host}templates/admin/js/timepicker/jquery-ui-sliderAccess.js"></script>
{/if}

<div class="col-lg-9 order-is-first">
	<h2 class="mb-3">
		Мутлист
	</h2>

	{if('{empty}' == '0')}
	<div class="block">
		{if('{error}' == '')}
		<div class="input-search mt mb">
			<i class="fas fa-search" onclick="search_mute({server})"></i>
			<label for="search_mute" class="custom-input with-title">
				<input id="search_mute" autocomplete="off" type="text" placeholder=" ">
				<span>Введите никнейм или SteamID</span>
			</label>
			<script> set_enter('#search_mute', 'search_mute({server})'); </script>
		</div>

		<div class="table-adaptive table-fused mt-4" id="muts">
			{func GetData:mutlist("{start}","{server}","{limit}")}
		</div>
		{else}
		<div class="empty-element">
			{error}
		</div>
		{/if}
	</div>

	<div id="pagination2">{pagination}</div>
	{else}
	<div class="empty-element">
		Сервера не привязаны к источникам информации.
	</div>
	{/if}
</div>

<div class="col-lg-3 order-is-last">
	{include file="/parts/mini-profile.tpl"}

	{if('{empty}' == '0')}
	<div class="block with-menu">
		<div class="block_head">
			Сервера
		</div>
		<ul class="vertical-navigation">
			{servers}
		</ul>
	</div>

	<div class="block block-table">
		<div class="block_head">
			Статистика
		</div>
		<div class="table-responsive mb-0">
			<table class="table table-bordered">
				<tr>
					<td style="width: 50%">Всего мутов</td>
					<td style="width: 50%">{count}</td>
				</tr>
				<tr>
					<td style="width: 50%">Активные</td>
					<td style="width: 50%">{count_active}</td>
				</tr>
				<tr>
					<td style="width: 50%">Перманентные</td>
					<td style="width: 50%">{count_permanent}</td>
				</tr>
				<tr>
					<td style="width: 50%">Временные</td>
					<td style="width: 50%">{count_temporal}</td>
				</tr>
			</table>
		</div>
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
  
	{***{include file="/parts/sidebar.tpl"}***}
</div>