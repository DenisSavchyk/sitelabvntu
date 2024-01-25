<div class="item">
	<div class="server">
		<div class="map-image" style="background-image: url({map_img});"></div>
		<div class="shadow"></div>
		<p>
		<span onclick="get_players({id});" data-toggle="modal" data-target="#server{id}">
			Онлайн: {now} из {max}
		</span>
		{***Карта: {map_name}***}
        </p>
		<strong>{name}</strong>
		<a href="steam://connect/{address}" title="Подключиться к серверу">
			IP адрес: {address}
			<i class="fal fa-gamepad"></i>
		</a>

		<div class="modal fade" id="server{id}">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title">Игроки</h4>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">×</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="table-responsive mb-0">
							<table class="table table-bordered">
								<thead>
								<tr>
									<td>#</td>
									<td>Ник</td>
									<td>Убийств</td>
									<td>Время</td>
									{if('{rcon}' == '1' && isset($_SESSION['id']) && is_worthy_specifically("s", {id}))}
									<td>Действие</td>
									{/if}
								</tr>
								</thead>
								<tbody id="players{id}">
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

		<div class="progress">
			<div class="progress-bar bg-{color}" role="progressbar" style="width: {percentage}%"></div>
		</div>
	</div>
</div>