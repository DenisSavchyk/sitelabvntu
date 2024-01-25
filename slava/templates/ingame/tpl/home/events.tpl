<div class="col-lg-9 order-is-first">
	<div class="block">
		<div class="block_head">
			События проекта
		</div>
		<div id="events">
			{func EventsRibbon:get_events("{start}","{class}","{limit}")}
		</div>
	</div>

	<div id="pagination2">{pagination}</div>
</div>

<div class="col-lg-3 order-is-last">
	{include file="/parts/mini-profile.tpl"}

	<div class="block with-menu">
		<div class="block_head">
			Категории
		</div>
		<ul class="vertical-navigation">
			{categories}
		</ul>
	</div>

	{include file="/parts/sidebar.tpl"}
</div>