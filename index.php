<?php 
require('db.php');
?>
<!DOCTYPE HTML>
<html lang="ua">
<head>
	<meta charset="UTF-8">
	<title>Головна - JetIKy.Health</title>
	<link rel="stylesheet" href="css/bootstrap.css">
	 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> 
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/fa/css/all.css">
	<link href="https://fonts.googleapis.com/css?family=Saira+Stencil+One&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Acme&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Ubuntu+Condensed&display=swap" rel="stylesheet">
	<link href="css/jquery-ui.css" rel="stylesheet">
	
</head>
<body>
	<div class="blog">
		<nav class="navbar navbar-expand-md navbar-light bg-dark">
		  <a class="nav--bar--color text-logo recent--logo" href="index.php"><img src="images/logo.svg" alt="" width="70" height="74"> JetIKy.Health</a>
		  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		    <span class="navbar-toggler-icon"></span>
		  </button>

		  <div class="collapse navbar-collapse" id="navbarSupportedContent">
		    <ul class="navbar-nav mr-auto">
		      <li class="nav-item active">
		        <a class="nav-link" href="index.php">Головна</a>
		      </li>
		      <li class="nav-item">
		        <a class="nav-link" href="about.php">Про нас</a>
		      </li>
		      <li class="nav-item">
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
				<div class="row" style="display: flex; justify-content: center;">
					<div class="col-md-11 col-sm-8 title">
						<h1 class="text-blog">Електронна система охорони здоров'я в JetIKy</h1>
						<p class="lead-para">-Цифрова трансформація системи охорони здоров’я <a href="/">JetIKy.Health</a></p>
					</div>
				</div>
			</div>

			<div class="container">
				<div class="row">
					<div class="col-md-8 col-sm-12">
						<?php 
						$page = 1;
						$query = "";
						if(isset($_GET['search'])){
							if(empty($_GET['search'])){
								header("Location: index.php");
							}else{
								$search = $_GET['search'];
								$query = "SELECT * FROM post WHERE postDate LIKE '%$search%' OR title LIKE '%$search%' OR category_name LIKE '%$search%' ";
							}
						}elseif(isset($_GET['category'])){
							$query = "SELECT * FROM post WHERE category_name = '$_GET[category]' ";
						}
						else{
							$query = "SELECT * FROM post ORDER BY postDate DESC";
						}
						$execution = mysqli_query($db, $query) or die(mysqli_error($db));
						if($execution){
							if(mysqli_num_rows($execution) > 0){
								while($result = mysqli_fetch_assoc($execution)){
									$result_id = $result['id'];
									$result_date = $result['postDate'];
									$result_title = $result['title'];
									$result_category = $result['category_name'];
									$result_image = $result['image'];
									$result_content = substr($result['content'], 0,150) . '.....';
									?>
									<div class="card blog_post">
										<!--<img src="admin/Upload/Image/<?php echo $result_image; ?>" class="card-img-top blog-img" alt="">-->
										<div class="card-body">
											<h3 class="card-title"><?php echo htmlentities($result_title); ?></h3>
											<p class="card-text extraText"><span><i class="far fa-edit"></i> <?php echo htmlentities($result_category); ?></span> <span>|</span> <span><i class="far fa-calendar-alt"></i> <?php echo htmlentities($result_date); ?></span></p> <br>
											<p class="card-text blogPara"><?php echo htmlentities($result_content); ?></p>
											<a href="single.php?id=<?php echo $result_id;?>" class="btn btn-danger"><i class="fad fa-book"></i> Детальніше</a>
										</div>
									</div>
									<?php
								}
							}else{
								echo "<span class='lead'>No results Found !!!</span>";
							}
						}else{

						}
						?>
						
					</div>

					<div class="col-md-4 col-xs-12">
						<div class="panel">
							<div class="panel-heading">
								<h4>Про нас *Коротко*</h4>
							</div>
							<div class="panel-body">
								<center><i class="fas fa-users"></i></center>
								<p>Зроблено для курсової роботи</p>
							</div>
						</div>

						<div class="panel">
							<div class="panel-heading">
								<h4>Недавні пости</h4>
							</div>
							<div class="panel-body">
								<?php 
								$sql = "SELECT * FROM post ORDER BY postDate LIMIT 5";
								$execution = mysqli_query($db, $sql) or die(mysqli_error($db));
								while($recent = mysqli_fetch_assoc($execution)){
									$id = $recent['id'];
									?>
									<ul class="recent">
										<li class="recent-items"><a href="single.php?id=<?php echo $id;?>"><?php echo $recent['title']; ?></a></li>
									</ul>
									<?php
								}
								?>
							</div>
						</div>

						<div class="panel">
							<div class="panel-heading">
								<h4>Категорії</h4>
							</div>
							<div class="panel-body">
								<?php 
								$sql = "SELECT name FROM category";
								$execution = mysqli_query($db, $sql) or die(mysqli_error($db));
								while($category = mysqli_fetch_assoc($execution)){
									?>
									<ul class="recent">
										<li class="recent-items"><a href="index.php?category=<?php echo $category['name'];?>"><?php echo $category['name']; ?></a></li>
									</ul>
									<?php
								}
								?>
								
							</div>
						</div>
					</div>
				</div>
			</div>
				
		</div>

		
		<footer class="container-fluid">
			<p>Міністерство Охорони Здоров'я JetIKy</p>
			
		</footer>
							
	</div>

	<script src="external/jquery/jquery.js"></script>
	<script src="jquery-ui.js"></script>

	<script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>