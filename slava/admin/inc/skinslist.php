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
	
	if ( ! empty( $_POST['del_model'] ) )
	{
		$db->m_query( "DELETE FROM `".DBcfg::$dbopt['db_prefix']."_skins` WHERE `id` = '".abs( ( int ) $_POST['model_id'] )."' LIMIT 1" );
		echo $eng->alert_mess('Игрок успешно удален!');
	}
	
	if ( isset( $_GET['model'] ) )
    {
		$query_model = $db->m_query( "SELECT * FROM `".DBcfg::$dbopt['db_prefix']."_skins` WHERE `id` = '".abs( ( int ) $_GET['model'] )."' LIMIT 1" );
		
		$date = $db->f_arr( $query_model );
		
		if ( $db->n_rows( $query_model ) > 0 )
		{
			if ( ! empty( $_POST['edit'] ) )
			{
			        if ( isset( $_FILES['uploadedFile'] ) && $_FILES['uploadedFile']['error'] === UPLOAD_ERR_OK ) {
			            $fileTmpPath = $_FILES['uploadedFile']['tmp_name'];
                        $fileName = $_FILES['uploadedFile']['name'];
                        $fileNameCmps = explode(".", $fileName);
                        $fileExtension = strtolower(end($fileNameCmps));
                        
                        $folder = '/uploads/';
                        
                        $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
                        
                        $allowedfileExtensions = array('jpg', 'gif', 'png');
                        
                        $uploadFileDir = dirname(dirname(dirname(__DIR__))) . $folder;
                        
                        $dest_path = $uploadFileDir . $newFileName;
                        
                        if (in_array($fileExtension, $allowedfileExtensions)) {
                            if(move_uploaded_file($fileTmpPath, $dest_path)) {
                                unlink(dirname(dirname(dirname(__DIR__))) . $date['image']);
                                $get_url = $folder . $newFileName;
                            } else {
                                $get_url = $date['image'];
                            }
                        }
                    } else {
                        $get_url = $date['image'];
                    }
        
					$db->m_query( "UPDATE `".DBcfg::$dbopt['db_prefix']."_skins` SET `server_id` = '".abs( ( int ) $_POST['server_id'] )."', `model_name` = '".$db->m_escape( trim( $_POST['model_name'] ) )."', `name_tt`= '".$db->m_escape( trim( $_POST['name_tt'] ) )."', `name_ct`= '".$db->m_escape( trim( $_POST['name_ct'] ) )."', `image` = '".$db->m_escape( trim( $get_url ) )."', `price` = '".abs( ( int ) $_POST['price'] )."' WHERE `id` = '".abs( ( int ) $_GET['model'] )."' LIMIT 1" );
					echo $eng->alert_mess( 'Модель отредактированная!' ).'<meta http-equiv=\'refresh\' content=\'1; url=http://'.$_SERVER[HTTP_HOST].$_SERVER[REQUEST_URI].'\' >';
			}
			
			echo '
			<div class="col-md-12">
				<div class="box box-info">
					<!-- box-header -->
					<div class="box-header">
						<i class="glyphicon glyphicon-user"></i>
						<h3 class="box-title">Модель #'.$date['id'].'</h3>
						<div class="pull-right box-tools">
							<a class="btn btn-info btn-sm" href="'.$url.'auth/admin/skins.php" data-toggle="tooltip" title="" data-placement="left" data-original-title="Назад"><i class="fa fa-mail-reply"></i></a>
							<button class="btn btn-info btn-sm" data-widget="collapse" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="Скрыть"><i class="fa fa-minus"></i></button>
							<button class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="Убрать"><i class="fa fa-times"></i></button>
						</div>
					</div><!-- /.box-header -->
					<div class="box-body">
						<form role="form" action="" method="POST" autocomplete="off" enctype="multipart/form-data">
						    <div class="form-group">
                                <label><span id="server_annotation">Сервер для продажи</span>:</label>
                                '.$eng->serverlists().'
                                <script>$("#server_id").val('.$date['server_id'].').prop("selected", true);</script>
        					</div>
							<div class="form-group">
								<label><span id="login_annotation">Название модели</span>:</label>
								<input type="text" id="model_name" name="model_name" value="'.$date['model_name'].'" placeholder="Название модели" class="form-control" required>
							</div>
							<div class="form-group">
								<label>Название модели на сервере <b class="text-info">ЗА CT</b> - ЛАТИНИЦА!!!:</label>
								<input type="text" id="name_ct" name="name_ct" value="'.$date['name_ct'].'" placeholder="Название модели на сервере за CT" class="form-control" required>
							</div>
							<div class="form-group">
								<label>Название модели на сервере <b class="text-red">ЗА TT</b> - ЛАТИНИЦА!!!:</label>
								<input type="text" id="name_tt" name="name_tt" value="'.$date['name_tt'].'" placeholder="Название модели на сервере за TT" class="form-control" required>
							</div>
							<div class="form-group">
								<label>Цена:</label>
								<input type="number" id="price" name="price" value="'.$date['price'].'" min="1" placeholder="Цена модели" pattern="^[0-9]+$" class="form-control" required="">
							</div>
							<div class="form-group">
								<label>Изображение модели: <a href="#modal_skin" data-toggle="modal" data-target="#modal_skin">Посмотреть <i class="fa fa-eye"></i></a></label>
								<input type="file" name="uploadedFile" accept="image/*">
								<p class="help-block">Выбирете новое фото для обновления</p>
							</div>	
							<div class="clearfix"><input class="pull-right btn btn-info" type="submit" value="Изменить данные" name="edit"></div>
						</form>					
					</div><!-- /.box-body -->
				</div><!-- /.box -->
				<div class="modal fade" id="modal_skin" style="display: none;">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true"><i class="fa fa-times"></i></span></button>
                        <h4 class="modal-title">'.$date['model_name'].' (#'.$date['id'].')</h4>
                      </div>
                      <img class="img-responsive modal-body" src="'.$url.$date['image'].'" />
                      <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Закрыть</button>
                      </div>
                    </div>
                    <!-- /.modal-content -->
                  </div>
                  <!-- /.modal-dialog -->
                </div><!-- /.modal -->
			</div>';	
		} else {
			echo '
			<div class="col-md-12">
				<div class="alert alert-danger alert-dismissable">
					<i class="fa fa-check"></i>
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
					<h4>Внимание!</h4>
					<b>Модель не найдена <a href="#" onclick="history.back();return false;">вернуться назад!</a></b>
				</div>
			</div>';
		}
	} else {
		echo '
		<div class="col-md-6">
			<div class="box box-primary">
				<div class="box-header">
					<i class="fa fa-list"></i>
					<h3 class="box-title">Список моделей</h3>
					<div class="box-tools pull-right">
						<button class="btn btn-primary btn-sm" data-widget="collapse" data-toggle="tooltip" title="" data-placement="left" data-original-title="Скрыть"><i class="fa fa-minus"></i></button>
						<button class="btn btn-primary btn-sm" data-widget="remove" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="Убрать"><i class="fa fa-times"></i></button>
					</div>
				</div><!-- /.box-header -->
				<div class="box-body">
					<div class="box-body table-responsive no-padding">
						<table class="table table-bordered table-hover">
							<thead style="color: #eeeeee; background-color: #4A4A4A;">
								<tr>
									<th width="1%"><center><i class="fa fa-arrow-down"></i></center></th>
									<th><i class="glyphicon glyphicon-user"></i> Название</th>
									<th width="20%"><center><i class="fa fa-rub"></i> Цена</center></th>
									<th width="20%"><center><i class="fa fa-cog"></i> Функции</center></th>
								</tr>
							</thead>
							<tbody>';
	
						$pagination = $eng->pagination( array( "query" => "SELECT * FROM `".DBcfg::$dbopt['db_prefix']."_skins` ORDER BY `id` ASC", "page_num" => 14, "url" => $url."auth/admin/skins.php" ) );
						
						$query = $db->m_query( $pagination['query'] );
						
						if ( $db->n_rows( $query ) > 0 )
						{
							$i = $pagination['count'];
							while ( $date = $db->f_arr( $query ) )
							{
								++$i;
								$mn = $date['model_name'];
								
								$price = '<span class="label label-primary" data-toggle="tooltip" data-placement="left" data-original-title="Цена: '.$date['price'].' ₽">'.$date['price'].' ₽</span>';
			
								echo '
								<tr>
									<td style="color: #eeeeee; background-color: #4A4A4A;"><center><b>'.$i.'</b></center></td>
									<td><b data-toggle="tooltip" data-placement="right" data-original-title="'.$mn.'">'.$mn.'</b></td>
									<td><center>'.$price.'</center></td>
									<td>
										<center>
											<a href="?model='.$date['id'].'" role="button" data-toggle="modal" class="btn btn-xs btn-primary"><i data-toggle="tooltip" data-placement="top" data-original-title="Редактировать" class="fa fa-edit"></i></a>
											<a href="#del'.$date['id'].'" role="button" data-toggle="modal" class="btn btn-xs btn-danger"><i data-toggle="tooltip" data-placement="right" data-original-title="Удалить" class="fa fa-trash-o"></i></a>
										</center>
									</td>
								</tr>
								<div class="modal fade" id="del'.$date['id'].'" role="dialog" aria-hidden="true">
									<div class="modal-dialog">
									   <form action="" method="POST" style="margin: 0 0 5px;">
											<input type="hidden" name="model_id" value="'.$date['id'].'">
											<input type="hidden" name="server_id" value="'.$date['server_id'].'">
											<div class="modal-body">
												<div class="alert alert-success" style="margin-bottom: 0;">
													<center><b>Вы подтверждаете удаление модели №'.$i.'?</b></center>
													<a class="btn btn-danger" data-dismiss="modal">Нет</a>
													<input style="float:right; margin-right: 20px;" class="btn btn-success" type="submit" value="Да" name="del_model">  
												</div>
											</div>
										</form>
									</div><!-- /.modal-dialog -->
								</div><!-- /.modal -->';
							}
							echo '</tbody>
							</table><center>'.$pagination['pages'].'</center>';
						} else {
							echo '
							<tr>
								<td colspan="4"><b>Список моделей пуст!</b></td>
							</tr></tbody>
							</table>';
						}
			echo '</div>
				</div>
			</div>
		</div>';
		require_once "inc/skinsadd.php";
	}
?>