<?PHP
	if(!file_exists($_SERVER['DOCUMENT_ROOT'] . '/application/configs/database.php')):
		require($_SERVER['DOCUMENT_ROOT'] . '/application/configs/install/view.php');
		exit;
	endif;
	
	@session_start();
	
	/*
		Загрузка библиотек
	*/
	spl_autoload_register(
		function($name) {
			$folders = scandir($_SERVER['DOCUMENT_ROOT'] . "/application/library/");
			
			for($i = 0; $i < sizeof($folders); $i++) {
				if(!is_file($folders[$i]) && $folders[$i][0] != '.') {
					$file = $_SERVER['DOCUMENT_ROOT'] . "/application/library/class." . strtolower($name) . ".php";
					
					if(file_exists($file)) {
						require_once($file);
						return;
					}
				}
			}
			
			echo "Class {$name} not found!";
		}
	);
	
	/*
		Подключение базы данных
	*/
	$db = include($_SERVER['DOCUMENT_ROOT'] . '/application/configs/database.php');
	
	try {
		$pdo = new PDO("mysql:host={$db['hostname']};dbname={$db['dataname']}", $db['username'], $db['password']);
		$pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
		$pdo->exec("set names utf8"); 
		
		require($_SERVER['DOCUMENT_ROOT'] . '/application/functions.php');
		
		$sth = $pdo->query("SELECT * FROM `configs` LIMIT 1");
		$sth->setFetchMode(PDO::FETCH_OBJ);
		$conf = $sth->fetch();
		
		$usr = new Users($pdo);
		$tpl = new Template($pdo, $conf);

		$GLOBALS['tpl'] = $tpl;
		$GLOBALS['usr'] = $usr;
		$GLOBALS['pdo'] = $pdo;
	}
	catch(PDOException $e) {
		print "Error!: " . $e->getMessage() . "<br>";
		die();
	}
	
	/*
		Загрузка маршрутизаторов страниц
	*/
	$folders = scandir($_SERVER['DOCUMENT_ROOT'] . "/application/routing/");
	for($i = 0; $i < sizeof($folders); $i++) {
		if(!is_file($folders[$i]) && $folders[$i][0] != '.') {
			$file = $_SERVER['DOCUMENT_ROOT'] . "/application/routing/{$folders[$i]}";
			
			if(file_exists($file)) {
				require_once($file);
			}
		}
	}
	
	Routing::execute($_SERVER['REQUEST_URI']);