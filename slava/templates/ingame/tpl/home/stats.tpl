<div class="col-lg-9 order-is-first">
	<h2 class="mb-3">
		Статистика
	</h2>

	{if('{empty}' == '0')}
	<div class="block">
		{if('{error}' == '')}
			<div class="input-search mt mb">
				<i class="fas fa-search" onclick="search_stats({server})"></i>
				<label for="search_stats" class="custom-input with-title">
					<input id="search_stats" autocomplete="off" type="text" placeholder=" ">
					<span>Введите никнейм, SteamID или IP</span>
				</label>
				<script> set_enter('#search_stats', 'search_stats({server})'); </script>
			</div>

			<div class="table-adaptive table-fused mt-4" id="stats">
				{func GetData:stats("{start}","{server}","{limit}")}
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