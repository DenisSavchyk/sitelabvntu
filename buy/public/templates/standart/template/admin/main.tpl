<main>
	<div class="container">
		<div class="row">
			<?
				$versions = is_version($this->conf->version);
				if($versions['status'] && $usr->is_access("a")):
			?>
			<div class="col-lg-12 col-sm-12 mb-2">
				<div class="alert alert-default" role="alert">
					<h4 class="alert-heading">
						Доступно новое обновление!
					</h4>
					
					<div clas="row">
						<div class="col">
							Команда разработчиков PHP eStore выпустили новое обновление!<br>
							Перейдите на страницу управления обновлениями, что бы узнать подробнее!
						</div>
						<div class="col mt-2">
							<a class="btn btn-success btn-sm" href="/admin/updates">
								Управление обновлениями
							</a>
						</div>
					</div>
				</div>
			</div>
			<?
				endif;
				echo $this->get_menu("elements/admin/menu", "{active:admin}");
			?>
		
			<div class="col-lg-8 col-sm-12 mb-4">
				<div class="card padding">
					<div class="card-header">
						Основные настройки
					</div>
					
					<div class="card-body padding-null mt-2">
						<div class="input-group">
							<input id="m_title" type="text" class="form-control" placeholder="Наименование магазина" value="<?=$this->conf->title;?>">
							<button class="btn bg-default" onclick="js_main('title', $('#m_title').val());">
								Изменить
							</button>
						</div>
						<div class="input-group mt-2">
							<input id="m_description" type="text" class="form-control" placeholder="Описание магазина" value="<?=$this->conf->description;?>">
							<button class="btn bg-default" onclick="js_main('description', $('#m_description').val());">
								Изменить
							</button>
						</div>
						<div class="input-group mt-2">
							<input id="m_keywords" type="text" class="form-control" placeholder="Теги магазина" value="<?=$this->conf->keywords;?>">
							<button class="btn bg-default"  onclick="js_main('keywords', $('#m_keywords').val());">
								Изменить
							</button>
						</div>
					</div>
				</div>
				
				<?
					if($usr->is_access("b")):
				?>
				<div class="card padding mt-4">
					<div class="card-header">
						Управление кассами
					</div>
					
					<div class="card-body padding-null mt-2">
						<div class="row">
							<div class="col-4">
								<div class="list-group" id="list-tab" role="tablist">
									<a class="bg-default list-group-item list-group-item-action active" id="list-qiwi-list" data-bs-toggle="list" href="#list-qiwi" role="tab" aria-controls="list-qiwi">
										Qiwi
									</a>
									<a class="bg-default list-group-item list-group-item-action" id="list-fk-list" data-bs-toggle="list" href="#list-fk" role="tab" aria-controls="list-fk">
										Free-kassa
									</a>
								</div>
							</div>
							<div class="col-8">
								<div class="tab-content" id="nav-tabContent">
									<div class="tab-pane fade show active" id="list-qiwi" role="tabpanel" aria-labelledby="list-qiwi-list">
										<?
											$qiwi = get_cashier_data($this->pdo, 'qiwi');
										?>
										<div class="input-group">
											<input id="qw_field" type="text" class="form-control" placeholder="Секретный ключ" value="<?=$qiwi->field;?>">
											<button class="btn bg-default" onclick="js_qiwi('field', $('#qw_field').val());">
												Изменить
											</button>
										</div>
										
										<div class="input-group mt-2">
											<select class="form-select" id="qw_enable">
												<option value="0" <?=($qiwi->enable ? "" : "selected");?>>Выключен</option>
												<option value="1" <?=($qiwi->enable ? "selected" : "");?>>Включён</option>
											</select>
											<button class="btn bg-default" onclick="js_qiwi('enable', $('#qw_enable').val());">
												Изменить
											</button>
										</div>
										
										<div class="alert alert-dark mt-2" role="alert">
											<div class="row">
												<div class="col-lg-4 align-self-center text-center">
													<i class="fas fa-exclamation-triangle" style="font-size:48px;"></i>
												</div>
												<div class="col">
													Прочтите <a href="https://phpestore.ru/wiki/qiwi" class="alert-link">документацию</a> по настройке кассы.
												</div>
											</div>
										</div>
									</div>
									<div class="tab-pane fade show" id="list-fk" role="tabpanel" aria-labelledby="list-fk-list">
										<?
											$fk = get_cashier_data($this->pdo, 'free-kassa');
										?>
										<div class="input-group">
											<input id="fk_id_shop" type="text" class="form-control" placeholder="Номер магазина" value="<?=$fk->id_shop;?>">
											<button class="btn bg-default" onclick="js_fk('id_shop', $('#fk_id_shop').val());">
												Изменить
											</button>
										</div>
										
										<div class="input-group mt-2">
											<input id="fk_field" type="text" class="form-control" placeholder="Секретный ключ 1" value="<?=$fk->field;?>">
											<button class="btn bg-default" onclick="js_fk('field', $('#fk_field').val());">
												Изменить
											</button>
										</div>
										
										<div class="input-group mt-2">
											<input id="fk_field_2" type="text" class="form-control" placeholder="Секретный ключ 2" value="<?=$fk->field_2;?>">
											<button class="btn bg-default" onclick="js_fk('field_2', $('#fk_field_2').val());">
												Изменить
											</button>
										</div>
										
										<div class="input-group mt-2">
											<select class="form-select" id="fk_enable">
												<option value="0" <?=($fk->enable ? "" : "selected");?>>Выключен</option>
												<option value="1"<?=($fk->enable ? "selected" : "");?>>Включён</option>
											</select>
											<button class="btn bg-default" onclick="js_fk('enable', $('#fk_enable').val());">
												Изменить
											</button>
										</div>
										
										<div class="alert alert-dark mt-2" role="alert">
											<div class="row">
												<div class="col-lg-4 align-self-center text-center">
													<i class="fas fa-exclamation-triangle" style="font-size:48px;"></i>
												</div>
												<div class="col">
													Прочтите <a href="https://phpestore.ru/wiki/free-kassa" class="alert-link">документацию</a> по настройке кассы.
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?
					endif;
				?>
			</div>
		</div>
	</div>
</main>