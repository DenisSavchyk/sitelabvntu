<?PHP
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
		$GLOBALS['pdo'] = $pdo;
		
		require($_SERVER['DOCUMENT_ROOT'] . '/application/functions.php');
		
		$sth = $pdo->query("SELECT * FROM `configs` LIMIT 1");
		$sth->setFetchMode(PDO::FETCH_OBJ);
		$conf = $sth->fetch();
		
		$usr = new Users($pdo);
		$GLOBALS['usr'] = $usr;
		
		$tpl = new Template($pdo, $conf);
		$GLOBALS['tpl'] = $tpl;
	}
	catch(PDOException $e) {
		print "Error!: " . $e->getMessage() . "<br>";
		die();
	}