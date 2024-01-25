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
	
	echo '
	<div class="card card-danger">
      <div class="card-header">
        <h3 class="card-title">Последние покупатели скинов</h3>
      </div>
      <div class="card-body table-responsive">
        <div class="row">					
				<table class="table table-bordered table-hover">
					<thead style="color: #eeeeee; background-color: #4A4A4A;">
						<tr>
							<th width="1%"><center><i class="fa fa-arrow-down"></i></center></th>
							<th><i class="fa fa-user"></i> Игрок</th>
							<th><center><i class="fa fa-tasks"></i> Сервер</center></th>
							<th><center><i class="fa fa-shopping-cart"></i> Модель</center></th>
						</tr>
					</thead>
					<tbody>';
					
				$query = $db->m_query( "SELECT * FROM `bp_skin` ORDER BY `id` DESC LIMIT 5" );
				if ( $db->n_rows( $query ) > 0 )
				{
					$num = 1;
					while ( $date = $db->f_arr( $query ) )
					{
						$auth = ( strlen( $date['nick'] ) > 15 ) ? substr( $date['nick'], 0, 13 ).'...' : $date['nick'];
						$server = ( mb_strlen( $at->serv_info( $date['server_id'] ) ) > 19 ) ? mb_substr( $at->serv_info( $date['server_id'] ), 0, 17, 'UTF-8' ).'...' : $at->serv_info( $date['server_id'] );
						$skins = $db->m_query( "SELECT * FROM `bp_skins` WHERE `id` = '".$date['skin_id']."' ORDER BY `id` LIMIT 1" );
						$skin = $db->f_arr( $skins );
						echo '
						<tr '.$add_tr.'>
							<td style="color: #eeeeee; background-color: #4A4A4A;"><center><b>'.$num.'</b></center></td>
							<td><b data-toggle="tooltip" data-placement="right" data-original-title="'.$date['nick'].'">'.$auth.'</b></td>
							<td><center><h6><b data-toggle="tooltip" data-placement="right" class="badge bg-danger" data-original-title="'.$at->serv_info( $date['server_id'] ).'">'.$server.'</b></h6></center></td>
							<td><center><h6><b data-toggle="tooltip" data-placement="right" class="badge bg-success">'.$skin['model_name'].'</b></h6></center></td>
						</tr>';
						$num++;
					}
				} else {
					echo '
					<tr>
						<td colspan="4"><b>Список покупателей пуст!</b></td>
					</tr>';
				}
			echo '</tbody>
            </table>

        </div>
      </div>
      <!-- /.card-body -->
    </div>';
?>