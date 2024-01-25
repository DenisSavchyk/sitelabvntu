<script>
	$(".monitoring").remove();
	$("#hidden-menu").addClass("with-border");
</script>
</div>
</div>

<div class="container">
	<div class="row mt-5">
		<div class="col-lg-3">
			{include file="/parts/detailed-profile.tpl"}
		</div>

		<div class="col-lg-9 profile-page">
			<ul class="profile-top-menu mb-4">
				<li>
					<a href="../profile?id={{$user->id}}">Профиль</a>
				</li>
				<li>
					<a href="../friends">Друзья</a>
				</li>
				<li>
					<a href="../my_stores">Привилегии</a>
				</li>
				<li>
					<a class="active" href="../purse">Кошелек</a>
				</li>
				<li>
					<a href="../messages">Сообщения</a>
				</li>
				<li>
					<a href="../notifications">Уведомления</a>
				</li>
			</ul>

			{if('{success}' == '1')}
			<div class="noty-block success">
				<h5>Ваш баланс успешно пополнен!</h5>
				<p><b>{login}</b>, Ваш баланс успешно пополнен!</p>
			</div>
			{/if}
			{if('{fail}' == '1')}
			<div class="noty-block error">
				<h5>Внимание! Ваш баланс не пополнен!</h5>
				<p>Возможно произошла ошибка, либо Вы отменили платеж.</p>
			</div>
			{/if}

			<div class="pay-area">
				<b>Пополнение баланса</b>

				<div class="row">
					<div class="col-lg-6">
						<div class="money-info-block">
							<div>
								<i class="far fa-wallet"></i>
								<p>Баланс</p>
								<span id="money">{{$user->shilings}}Р</span>
							</div>
							<div>
								<i class="far fa-percent"></i>
								<p>Скидка</p>
								<span id="proc">{{$user->proc}}%</span>
							</div>
						</div>
					</div>
					<div class="col-lg-6">
						<span data-target="#voucher" data-toggle="modal">Активировать бонус код</span>
					</div>
				</div>

				<div class="pay-input">
				{if('{up}' == '1')}
					<input class="form-control" id="number_up" placeholder="Введите сумму для пополнения" value="{pirce}">
					<button class="btn btn-primary btn-sm" onclick="refill_balance('up');">Пополнить</button>
				{/if}
				{*
				{if('{rb}' == '1')}
					<input class="form-control" id="number_rb" placeholder="Укажите сумму" value="{pirce}">
					<button class="btn btn-outline-primary btn-xl" onclick="refill_balance('rb');">Пополнить</button>
				{/if}
				{if('{up}' == '1')}
					<input class="form-control" id="number_up" placeholder="Укажите сумму" value="{pirce}">
					<button class="btn btn-outline-primary btn-xl" onclick="refill_balance('up');">Пополнить</button>
				{/if}
				{if('{wb}' == '1')}
					<input class="form-control" id="number_wb" placeholder="Укажите сумму" value="{pirce}">
					<button class="btn btn-outline-primary btn-xl" onclick="refill_balance('wb');">Пополнить</button>
				{/if}
				{if('{ya}' == '1')}
					<input class="form-control" id="number_ya" placeholder="Укажите сумму" value="{pirce}">
					<button class="btn btn-outline-primary btn-xl" onclick="refill_balance('ya');">Пополнить</button>
				{/if}
				{if('{ik}' == '1')}
					<input class="form-control" id="number_ik" placeholder="Укажите сумму" value="{pirce}">
					<button class="btn btn-outline-primary btn-xl" onclick="refill_balance('ik');">Пополнить</button>
				{/if}
				{if('{wo}' == '1')}
					<input class="form-control" id="number_wo" placeholder="Укажите сумму" value="{pirce}">
					<button class="btn btn-outline-primary btn-xl" onclick="refill_balance('wo');">Пополнить</button>
				{/if}
				{if('{ps}' == '1')}
					<input class="form-control" id="number_ps" placeholder="Укажите сумму" value="{pirce}">
					<button class="btn btn-outline-primary btn-xl" onclick="refill_balance('ps');">Пополнить</button>
				{/if}
				*}
				</div>

				<div id="balance_result_fk"></div>
				<div id="balance_result_rb"></div>
				<div id="balance_result_wo"></div>
				<div id="balance_result_ps"></div>
				<div id="balance_result_ya"></div>
				<div id="balance_result_ik"></div>
				<div id="balance_result_wb"></div>
				<div id="balance_result_up"></div>
			</div>

			<script>$('#voucher').modal('hide');</script>
			<div id="voucher" class="modal fade">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
							<h4 class="modal-title">Активация ваучера</h4>
						</div>
						<div class="modal-body">
							<input class="form-control" type="text" id="voucher_key" placeholder="Введите ваучер" maxlength="50">
							<button class="btn btn-primary" onclick="activate_voucher();">Активировать</button><br>
							<div id="activate_result"></div>
						</div>
					</div>
				</div>
			</div>

			<h2>История операций</h2>

			<div id="operations" class="table-adaptive">
				<div class="loader"></div>
				<script>get_operations();</script>
			</div>
		</div>