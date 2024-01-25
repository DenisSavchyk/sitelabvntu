<div class="col-lg-9 order-is-first">
	<h2 class="mb-3 float-left">
		Заявки на разбан
	</h2>
	<a href="../bans/add_ban" class="btn btn-light btn-sm float-right">
		<i class="far fa-plus"></i> Добавить заявку
	</a>

	<div class="clearfix"></div>

	<div class="block">
		<div class="table-adaptive table-fused mt" id="bans">
			{func GetData:bans_applications("{start}","{server}","{limit}")}
		</div>
	</div>

	<div id="pagination2">{pagination}</div>
</div>

<div class="col-lg-3 order-is-last">
	{include file="/parts/mini-profile.tpl"}

	<div class="block with-menu">
		<div class="block_head">
			Сервера
		</div>
		<ul class="vertical-navigation">
			{servers}
		</ul>
	</div>

  {if("{{$steam_group_link}}" != "")}
	<a target="_blank" class="our-steam-group" href="https://steamcommunity.com/groups/in-g">
		<span>Мы в Steam</span>
		<i class="fab fa-steam-symbol"></i>
	</a>
	<a target="_blank" class="our-steam-group" href="https://vk.com/rus_ingame">
		<span>Мы ВКонтакте</span>
		<i class="fab fa-vk"></i>
	</a>
{/if}
  
	{***{include file="/parts/sidebar.tpl"}***}
</div>