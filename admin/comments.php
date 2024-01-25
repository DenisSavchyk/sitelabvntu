<?php 
require('db.php');
session_start();
if(!isset($_SESSION['user_id']))
{
	header("Location:index.php");
}
?>

<?php 
if(isset($_GET['Approve_ID'])){
	if(!empty($_GET['Approve_ID'])){
		$sql = "UPDATE comment SET status = 'approved', approved_by = '$_SESSION[name]' WHERE id = '$_GET[Approve_ID]'";
		$execution = mysqli_query($db, $sql) or die(mysqli_error($db));
		if($execution){
			echo '<script>alert("COMMENT APPROVED")</script>';
			header("Location: comments.php");
		}
		else{
			echo '<script>alert("SOMETHING WENT WRONG PLEASE TRY AGAIN")</script>';
			header("Location: comments.php");
		}
	}
	else{
		header("Location: comments.php");
	}
}

if(isset($_GET['Unapprove_ID'])){
	if(!empty($_GET['Unapprove_ID'])){
		$sql = "UPDATE comment SET status = 'unapprove' WHERE id = '$_GET[Unapprove_ID]'";
		$execution = mysqli_query($db, $sql) or die(mysqli_error($db));
		if($execution){
			echo '<script>alert("COMMENT UNAPPROVED")</script>';
			header("Location: comments.php");
		}
		else{
			echo '<script>alert("SOMETHING WENT WRONG PLEASE TRY AGAIN")</script>';
			header("Location: comments.php");
		}
	}
	else{
		header("Location: comments.php");
	}
}
?>

<!DOCTYPE HTML>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Коментарі</title>

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

	<link rel="stylesheet" href="../css/style.css">
	<script src="https://kit.fontawesome.com/ca0905f6a5.js"></script>
	<link href="https://fonts.googleapis.com/css?family=Saira+Stencil+One&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Acme&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Ubuntu+Condensed&display=swap" rel="stylesheet">

	
</head>
<body>
	<div class="blog blog_m">

		<div class="container-fluid">
			<div class="sidebar">
				<h1 class="sidebar-heading">JetIKy.Health - <?php echo $_SESSION['name']; ?></h1>
				<div class="row">
					<div class="col-sm-2 sidebar">
						
						<ul id="side-menu" class="nav nav-pills navig">
							<li><a href="dashboard.php" class="nav-link links-sidebar"><i class="fas fa-columns"></i>&nbsp; Головна</a></li>
							<li><a href="newpost.php" class="nav-link links-sidebar"><i class="fas fa-list-alt"></i>&nbsp; Новий пост</a></li>
							<li><a href="category.php" class="nav-link links-sidebar"><i class="fas fa-tags"></i>&nbsp; Категорії</a></li>
							<li><a href="users.php" class="nav-link links-sidebar"><i class="fas fa-user-tie"></i>&nbsp; Корисувачі</a></li>
							<li class="active"><a href="comments.php" class="nav-link links-sidebar"><i class="fas fa-comments"></i>&nbsp; Коментарі</a></li>
							<li><a href="contact.php" class="nav-link links-sidebar"><i class="fas fa-comments"></i>&nbsp; Запити</a></li>
							<li><a href="../index.php" class="nav-link links-sidebar"><i class="fab fa-blogger-b"></i>&nbsp; Сторінка блогу</a></li>
							<li><a href="logout.php" class="nav-link links-sidebar"><i class="fas fa-sign-out-alt"></i>&nbsp; Вийти</a></li>
						</ul>
					</div>

					<div class="col-sm-10 content">

						<?php 
						$sql = "SELECT * FROM comment WHERE status = 'approved' ORDER BY commentdate";
						$execution = mysqli_query($db, $sql) or die(mysqli_error($db));
						$postNo = 1;
						?>
							<h3 class="post-heading">Підтверджені коментарі</h3>

							<table class="table">
								<thead class="thead-dark">
									<tr>
										<th>Номер</th>
										<th>Дата створення</th>
										<th>Електронна пошта</th>
										<th>Коментар</th>
										<th>Коментар від</th>
										<th>Дія</th>
									</tr>
								</thead>
								<tbody>
									<?php
									while($result = mysqli_fetch_assoc($execution)){
										$commentid = $result['id'];
										$dateadded = $result['commentdate'];
										$commentemail = $result['email'];
										$commentcontent = $result['comment'];
										$commentstatus = $result['status'];
										$approved_by = $result['approved_by']; ?>
										<tr>
											<td><?php echo $postNo; ?></td>
											<td><?php echo $dateadded; ?></td>
											<td><?php echo $commentemail; ?></td>
											<td><?php echo $commentcontent; ?></td>
											<td><?php echo $approved_by; ?></td>
											<td><a href="comments.php?Unapprove_ID=<?php echo $commentid;?>"><button class="btn btn-danger"><i class="far fa-thumbs-down"></i></button></a></td>
										</tr>
										<?php
										$postNo++;
									}?>
						

								</tbody>
							</table>

						<?php 
						$sql = "SELECT * FROM comment WHERE status = 'unapprove' ORDER BY commentdate";
						$execution = mysqli_query($db, $sql) or die(mysqli_error($db));
						$postNo = 1;
						?>
							<h3 class="post-heading">Не підтверджені коментарі</h3>

							<table class="table">
								<thead class="thead-dark">
									<tr>
										<th>Номер</th>
										<th>Дата створення</th>
										<th>Електронна пошта</th>
										<th>Кометар</th>
										<th>Статус</th>
										<th>Дія</th>
									</tr>
								</thead>
								<tbody>
									<?php
									while($result = mysqli_fetch_assoc($execution)){
										$commentid = $result['id'];
										$dateadded = $result['commentdate'];
										$commentemail = $result['email'];
										$commentcontent = $result['comment'];
										$commentstatus = $result['status'];
										?>
										<tr>
											<td><?php echo $postNo; ?></td>
											<td><?php echo $dateadded; ?></td>
											<td><?php echo $commentemail; ?></td>
											<td><?php echo $commentcontent; ?></td>
											<td><?php echo $commentstatus; ?></td>
											<td><a href="comments.php?Approve_ID=<?php echo $commentid;?>"><button class="btn btn-success"><i class="far fa-thumbs-up"></i></button></a></td>
										</tr>
										<?php
										$postNo++;
									}?>
						

								</tbody>
							</table>
						


						<!-- <footer class="container-fluid">
							<p>MADE BY MYDACHEK</p>
							<p> <a href=""><i class="fab fa-facebook-square"></i></a> | <a href=""><i class="fab fa-instagram"></i></a> | <a href=""><i class="fab fa-linkedin"></i></a> </p>
						</footer> -->
					</div>
				</div>
			</div>
		</div>
		
	</div>


	<!-- Script Files -->
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>