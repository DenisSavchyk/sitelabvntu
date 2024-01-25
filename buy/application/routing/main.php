<?PHP
	/*
		Главная страница
	*/
	Routing::route('/', function() {
		global $tpl;
		
		$tpl->run();
		$tpl->set('{content}', $tpl->get_file("main/index"));
		$tpl->execute();
	});
	
	/*
		Регистрация пользователей
	*/
	Routing::route('/register', function() {
		if(is_auth()) {
			header("Location: /");
		}
		
		global $tpl;
		
		$tpl->run();
		$tpl->set('{content}', $tpl->get_file("main/register"));
		$tpl->set('{title}', 'Регистрация профиля');
		$tpl->set('{og:title}', 'Регистрация профиля');
		
		$tpl->execute();
	});
	
	/*
		Управление кошельком
	*/
	Routing::route('/wallet', function() {
		if(!is_auth()) {
			header("Location: /");
		}
		
		global $tpl;
		
		$tpl->run();
		$tpl->set('{content}', $tpl->get_file("main/wallet"));
		$tpl->execute();
	});
	
	/*
		Ответ пополнения баланса
	*/
	Routing::route('/replenishment/(\w+)', function($result) {
		switch($result):
			case 'info':
				if(isset($_GET['qiwi']) && $_GET['qiwi'] == 'get'):
					$data = json_decode(file_get_contents('php://input'), true);
					
					if(array_key_exists('HTTP_X_API_SIGNATURE_SHA256', $_SERVER)):
						$signature = $_SERVER['HTTP_X_API_SIGNATURE_SHA256'];
					else:
						$signature = null;
					endif;
					
					if(empty($data) || empty($signature)):
						http_response_code(204);
						exit('Error: [empty data]');
					endif;
					
					$pay_number = $data['bill']['billId'];
					$status     = $data['bill']['status']['value'];
					$amount     = $data['bill']['amount']['value'];
					$id_user    = $data['bill']['customer']['account'];
					
					$conf_qiwi = get_cashier_data($GLOBALS['pdo'], 'qiwi');
					
					$Qiwi = new Qiwi($conf_qiwi->field);
					
					if(!$Qiwi->checkNotificationSignature($signature, $data, $conf_qiwi->field) && $status == 'PAID'):
						http_response_code(400);
						exit("Error: [bad signature]");
					else:
						$data_user = $GLOBALS['usr']->get_user_data($id_user);
						
						if(empty($data_user->id)):
							http_response_code(404);
							exit('Error: [User does not exist]');
						else:
							if($GLOBALS['usr']->set_user_balance($id_user, ($data_user->balance + intval($amount)))):
								send_user_events($GLOBALS['pdo'], get_events_data($GLOBALS['pdo'], 'balance')->id, $data_user->id, "Пополнение через систему Qiwi на сумму " . intval($amount) . " руб.");
								add_logs('Пополнение баланса через систему Qiwi на сумму: ' . intval($amount) . ' руб. пользователем ' . $data_user->login);
							endif;
						endif;
						
						exit('OK');
					endif;
				endif;
				
				if(isset($_POST['MERCHANT_ID']) && isset($_POST['MERCHANT_ORDER_ID'])):
					$conf_fk = get_cashier_data($GLOBALS['pdo'], 'free-kassa');
					$hash = md5($conf_fk->id_shop
						. ':'
						. $_POST['AMOUNT']
						. ':'
						. $conf_fk->field_2
						. ':'
						. $_POST['MERCHANT_ORDER_ID']
					);
					add_logs("Начинаем сверять {$hash} - {$_POST['SIGN']}");
					if($hash == $_POST['SIGN']):
						$data_user = $GLOBALS['usr']->get_user_data($_POST['MERCHANT_ORDER_ID']);
						
						if($GLOBALS['usr']->set_user_balance($_POST['MERCHANT_ORDER_ID'], ($data_user->balance + $_POST['AMOUNT']))):
							send_user_events($GLOBALS['pdo'], get_events_data($GLOBALS['pdo'], 'balance')->id, $data_user->id, "Пополнение через систему Free-kassa на сумму " . $_POST['AMOUNT'] . " руб.");
							add_logs('Пополнение баланса через систему Free-kassa на сумму: ' . $_POST['AMOUNT'] . ' руб. пользователем ' . $data_user->login);
						endif;
						
						exit('ok');
					endif;
				endif;
				
				break;
			default:
				$tpl = $GLOBALS['tpl'];
				
				$tpl->run();
				$tpl->set('{content}', $tpl->get_file("main/replenishment/" . $result));
				$tpl->set('{title}', 'Результат пополнения');
				$tpl->set('{og:title}', 'Результат пополнения');
				$tpl->execute();
				
				break;
		endswitch;
	});
	
	/*
		Ответ пополнения баланса для Qiwi
	*/
	Routing::route('/replenishment/qiwi/info', function() {
		$data = json_decode(file_get_contents('php://input'), true);
		
		if(array_key_exists('HTTP_X_API_SIGNATURE_SHA256', $_SERVER)):
			$signature = $_SERVER['HTTP_X_API_SIGNATURE_SHA256'];
		else:
			$signature = null;
		endif;
		
		if(empty($data) || empty($signature)):
			http_response_code(204);
			exit('Error: [empty data]');
		endif;
		
		$pay_number = $data['bill']['billId'];
		$status     = $data['bill']['status']['value'];
		$amount     = $data['bill']['amount']['value'];
		$id_user    = $data['bill']['customer']['account'];
		
		$conf_qiwi = get_cashier_data($GLOBALS['pdo'], 'qiwi');
		
		$Qiwi = new Qiwi($conf_qiwi->field);
		
		if(!$Qiwi->checkNotificationSignature($signature, $data, $conf_qiwi->field) && $status == 'PAID'):
			http_response_code(400);
			exit("Error: [bad signature]");
		else:
			$data_user = $GLOBALS['usr']->get_user_data($id_user);
			
			if(empty($data_user->id)):
				http_response_code(404);
				exit('Error: [User does not exist]');
			else:
				if($GLOBALS['usr']->set_user_balance($id_user, ($data_user->balance + intval($amount)))):
					send_user_events($GLOBALS['pdo'], get_events_data($GLOBALS['pdo'], 'balance')->id, $data_user->id, "Пополнение через систему Qiwi на сумму " . intval($amount) . " руб.");
					add_logs('Пополнение баланса через систему Qiwi на сумму: ' . intval($amount) . ' руб. пользователем ' . $data_user->login);
				endif;
			endif;
			
			exit('OK');
		endif;
	});
	
	/*
		Управление покупками
	*/
	Routing::route('/purchases', function() {
		if(!is_auth()) {
			header("Location: /");
		}
		
		global $tpl;
		
		$tpl->run();
		$tpl->set('{content}', $tpl->get_file("main/purchases"));
		$tpl->set('{title}', 'Мои покупки');
		$tpl->execute();
	});
	
	/*
		Страница продукта
	*/
	Routing::route('/product/(\d+)', function($id) {
		global $tpl, $pdo;
		
		$sth = $pdo->query("SELECT * FROM `product` WHERE `id`='{$id}'");
		
		if(!$sth->rowCount()) {
			header("Location: /404");
		}
		
		$sth->setFetchMode(PDO::FETCH_OBJ);
		$product = get_product_data($pdo, $sth->fetch()->id);
		
		$tpl->run();
		$tpl->set('{content}', $tpl->get_file("main/product"));
		
		$tpl->set('{title}', $product->name);
		$tpl->set('{og:title}', $product->name);
		$tpl->set('{og:description}', strip_tags($product->description));
		$tpl->set('{og:meta}', '{site_name}' . $product->image);
		
		$tpl->set('{id}', $id);
		$tpl->execute();
	});
	
	/*
		Ошибка 404
	*/
	Routing::route('/404', function() {
		global $tpl;
		
		$tpl->run();
		$tpl->set('{content}', $tpl->get_file("errors/404"));
		$tpl->execute();
	});
	
	/*
		Загрузка файлов
	*/
	Routing::route('/downloads/(\w+)', function($hash) {
		if(!down_link($GLOBALS['pdo'], $hash)):
			header("Location: /404");
		endif;
	});
	
	/*
		API система
	*/
	Routing::route('/api/binding/(\w+)/(\w+)', function($id_product, $address) {
		if(is_binding_product($GLOBALS['pdo'], $id_product, $address)):
			exit('yes');
		else:
			exit('no');
		endif;
	});