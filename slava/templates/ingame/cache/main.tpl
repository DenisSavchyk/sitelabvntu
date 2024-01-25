<?php
$steam_group_link = ' # ';
$logo_name = ' <span>Ингейм | INGAME - Комплекс игровых серверов CS:GO</span> ';
$slider[0]['title'] = '<b> НОВЫЙ 2020</b>  ';
$slider[0]['content'] = '';
$slider[0]['image'] = ' ../templates/ingame/img/slide-1.jpg ';
$slider[0]['link'] = ' ../ ';
$header_menu[0]['name'] = ' <i class="fab fa-teamspeak"></i> Стать админом';
$header_menu[0]['link'] = ' ../forum/topic?id=11 ';
$header_menu[1]['name'] = ' <i class="fal fa-badge-percent"></i> Акции и скидки ';
$header_menu[1]['link'] = ' ../discounts ';
$header_menu[2]['name'] = ' <i class="fal fa-suitcase"></i> Кейсы ';
$header_menu[2]['link'] = ' ../cases ';
$header_menu[3]['name'] = ' <i class="fal fa-headset"></i> Техподдержка ';
$header_menu[3]['link'] = ' ../support ';
$header_menu[4]['name'] = ' <i class="fal fa-poll-h"></i> Правила ';
$header_menu[4]['link'] = ' ../rules ';
$vertical_menu_2[0]['name'] = ' Главная страница ';
$vertical_menu_2[0]['link'] = ' ../ ';
$vertical_menu_2[1]['name'] = ' Новости проекта ';
$vertical_menu_2[1]['link'] = ' ../news ';
$vertical_menu_2[2]['name'] = ' Магазин услуг ';
$vertical_menu_2[2]['link'] = ' ../store ';
$vertical_menu_2[3]['name'] = ' Форум ';
$vertical_menu_2[3]['link'] = ' ../forum ';
$vertical_menu_2[4]['name'] = ' Техподдержка ';
$vertical_menu_2[4]['link'] = ' ../support ';
$vertical_menu_3[0]['name'] = ' Пользователи ';
$vertical_menu_3[0]['link'] = ' ../users ';
$vertical_menu_3[1]['name'] = ' Администраторы ';
$vertical_menu_3[1]['link'] = ' ../admins ';
$vertical_menu_3[2]['name'] = ' Список банов ';
$vertical_menu_3[2]['link'] = ' ../banlist ';
$vertical_menu_3[3]['name'] = ' Заявки на разбан ';
$vertical_menu_3[3]['link'] = ' ../bans ';
$vertical_menu_3[4]['name'] = ' Игровая статистика ';
$vertical_menu_3[4]['link'] = ' ../stats ';
$vertical_menu_4[0]['name'] = ' Об обработке персональных данных ';
$vertical_menu_4[0]['link'] = ' ../processing-of-personal-data ';
$vertical_menu_4[1]['name'] = ' Политика конфиденциальности ';
$vertical_menu_4[1]['link'] = ' ../privacy-policy ';
$vertical_menu_4[2]['name'] = ' Правила ';
$vertical_menu_4[2]['link'] = ' ../rules ';
$vertical_menu_4[3]['name'] = ' FAQ ';
$vertical_menu_4[3]['link'] = ' ../faq ';
$footer_description = '
Игровой проект evolutiongame.ru. Комплекс игровых серверов CS:GO.
Добро пожаловать на игровой портал по игре Counter-Strike Global Offensive. 

';

?>
<!DOCTYPE html>
<html lang="ru">
	<?php if($conf->off == 1 and $sessionadmin != 'yes'): ?>
		<?php $off_data = db_get_info($pdo, "off_message", "config__secondary", 'null', 0); ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">



    <title>Evolutiongame.ru - сайт на реконструкции</title>


    <link href="assets/css/bootstrap.css" rel="stylesheet">
	<link href="assets/css/bootstrap-theme.css" rel="stylesheet">
	<link href="assets/css/font-awesome.css" rel="stylesheet">


    <link href="assets/css/style.css" rel="stylesheet">
    

  </head>

  <body>

	<div id="wrapper">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h1>Обновление</h1>
					<h2 class="subtitle">Сайт на реконструкции</h2> 
					<!---<?php echo $off_data[0]['off_message']; ?>--->
					<div id="countdown">Планируемая дата открытия: **.**.2020 **:00 (MSK)</div> 
					
				</div>
				
			</div>
			<div class="row">
				<div class="col-lg-6 col-lg-offset-3">
						<p class="copyright"> </p>
                        
				</div>
			</div>		
		</div>
	</div>
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/jquery.countdown.min.js"></script>
	<script type="text/javascript">
      $('#countdown').countdown('2019/09/20', function(event) {
        $(this).html(event.strftime('%w недель %d дней <br /> %H:%M:%S'));
      });


</body> 
</html>






	<?php else: ?>
		{content}
	<?php endif; ?>
</html>