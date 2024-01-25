<?php 
if (!defined("BLOCK")) {
    exit("\r\n\t\t<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" /> \r\n\t\t<html>\r\n\t\t\t<head>\r\n\t\t\t\t<title>404 Not Found</title>\r\n\t\t\t</head>\r\n\t\t\t<body>\r\n\t\t\t\t<h1>Not Found</h1>\r\n\t\t\t\t<p>The requested URL was not found on this server.</p>\r\n\t\t\t</body>\r\n\t\t</html>");
}	
echo '
	<div class="card card-'.$colour.'">
      <div class="card-header">
        <h3 class="card-title">Последние покупатели</h3>
      </div>
      <div class="card-body table-responsive">
        <div class="row">
          <table class="table table-bordered table-hover">
            <thead style="color: #eeeeee; background-color: #4A4A4A;">
            <tr>
            <th width="1%"><center><i class="fa fa-arrow-down"></i></center></th>
            <th><i class="fa fa-user"></i> Игрок</th>
            <th><center><i class="fa fa-tasks"></i> Сервер</center></th>
            <th width="20%"><center><i class="fa fa-calendar"></i> Срок</center></th>
            </tr>
            </thead>
            <tbody>';	
				$query = $db->m_query( "SELECT * FROM `bp_admins` ORDER BY `id` DESC LIMIT 5" );
				if ( $db->n_rows( $query ) > 0 )
				{
					$num = 1;
					while ( $date = $db->f_arr( $query ) )
					{
						if ( $date['utime'] == 0 ) {
							$thisdate = '<span class="badge bg-success" data-toggle="tooltip" data-placement="left" data-original-title="Навсегда">Навсегда</span>';
						} else {
							$date_utime = $eng->dateDiff( time(), $date['utime'] );
							if ( $date_utime == 'end' ) {
								$thisdate = '<span class="badge bg-danger" data-toggle="tooltip" data-placement="left" data-original-title="Срок истек">Срок истек</span>';
							} else if ( $date_utime == 'few' ) {
								$thisdate = '<span class="badge bg-danger" data-toggle="tooltip" data-placement="left" data-original-title="Пару секунд">Пару секунд</span>';
							} else {
								$thisdate = '<span class="badge bg-danger" data-toggle="tooltip" data-placement="left" data-original-title="'.$date_utime.'">'.$date_utime.'</span>';
							}
						}
						$auth = ( strlen( $date['auth'] ) > 15 ) ? substr( $date['auth'], 0, 13 ).'...' : $date['auth'];
						$server = ( mb_strlen( $at->serv_info( $date['server_id'] ) ) > 19 ) ? mb_substr( $at->serv_info( $date['server_id'] ), 0, 17, 'UTF-8' ).'...' : $at->serv_info( $date['server_id'] );
						echo '
						<tr>
							<td style="color: #eeeeee; background-color: #4A4A4A;"><center><b>'.$num.'</b></center></td>
							<td><b data-toggle="tooltip" data-placement="right" data-original-title="'.$date['auth'].'">'.$auth.'</b></td>
							<td><h6><center><b data-toggle="tooltip" data-placement="right" class="badge bg-success" data-original-title="'.$at->serv_info( $date['server_id'] ).'">'.$server.'</b></center></h6></td>
							<td><h6><center>'.$thisdate.'</h6></center></td>
						</tr>';
						$num++;
					}
				} else {
					echo '
					<tr>
						<td colspan="4"><b>Список администрации пуст!</b></td>
					</tr>';
				}
			echo '</tbody>
            </table>
        </div>
      </div>
    </div>';
?>