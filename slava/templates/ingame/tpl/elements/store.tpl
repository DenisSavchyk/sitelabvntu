<div id="admin{id}" class="table-row">
	<div class="row">
		<div class="col-lg-3">
			<strong id="new_name_{id}">
				{name}
			</strong>
		</div>
		<div class="col-lg-3 with-icon with-description">
			<i class="far fa-dot-circle"></i>
			<p id="new_active_{id}">
			{if('{active}' == '2')}
				<a id="admin_block{id}" class="text-danger" data-container="body" data-toggle="popover" data-placement="top" title="Заблокирован" data-content="Причина: {cause}<br>Цена разблокировки: {pirce}р{if('{link}'!='')}<br>Ссылка на <a target='blank' href='{link}'>доказательства</a>{/if}">
					Заблокирован
				</a>
				<script>$('#admin_block{id}').popover({ html: true, animation: true, trigger: "click", delay: { "show": 100, "hide": 100 } });</script>
			{else}
				{if('{pause}' != '0')}Приостановлен{else}Активен{/if}
			{/if}
			</p>
			<span>Статус</span>
		</div>
		<div class="col-lg-4 with-icon with-description">
			<i class="far fa-server"></i>
			<p>{server}</p>
			<span>Сервер</span>
		</div>
		<div class="col-lg-2 with-button">
			<button class="btn btn-light btn-sm float-lg-right" onclick="get_stores_info({id});" data-target="#modal{id}" data-toggle="modal">
				<i class="far fa-cog"></i>
			</button>
			<div id="modal{id}" class="modal fade">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
							<h4 class="modal-title">Подробная информация</h4>
						</div>
						<div class="modal-body" id="store_info{id}">
							<div class="loader"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>