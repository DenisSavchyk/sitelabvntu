<?php 
if (!defined("BLOCK")) {
    exit("\r\n\t\t<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" /> \r\n\t\t<html>\r\n\t\t\t<head>\r\n\t\t\t\t<title>404 Not Found</title>\r\n\t\t\t</head>\r\n\t\t\t<body>\r\n\t\t\t\t<h1>Not Found</h1>\r\n\t\t\t\t<p>The requested URL was not found on this server.</p>\r\n\t\t\t</body>\r\n\t\t</html>");
}
echo '
    <div class="card card-outline card-'.$colour.'">
    <div class="card-body">
      <div class="row">
      <div class="col-md-12">
<div class="callout callout-info" style="margin-bottom: 0!important;">
        <h4><i class="fa fa-info"></i> Инфо:</h4>
        <p>Сортировка происходит от самой большой суммы доната до самой маленькой.</p>
	  </div>
	  <br>
	<div class="box-body table-responsive no-padding">					
				<table class="table table-bordered table-hover">
					<thead style="color: #eeeeee; background-color: #4A4A4A;">
						<tr>
                        <th width="1%"><center><i class="fa fa-arrow-down"></i></th>
                        <th><i class="fa fa-user"></i> Игрок</th>
                        <th><i class="fa fa-rub"></i> Сумма</<i></th>
						</tr>
					</thead>
					<tbody>';
					
			$pagination = $eng->pagination( array( "query" => "SELECT * FROM `bp_donaters` ORDER BY `summ` DESC, `summ` DESC", "page_num" => $num_page, "url" => $url."donaters" ) );
			$query = $db->m_query( $pagination['query'] );
			if ( $db->n_rows( $query ) > 0 )
			{
				$i = $pagination['count'];
				while ( $date = $db->f_arr( $query ) )
				{
					$i++;
					$num = 1;
					$add_tr = ( $date['utime'] != 0 && $date['utime'] < time() ) ? 'class="danger"' : '';
					
					echo '
					<tr '.$add_tr.'>
                    <td style="color: #eeeeee; background-color: #4A4A4A;"><center><b>'.$i.'</b></td>
                    <td><h6><b data-toggle="tooltip" class="badge bg-success" data-placement="right" data-original-title="'.$date['nick'].'">'.$date['nick'].'</b></h6></td>
                    <td><h6><b data-toggle="tooltip" class="badge bg-info" data-placement="right" data-original-title="'.$date['summ'].' Рублей.">'.$date['summ'].' Руб.</b></<b></h6></td>
					</tr>';
				}
				echo '</tbody>
				</table><br><center>'.$pagination['pages'].'</center>';
			} else {
				echo '
				<tr>
					<td colspan="7"><b>Список администрации пуст!</b></td>
				</tr></tbody>
				</table>';
			}
	echo '</div>
		</div>';
?>