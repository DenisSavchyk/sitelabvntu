<div class="col-lg-9 order-is-first">
	{***{include file="/parts/slider.tpl"}
	{include file="/elements/chat.tpl"}***}

	<h2 class="mb-3 float-left">
		Форум
	</h2>
	{if(is_worthy("t"))}
	<a class="btn btn-light btn-sm float-right" href="../forum/edit_forum">
		<i class="far fa-cog"></i>
		Настройка
	</a>
	{/if}
	<div class="clearfix"></div>
	<div id="forum">
      
		{func Forum:get_forums()}
	</div>

	{include file="/parts/site_stats.tpl"}
</div>
<div class="col-lg-3 order-is-last">
	{include file="/parts/mini-profile.tpl"}
	{include file="/parts/sidebar.tpl"}
	{include file="/elements/vk_widgets.tpl"}
</div>