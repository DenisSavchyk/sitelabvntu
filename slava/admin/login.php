<?php
	define ( 'BLOCK', true );
	@require_once '../../core/core.php';
	if ( $adm_ip != NULL && $adm_ip != $_SERVER["REMOTE_ADDR"] ) header('Location: '.$url.'');
	if ( $_COOKIE['adhash'] == hash( "sha256", "".$adm_login.".".$adm_pass."" ) ) { header('Location: '.$url.'auth/admin/'); } else { unset( $_COOKIE['adhash'] ); setcookie("adhash", null, time()-3600, "/"); }
	if ( ! empty( $_POST['login'] ) && ! empty( $_POST['password'] ) );
	{
		$login = trim( $_POST['login'] );
		$password = trim( $_POST['password'] );
		$hash = hash( "sha256", "".$login.".".$password."" );
		
		if ( $login == $adm_login && $password == $adm_pass ) {
			setcookie( "adhash", $hash, ( time() + ( 60 * 60 * 24 * 7 ) ), "/" );
			header('Location: '.$url.'auth/admin/');
		} else $message = $eng->alert_mess('Неправильно введён логин или пароль!');
	}
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
      <!-- Navbar Right Menu -->
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
            <li class="active">
                <a href="<?php echo $url;?>">
                    <i class="fa fa-home text-<?php echo $colour;?>"></i> <span>Главная страница  </span>
                </a>
            </li>
        </ul>
    </section>
</aside>

		<!--- МЕНЮ --->
		<aside class="right-side">
			<section class="content-header" style="text-align: ;">
				<div class="row">
					<div class="col-xs-12" id="login-box">
						<div class="header"
							style="color: #33B1CC; text-shadow: 0px 0px 25px #3FDCEF; padding: 10px 10px; text-align: center; font-size: 33px; font-weight: 300; background: #0000001a;">
							Вход в админ панель<p
								style="margin: 0 0 10px;font-size: 15px;font-weight: bold;color: #c9e120;text-shadow: 0px 0px 5px #008749;">
								ТОЛЬКО ДЛЯ АДМИНИСТРАТОРОВ! ПАНЕЛЬ НЕ ПРОДАЁТСЯ!</p>
						</div>
						<form action="" method="post">
							<div class="body bg-gray">
								<div class="form-group">
									<input type="text" name="login" validate="required" required placeholder="Логин"
										class="form-control" />
								</div>
								<div class="form-group">
									<input type="password" name="password" validate="required" required
										placeholder="Пароль" class="form-control" />
								</div>
							
								<button class="btn bg-olive btn-block" type="submit">Авторизоваться</button>
							</div>
						</form>
						
					</div>
				</div>
			</section>

		</aside>
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