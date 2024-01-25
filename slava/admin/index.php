<?php 
	define ( 'BLOCK', true );
	@require_once '../../core/core.php';
	if ( $adm_ip != NULL && $adm_ip != $_SERVER["REMOTE_ADDR"] ) header('Location: '.$url.'');
	if ( $_COOKIE['adhash'] != hash( "sha256", "".$adm_login.".".$adm_pass."" ) ) header('Location: '.$url.'auth/admin/login.php');
	$body = $eng->tmp_bar();
?>
<!DOCTYPE html>
<html>

<!--- head --->
<head>
    <meta charset="UTF-8">
    <title><?php echo $site_name;?> | Админ Центр</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <meta name="description" content="Онлайн приобретение привилегий на серверах">
    <meta name="keywords" content="Онлайн, приобретение, привилегий, на серверах">

    <link rel="shortcut icon" href="<?php echo $url;?>auth/admin/style/img/favicon.ico?3">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet"type="text/css" />
    <link href="<?php echo $url;?>auth/admin/style/bp/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo $url;?>auth/admin/style/bp/_all-skins.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo $url;?>auth/admin/style/bp/jquery.jgrowl.min.css" rel="stylesheet" type="text/css" />

    <link href="<?php echo $url;?>/style/css/iCheck/all.css" rel="stylesheet" type="text/css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</head>
<!--- head --->

<body class="skin-<?php echo $colour;?> sidebar-mini">
	<div class="wrapper">
		<!--- header --->
		<header class="main-header">
    <a href="<?php echo $url;?>" class="logo">
        <span class="logo-mini"><b><?php echo $site_name_mini;?></b></span>
        <span class="logo-lg"><b><?php echo $site_name;?></b></span>
    </a>
    <nav class="navbar navbar-static-top" role="navigation">
				<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
					<span class="sr-only">Переключить</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>
				<div class="navbar-right">
					<ul class="nav navbar-nav">
						<li>
							<a target="_blank" href="<?php echo $url;?>core/logs.txt">
								<i class="fa fa-bar-chart-o"></i> <span>Логи</span>
							</a>
						</li>
						<!-- User Account: style can be found in dropdown.less -->
						<li class="dropdown user user-menu">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<i class="fa fa-gears"></i>
								<span>Инструменты <i class="caret"></i></span>
							</a>
							<ul class="dropdown-menu">
								<!-- Menu Footer-->
								<li class="user-footer">
									<?php require_once "inc/fast_block.php"; ?>
								</li>
							</ul>
						</li>
					</ul>
				</div>
			</nav>
</header>
		<!--- header --->
		<!--- МЕНЮ --->

		<aside class="main-sidebar">
    <section class="sidebar">
        <ul class="sidebar-menu">
            <li class="header" style="font-size: 16px;">
                <center>Навигация</center>
            </li>
            <li>
                <a href="<?php echo $url;?>/auth/admin/index.php">
                    <span>Главная страница</span>
                </a>
			</li>
			<li>
                <a href="<?php echo $url;?>/auth/admin/users.php">
                    <span>Управление покупателями</span>
                </a>
			</li>
			<li>
                <a href="<?php echo $url;?>/auth/admin/skins.php">
                    <span>Управление моделями</span>
                </a>
			</li>
			<li>
                <a href="<?php echo $url;?>/auth/admin/updates.php">
                    <span>Управление обновлениями</span>
                </a>
            </li>
			<li>
                <a href="<?php echo $url;?>/auth/admin/settings.php">
                    <span>Настройки сайта</span>
                </a>
            </li>
        </ul>
    </section>
</aside>

		<!-- Right side column. Contains the navbar and content of the page -->
		<aside class="right-side">
			<!-- Content Header (Page header) -->
			<section class="content-header">
				<h1>
					Панель управления
				</h1>
				<ol class="breadcrumb">
					<li><a href="#"><a href="<?php echo $url;?>"><i class="fa fa-dashboard"></i> Главная страница</a>
					</li>
					<li class="active">Панель управления</li>
				</ol>
			</section><br>
			<!-- Main content -->
			<section class="content">
				<div class="row">
					<?php require_once "inc/admservers.php"; ?>
					<div id="mess" class="jGrowl bottom-right">
						<div class="jGrowl-notification"></div>
					</div>
				</div>
			</section>
		</aside><!-- /.right-side -->
		<!-- ./wrapper -->

		<!-- Modals -->
		<div class="modal fade" id="m_up" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog">
				<form action="" method="POST" style="margin: 0 0 5px;">
					<div class="modal-body">
						<div class="alert alert-success" style="margin-bottom: 0;">
							<center><b>Вы подтверждаете удаление истекших аккаунтов?</b></center>
							<a class="btn btn-danger" data-dismiss="modal">Нет</a>
							<input style="float:right; margin-right: 20px;" class="btn btn-success" type="submit"
								value="Да" name="update">
						</div>
					</div>
				</form>
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->

		<div class="modal fade" id="m_chat" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog">
				<form action="" method="POST" style="margin: 0 0 5px;">
					<div class="modal-body">
						<div class="alert alert-success" style="margin-bottom: 0;">
							<center><b>Вы подтверждаете выполнения очистки чата?</b></center>
							<a class="btn btn-danger" data-dismiss="modal">Нет</a>
							<input style="float:right; margin-right: 20px;" class="btn btn-success" type="submit"
								value="Да" name="del_chat">
						</div>
					</div>
				</form>
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->

		<div class="modal fade" id="m_ses" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog">
				<form action="" method="POST" style="margin: 0 0 5px;">
					<div class="modal-body">
						<div class="alert alert-success" style="margin-bottom: 0;">
							<center><b>Вы подтверждаете выполнения очистки сессий?</b><br />(Все пользователи сайта
								станут не авторизованы!)</center>
							<a class="btn btn-danger" data-dismiss="modal">Нет</a>
							<input style="float:right; margin-right: 20px;" class="btn btn-success" type="submit"
								value="Да" name="del_ses">
						</div>
					</div>
				</form>
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->

		<div class="modal fade" id="m_opt" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog">
				<form action="" method="POST" style="margin: 0 0 5px;">
					<div class="modal-body">
						<div class="alert alert-success" style="margin-bottom: 0;">
							<center><b>Вы подтверждаете выполнения оптимизации базы данных?</b></center>
							<a class="btn btn-danger" data-dismiss="modal">Нет</a>
							<input style="float:right; margin-right: 20px;" class="btn btn-success" type="submit"
								value="Да" name="opt">
						</div>
					</div>
				</form>
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->

		<footer class="main-footer">
<div class="pull-right d-none d-sm-inline-block">

Made with love <a href="https://vk.com/texymcru" target="_blank" title="Веб-Студия. Продажа веб-скриптов и многое другое!">TexyMC</a>. Version: 2.1

</div>
&copy; <script type="d18c465185e941b8455e67c8-text/javascript">
		document.write(new Date().getFullYear());
	</script> TexyMC | Все права защищены.
</footer>
		<script src="<?php echo $url;?>auth/admin/style/js/app.min.js" type="text/javascript"></script>
</body>

</html>