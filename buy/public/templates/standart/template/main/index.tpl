<main>
	<div class="container">
		<div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
			<div class="carousel-inner">
				<div class="carousel-item active">
					<a href="https://worksma.ru/co?id=1" target="_blank">
						<img src="{assets}img/carousel/worksma.png" class="d-block w-100" alt="Торговая площадка WORKSMA">
					</a>
				</div>
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
		
		<div class="row">
			<?
				$sth = $this->pdo->query("SELECT * FROM `product` WHERE 1 ORDER BY `id` DESC");
				
				if(!$sth->rowCount()):
				?>
					<div class="col-lg-12 mt-4 text-white text-center">
						<h4>Товаров нет.</h4>
					</div>
				<?
				else:
					$sth->setFetchMode(PDO::FETCH_OBJ);
					while($row = $sth->fetch()) {
						?>
						<div class="col-lg-4 mb-4">
							<div class="card product" onclick="change_url('/product/<?=$row->id;?>');">
								<div class="card-post_image" style="background-image:url('<?=$row->image;?>');">
									<div class="card-post_text">
										<h5><?=$row->name;?></h5>
									</div>
								</div>
							</div>
						</div>
						<?
					}
				endif;
			?>
		</div>
	</div>
</main>