<div class="col-lg-9 order-is-first">
	<h2 class="mb-3 float-left">
		Новости
	</h2>
	{if(is_worthy("b"))}
	<a class="btn btn-light btn-sm float-right" href="../news/add_new">
		<i class="far fa-plus"></i>
		Добавить новость
	</a>
	{/if}

	<div class="clearfix"></div>

	<div id="new_news" class="row">
		{func GetData:news("{start}","{class}","{limit}")}
	</div>
	
	<div id="pagination2">{pagination}</div>
</div>

<div class="col-lg-3 order-is-last">
	{include file="/parts/mini-profile.tpl"}
	{include file="/parts/sidebar.tpl"}
	{include file="/elements/vk_widgets.tpl"}
</div>