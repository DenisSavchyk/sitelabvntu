<?
	require($_SERVER['DOCUMENT_ROOT'] . '/application/configs/install/configs.php');
?>
<!DOCTYPE html>
<html lang="ru">
	<head>
		<meta charset="utf-8">
		<title>Установщик :: PHP eStore</title>
		
		<link rel="shortcut icon" href="<?=SERVER_NAME;?>favicon.ico">
			<!--[ Toasty ]!-->
		<link href="<?=SERVER_NAME;?>public/addons/toasty/toasty.min.css" rel="stylesheet" type="text/css">
		
		<link href="<?=ASSETS;?>css/bootstrap.min.css" rel="stylesheet" type="text/css">
		<link href="<?=ASSETS;?>css/custom.css" rel="stylesheet" type="text/css">
		
		<script src="<?=ASSETS;?>js/jquery-3.6.0.min.js"></script>
		<script src="<?=SERVER_NAME;?>public/addons/ckeditor/ckeditor.js"></script>
	</head>
	
	<body>
		<header class="sticky-top">
			<nav class="navbar navbar-expand-lg">
				<div class="container-fluid container">
					<a href="https://worksma.ru" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Перейти на сайт разработчиков" class="navbar-brand mb-0 h1" style="cursor:pointer;">
						PHP eStore
					</a>
				</div>
			</nav>
		</header>
	
		<main>
			<div class="container">
				<div class="row">
					<div class="col-lg-4 col-sm-12 mb-4">
						<div class="card padding">
							<div class="card-header text-center">
								Проверка подключения
							</div>
							<form class="card-body" id="form_mysql">
								<input type="text" class="form-control mb-2" placeholder="Адрес хостинга" name="hostname" id="hostname" required>
								<input type="text" class="form-control mb-2" placeholder="Имя базы данных" name="dataname" id="dataname" required>
								<input type="text" class="form-control mb-2" placeholder="Пользователь" name="username" id="username" required>
								<input type="text" class="form-control mb-2" placeholder="Пароль" name="password" id="password" required>
								
								<input type="submit" class="btn bg-default w-100" value="Проверить подключение">
							</form>
						</div>
					</div>
					
					<div class="col-lg-8 col-sm-12">
						<div class="card padding">
							<div class="card-header text-center">
								Конфигурации сайта
							</div>
							<form class="card-body" id="form_install">
								<div class="row">
									<div class="col-lg-6">
										<input name="project" type="text" class="form-control mb-2" placeholder="Наименование сайта" value="PHP eStore" required>
									</div>
									<div class="col-lg-6">
										<input name="description" type="text" class="form-control mb-2" placeholder="Описание сайта" value="PHP eStore - это движок магазина цифровых товаров, который позволяет продавать и управлять цифровым товаром." required>
									</div>
									<div class="col-lg-6">
										<input name="keywords" type="text" class="form-control mb-2" placeholder="Теги сайта" value="PHP eStore, магазин, цифровых, товаров, купить eStore, купить php store, php, store, скрипты, веб скрипты" required>
									</div>
									<div class="col-lg-6">
										<select class="form-control mb-2" name="template">
											<option value="standart">Стандартный шаблон</option>
										</select>
									</div>
								</div>
								
								<input id="b_install" type="submit" class="btn bg-default w-100" value="Установить" disabled>
							</form>
						</div>
					</div>
				</div>
			</div>
		</main>
		
		<script src="<?=ASSETS;?>js/popper.min.js"></script>
		<script src="<?=SERVER_NAME;?>public/addons/toasty/toasty.min.js"></script>
		<script src="<?=ASSETS;?>js/bootstrap.min.js"></script>
		<script src="<?=ASSETS;?>js/custom.js"></script>
	</body>
</html>