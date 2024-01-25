<?php
	define ( 'BLOCK', true );
	@require_once '../../core/cfg.php';
	
	$id = abs( ( int ) $_POST['id'] );
	
	if ( $id == 3 ) {
		$server = abs( ( int ) $_POST['server'] );
		$service_id = abs( ( int ) $_POST['service_id'] );

		function doplata( $server, $service_id )
		{
			global $db;
			$server_id = abs((int) $server);
			$service = abs((int) $service_id);
			$quer = $db->m_query('SELECT MAX(id) FROM `'.DBcfg::$dbopt['db_prefix'].'_tarifs` WHERE `server_id` = '.$server_id.'');
			
			while($row = $db->f_arr($quer)){
				if($row['MAX(id)'] == $service)
				{
					$max = '<center style="color: red; font-weight: bold;">У ВАС МАКСИМАЛЬНАЯ ПРИВИЛЕГИЯ!!!</center><hr><center>Доплата невозможна!</center>';
				} else {
					$max .= tarifs( $server, $service_id );
				}
			}

			return "\r\n\t\t\t" . $max . "\r\n\t\t\t";
		}

		echo doplata( $server, $service_id );
	} elseif ( $id == 1 ) {
		$server = abs( ( int ) $_POST['server'] );
		$service_id = abs( ( int ) $_POST['service_id'] );

		function tarifs( $server, $service_id )
		{
			global $db;
			$server_id = abs((int) $server);
			$service = $service_id;
			$query = $db->m_query('SELECT * FROM `'.DBcfg::$dbopt['db_prefix'].'_tarifs` WHERE `id` > '.$service.' AND `server_id` = '.$server_id.'');
			
			if (0 < $db->n_rows($query)) {
				while ($row = $db->f_arr($query)) {
					$list .= '<option value="' . $row['id'] . '">' . $row['name'] . ' </option>' . PHP_EOL;
				}
			}
			else {
				$list = '';
			}

			return "\r\n\t\t\t" . '<select class="form-control" id="tariff" name="tariff" required>' . "\r\n\t\t\t\t" . '<option value="0" disabled="disabled" selected="selected">Выбрать привилегию</option>' . "\r\n\t\t\t\t" . $list . "\r\n\t\t\t" . '</select>';
		}

		echo tarifs( $server, $service_id );
	} else {
		echo ''; 
	}
?>