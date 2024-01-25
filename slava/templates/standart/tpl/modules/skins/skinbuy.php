<?php 
	define ( 'BLOCK', true );
	@require_once "../core/cfg.php";
	
	if ( $_POST['nickname'] == NULL || strlen( $_POST['nickname'] ) > 32 ){
		header("HTTP/1.1 301 Moved Permanently");
		header("Location: ".$url."skins?error=2");
		exit();
	} else if ( $_POST['id_skin'] == NULL || $_POST['id_skin'] == 0 ) {
	    header("HTTP/1.1 301 Moved Permanently");
		header("Location: ".$url."skins?error=4");
		exit();
	}
    
    $query = $db->m_query( "SELECT * FROM `".DBcfg::$dbopt['db_prefix']."_skins` WHERE `id` = '".abs( ( int ) $_POST['id_skin'] )."' LIMIT 1" );
	$date = $db->f_arr( $query );
	
	$server = $db->m_query( "SELECT * FROM `".DBcfg::$dbopt['db_prefix']."_servers` WHERE `id` = '".abs( ( int ) $date['server_id'] )."' LIMIT 1" );
	$sdate = $db->f_arr( $server );
	
	if ( $db->n_rows( $query ) == 0 || $db->n_rows( $server ) == 0 )
	{
		header("HTTP/1.1 301 Moved Permanently");
		header("Location: ".$url."skins?error=1");
		exit();
	}
	
	$desc = 'Приобретение модели '.$date['model_name'].' на сервере ' . $sdate['name'];

	$id = rand(999, 999999);
	$db->m_query( "INSERT INTO `".DBcfg::$dbopt['db_prefix']."_temp_skins` (`id`, `nick`, `server_id`, `skin_id`) VALUES ('".$id."', '".$db->m_escape( trim( $_POST['nickname'] ) )."', '".abs( ( int ) $date['server_id'] )."', '".abs( ( int ) $_POST['id_skin'] )."')" );
	echo '
	<html> 
	<head>
		<title>Переадресация на сайт платёжной системы...</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<meta http-equiv="Content-Language" content="ru">
		<meta http-equiv="Pragma" content="no-cache">
		<meta name="robots" content="noindex,nofollow">
	</head>
	<body>';
		if ( $robo_on == 1 ){
		    $signature = md5("".$robo_login.":".$date['price'].":".$id.":".$robo_pass1.":Shp_id=".$id.":Shp_t=:Shp_type=skins");
			
			echo '
			<form name="oplata" method="GET" action="https://www.free-kassa.ru/merchant/cash.php">
			<input type="hidden" name="MrchLogin" value="'.$robo_login.'" />
			<input type="hidden" name="OutSum" value="'.$date['price'].'" />
			<input type="hidden" name="InvId" value="'.$id.'" />
			<input type="hidden" name="Desc" value="'.$desc.'" />
			<input type="hidden" name="SignatureValue" value="'.$signature.'" />
			<input type="hidden" name="Culture" value="ru" />
			<input type="hidden" name="Encoding" value="utf-8" />
			<input type="hidden" name="Shp_id" value="'.$id.'" />
			<input type="hidden" name="Shp_t" value="" />
			<input type="hidden" name="Shp_type" value="skins" />
			<noscript><input type="submit" value="Нажмите, если не хотите ждать!" onclick="document.oplata.submit();"></noscript>
		</form>';

		} else {
			header("HTTP/1.1 301 Moved Permanently");
			header("Location: ".$url."?error=5");
			exit();
		}
		echo '
		<script language="Javascript" type="text/javascript">
			document.oplata.submit();
		</script>
	</body>
	</html>';
?>