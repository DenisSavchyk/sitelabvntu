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

	
	$data = $db->m_query( "SELECT * FROM `bp_admins` WHERE `id` = " . $id );
	$data = $db->f_arr( $data );
	
	$block = '';
	
	if( $data['utime'] == 0 )
	{
		$block = 'disabled';
	}
	
	echo '
	<div class="card card-danger card-outline">
	<div class="card-header">
	  <h3 class="card-title">
		<i class="fa fa-lock"></i>
		Дополнительные услуги
	  </h3>
	</div>
	<div class="card-body">	
		<script type="text/javascript">
			$(function(){
				$.ajax({
					type: "POST",
					url: "'.$url.'service.php",
					data: "service_id=' . $data['service_id'] . '&id=6&server_id="+'.$data['server_id'].',
					success: function(data){
						$("#tarif_list").html(data);
					}
				});
			});	
			
			function changeselect(){
				$.ajax
				({
					type: "POST",
					url: "'.$url.'service.php",
					data: "id=7&service_id=" + $(\'select[name=service_id]\').val(),
					success: function(data)
					{
						$("#tarif_price").html(data);
					}
				});
			};
			
			function show_u_form( type )
			{
				pro = $(\'#form-prolong:hidden\').length
				doc = $(\'#form-changeserv:hidden\').length
				
				console.log( pro )
				if( type == 1 )
				{
					if( pro == 1 )
					{
						$(\'#form-prolong\').show();
					}
					
					if( doc != 1 )
					{
						$(\'#form-changeserv\').hide();
					}
				}
				else
				{
					if( doc == 1 )
					{
						$(\'#form-changeserv\').show();
					}
					
					if( pro != 1 )
					{
						$(\'#form-prolong\').hide();
					}
				}
			}
			
		</script>
			<div class="box-body" style="">		
			<input onclick="show_u_form( 1 )" style="width: 49%" class="btn btn-lg input-block btn-success ' . $block . '"  type="submit" value="Продлить" name="submit">
			<input onclick="show_u_form( 2 )" style="width: 50%" class="btn btn-lg input-block btn-success" type="submit" value="Докупить" name="submit">
			</div>
			<div id="form-changeserv" style="display:none; width: 97%; margin-left: 10px">
				<form action="' . $url . 'auth/changeservice.php" method="POST" autocomplete="off">
				<input type="hidden" id="nick" name="nick" value="'.$date['auth'].'">
	<input type="hidden" id="service_id" name="service_id" value="'.$date['service_id'].'">
    <input type="hidden" id="server_id" name="server_id" value="'.$date['server_id'].'">
					<div class="form-group">
					<br>
						<label>Выберите услугу (выше вашей!)</label>
						<div id="tarif_list"></div>
					</div>
					<div class="form-group">
						<label>Срок:</label>
						<div id="tarif_price"></div>
					</div>
					<div class="form-group">
		<label>Способ оплаты:</label>
		<select id="how2" name="how2" class="form-control" required>
			'.$wmr.'
			'.$uni.'
			'.$rob.'
			'.$fre.'									
		</select>
	</div>
					<input type="hidden" name="user_id" value="'.$id.'">
					<div class="clearfix"><input disabled class="btn btn-block btn-danger" type="submit" value="Функция временно недоступна" name="submit"></div>	
				</form><br><br>
				<button class="btn btn-info btn-sm" data-toggle="modal" data-target="#doplata"><b>Как правильно докупить?</b></button>
			</div>
			<div id="form-prolong" style="display:none; width: 97%; margin-left: 10px">
				<script type="text/javascript">
					$(function time_list(){
						$.ajax({
							type: "POST",
							url: "'.$url.'service.php",
							data: "id=2&tarif_time="+'.$data['service_id'].',
							success: function(data){
								$("#tarif_list_time").html(data);
							}
						});
					});
				</script>
				<form action="'.$url.'auth/prolong.php" id="prolong" name="prolong" method="POST" style="margin: 0;" autocomplete="off">
					<div class="form-group">
					<br>
						<label>Срок:</label>
						<div id="tarif_list_time"></div>
					</div>
					<input type="hidden" name="how" value="4">
					<input type="hidden" name="user_id" value="'.$data['id'].'">
					<input disabled class="btn btn-block btn-danger" type="submit" value="Функция временно недоступна" name="submit">
				</form>
			</div>
		</div><!-- /.box-body -->
	</div><!-- /.box -->
	
	<div class="modal fade" id="doplata">
	  <div class="modal-dialog modal-lg">
		<div class="modal-content">
		  <div class="modal-header">
			<h4 class="modal-title">Как правильно доплатить?</h4>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
		  </div>
		  <div class="modal-body">
		  <b>Как правильно!!!</b>
		  <hr>
		  <li>1. Открываете вкладку "<b>Докупить</b>".</li>
		  <li>2. Выбераете <b>только</b> привилегию <b>выше вашей</b>!</li>
		  <li>3. <b>Убедились, что выбрали привилегию ваше вашей?</b></li>
		  <li>4. Нажимаете кнопку "<b>Докупить</b>"</li>
		  <li>5. <b>Смотрите сумму докупки</b> и <b>Оплачиваете!</b></li>
		  <hr>	  <p>
		  <b>Как не правильно!!! (Ошибки)</b><br>
		  
		  <li>Если вы нажали на кнопку "<b>Докупить</b>", то <b>ни в коем</b> случаи не выбирайте привилегию <b>меньше вашей</b>!!!</li>
		  <li>Если вы <b>не выбрали</b> привилегию <b>выше вашей</b>, в таком случаи не нажимайте на вторую кнопку "<b>Докупить</b>", иначе вы купите пустоту и ваша привилегия исчезнет.</li>
			  </p>
			  <p>
			  
На странице оплаты произойдет перерасчет стоимости услуги.
			  </p>
			  </div>
		  <div class="modal-footer justify-content-between">
			<button type="button" class="btn btn-primary" data-dismiss="modal">Закрыть</button>
		  </div>
		</div>
		<!-- /.modal-content -->
	  </div>
	  <!-- /.modal-dialog -->
	</div>
	<!-- /.modal -->';
?>