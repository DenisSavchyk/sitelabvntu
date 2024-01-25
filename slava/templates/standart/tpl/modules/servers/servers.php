<?php 
if (!defined("BLOCK")) {
    exit("\r\n\t\t<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" /> \r\n\t\t<html>\r\n\t\t\t<head>\r\n\t\t\t\t<title>404 Not Found</title>\r\n\t\t\t</head>\r\n\t\t\t<body>\r\n\t\t\t\t<h1>Not Found</h1>\r\n\t\t\t\t<p>The requested URL was not found on this server.</p>\r\n\t\t\t</body>\r\n\t\t</html>");
}
	echo '
    <div class="card card-'.$colour.'">
    <div class="card-header">
      <h3 class="card-title">Список серверов</h3>
    </div>
    <div class="card-body table-responsive">
      <div class="row">
      <table class="table table-bordered table-hover">
      <thead style="color: #eeeeee; background-color: #4A4A4A;">
      <tr>
      <th width="1%"><center><i class="fa fa-arrow-down"></i></center></th>
      <th><i class="fa fa-tasks"></i> Название</th>
      <th><i class="fa fa-map-marker"></i> IP - Адрес</th>
      <th><center><i class="fa fa-location-arrow"></i> Быстрое Подключение</center></th>
      </tr>
      </thead>
      <tbody>';
$query = $db->m_query( "SELECT * FROM `".DBcfg::$dbopt['db_prefix']."_servers` ORDER BY `id`" );
							if ( $db->n_rows( $query ) > 0 )
							{while ( $date = $db->f_arr( $query ) ){
									echo '<tr>
										<td style="color: #eeeeee; background-color: #4A4A4A;"><center><b>'.$date['id'].'</b></center></td>
										<td><h6><center><b data-toggle="tooltip" data-placement="right" data-original-title="'.$date['name'].'"class="badge bg-success">'.$date['name'].'</b></h6></center></td>
										<td><h6><a href="#" class="copy-clipboard" data-clipboard-text="'.$date['address'].'" data-text="Скопировать повторно"><b data-toggle="tooltip" data-placement="right" data-original-title="Скопировать адрес сервера"class="badge bg-danger">'.$date['address'].'</b></h6></a></td>
										<td><center><b data-toggle="tooltip" data-placement="right" data-original-title="'.$date['address'].'"><a href="steam://connect/'.$date['address'].'" rel="nofollow" class="btn btn-success">Играть</a></b></center></td>
									      </tr>';}} else {echo '<tr><td colspan="4"><b>Список серверов пуст!</b></td></tr>';}
							echo '</tbody>
                            </table>
                        </div>
                      </div>
                    </div>';
?>