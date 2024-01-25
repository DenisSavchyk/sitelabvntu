<main>
	<div class="container">
		<div class="row">
			<?=$this->get_menu("elements/admin/menu", "{active:admin:control}");?>

			<div class="col-lg-8 col-sm-12 mb-4">
				<div class="card padding">
					<div class="card-header">
						Управление товарами
					</div>
					<div class="card-body padding-null mt-2">
						<div class="table-responsive">
							<table class="table table-borderless text-white" style="border-radius: 0.8rem;">
								<thead>
									<tr>
										<th scope="col">ID</th>
										<th scope="col">Наименование</th>
										<th scope="col">Категория</th>
										<th scope="col">Стоимость</th>
										<th scope="col">Скидка</th>
										<th scope="col">Действие</th>
									</tr>
								</thead>
								<tbody>
									<?
										$sth = $this->pdo->query("SELECT * FROM `product` WHERE 1 ORDER BY `id` DESC");

										if(!$sth->rowCount()):
											?>
											<tr class="text-center">
												<td colspan="6">Нет товаров</td>
											</tr>
											<?
										else:
											while($row = $sth->fetch(PDO::FETCH_OBJ)):
												$category = get_category_data($this->pdo, $row->id);
												?>
												<tr>
													<td><?=$row->id;?></td>
													<td><?=$row->name;?></td>
													<td><?=(get_optgroup_name($this->pdo, $category->id) . " / " . $category->name);?></td>
													<td><?=$row->price;?></td>
													<td><?=$row->discount;?>%</td>
													<td><span onclick="js_delete(<?=$row->id;?>);" style="color:red;cursor:pointer;">Удалить</span></td>
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
		</div>
	</div>
</main>