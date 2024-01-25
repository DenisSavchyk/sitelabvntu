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
	
	if ( ! empty( $_POST['changepass'] ) )
	{
		if ( trim( $_POST['newpass'] ) != trim( $_POST['twonewpass'] ) ) {
			echo $eng->alert_mess( 'Пароли не совпадают!' );
		} else if ( trim( $_POST['newpass'] ) == NULL || trim( $_POST['twonewpass'] ) == NULL || trim( $_POST['lastpass'] ) == NULL ) {
			echo $eng->alert_mess( 'Заполнены не все поля!' );
		} else if ( ! preg_match( '/^[\w]{6,32}+$/', trim( $_POST['newpass'] ) ) ) { 
			echo $eng->alert_mess( 'В пароле могут быть только английские буквы и цифры, а также его длина должна быть от 6 до 32 символа!' );
		} else {
			$query = $db->m_query( "SELECT * FROM `bp_admins` WHERE `password` = '".$db->m_escape( md5( sha1( trim( $_POST['lastpass'] ) ) ) )."' AND `id` = '".$id."' AND `hash` = '".$hash."' LIMIT 1" );
			if ( $db->n_rows( $query ) > 0 )
			{
				$db->m_query( "UPDATE `bp_admins` SET `password` = '".$db->m_escape( md5( sha1( trim( $_POST['newpass'] ) ) ) )."', `servpass` = '".$db->m_escape( trim( $_POST['newpass'] ) )."' WHERE `id` = '".$id."' AND `hash` = '".$hash."' LIMIT 1" );
				echo $eng->alert_mess('Пароль успешно изменен!');
				$server = $at->auth_info( 'server_id', $id, $hash );
				$eng->up_cfg ( $server, $eng->g_cfg( $server ) );
			} else {
				echo $eng->alert_mess( 'Старый пароль указан неверно!' );
			}
		}
	}
	
	echo '
	<div class="card card-danger card-outline">
	<div class="card-header">
	  <h3 class="card-title">
		<i class="fa fa-lock"></i>
		Смена пароля
	  </h3>
	</div>
	<div class="card-body">	
			<form action="" method="POST" autocomplete="off">
				<div class="form-group">
					<label>Старый пароль:</label>
					<input type="password" id="lastpass" name="lastpass" placeholder="Старый пароль" required class="form-control">
				</div>
				<div class="form-group">
					<label>Новый пароль:</label>
					<input type="password" id="newpass" name="newpass" placeholder="Новый пароль" pattern="^[\w]{6,32}$" required class="form-control">
				</div>
				<div class="form-group">
					<label>Новый пароль:</label>
					<input type="password" id="twonewpass" name="twonewpass" placeholder="Новый пароль" pattern="^[\w]{6,32}$" required class="form-control">
				</div>
				<div class="clearfix"><input class="pull-right btn btn-success" type="submit" value="Изменить пароль" name="changepass"></div>	
			</form></div></div>
';
?>