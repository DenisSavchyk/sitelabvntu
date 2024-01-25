<?php

	$server='46.174.50.7';
	$username='u26279_blog';
	$password='9D6p6C1w7L';
	$database='u26279_blog';
	$db = mysqli_connect($server,$username,$password,$database);

	if (!$db) {
		die("Connection failed: " . mysqli_connect_error());
	}

?>