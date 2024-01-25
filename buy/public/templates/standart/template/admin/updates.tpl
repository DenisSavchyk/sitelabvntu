<main>
	<div class="container">
		<div class="row">
			<?=$this->get_menu("elements/admin/menu", "{active:admin:updates}");?>
			
			<div class="col-lg-8 col-sm-12">
				<div class="card padding">
					<div class="card-header">
						Система
					</div>
					<div class="card-body padding-null mt-2">
						<table class="table table-borderless text-white">
							<tbody>
								<tr>
									<td class="padding-null">
										Текущая версия:
									</td>
									<td class="padding-null">
										<?=$this->conf->version;?>
									</td>
								</tr>
								<tr>
									<td class="padding-null">
										От:
									</td>
									<td class="padding-null">
										<?=date("d.m.Y г.", $this->conf->time_update);?>
									</td>
								</tr>
								<?
									$versions = is_version($this->conf->version);
									
									if($versions['status']):
								?>
									<tr><td colspan="2"><hr></td></tr>
									
									<tr>
										<td class="padding-null">
											Доступна версия:
										</td>
										<td class="padding-null">
											<?=$versions['versions'][$versions['pos_id'] + 1]['version'];?>
										</td>
									</tr>
								<?
									endif;
								?>
							</tbody>
						</table>
						
						<?
							if($versions['status']):
						?>
							<div class="progress mb-2">
								<div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
							</div>
							
							<button id="update_button" class="btn bg-default btn-sm w-100" onclick="update_system();">
								Обновить
							</button>
						<?
							endif;
						?>
					</div>
				</div>
				
				<?
					$news = get_news();
					if(!$news):
						?>
							<div class="card padding text-center mt-4">
								Новостей нет.
							</div>
						<?
					else:
						for($i = 0; $i < sizeof($news); $i++):
							?>
								<div class="ui-list block mt-4">
									<div class="row d-flex align-items-center">                   
										<div class="col-lg-4 d-flex align-items-center">
											<div class="name">
												<a href="https://phpstore.worksma.ru/product/11">
													<strong class="d-block">
														<?=$news[$i]['title'];?>
													</strong>
												</a>
												<span class="d-block">
													<?=$news[$i]['subtitle'];?>
												</span>
											</div>
										</div>
										<div class="col-lg-5 text-center">
											<div class="contributions">
												<?=date("d.m.Y в H:i", $news[$i]['time_create']);?>
											</div>
										</div>
										<div class="col-lg-3">
											<div class="details d-flex">
												<div class="item">
													<strong>
														<button data-bs-toggle="collapse" data-bs-target="#desc_<?=md5($news[$i]['title'] . $news[$i]['time_create']);?>" class="btn text-muted" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Узнать подробнее">
															<i class="fas fa-info" aria-hidden="true"></i>
														</button>
													</strong>
												</div>
												<div class="item">
													<strong>
														<a href="https://worksma.ru/support" class="btn text-muted" data-bs-toggle="tooltip" data-bs-placement="top" title="Пожаловаться на обновление">
															<i class="fas fa-bug" aria-hidden="true"></i>
														</a>
													</strong>
												</div>
											</div>
										</div>
									</div>
									
									<div class="collapse mt-2" id="desc_<?=md5($news[$i]['title'] . $news[$i]['time_create']);?>">
										<?=$news[$i]['description'];?>
									</div>
								</div>
							<?
						endfor;
					endif;
				?>
			</div>
		</div>
	</div>
</main>