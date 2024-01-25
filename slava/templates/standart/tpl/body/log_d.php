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
	
	$nums = $db->n_rows( $db->m_query( "SELECT * FROM `bp_donaters`" ) );
	echo ' <span class="right badge badge-success">'.$nums.'</span>';	
?>