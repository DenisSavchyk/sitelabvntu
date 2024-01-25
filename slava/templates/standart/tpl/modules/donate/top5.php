<?php 
if (!defined("BLOCK")) {
    exit("\r\n\t\t<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" /> \r\n\t\t<html>\r\n\t\t\t<head>\r\n\t\t\t\t<title>404 Not Found</title>\r\n\t\t\t</head>\r\n\t\t\t<body>\r\n\t\t\t\t<h1>Not Found</h1>\r\n\t\t\t\t<p>The requested URL was not found on this server.</p>\r\n\t\t\t</body>\r\n\t\t</html>");
}
echo '
	<div class="card card-'.$colour.'">
    <div class="card-header">
      <h3 class="card-title">Топ пожертвований</h3>
    </div>
    <div class="card-body table-responsive">
      <div class="row">
        
        <table class="table table-bordered table-hover">
          <thead style="color: #eeeeee; background-color: #4A4A4A;">
          <tr>
          <th width="1%"><center><i class="fa fa-arrow-down"></i></center></th>
          <th><i class="fa fa-user"></i> Игрок</th>
          <th><i class="fa fa-rub"></i> Сумма</th>
          </tr>
          </thead>
          <tbody>';
				$query = $db->m_query( "SELECT * FROM `bp_donaters` ORDER BY `summ` DESC LIMIT 5" );
				if ( $db->n_rows( $query ) > 0 )
				{
					$num = 1;
					while ( $date = $db->f_arr( $query ) )
					{
						echo '
						<tr>
							<td style="color: #eeeeee; background-color: #4A4A4A;"><center><b>'.$num.'</b></td>
							<td><h6><b data-toggle="tooltip" class="badge bg-success" data-placement="right" data-original-title="'.$date['nick'].'">'.$date['nick'].'</b></h6></td>
							<td><h6><b data-toggle="tooltip" class="badge bg-info" data-placement="right" data-original-title="'.$date['summ'].' Рублей.">'.$date['summ'].' Руб.</b></h6></td>
						</tr>';
						$num++;
					}
				} else {
					echo '
					<tr>
						<td colspan="3"><b>Список донатеров пуст!</b></td>
					</tr>';
				}
			echo '</tbody>
            </table>
        </div>
      </div>
    </div>';
?>