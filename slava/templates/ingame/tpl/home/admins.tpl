<div class="col-lg-9 order-is-first">
	<h2 class="mb-3 float-left">
		Действующие Админы
	</h2>
	{if(is_worthy("j"))}
	<a class="btn btn-light btn-sm float-right" href="../edit_admins">
		<i class="far fa-pencil"></i>
		Управление
	</a>
	{/if}

	<div class="clearfix"></div>

	{func GetData:servers_admins({server})}
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