<?php 
if (!defined("BLOCK")) {
    exit("\r\n\t\t<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" /> \r\n\t\t<html>\r\n\t\t\t<head>\r\n\t\t\t\t<title>404 Not Found</title>\r\n\t\t\t</head>\r\n\t\t\t<body>\r\n\t\t\t\t<h1>Not Found</h1>\r\n\t\t\t\t<p>The requested URL was not found on this server.</p>\r\n\t\t\t</body>\r\n\t\t</html>");
}	
echo '
	<div class="card card-outline card-'.$colour.'">
      <div class="card-body">
        <div class="row">
        <div class="col-md-12">
		<div class="callout callout-info">
        <h4><i class="fa fa-info"></i> Инфо:</h4>
        <p>Сортировка происходит по окончанию срока услуги. Данные от привилегии вы можете изменить в <a href="'.$url.'auth/login.php">Кабинете.</a></p>
	  </div> </div><br>
			<div class="box-body table-responsive no-padding">					
				<table class="table table-bordered table-hover">
					<thead style="color: #eeeeee; background-color: #4A4A4A;">
						<tr>
							<th width="1%"><center><i class="fa fa-arrow-down"></i></center></th>
							<th><i class="glyphicon glyphicon-user"></i> Игрок</th>
							<th><center><i class="fa fa-tasks"></i> Сервер</center></th>
							<th><center><i class="fa fa-shopping-cart"></i> Привилегия</center></th>
							<th width="11%"><center><i class="fa fa-plus"></i> Добавлен</center></th>
							<th width="8%"><center><i class="fa fa-calendar"></i> Срок</center></th>
						</tr>
					</thead>
					<tbody>';
			$pagination = $eng->pagination( array( "query" => "SELECT * FROM `bp_admins` ORDER BY `time` DESC, `time` DESC", "page_num" => $num_page, "url" => $url."list" ) );
			$query = $db->m_query( $pagination['query'] );
			if ( $db->n_rows( $query ) > 0 )
			{
				$i = $pagination['count'];
				while ( $date = $db->f_arr( $query ) )
				{
					$i++;
					if ( $date['utime'] == 0 ) {
						$thisdate = '<span class="badge bg-success" data-toggle="tooltip" data-placement="left" data-original-title="Навсегда">Навсегда</span>';
					} else {
						$date_utime = $eng->dateDiff( time(), $date['utime'] );
						if ( $date_utime == 'end' ) {
							$thisdate = '<span class="badge bg-primary" data-toggle="tooltip" data-placement="left" data-original-title="Срок истек">Срок истек</span>';
						} else if ( $date_utime == 'few' ) {
							$thisdate = '<span class="badge bg-danger" data-toggle="tooltip" data-placement="left" data-original-title="Пару секунд">Пару секунд</span>';
						} else {
							$thisdate = '<span class="badge bg-danger" data-toggle="tooltip" data-placement="left" data-original-title="'.$date_utime.'">'.$date_utime.'</span>';
						}
					}
					
					echo '
					<tr>
						<td style="color: #eeeeee; background-color: #4A4A4A;"><center><b>'.$i.'</b></center></td>
						<td><b data-toggle="tooltip" data-placement="right" data-original-title="'.$date['auth'].'">'.$date['auth'].'</b></td>
						<td><center><b data-toggle="tooltip" data-placement="right" data-original-title="'.$at->serv_info( $date['server_id'] ).'">'.$at->serv_info( $date['server_id'] ).'</b></center></td>
						<td><center><b data-toggle="tooltip" data-placement="right" data-original-title="'.$at->tarif_info( $date['service_id'] ).'">'.$at->tarif_info( $date['service_id'] ).'</b></center></td>
						<td><center><h6><span data-toggle="tooltip" data-placement="right" data-original-title="'.date('d.m.Y [H:i]', $date['time']).'" class="badge bg-warning">'.date('d.m.Y [H:i]', $date['time']).'</span></h6></center></td>
						<td><center><h6>'.$thisdate.'</h6></center></td>
					</tr>';
				}
				echo '</tbody>
				</table><center>'.$pagination['pages'].'</center>';
			} else {
				echo '
				<tr>
					<td colspan="7"><b>Список администрации пуст!</b></td>
				</tr></tbody>
				</table>';
			}
	echo '</div>
		</div>
	</div>';
?>