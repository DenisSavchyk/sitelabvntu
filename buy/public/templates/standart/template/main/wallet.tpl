<main>
	<div class="container">
		<div class="row">
			<div class="col-lg-8 col-sm-12 mb-4">
				<div class="card padding">
					<div class="card-header">
						История баланса
					</div>
					
					<div class="card-body padding-null mt-2">
						<div class="table-responsive">
							<table class="table table-borderless bg-default" style="border-radius: 0.8rem;">
								<thead>
									<tr>
										<th scope="col">#</th>
										<th scope="col">Дата</th>
										<th scope="col">Событие</th>
									</tr>
								</thead>
								<tbody>
									<?
										$sth = $this->pdo->query("SELECT * FROM `events` WHERE `id_user`='{$usr->get_user_data()->id}' and `id_event`='".get_events_data($this->pdo, 'balance')->id."' ORDER BY `id` DESC LIMIT 5");
										
										if(!$sth->rowCount()):
											?>
												<tr class="text-center">
													<td colspan="3">Нет операций</td>
												</tr>
											<?
										else:
											$sth->setFetchMode(PDO::FETCH_OBJ);
											while($row = $sth->fetch()):
												?>
												<tr>
													<th scope="row"><?=$row->id;?></th>
													<td><?=date("d.m.Y в H:i", $row->time_event);?></td>
													<td><?=$row->message;?></td>
												</tr>
												<?
											endwhile;
										endif;
									?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			
			<div class="col-lg-4 col-sm-12 mb-4">
				<div class="card padding">
					<div class="card-header">
						Текущий баланс
					</div>
					
					<div class="card-body text-center">
						<font style="font-size:3rem; font-weight: bold;" class="text-muted">
							<?=$usr->get_user_data()->balance;?>
						</font>
						<i class="fas fa-ruble-sign text-muted" style="font-size:2em;"></i>
					</div>
				</div>
			</div>
			
			<?
				$qiwi = get_cashier_data($this->pdo, 'qiwi');
				if($qiwi->enable == 1):
			?>
			<div class="col-lg-6 col-sm-12 mb-4">
				<div class="card padding">
					<div class="card-header">
						Пополнить через Qiwi
					</div>
					
					<div class="card-body padding-null">
						<img src="{assets}img/wallet/qiwi.png" class="w-100 mb-1">
						<div class="input-group">
							<input id="q_value" type="number" class="form-control" min="10" placeholder="Сколько будем пополнять?">
							<button class="btn bg-default" onclick="replenish('qiwi', $('#q_value').val());">
								Пополнить
							</button>
						</div>
					</div>
				</div>
			</div>
			<?
				endif;
					
				$fk = get_cashier_data($this->pdo, 'free-kassa');
				if($fk->enable == 1):
			?>
			<div class="col-lg-6 col-sm-12 mb-4">
				<div class="card padding">
					<div class="card-header">
						Пополнить через Free-Kassa
					</div>
					
					<div class="card-body padding-null">
						<img src="{assets}img/wallet/free-kassa.png" class="w-100 mb-1">
						<div class="input-group">
							<input id="fw_value" type="number" class="form-control" min="10" placeholder="Сколько будем пополнять?">
							<button class="btn bg-default" onclick="replenish('free-kassa', $('#fw_value').val());">
								Пополнить
							</button>
						</div>
					</div>
				</div>
			</div>
			<?
				endif;
			?>
		</div>
	</div>
</main>