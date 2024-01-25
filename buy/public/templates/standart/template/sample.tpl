<!DOCTYPE html>
<html lang="ru">
	<head>
		<title><?
			if('{title}' == ''):
				echo 'Магазин цифровых товаров';
			else:
				echo '{title}';
			endif;
		?> | <?=$this->conf->title;?></title>
		
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="<?=$this->conf->description;?>">
		<meta name="keywords" content="<?=$this->conf->keywords;?>">
		
		<meta property="og:title" content="<?
			if('{og:title}' == ''):
				echo $this->conf->title;
			else:
				echo '{og:title}';
			endif;
		?>">
		<meta property="og:description" content="<?
			if('{og:description}' == ''):
				echo $this->conf->description;
			else:
				echo '{og:description}';
			endif;
		?>">
		<meta property="og:image" content="<?
			if('{og:meta}' == ''):
				echo '{assets}img/meta.png';
			else:
				echo '{og:meta}';
			endif;
		?>">
		
		<link rel="shortcut icon" href="{site_name}favicon.ico?v={cache}">
			<!--[ Toasty ]!-->
		<link href="{site_name}public/addons/toasty/toasty.min.css?v={cache}" rel="stylesheet" type="text/css">
		
		<link href="{assets}css/bootstrap.min.css?v={cache}" rel="stylesheet" type="text/css">
		<link href="{assets}css/custom.css?v={cache}" rel="stylesheet" type="text/css">
		
		<script src="{assets}js/jquery-3.6.0.min.js?v={cache}"></script>
		<script src="{site_name}public/addons/ckeditor/ckeditor.js?v={cache}"></script>
	</head>
	
	<body>
		<input id="token" type="hidden" value="{token}">
		<header class="sticky-top">
			<nav class="navbar navbar-expand-lg">
				<div class="container-fluid container">
					<span data-bs-toggle="tooltip" data-bs-placement="bottom" title="Вернуться на главную" class="navbar-brand mb-0 h1" onclick="change_url('/');" style="cursor:pointer;">
						<?=$this->conf->title;?>
					</span>
					
					<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
						<i class="fa fa-bars text-white" aria-hidden="true"></i>
					</button>
					<div class="collapse navbar-collapse" id="navbarSupportedContent">
						<div class="me-auto"></div>
						<ul class="navbar-nav d-flex mb-2 mb-lg-0">
							<?
								if(!is_auth()):
							?>
								<li class="nav-item">
									<span class="nav-link" data-bs-toggle="modal" data-bs-target="#modal_login" style="cursor:pointer;">
										Войти на сайт
									</span>
								</li>
							<?
								else:
							?>
								<?
									if($usr->is_access("a")):
								?>
									<li class="nav-item nav-link">
										<a class="btn bg-default btn-sm" href="/admin/product/add">
											<i class="fas fa-plus text-success"></i>
											Добавить товар
										</a>
									</li>
								<?
									endif;
								?>
								<li class="nav-item dropdown">
									<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
										<?=$usr->get_user_data()->login;?>
									</a>
									<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
										<?
											if($usr->is_access("a")):
										?>
										<li>
											<a class="dropdown-item" href="/admin">
												<i class="fas fa-jedi text-muted"></i>
												Панель управления
											</a>
										</li>
										<hr class="dropdown-divider">
										<?
											endif;
										?>
										<li>
											<a class="dropdown-item" href="/wallet">
												<i class="fas fa-wallet text-muted"></i>
												Мой кошелёк
											</a>
										</li>
										<li>
											<a class="dropdown-item" href="/purchases">
												<i class="fas fa-shopping-basket text-muted" aria-hidden="true"></i>
												Мои покупки
											</a>
										</li>
										<hr class="dropdown-divider">
										<li>
											<a class="dropdown-item" onclick="logout();" style="cursor:pointer;">
												<i class="far fa-times-circle text-danger"></i>
												Выйти
											</a>
										</li>
									</ul>
								</li>
							<?
								endif;
							?>
						</ul>
					</div>
				</div>
			</nav>
		</header>
	
		{content}
		
		<footer class="text-center text-muted">
			Копирайт &copy; 2021 <a href="https://worksma.ru" target="_blank" class="text-success">WORKSMA</a>, все права сохранены! 
		</footer>
		
		<?
			if(!is_auth()):
		?>
			<div class="modal fade" id="modal_login" tabindex="-1" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">
								Вход на сайт
							</h5>
							<button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close">
								<i class="fas fa-times text-muted"></i>
							</button>
						</div>
						<div class="modal-body">
							<div class="input-group mb-2">
								<span class="input-group-text">
									<i class="fas fa-user text-white"></i>
								</span>
								<input id="l_login" class="form-control" type="text" placeholder="Введите логин">
							</div>
							<div class="input-group mb-2">
								<span class="input-group-text">
									<i class="fas fa-key text-white"></i>
								</span>
								<input id="l_password" class="form-control" type="password" placeholder="Введите пароль">
							</div>
						</div>
						<div class="modal-footer">
							<span class="mr-2" style="cursor:pointer;" onclick="change_url('/register');">
								Нет аккаунта?
							</span>
							<button type="button" class="btn btn-sm bg-default" onclick="login();">
								Войти
							</button>
						</div>
					</div>
				</div>
			</div>
		<?
			endif;
		?>
		
		<script src="{assets}js/popper.min.js?v={cache}"></script>
		<script src="{site_name}public/addons/toasty/toasty.min.js?v={cache}"></script>
		<script src="{assets}js/bootstrap.min.js?v={cache}"></script>
		<script src="{assets}js/custom.js?v={cache}"></script>
		<script src="https://kit.fontawesome.com/4e87f26727.js" crossorigin="anonymous"></script>
		<script src="{site_name}application/performers/main.js?v={cache}"></script>
	</body>
</html>