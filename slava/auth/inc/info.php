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
	
	$wmr = ( $wmr_on == 1 ) ? '<option value="1" selected="selected">Webmoney</option>' : '';
	$uni = ( $uni_on == 1 ) ? '<option value="2">Unitpay ( SMS, VISA, QIWI, ЯД )</option>' : '';
	$rob = ( $robo_on == 1 ) ? '<option value="3">Robokassa ( SMS, VISA, QIWI, ЯД, Webmoney )</option>' : '';
	$fre = ( $free_on == 1 ) ? '<option value="4">Free-Kassa ( SMS, VISA, QIWI, ЯД )</option>' : '';
		
	if ( ! empty( $_POST['changename'] ) )
	{
		if ( mb_strlen( $_POST['name'], 'UTF-8' ) > 12 || trim( $_POST['name'] ) == NULL ) 
		{
			echo $eng->alert_mess( 'Не заполнено поле "Имя", или поле превышает 12 символов!' );
		} else {
			$db->m_query( "UPDATE `".DBcfg::$dbopt['db_prefix']."_admins` SET `name` = '".$db->m_escape( trim( $_POST['name'] ) )."' WHERE `id` = '".$id."' AND `hash` = '".$hash."' LIMIT 1" );
			echo $eng->alert_mess( 'Имя успешно изменено!' );
			$eng->log( '['.date( 'd.m.Y H:i', time() ).']['.$_SERVER["REMOTE_ADDR"].'] Игрок '.$at->auth_info( 'auth', $id, $hash ).' сменил свое Имя на новое - '.$_POST['name'].'' . PHP_EOL );
		}
	}
	
	if ( ! empty( $_POST['changeskype'] ) )
	{
		if ( strlen( $_POST['skype'] ) > 32 || trim( $_POST['skype'] ) == NULL ) 
		{
			echo $eng->alert_mess( 'Не заполнено поле "Skype", или поле превышает 32 символа!' );
		} else {
			$db->m_query( "UPDATE `".DBcfg::$dbopt['db_prefix']."_admins` SET `skype` = '".$db->m_escape( trim( $_POST['skype'] ) )."' WHERE `id` = '".$id."' AND `hash` = '".$hash."' LIMIT 1" );
			echo $eng->alert_mess( 'Skype успешно изменен!' );
			$eng->log( '['.date( 'd.m.Y H:i', time() ).']['.$_SERVER["REMOTE_ADDR"].'] Игрок '.$at->auth_info( 'auth', $id, $hash ).' сменил свой Skype на новый - '.$_POST['skype'].'' . PHP_EOL );
		}
	}
	
	if ( ! empty( $_POST['changeauth'] ) )
	{
		$f = file( "../core/nicks.txt" );
		foreach ( $f as $num => $str ) {
			if ( trim( $_POST['auth'] ) == NULL ) break;
			if ( strpos( $str, trim( $_POST['auth'] ) ) !== false ) {
				echo $eng->alert_mess('Данный ник использовать нельзя!');
				$err = 1;
			}
		}
		
		if ( $err != 1 ){
			$query_admins = $db->m_query( "SELECT * FROM `".DBcfg::$dbopt['db_prefix']."_admins` WHERE `auth` = '".$db->m_escape( trim( $_POST['auth'] ) )."' AND `server_id` = '".abs( ( int ) $_POST['server'] )."' LIMIT 1" );
			if ( $db->n_rows( $query_admins ) > 0 ) {
				echo $eng->alert_mess( 'Игрок уже зарегистрирован на данном сервере!' );
			} else if ( trim( $_POST['type'] ) == 'a' && preg_match('/[а-яё]/i', trim( $_POST['auth'] ) ) || $_POST['auth'] == NULL || strlen( $_POST['auth'] ) > 32 ) {
				echo $eng->alert_mess( 'Ник не указан или указан неверно!' );
			} else if ( trim( $_POST['type'] ) == 'ca' && ! preg_match("/^STEAM_0:[01]:[0-9]{5,10}$/", trim( $_POST['auth'] ) ) ) {
				echo $eng->alert_mess( 'Неверно заполнено поле "Steam ID"' );
			} else if ( trim( $_POST['type'] ) == 'de' && ! preg_match("/^[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}$/", trim( $_POST['auth'] ) ) ) {
				echo $eng->alert_mess( 'Неверно заполнено поле "IP - Адрес"' );
			} else {
				$ath = $at->ch_auth( $id );
				if ( $ath == 3 ) {
					echo $eng->alert_mess( 'Ник можно менять только 3 раза в месяц!"' );
				} else {
					$eng->log( '['.date( 'd.m.Y H:i', time() ).']['.$_SERVER["REMOTE_ADDR"].'] Игрок '.$at->auth_info( 'auth', $id, $hash ).' сменил свой Ник/SteamID/IP на новый - '.$_POST['auth'].'' . PHP_EOL );
					$db->m_query( "UPDATE `".DBcfg::$dbopt['db_prefix']."_admins` SET `auth` = '".$db->m_escape( trim( $_POST['auth'] ) )."' WHERE `id` = '".$id."' AND `hash` = '".$hash."' LIMIT 1" );
					$server = abs( ( int ) $_POST['server'] );
					$eng->up_cfg ( $server, $eng->g_cfg( $server ) );
					echo $eng->alert_mess( 'Ник успешно изменен. Изменять Ник можно 3 раза в месяц!' );
				}
			}
		}
	}
	
	$query = $db->m_query( "SELECT * FROM `".DBcfg::$dbopt['db_prefix']."_admins` WHERE `id` = '".$id."' AND `hash` = '".$hash."' LIMIT 1" );
	while( $date = $db->f_arr( $query ) ) 
	{
		if ( $date['utime'] == 0 ) {
			$block_submit = 'disabled';
			$thisdate = 'Бессрочно';
		} else {
			$date_utime = $eng->dateDiff( time(), $date['utime'] ); 
			if ( $date_utime == 'end' ){
				$thisdate = 'Срок истек';
			} else if ( $date_utime == 'few' ){
				$thisdate = 'Пару секунд';
			} else {
				$thisdate = $date_utime;
			}
		}
		
		if ( $date['flags'] == 'a' ) {
			$login = 'Ник';
		} else if ( $date['flags'] == 'ca' ) {
			$login = 'SteamID';
		} else if ( $date['flags'] == 'de' ) {
			$login = 'IP - Адрес';
		}
		
		$query_server = $db->m_query( "SELECT * FROM `".DBcfg::$dbopt['db_prefix']."_servers` WHERE `id` = '".$date['server_id']."' LIMIT 1" );
		$date_server = $db->f_arr( $query_server );
		
		$query_tarifs = $db->m_query( "SELECT * FROM `".DBcfg::$dbopt['db_prefix']."_tarifs` WHERE `id` = '".$date['service_id']."' LIMIT 1" );
		$date_tarif = $db->f_arr( $query_tarifs );
		
		echo '
        <div class="card card-danger card-outline">
        <div class="card-header">
          <h3 class="card-title">
            <i class="fa fa-info"></i>
            Информация
          </h3>
        </div>
        <div class="card-body">	
        <label>Сервер:</label>	
				<div class="input-group">
					<div class="input-group-prepend">
                            <span class="input-group-text"><i class="far fa-user"></i></span>
                          </div>
                        <input disabled type="text" id="name" name="name" placeholder="Имя" required value="'.$at->serv_info( $date['server_id'] ).'" class="form-control">
                        </div>
				  <br><label>Привилегия:</label>
				  <div class="input-group">
			
					<div class="input-group-prepend">
                            <span class="input-group-text"><i class="far fa-user"></i></span>
                          </div>
						<input disabled type="text" id="auth" name="auth" required value="'.$at->tarif_info( $date['service_id'] ).'" class="form-control">
                    </div>
                    <label>Куплена:</label>	
				<div class="input-group">
					<div class="input-group-prepend">
                            <span class="input-group-text"><i class="far fa-user"></i></span>
                          </div>
						<input disabled type="text" id="name" name="name" placeholder="Имя" required value="'.date( 'd.m.Y [H:i]', $date['time'] ).'" class="form-control">
						</div>
				  <br><label>Срок:</label>
				  <div class="input-group">
			
					<div class="input-group-prepend">
                            <span class="input-group-text"><i class="far fa-user"></i></span>
                          </div>
						<input disabled type="text" id="auth" name="auth"  required value="'.$thisdate.'" class="form-control">
					</div>
				</div></div>
		';
	}
?>