<main>
	<div class="container">
		<div class="row">
			<?
				$sth = $this->pdo->query("SELECT * FROM `product` WHERE `id`='{id}'");
				$sth->setFetchMode(PDO::FETCH_OBJ);
				$row = $sth->fetch();
			?>
			<style>
				.col-lg-4.sticky-lg-top {
					align-self: flex-start;
					top: 4.4rem;
				}
			</style>
			<div class="col-lg-4 col-sm-12 sticky-lg-top">
				<div class="card padding">
					<table class="table table-borderless text-white">
						<tbody>
							<tr>
								<td>Название</td>
								<td><?=$row->name;?></td>
							</tr>
							<tr>
								<td>Категория</td>
								<td><?=get_category_name($this->pdo, $row->id_category);?></td>
							</tr>
							<tr>
								<td>Стоимость</td>
								<td>
									<?
										if(($price = get_price($row->price, $row->discount))):
											echo $price . ' ' . $this->conf->currency;
										else:
											echo 'Бесплатно';
										endif;
									?>
								</td>
							</tr>
						</tbody>
					</table>
					<?
						if(is_auth()):
							if($GLOBALS['usr']->get_user_data()->balance < $row->price):
								?>
								<button class="btn btn-success" disabled>Недостаточно средств</button>
								<?
							else:							
								if($row->binding == '1'):
									?>
									<button class="btn btn-success" onclick="binding(<?=$row->id;?>);">
										<?=($price ? "Купить" : "Получить");?>
									</button>
									<?
								else:
									?>
									<button class="btn btn-success" onclick="buy(<?=$row->id;?>, 0);">
										<?=($price ? "Купить" : "Получить");?>
									</button>
									<?
								endif;
							endif;
						else:
					?>
						<button class="btn btn-success" disabled>Сначала авторизуйтесь</button>
					<?
						endif;
					?>
				</div>
				
				<div class="card padding mt-4 mb-4">
					<?=$row->description;?>
				</div>
			</div>
			
			<div class="col-lg-8 col-sm-12">
				<div class="card padding">
					<div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
						<div class="carousel-inner">
							<?
								$sth = $this->pdo->query("SELECT * FROM `product__images` WHERE `id_product`='{id}' ORDER BY `id` DESC");
								
								if(!$sth->rowCount()):
								?>
									<div class="carousel-item active">
										<img src="<?=$row->image;?>" class="d-block w-100">
									</div>
								<?
								endif;
								
								$sth->setFetchMode(PDO::FETCH_OBJ);
								$active = true;
								while($rw = $sth->fetch()):
							?>
								<div class="carousel-item <?
									if($active):
										echo 'active';
										$active = false;
									endif;
								?>">
									<img src="<?=$rw->image;?>" class="d-block w-100">
								</div>
							<?
								endwhile;
							?>
						</div>
						<button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
							<span class="carousel-control-prev-icon" aria-hidden="true"></span>
							<span class="visually-hidden">Назад</span>
						</button>
						<button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
							<span class="carousel-control-next-icon" aria-hidden="true"></span>
							<span class="visually-hidden">Далее</span>
						</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>