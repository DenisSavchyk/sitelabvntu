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
	
	if ( ! empty( $_POST['add'] ) )
	{
        if (isset($_FILES['uploadedFile']) && $_FILES['uploadedFile']['error'] === UPLOAD_ERR_OK && isset($_POST['model_name']) && isset($_POST['server_id']) && isset($_POST['name_ct']) && isset($_POST['name_tt']) && isset($_POST['price'])) {
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
                if(move_uploaded_file($fileTmpPath, $dest_path))
                {
                    $get_url = $folder . $newFileName;
                    $db->m_query( "INSERT INTO `".DBcfg::$dbopt['db_prefix']."_skins` (`id`, `server_id`, `model_name`, `name_tt`, `name_ct`, `image`, `price`) VALUES (NULL, '".$db->m_escape( trim( $_POST['server_id'] ) )."', '".$db->m_escape( trim( $_POST['model_name'] ) )."', '".$db->m_escape( trim( $_POST['name_tt'] ) )."', '".$db->m_escape( trim( $_POST['name_ct'] ) )."', '".$db->m_escape( trim( $get_url ) )."', '".abs( ( int ) $_POST['price'] )."')" );
                    echo $eng->alert_mess( 'Модель успешно добавлена!' ).'<meta http-equiv=\'refresh\' content=\'1; url=http://'.$_SERVER[HTTP_HOST].$_SERVER[REQUEST_URI].'\' >';
                }
                else
                {
                    echo $eng->alert_mess( 'Ошибка добавления модели!' ).'<meta http-equiv=\'refresh\' content=\'1; url=http://'.$_SERVER[HTTP_HOST].$_SERVER[REQUEST_URI].'\' >';
                }
            }
        } else {
            echo $eng->alert_mess( 'Ошибка добавления модели!' ).'<meta http-equiv=\'refresh\' content=\'1; url=http://'.$_SERVER[HTTP_HOST].$_SERVER[REQUEST_URI].'\' >';
        }
	}
	
	echo '
	<div class="col-md-6">
		<div class="box box-success">
			<!-- box-header -->
			<div class="box-header">
				<i class="fa fa-plus"></i>
				<h3 class="box-title">Добавить модель</h3>
				<div class="pull-right box-tools">
					<button class="btn btn-success btn-sm" data-widPOST="collapse" data-toggle="tooltip" title="" data-placement="left" data-original-title="Скрыть"><i class="fa fa-minus"></i></button>
					<button class="btn btn-success btn-sm" data-widPOST="remove" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="Убрать"><i class="fa fa-times"></i></button>
				</div>
			</div><!-- /.box-header -->
			<div class="box-body">
				<form role="form" action="" method="POST" autocomplete="off" enctype="multipart/form-data">
				    <div class="form-group">
						<label><span id="server_annotation">Сервер для продажи</span>:</label>
						'.$eng->serverlists().'
					</div>
					<div class="form-group">
						<label><span id="login_annotation">Название модели</span>:</label>
						<input type="text" id="model_name" name="model_name" placeholder="Название модели" class="form-control" required>
					</div>
					<div class="form-group">
						<label><span id="login_annotation">Название модели на сервере <b class="text-info">ЗА CT</b> - ЛАТИНИЦА!!!</span>:</label>
						<input type="text" id="name_ct" name="name_ct" placeholder="Название модели на сервере за CT" class="form-control" required>
					</div>
					<div class="form-group">
						<label><span id="login_annotation">Название модели на сервере <b class="text-red">ЗА TT</b> - ЛАТИНИЦА!!!</span>:</label>
						<input type="text" id="name_tt" name="name_tt" placeholder="Название модели на сервере за TT" class="form-control" required>
					</div>
					<div class="form-group">
                        <label for="image">Изображение модели:</label>
                        <input type="file" name="uploadedFile" accept="image/*">
                    </div>
					<div class="form-group">
						<label>Цена:</label>
						<input type="number" id="price" name="price" value="100" min="1" placeholder="Цена модели" pattern="^[0-9]+$" class="form-control" required>
					</div>
					<div class="clearfix"><input class="pull-right btn btn-block btn-success" type="submit" value="Добавить модель" name="add"></div>
				</form>
			</div><!-- /.box-body -->
		</div><!-- /.box -->
	</div>';
?>