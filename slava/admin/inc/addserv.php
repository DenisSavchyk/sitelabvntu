<?php 
	if ( ! defined ( 'BLOCK' ) )
	{
		exit ( "
		<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" /> 
		<html>
			<head>
				<title>404 Not Found</title>
			</head>
			<body>
				<h1>Not Found</h1>
				<p>The requested URL was not found on this server.</p>
			</body>
		</html>" ); 
	}
	
	if ( ! empty( $_POST['addserver'] ) )
	{
		$sql_uniq = $db->m_query( "SELECT * FROM `".DBcfg::$dbopt['db_prefix']."_servers` WHERE `name` = '".$db->m_escape( trim( $_POST['name'] ) )."' AND `hostname` = '".$db->m_escape( trim( $_POST['hostname'] ) )."' AND `login` = '".$db->m_escape( trim( $_POST['login'] ) )."' AND `password` = '".$db->m_escape( trim( $_POST['password'] ) )."' LIMIT 1" );
		
		if ( $db->n_rows( $sql_uniq ) > 0 ) {
			echo $eng->alert_mess( 'Сервер уже зарегистрирован!' );
		} else if ( trim( $_POST['name'] ) == NULL || trim( $_POST['hostname'] ) == NULL || trim( $_POST['login'] ) == NULL || trim( $_POST['password'] ) == NULL || trim( $_POST['address'] ) == NULL || trim( $_POST['path'] ) == NULL ) {
			echo $eng->alert_mess( 'Все поля обязательны для заполнения!' );
		} else {
			$db->m_query( "INSERT INTO `".DBcfg::$dbopt['db_prefix']."_servers` (`id`, `name`, `hostname`, `login`, `password`, `address`, `path`, `skins`, `skins_file`, `skins_save`) VALUES (NULL, '".$db->m_escape( trim( $_POST['name'] ) )."', '".$db->m_escape( trim( $_POST['hostname'] ) )."', '".$db->m_escape( trim( $_POST['login'] ) )."', '".$db->m_escape( trim( $_POST['password'] ) )."', '".$db->m_escape( trim( $_POST['address'] ) )."', '".$db->m_escape( trim( $_POST['path'] ) )."', '".abs( ( int ) $_POST['skins'] )."', '".$db->m_escape( trim( $_POST['skins_file'] ) )."', '".$db->m_escape( trim( $_POST['skins_save'] ) )."')" );
			echo $eng->alert_mess( 'Сервер успешно добавлен!' ).'<meta http-equiv=\'refresh\' content=\'1; url=http://'.$_SERVER[HTTP_HOST].$_SERVER[REQUEST_URI].'\' >';
		}
	}
	
	echo '
	<div class="col-md-6">
		<div class="box box-info">
			<!-- box-header -->
			<div class="box-header">
				<i class="fa fa-tasks"></i>
				<h3 class="box-title">Добавить сервер</h3>
				<div class="pull-right box-tools">
					<button class="btn btn-info btn-sm" data-widget="collapse" data-toggle="tooltip" title="" data-placement="left" data-original-title="Скрыть"><i class="fa fa-minus"></i></button>
					<button class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="Убрать"><i class="fa fa-times"></i></button>
				</div>
			</div><!-- /.box-header -->
			<div class="box-body">
				<form role="form" action="" method="POST" autocomplete="off">
					<div class="form-group">
						<label>Название:</label>
						<input type="text" id="name" name="name" placeholder="Название" class="form-control" required>
					</div>
					<div class="form-group">
						<label>FTP Хост:</label>
						<input type="text" id="hostname" name="hostname" placeholder="FTP Хост" class="form-control" required>
					</div>
					<div class="form-group">
						<label>FTP Логин:</label>
						<input type="text" id="login" name="login" placeholder="FTP Логин" class="form-control" required>
					</div>
					<div class="form-group">
						<label>FTP Пароль:</label>
						<input type="password" id="password" name="password" placeholder="FTP Пароль" class="form-control" required>
					</div>
					<div class="form-group">
						<label>IP:PORT:</label>
						<input type="text" id="address" name="address" pattern="\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}:\d{1,5}" placeholder="IP:PORT" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Путь к файлу:</label>
						<input type="text" id="path" name="path" placeholder="Путь к файлу users.ini" value="/addons/amxmodx/configs/" class="form-control" required>
					</div>
					<hr>
					<script src="'.$url.'auth/admin/style/skins.js"></script>
                    <div class="form-group">
                        <input type="checkbox" id="skins" name="skins" value="0">
                        <label for="skins"> Включить продажу моделей?</label>
                        <br>
                        <span id="fileskin" style="display: none;">
                            <label>Путь к файлу скинов: <span class="text-red">С ФАЙЛОМ*</span></label>
                            <input type="text" id="skins_file" name="skins_file" placeholder="Путь к файлу моделей с файлом" value="/cstrike/addons/amxmodx/configs/cm/custom_models.ini" class="form-control" disabled>
                            <label>Формат: %n - ник | %ct - скин CT | %tt - скин TT | %d - день | %m - мес. | %y - год<br><span class="text-red">ВНИМАНИЕ!!!</span> [ и ] будут заменены на ", например [%n] будет "%n"</label>
                            <input type="text" id="skins_save" name="skins_save" placeholder="Вид сохранения в файл" value="[n] [%n] [%ct] [%tt] [0]" class="form-control" disabled>
                        </span>
                    </div>
					<div class="clearfix"><input class="pull-right btn btn-info" type="submit" value="Добавить сервер" name="addserver"></div>
				</form>
			</div><!-- /.box-body -->
		</div><!-- /.box -->
	</div>';
?>