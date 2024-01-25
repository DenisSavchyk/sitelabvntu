{sql select($off_data, $pdo, 'off_message', 'config__secondary', 'null', 0)}
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
					<!---{{$off_data[0]['off_message']}}--->
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





