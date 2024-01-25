<?php 
require('db.php');

if(isset($_POST['submit'])){
	if(!empty($_POST['submit'])){
		date_default_timezone_set('Asia/Manila');
		$time = time();
		$dateTime = strftime('%Y-%m-%d %H:%M:%S ',$time);
		$name = $_POST['name'];
		$email = $_POST['email'];
		$phone = $_POST['phone'];
		$message = $_POST['message'];
		$sql = "INSERT INTO contact (contactdate, name, email, phone, message) VALUES ('$dateTime', '$name', '$email', '$phone', '$message')";
		$execution = mysqli_query($db, $sql) or die(mysqli_error($db));
		if($execution){
			header("Location: index.php");
		}
		else{
			echo '<script>alert("Something Went Wrong!!!")</script>';
		}

	}
}
?>

<!DOCTYPE HTML>
<html lang="en" ng-app>
<head>
	<meta charset="UTF-8">
	<title>Записатися - JetIKy.Health</title>

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" href="css/style.css">
	<script src="https://kit.fontawesome.com/ca0905f6a5.js"></script>
	<link href="https://fonts.googleapis.com/css?family=Saira+Stencil+One&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Acme&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Ubuntu+Condensed&display=swap" rel="stylesheet">
	<link href="css/jquery-ui.css" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>


	
</head>
<body>
	<div class="blog blog_a">

		<nav class="navbar navbar-expand-md navbar-light bg-dark">
		  <a class="nav--bar--color text-logo recent--logo" href="index.php"><img src="images/logo.svg" alt="" width="70" height="74"> JetIKy.Health</a>
		  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		    <span class="navbar-toggler-icon"></span>
		  </button>

		  <div class="collapse navbar-collapse" id="navbarSupportedContent">
		    <ul class="navbar-nav mr-auto">
		      <li class="nav-item">
		        <a class="nav-link" href="index.php">Головна</a>
		      </li>
		      <li class="nav-item">
		        <a class="nav-link" href="about.php">Про нас</a>
		      </li>
		      <li class="nav-item active">
		        <a class="nav-link" href="contact.php">Записатися</a>
		      </li>
		      
		    </ul>
		    <form class="form-inline my-2 my-lg-0">
		      <input class="form-control mr-sm-2" id="autocomplete" type="search" placeholder="Пошук" aria-label="Search">
		      <button class="btn btn-outline-success my-2 my-sm-0" type="submit"><i class="fas fa-search"></i></button>
		    </form>
		  </div>
		</nav>

		<div class="container">
			<div>
				<div class="row">
					<div class="col-md-4 title">
						<h1 class="text-blog">Записатися</h1>
					</div>
				</div>
			</div>

			<div class="about">
				<div class="container">
					<div class="row contact-section">
						<div class="col-md-7">
							<h5 class="contactHeading">Введіть данні!</h5>

							<form method="POST" action="contact.php" name="frm">
								<div class="form-group">
									<input type="text" name="name" id="name" class="form-control" placeholder="ПІБ" ng-model="user.name" required> <span style="color:red; font-weight: bold;" ng-show="frm.name.$error.required"></span>
								</div>
								<div class="form-group">
									<input type="email" name="email" id="email" class="form-control" placeholder="Електронна пошта" ng-model="user.email" required> <span style="color:red; font-weight: bold;" ng-show="frm.email.$error.required"></span> <span style="color:red; font-weight: bold;" ng-show="frm.email.$error.email">Не вірний формат електроної пошти</span>
								</div>
								<div class="form-group">
									<input type="text" name="phone" id="phone" class="form-control" placeholder="Номер телефону" ng-model="user.phone" ng-minlength = "10" ng-maxlength = "12" required> <span style="color:red; font-weight: bold;" ng-show="frm.phone.$error.minlength">Номер меньше за 10 цифр</span> <span style="color:red; font-weight: bold;" ng-show="frm.phone.$error.required"></span> <span style="color:red; font-weight: bold;" ng-show="frm.phone.$error.maxlength">Номер занадто довгий</span>
								</div>
								<div class="form-group">
									<textarea name="message" cols="30" id="message" rows="5" class="form-control" ng-model="user.message" required></textarea> <span style="color:red; font-weight: bold;" ng-show="frm.message.$error.required"></span>
								</div>
								<div class="form-group">
									<input type="submit" name="submit" value="Відправити" id="mysubmit" class="btn btn-info submit" ng-disabled = "frm.$invalid">
								</div>
							</form>

						</div>
						<div class="col-md-5">
							<div class="address">
								<h5 class="contactHeading">Пам'ятка</h5>
								<div class="cont-panel">
									<h6>Обов'язки</h6>
									<p>Уточнюйте до якого лікаря вам потрібно</p>
									<p>Чітко описуйте проблему</p>
									<p>Перевіряйте введені дані</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
	
		</div>

		<div class="footer_c">
		<footer class="container-fluid">
			<p>Міністерство Охорони Здоров'я JetIKy</p>
			
		</footer>
</div>
	</div>

	<script src="external/jquery/jquery.js"></script>
	<script src="jquery-ui.js"></script>

	<script type="text/javascript">

		function IsValidName(name){
			if(name == ""){
				return false;
			}
			else{
				return true;
			}
		}
		
		function IsValidEmail(email){
            if (email.length <= 2) {
                return false;
            }
            if (email.indexOf("@") == -1) {
                return false;
            }

            var parts = email.split("@");
            var dot = parts[1].indexOf(".");
            var len = parts[1].length;
            var dotSplits = parts[1].split(".");
            var dotCount = dotSplits.length - 1;

            if (dot == -1 || dot < 2 || dotCount > 2) {
                return false;
            }

            for (var i = 0; i < dotSplits.length; i++) {
                if (dotSplits[i].length == 0) {
                    return false;
                }
            }
		};

		function IsValidPhone(phone){
			if((phone.length == 10) || (phone.length == 11)){
				return true;
			}
			else{
				return false;
			}
		}
		function IsValidMessage(message){
			if(message == ""){
				return false;
			}
			else{
				return true;
			}
		}


		function ValidContact(){
			var name = document.getElementById("name").value;
			var email = document.getElementById("email").value;
			var phone = document.getElementById("phone").value;
			var message = document.getElementById("message").value;
			
			if(!IsValidName(name)){
				alert("Name Required");
			}
			if(!IsValidEmail(email)){
				alert("Invalid Email");
			}
			if(!IsValidPhone(phone)){
				alert("Invalid Phone Number");
			}
			if(!IsValidMessage(message)){
				alert("Message Field Empty");
			}
			
			else{
				alert("Thankyou");
			}
		}
	</script>

	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>