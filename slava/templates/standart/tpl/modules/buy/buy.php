<?php 
if (!defined("BLOCK")) {
    exit("\r\n\t\t<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" /> \r\n\t\t<html>\r\n\t\t\t<head>\r\n\t\t\t\t<title>404 Not Found</title>\r\n\t\t\t</head>\r\n\t\t\t<body>\r\n\t\t\t\t<h1>Not Found</h1>\r\n\t\t\t\t<p>The requested URL was not found on this server.</p>\r\n\t\t\t</body>\r\n\t\t</html>");
}
	if ( ! empty( $_GET['error'] ) ) { $id = abs( ( int ) $_GET['error'] ); if ( $id > 0 && $id <= 9 ) { $error_mess = array( 1 => '<center><strong>Игрок уже зарегистрирован на данном сервере!</strong></center>', 2 => '<center><strong>Не выбран сервер!</strong></center>', 3 => '<center><strong>Не выбрана услуга или срок!</strong></center>', 4 => '<center><strong>"Ник" не указан или указан неверно!</strong></center>',  5 => '<center><strong>"Steam ID/IP" не указан или указан неверно!</strong></center>', 6 => '<center><strong>Не выбран тип авторизации!</strong></center>', 7 => '<center><strong>Данный ник использовать нельзя!</strong></center>', 8 => '<center><strong>В пароле могут быть только английские буквы и цифры, а также его длина должна быть от 6 до 32 символа!</strong></center>', 9 => '<center><strong>Платежная система не найдена!</strong></center>');$error = "$('.toastsDefaultAutohide').ready(function(){ $(document).Toasts('create', {class: 'bg-danger',title: 'Ошибка!',autohide: true,delay: 15000,position: 'bottomRight',icon: 'fa fa-warning fa-lg',body: '".$error_mess[$id]."'})});";}}
	$wmr = ( $wmr_on == 1 ) ? '<option value="1" selected="selected">Webmoney</option>' : '';
	$uni = ( $uni_on == 1 ) ? '<option value="2">Unitpay ( SMS, VISA, QIWI, ЯД, WebMoney )</option>' : '';
	$free = ( $free_on == 1 ) ? '<option value="3">Free Kassa ( SMS, VISA, QIWI, ЯД )</option>' : '';
	$rob = ( $robo_on == 1 ) ? '<option value="5">Free Kassa ( SMS, VISA, QIWI, ЯД )</option>' : '';
    $liqpay = ( $lp_on == 1 ) ? '<option value="4">LiqPay ( Приват24, Украина )</option>' : '';
    $discount_mess = ( $discount_on == 1 ) ? '<div class="alert alert-success alert-dismissible">
    <h5><i class="icon fas fa-exclamation-triangle"></i> Внимание! Скидки!</h5>
    Сейчас действуют скидки -'.$discount.' на все услуги!
  </div>' : '';
	echo '
	<script type="text/javascript">$(function() { tarif_list(); time_list(); '.$error.' $("#tarif_list").click(function(){ var tarif = $( "#tarif" ).val(); $.ajax({ type: "POST", url: "'.$url.'service.php", data: "id=4&tarif="+tarif, success: function(data){ $("#tarif_info").html(data); } }); }); }); function tarif_list() { var server = $( "#server" ).val(); $.ajax({ type: "POST", url: "'.$url.'service.php", data: "id=1&server="+server, success: function(data){ $("#tarif_list").html(data); } }); } function time_list() { var tarif_time = $( "#tarif" ).val(); $.ajax({ type: "POST", url: "'.$url.'service.php", data: "id=2&tarif_time="+tarif_time, success: function(data){ $("#tarif_list_time").html(data); } }); } function tarif_price() { var tarif_time = $( "#tarif" ).val(); $.ajax({ type: "POST", url: "'.$url.'service.php", data: "id=2&tarif_time="+tarif_time, success: function(data){ $("#tarif_list_time").html(data); } }); } function sel_server() { var server = $( "#server" ).val(); $.ajax({ type: "POST", url: "'.$url.'service.php", data: "id=3&server="+server, success: function(data){ $("#selected_server").html(data); } }); } function changetype(name) { if (name=="a") { $("#login_annotation").html("Ник"); $("#auth").attr("placeholder", "Ник в игре"); } }</script>
	<div class="card card-'.$colour.' card-tabs">
    <div class="card-header p-0 pt-1">
        <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="buy-tab" data-toggle="pill" href="#buy" role="tab" aria-controls="buy" aria-selected="false">Покупка доната</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="donate-tab" data-toggle="pill" href="#donate" role="tab" aria-controls="donate" aria-selected="true">Пожертвования</a>
            </li>
        </ul>
    </div>
    <div class="card-body">
        <div class="tab-content" id="custom-tabs-one-tabContent">
            <div class="tab-pane fade active show" id="buy" role="tabpanel" aria-labelledby="buy">
            '.$discount_mess.'
                <form role="form" action="pay.php" method="POST" autocomplete="off">
                    <input type="hidden" name="type" value="a">
                    <div class="form-group">
                        <label><i class="fa fa-server"></i> Выберите Сервер:</label>
                        '.$eng->serverlist().'
                    </div>
                    <div class="form-group">
                        <label><i class="fa fa-diamond"></i> Выберите Привилегию (СКИДКИ 60%):</label>
                        <div id="tarif_list"></div>
                        <div id="tarif_info"></div>
                    </div>
                    <div class="form-group">
                        <label><i class="fa fa-calendar"></i> Срок:</label>
                        <div id="tarif_list_time"></div>
                    </div>
                    <div class="form-group">
                        <label>Введите ник:</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="far fa-user"></i></span>
                            </div>
                            <input type="text" id="auth" name="auth" placeholder="Запишите Сюда Ваш Ник (Английские буквы и цифры)" class="form-control" maxlength="32" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Введите пароль:</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-lock"></i></span>
                            </div>
                            <input type="text" id="pass" name="pass"
                                placeholder="Придумайте Пароль (Не меньше 6 символов)" pattern="^[\w]{6,32}$" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label><i class="fa fa-ruble"></i> Способ оплаты:</label>
                        <select id="how" name="how" class="form-control" required>
                            '.$free.'
                            '.$liqpay.'
                            '.$uni.'
                            '.$rob.'
                            '.$wmr.'
                        </select>
                    </div>
                    <input type="submit" name="submit" value="Купить" class="btn btn-block btn-outline-success btn-lg">
                    <div class="card-footer">
                        <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" checked>
                            <label for="customCheckbox2" class="custom-control-label"></label> Нажимая кнопку "Купить" вы соглашаетесь с условиями проекта.
                        </div>
                    </div>
            </div> </label>
            <div id="mess"></div>
            </form>';
?>