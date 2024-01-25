<?php
	define ( 'BLOCK', true );
	@require_once '../core/core.php';
	if ( isset( $_GET['exit'] ) ) $at->auth_exit( $_SESSION['id'] );
	if ( !empty( $_POST['login'] ) && !empty( $_POST['password'] ) )
	{
		$login = trim( $_POST['login'] );
		$password = md5( sha1( trim( $_POST['password'] ) ) );
		$server = abs( ( int ) $_POST['server'] );
		
		if ( $server == 0 ) {
			$message = "<script type='text/javascript'>
				$('.toastsDefaultAutohide').ready(function(){
					$(document).Toasts('create', {
					  class: 'bg-danger', 
					  title: 'Ошибка!',
					  autohide: true,
					  delay: 15000,
					  position: 'bottomRight',
					  icon: 'fa fa-warning fa-lg',
					  body: 'Не выбран сервер!'
					})
				  });
				  </script>";
		} else {
			$auth = $at->on_auth( $login, $password, $server );
			if ( $auth['request'] == 'ok' ) {
				die('<center>Успешная авторизация!</center><script>window.location.href = "'.$url.'auth";</script>');
			} else {
				$message = "<script type='text/javascript'>
				$('.toastsDefaultAutohide').ready(function(){
					$(document).Toasts('create', {
					  class: 'bg-danger', 
					  title: 'Ошибка!',
					  autohide: true,
					  delay: 15000,
					  position: 'bottomRight',
					  icon: 'fa fa-warning fa-lg',
					  body: 'Неправильно введён логин или пароль!'
					})
				  });
				  </script>";
			}
		}
	}
	$check_auth = $at->check_auth();
	if ( $check_auth['request'] != 'error' ) header("Location: ".$url."auth/");
?>
<!DOCTYPE html>
<html>
<!--- head --->
<?php require_once "../templates/standart/tpl/body/head.php";?>
<!--- head --->

<!--- header --->
<?php require_once "../templates/standart/tpl/body/header.php";?>
<!--- header --->
<!--- МЕНЮ --->
<?php require_once "../templates/standart/tpl/body/menu2.php";?>
<!--- МЕНЮ --->
<div class="content-wrapper" style="min-height: 256.031px;">
	<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">Вход в личный кабинет</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Главная страница</a></li>
					</ol>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	<!-- /.content-header -->

	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">
			<div class="row">
			<div class="col-md-6">
					<div class="header"
						style="color: #33B1CC; text-shadow: 0px 0px 25px #3FDCEF; padding: 10px 10px; text-align: center; font-size: 33px; font-weight: 300; background: #0000001a;">
						Вход в личный кабинет<p
							style="margin: 0 0 10px;font-size: 15px;font-weight: bold;color: #c9e120;text-shadow: 0px 0px 5px #008749;">
							У ВАС ЕСТЬ ПРИВИЛЕГИЯ? - ВОЙДИТЕ ПОД ЕЁ ДАННЫМИ !</p>
					</div>
					<form action="" method="post">
						<div class="body bg-gray" style="background-color: #12000033 !important;">
							<div class="form-group">
								<?php echo $eng->serverlist();?>
							</div>
							<div class="form-group">
								<input type="text" style="color: #0DBBFF" name="login" validate="required" required
									placeholder="Ваш Ник на Сервере" class="form-control" />
							</div>
							<div class="form-group">
								<input type="password" style="color: #0DBBFF" name="password" validate="required"
									required placeholder="Ваш пароль" class="form-control" />
							</div>
						
						
							<button class="btn bg-olive btn-block" type="submit">Авторизироваться!</button>
							</div>
					</form>
				</div>
				<div class="col-md-6">
				<div class="card card-<?php echo $colour;?>">
    <div class="card-header">
      <h3 class="card-title">Помощь</h3>
    </div>
    <div class="card-body">
      <div class="row">
        <div class="callout callout-success">
          <ul style="list-style: square outside;margin-bottom:0;">

            <li><b>Как получить логин и пароль?</b><br>Вам необходимо приобрести привилегию, после этого у вас появится возможность пользоваться личным кабинетом.</li>
            <li><b>Как сменить данные?</b><br>Авторизуйтесь в личном кабинете, там вы найдете формы для смены: ника, пароля.</li>
            </ul>
        </div>
      </div>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
               </div>				<!--/.col (right) -->
			</div>
			<!-- /.row -->
		</div><!-- /.container-fluid -->
	</section>
	<!-- /.content -->
</div><?php if ( isset( $message ) ) { echo $message; } ?>

<!--- bottom --->
<?php require_once "../templates/standart/tpl/body/bottom.php";?>
<!--- bottom --->
<!--

/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\
|        $ Site developed by TexyMC.ru $   |
|        $ Contacts - vk.me/texymcru $     |
|        $ Site - texymc.ru $              |
|        © TexyMC 2017-2020                |
\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/ 

-->
</body>

</html>