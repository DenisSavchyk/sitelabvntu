<main>
	<div class="container">
		<form id="product_add_form" action="/application/performers/actions/main.php" method="POST" class="row" enctype="multipart/form-data">
			<input type="hidden" name="add" value="1">
			
			<div class="col-lg-4 col-sm-12 mb-4">
				<div class="card padding mb-4">
					<div class="card-header">
						Параметры
					</div>
					<input type="text" name="name" required class="form-control" placeholder="Введите наименование">
					
					<div class="input-group mt-1">
						<span class="input-group-text"><i class="fas fa-ruble-sign text-muted"></i></span>
						<input type="number" name="price" required class="form-control" placeholder="Цена" min="0">
						
						<span class="input-group-text"><i class="fas fa-percent text-muted"></i></span>
						<input type="number" name="discount" required class="form-control" placeholder="Скидка" min="0" value="0">
					</div>
					
					<div class="form-floating mt-1">
						<select class="form-select" name="category" required>
							<option value="0" disabled selected>- выбрать -</option>
							<?
								$sth = $this->pdo->query("SELECT * FROM `product__optgroup` WHERE 1");
								$sth->setFetchMode(PDO::FETCH_OBJ);
								
								while($row = $sth->fetch()):
							?>
								<optgroup label="<?=$row->name;?>">
									<?
										$ath = $this->pdo->query("SELECT * FROM `product__category` WHERE `id_optgroup`='{$row->id}'");
										$ath->setFetchMode(PDO::FETCH_OBJ);
										
										while($arow = $ath->fetch()):
									?>
										<option value="<?=$arow->id;?>"><?=$arow->name;?></option>
									<?
										endwhile;
									?>
								</optgroup>
							<?
								endwhile;
							?>
						</select>
						<label for="category">Категория</label>
					</div>
					<div class="form-check mt-1">
						<input class="form-check-input" type="checkbox" value="" id="primaryBinding">
						<label class="form-check-label" for="primaryBinding">
							Требовать привязку
						</label>
					</div>
					<input type="submit" value="Добавить" class="btn btn-success mt-1" id="submit">
				</div>
				
				<div class="card padding mb-4">
					<div class="card-header">
						Документ
					</div>
					<div class="card-body padding-null">
						<input type="file" class="form-control" name="document" required>
					</div>
				</div>
				
				<div class="card padding mb-4">
					<div class="card-header">
						Изображения
					</div>
					<div class="card-body padding-null">
						<label for="main_image" class="mt-0">Главная картинка</label>
						<input id="main_image" type="file" class="form-control" name="image" accept="image/*" required>
						
						<label for="other_images" class="mt-2">Скриншоты</label>
						<input id="other_images" type="file" class="form-control" name="file[]" multiple="multiple" accept="image/*" required>
					</div>
				</div>
			</div>
			<div class="col-lg-8 col-sm-12">
				<textarea name="description" class="ckeditor"></textarea>
			</div>
		</form>
	</div>
</main>