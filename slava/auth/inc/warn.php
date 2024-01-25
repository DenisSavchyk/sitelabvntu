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
	
	$query = $db->m_query( "SELECT * FROM `bp_admins` WHERE `id` = '".$id."' AND `hash` = '".$hash."' LIMIT 1" );
	$date = $db->f_arr( $query );
	
	$date_utime = $eng->dateDiff( time(), $date['utime'] ); 
	if ( $date_utime == 'end' ){
		$thisdate_w = 'Срок действия вашего аккаунта истек';
	} else if ( $date_utime == 'few' ){
		$thisdate_w = 'У вас осталось пару секунд';
	} else {
		$thisdate_w = 'У вас осталось '.$date_utime;
	}
	
	if ( $date['utime'] == 0 ) {
		$mess .= '
		<div class="callout callout-danger">
			<h5>Уважаемый(ая) '.$date['name'].'!</h5>
			<p>Мы рады, что вы часть нашего проекта и оберегаете наш сервер от нарушителей!<3<br>
			Мы дорожим каждым своим игроком и просим вас соблюдать <a href="#" data-toggle="modal" data-target="#rules">правила проекта</a></p>
		</div>';
	} else if ( $date['utime'] < time() + 3600*24*3 ) {
		$mess .= '
		<div class="callout callout-danger">
			<h5>Уважаемый(ая) '.$date['name'].'!</h5>
			<p>'.$thisdate_w.'. Аккаунт автоматически приостановиться после окончания срока. Продлевайте услугу вовремя !</p>
		</div>';
	}

	$mess .= '
	<div class="callout callout-danger">
	<h5>Внимание ! ( Что делать, чтобы не украли аккаунт? )</h5>
	<p>Никому и не при каких условиях не сообщайте свой логин и пароль от кабинета! Администрация никогда не попросит у вас данные от кабинета!</p>
    </div>';
	
	if ( $_COOKIE['ad'] != 'stop' ) {
		echo $mess;
	}
?>