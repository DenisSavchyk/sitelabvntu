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
	
	$cost = '15';
	$db_connect = mysql_connect("", "", "");
	mysql_select_db ("", $db_connect);
	mysql_set_charset('utf8',$db_connect);
	
	$search = isset( $_GET["search"] ) ? $db->m_escape( trim( $_GET["search"] ) ) : false;

	if ( !empty( $search ) ) 
	{
		$amx_bans = mysql_query('SELECT * FROM amx_bans WHERE `player_nick` LIKE \'%'.$search.'%\' AND `expired` = 0 AND (`ban_length` = 0 OR `ban_created` + `ban_length` * 60 > '.time().') ORDER BY `bid` DESC LIMIT 1000', $db_connect);
	} else {
		$amx_bans = mysql_query("SELECT * FROM amx_bans ORDER BY `bid` DESC LIMIT 1000", $db_connect);
	}
	
    echo '
    <div class="card card-outline card-danger">
      <div class="card-body">
        <div class="row">
        <div class="col-md-12">
	<form method="GET" action="">
		<div class="input-group input-group-sm has-primary" style="margin-bottom: 10px;">
			<input type="text" name="search" value="'.$search.'" class="form-control" placeholder="Введите в поле Ваш ник или его часть и нажмите [Enter]">
			<span class="input-group-btn">
				<button class="btn btn-primary btn-flat" type="submit">Искать</button>
			</span>
		</div>
	</form>
	 </div>
	  <br>
			<div class="box-body table-responsive no-padding">					
				<table class="table table-bordered table-hover">
					<thead style="color: #eeeeee; background-color: #4A4A4A;">
						<tr>
					<th width="1%"><center><i class="fa fa-arrow-down"></i></center></th>
					<th><i class="fa fa-user"></i> Игрок</th>
					<th width="30%"><i class="fa fa-server"></i> Сервер</th>
					<th width="10%"><center><i class="fa fa-calendar"></i> Истекает</center></th>
				</tr>
			</thead>
			<tbody>';
					
			if ( mysql_num_rows( $amx_bans ) > 0 ) 
			{
				if ( ! empty( $_POST['buy_unban'] ) )
				{
					$one_ban = mysql_query("SELECT * FROM `amx_bans` WHERE `bid` = '".abs( ( int ) $_POST['banid'] )."' AND `expired` = 0 AND (`ban_length` = 0 OR `ban_created` + `ban_length` * 60 > ".time().")", $db_connect);
			
					if ( mysql_num_rows( $one_ban ) > 0 )
					{
						$id_acc = rand(999, 999999);
						$signature = md5("".$robo_login.":".$cost.":".$id_acc.":".$robo_pass1.":Shp_ban=".abs( ( int ) $_POST['banid'] )."");
						echo '
						<form name="oplata" method="GET" action="https://www.free-kassa.ru/merchant/cash.php">
						<input type="hidden" name="MrchLogin" value="'.$robo_login.'" />
						<input type="hidden" name="OutSum" value="'.$cost.'" />
						<input type="hidden" name="InvId" value="'.$id_acc.'" />
						<input type="hidden" name="Desc" value="Покупка разбана для игрока - ( #'.abs( ( int ) $_POST['banid'] ).' )" />
						<input type="hidden" name="SignatureValue" value="'.$signature.'" />
						<input type="hidden" name="Culture" value="ru" />
						<input type="hidden" name="Encoding" value="utf-8" />
						<input type="hidden" name="Shp_ban" value="'.abs( ( int ) $_POST['banid'] ).'" />
						</form>
						<script language="Javascript" type="text/javascript">
							document.oplata.submit();
						</script>';
						exit();
					} else {
						echo $eng->alert_mess( 'Игрок не найден, или бан уже истёк!' );
					}
				}
				
				$i = 0;
				while ( $row = mysql_fetch_array( $amx_bans ) )
				{
					$i++;
					if ( $row['ban_length'] == 0 ) {
						$expired = '<span class="label label-danger">Никогда</span>';
						$add_tr = '';
						$block = '';
					} else {
						$ban_end = ($row['ban_created'] + ($row['ban_length'] * 60));
						if ( $ban_end < time() || $row['expired'] == 1 ){
							$expired = '<span class="label label-success">Уже истёк</span>';
							$add_tr = 'class="success"';
							$block = 'disabled';
						} else {
							$expired = '<span class="label label-warning">'.date('d.m.Y [H:i]', $ban_end).'</span>';
							$add_tr = '';
							$block = '';
						}
					}
					
					echo '
					<tr '.$add_tr.'>
						<td style="color: #eeeeee; background-color: #4A4A4A;"><center><b>'.$i.'</b></center></td>
						<td><b>'.$row['player_nick'].'</b></td>
						<td><b>'.$row['server_name'].'</b></td>
						<td><center>'.$expired.'</center></td>
					</tr>';
				}
			} else {
				if ( !empty( $search ) ) {
					echo '
					<tr>
						<td colspan="6"><b>По данному запросу ничего не найдено!</b></td>
					</tr>';
				} else {	
					echo '
					<tr>
						<td colspan="6"><b>Бан-лист пустой!</b></td>
					</tr>';
				}
			}	
			
echo '		</tbody>
		</table>
	</div><!-- /.box -->';
?>