<div class="col-lg-9 order-is-first">
	<div class="noty-block info mb-3">
		<p>
			Мы будем благодарны, если Вы проверите <a target="_blank" href="../pages/baza_znaniy"><b>Базу Знаний</b></a> перед обращением к нам. Вы можете найти ответ на Ваш вопрос в базе. Если же этого не случилось, то создайте тикет.
		</p>
	</div>

	<h2 class="mb-3 float-left">
		Тикеты
	</h2>

	<a href="../support/add_ticket" class="btn btn-light btn-sm float-right">
		Создать тикет
	</a>
	{if(is_worthy("p"))}
	<a href="../support/all_tickets" class="btn btn-light btn-sm float-right mr-2">
		Тикеты
	</a>
	{/if}

	<div class="clearfix"></div>

	<div class="block">
		<div class="table-adaptive table-fused mt" id="tickets">
			<div class="loader"></div>
			<script>load_tickets('{id}');</script>
		</div>
	</div>
</div>

<div class="col-lg-3 order-is-last">
	{include file="/parts/mini-profile.tpl"}
	{include file="/parts/sidebar.tpl"}
</div>