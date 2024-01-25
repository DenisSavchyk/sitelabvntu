<div class="table-row">
	<div class="row">
		<div class="col-lg-3">
			<strong>
				{name}
			</strong>
		</div>
		<div class="col-lg-3 with-icon with-description">
			<i class="far fa-dot-circle"></i>
			<p>
			{if('{active}' == '2')}
				<a id="admin{id}" class="text-danger" data-container="body" data-toggle="popover" data-placement="top" title="Приостановлен" data-content="Причина: {cause}<br>Цена разблокировки: {pirce}руб.{if('{link}'!='')}<br>Ссылка на <a target='blank' href='{link}'>доказательства</a>{/if}">
					(приостановлен)
				</a>
				<script>$('#admin{id}').popover({html: true, animation: true, trigger: "click", delay: {"show": 100, "hide": 100}});</script>
			{else}
				Активен
			{/if}
			</p>
			<span>Статус</span>
		</div>
		<div class="col-lg-3 with-icon with-description">
			{if('{server}' == '')}
				{if('{user_id}' == '0')}
				<img src="../files/avatars/no_avatar.jpg" alt="Неизвестно">
				<p>Неизвестно</p>
				{else}
				<img src="../{avatar}" alt="{login}">
				<p><a target="_blank" href="../profile?id={user_id}">{login}</a></p>
				{/if}
				<span>Пользователь</span>
			{else}
				<i class="far fa-server"></i>
				<p>{server}</p>
				<span>Сервер</span>
			{/if}
		</div>
		<div class="col-lg-3 with-icon with-description">
			<i class="far fa-stars"></i>
			<p><a href="#" onclick="get_admin_info2({id});" data-target="#modal{id}" data-toggle="modal" title="Подробнее">{services}</a></p>
			<span>Услуг(а|и)</span>
			<div id="modal{id}" class="modal fade">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
							<h4 class="modal-title">Услуги</h4>
						</div>
						<div class="modal-body">
							<div class="table-responsive mb-0">
								<table class="table table-bordered">
									<thead>
									<tr>
										<td>#</td>
										<td>Услуга</td>
										<td>Дата покупки</td>
										<td>Дата окончания</td>
										<td>Осталось</td>
									</tr>
									</thead>
									<tbody id="admin_info{id}">
									<tr>
										<td colspan="10">
											<div class="loader"></div>
										</td>
									</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>