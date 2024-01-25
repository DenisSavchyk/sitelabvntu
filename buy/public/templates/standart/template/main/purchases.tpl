<main>
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-sm-12">
				<?
					$sth = $this->pdo->query("SELECT * FROM `users__purchases` WHERE `id_user`='{$_COOKIE['id']}' ORDER BY `id` DESC");
					
					if(!$sth->rowCount()):
				?>
					<center>
						<h5 class="text-muted">Вы еще ничего не купили.</h5>
					</center>
				<?
					else:
						$sth->setFetchMode(PDO::FETCH_OBJ);
						
						while($row = $sth->fetch()):
							$product = get_product_data($this->pdo, $row->id_product);
				?>
				<div class="ui-list block">
					<div class="row d-flex align-items-center">                   
						<div class="col-lg-4 d-flex align-items-center">
							<div class="order"><?=$row->id;?></div>
							<div class="image">
								<img src="{site_name}<?=$product->image;?>" alt="<?=$product->name;?>" class="img-fluid">
							</div>
							<div class="name">
								<a href="{site_name}product/<?=$row->id_product;?>">
									<strong class="d-block">
										<?=$product->name;?>
									</strong>
								</a>
								<span class="d-block">
									<?=get_full_category($this->pdo, $row->id_product);?>
								</span>
							</div>
						</div>
						<div class="col-lg-4 text-center">
							<div class="contributions">
								<?=date("d.m.Y в H:i", $row->time_buy);?>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="details d-flex">
								<div class="item">
									<strong>
										<button class="btn text-muted" onclick="download(<?=$row->id;?>);">
											<i class="fas fa-file-download"></i>
											Скачать
										</button>
									</strong>
								</div>
								<div class="item">
									<strong>
										<button class="btn text-muted" onclick="win_message('warning', 'Функция находится в разработке');">
											<i class="fas fa-bug"></i>
											Жалоба
										</button>
									</strong>
								</div>
								<div class="item">
									<strong>
										<button class="btn text-muted" onclick="del(<?=$row->id;?>);">
											<i class="fas fa-trash-alt"></i>
											Удалить
										</button>
									</strong>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?
						endwhile;
					endif;
				?>
			</div>
		</div>
	</div>
</main>