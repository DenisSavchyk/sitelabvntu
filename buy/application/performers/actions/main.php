<?PHP
	require($_SERVER['DOCUMENT_ROOT'] . '/application/fast_connect.php');
	
	if(empty($_POST['phpaction'])) {
		exit('[Ошибка инициализации]');
	}
	
	if($_POST['token'] != $_SESSION['token']) {
		exit('[Ошибка токена]');
	}
	
	if(isset($_POST['authorized'])) {
		$auth = $usr->login($_POST['login'], $_POST['password']);
		
		if($auth['status']):
			exit(json_encode([
				'status' => '1'
			]));
		else:
			exit(json_encode([
				'status' => '2',
				'message' => $auth['message']
			]));
		endif;
	}
	
	if(isset($_POST['registration'])) {
		$reg = $usr->register($_POST['login'], $_POST['password'], $_POST['name']);
		
		if($reg['status']):
			exit(json_encode([
				'status' => '1'
			]));
		else:
			exit(json_encode([
				'status' => '2',
				'message' => $reg['message']
			]));
		endif;
	}
	
	if(isset($_POST['logout'])) {
		$out = $usr->logout();
		
		if($out['status']):
			exit(json_encode([
				'status' => '1'
			]));
		else:
			exit(json_encode([
				'status' => '2',
				'message' => $out['message']
			]));
		endif;
	}
	
	if(isset($_POST['buy'])) {
		if(product_buy($pdo, $_POST['id'], $_POST['address'] ? $_POST['address'] : null)):
			exit(json_encode([
				'status' => '1',
				'message' => 'Спасибо за покупку!'
			]));
		else:
			exit(json_encode([
				'status' => '2',
				'message' => 'Недостаточно средств'
			]));
		endif;
	}
	
	if(isset($_POST['add']) && $usr->is_access("a")) {
		if(0 < $_FILES['image']['error']):
			exit(json_encode([
				'status' => '2',
				'message' => $_FILES['image']['error']
			]));
		endif;
		
		$image = "/public/uploads/images/" . get_rand_name($_FILES['image']['name']);
		if(!move_uploaded_file($_FILES['image']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . $image)):
			exit(json_encode([
				'status' => '2',
				'message' => 'Ошибка загрузки главного изображения!'
			]));
		endif;
		
		if(0 < $_FILES['document']['error']):
			exit(json_encode([
				'status' => '2',
				'message' => $_FILES['document']['error']
			]));
		endif;
		
		$document = "/public/uploads/files/" . get_rand_name($_FILES['document']['name']);
		if(!move_uploaded_file($_FILES['document']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . $document)):
			exit(json_encode([
				'status' => '2',
				'message' => 'Ошибка загрузки документа!'
			]));
		endif;
		
		if(!$pdo->query("INSERT INTO `product`(`name`, `description`, `resource`, `price`, `discount`, `id_category`, `image`, `binding`) VALUES ('{$_POST['name']}', '{$_POST['description']}', '{$document}', '{$_POST['price']}', '{$_POST['discount']}', '{$_POST['category']}', '{$image}', '{$_POST['binding']}')")):
			exit(json_encode([
				'status' => '2',
				'message' => 'Ошибка инициализации SQL!'
			]));
		endif;
		
		$id_product = get_product_last_id($pdo);
		
		for($i = 0; $i < count($_FILES['file']['name']); $i++):
			if(0 < $_FILES['file']['error'][$i]):
				add_logs("Ошибка загрузки: " . $_FILES['file']['error'][$i]);
			endif;
			
			$img = "/public/uploads/images/" . get_rand_name($_FILES['file']['name'][$i]);
			if(!move_uploaded_file($_FILES['file']['tmp_name'][$i], $_SERVER['DOCUMENT_ROOT'] . $img)):
				add_logs("Ошибка загрузки: " . $_FILES['file']['name'][$i]);
			endif;
			
			if(!$pdo->query("INSERT INTO `product__images`(`id_product`, `image`) VALUES ('{$id_product}', '{$img}')")):
				add_logs("Ошибка добавления: " . $_FILES['file']['name'][$i]);
			endif;
		endfor;
		
		exit(json_encode([
			'status' => '1'
		]));
	}
	
	if(isset($_POST['delete'])) {
		if(!is_auth()):
			exit(json_encode([
				'status' => '2',
				'message' => 'Сначала авторизуйтесь!'
			]));
		endif;
		
		$purchases = get_purchases_data($pdo, $_POST['id']);
		
		if($purchases->id_user != $usr->get_user_data()->id):
			exit(json_encode([
				'status' => '2',
				'message' => 'У Вас нет этого товара!'
			]));
		else:
			if(!$pdo->query("UPDATE `users__purchases` SET `id_user`='0' WHERE `id`='{$_POST['id']}'")):
				exit(json_encode([
					'status' => '2',
					'message' => 'Ошибка инициализации SQL!'
				]));
			endif;
		endif;
		
		exit(json_encode([
			'status' => '1'
		]));
	}
	
	if(isset($_POST['replenish'])) {
		switch($_POST['system']):
			case "qiwi":
				$data = get_cashier_data($pdo, $_POST['system']);
				
				$Qiwi = new Qiwi($data->field);
				$result = $Qiwi->createBill(
					$Qiwi->generateId(), [
						'amount'             => $_POST['value'] * 1.00,
						'currency'           => 'RUB',
						'comment'            => "Пополнение баланса на " . $_SERVER['SERVER_NAME'],
						'expirationDateTime' => $Qiwi->getLifetimeByDay(1),
						'email'              => 'webmaster@' . $_SERVER['DOCUMENT_ROOT'],
						'account'            => $usr->get_user_data()->id,
						'successUrl'         => $_SERVER['SERVER_NAME'] . '/replenishment/success'
					]
				);

				exit(json_encode(['url' => $result['payUrl']]));
			break;
			
			case "free-kassa":
				$data = get_cashier_data($pdo, $_POST['system']);
				
				$hash = md5($data->id_shop
					. ':'
					. $_POST['value']
					. ':'
					. $data->field
					. ':'
					. $usr->get_user_data()->id
				);
				
				$url = "https://www.free-kassa.ru/merchant/cash.php";
				$url .= "?m=" . $data->id_shop;
				$url .= "&oa=" . $_POST['value'];
				$url .= "&o=" . $usr->get_user_data()->id;
				$url .= "&s=" . $hash;
				
				exit(json_encode(['url' => $url]));
			break;
		endswitch;
	}
	
	if(isset($_POST['download'])) {
		$purchases = get_purchases_data($pdo, $_POST['id_purchases']);
		$hash = gen_link($pdo, $purchases->id_product);
		
		exit(json_encode([
			'alert' => 'success',
			'message' => 'Генерация прошла успешно!',
			'file' => 'https://' . $_SERVER['SERVER_NAME'] . '/downloads/' . $hash,
			'name' => get_product_filename($pdo, $purchases->id_product)
		]));
	}
	
	if(isset($_POST['update_system'])):
		$versions = is_version($conf->version);
		if(!$versions['status']):
			exit(json_encode([
				'alert' => 'warning',
				'message' => 'Вы используете последнюю версию!'
			]));
		else:
			ignore_user_abort(1);
			set_time_limit(0);
		
			$new_version = $versions['versions'][$versions['pos_id'] + 1];
			$files = get_files($new_version['id_version']);
			
			$down = download_file([
				'temp' => 'application/temp',
				'url' => $files['resource'],
				'file' => date("YmdHis") . '.zip'
			]);
			
			if($down['status']):
				$zip = new ZipArchive;
				$file = $zip->open($down['file']);
				
				if($file === true):
					$zip->extractTo($_SERVER['DOCUMENT_ROOT'] . '/');
					
					if($zip->close()):
						$pdo->query("UPDATE `configs` SET `version`='{$new_version['version']}', `time_update`='{$new_version['time_create']}' WHERE 1");
						unlink($down['file']);
						
						require($_SERVER['DOCUMENT_ROOT'] . '/application/temp/update_pdo.php');
						
						exit(json_encode([
							'alert' => 'success',
							'message' => 'Успешное обновление!'
						]));
					endif;
					
					exit(json_encode([
						'alert' => 'error',
						'message' => 'Произошла ошибка!'
					]));
				endif;
			endif;
		endif;
		
		exit(json_encode([
			'alert' => 'warning',
			'message' => 'Резеврный ответ.. Обратитесь к разработчику!'
		]));
	endif;
	
	if(isset($_POST['js_qiwi'])):
		if(!$usr->is_access("b")):
			exit(json_encode([
				'alert' => 'warning',
				'message' => 'Недостаточно прав!'
			]));
		endif;
	
		switch($_POST['type']):
			case 'enable':
				if($pdo->query("UPDATE `configs__cashier` SET `enable`='{$_POST['params']}' WHERE `code`='qiwi'")):
					exit(json_encode([
						'alert' => 'success',
						'message' => 'Настройки успешно сохранены!'
					]));
				endif;
			break;
			
			case 'field':
				if($pdo->query("UPDATE `configs__cashier` SET `field`='{$_POST['params']}' WHERE `code`='qiwi'")):
					exit(json_encode([
						'alert' => 'success',
						'message' => 'Настройки успешно сохранены!'
					]));
				endif;
			break;
		endswitch;
	endif;
	
	if(isset($_POST['js_fk'])):
		if(!$usr->is_access("b")):
			exit(json_encode([
				'alert' => 'warning',
				'message' => 'Недостаточно прав!'
			]));
		endif;
	
		switch($_POST['type']):
			case 'enable':
				if($pdo->query("UPDATE `configs__cashier` SET `enable`='{$_POST['params']}' WHERE `code`='free-kassa'")):
					exit(json_encode([
						'alert' => 'success',
						'message' => 'Настройки успешно сохранены!'
					]));
				endif;
			break;
			
			case 'id_shop':
				if($pdo->query("UPDATE `configs__cashier` SET `id_shop`='{$_POST['params']}' WHERE `code`='free-kassa'")):
					exit(json_encode([
						'alert' => 'success',
						'message' => 'Настройки успешно сохранены!'
					]));
				endif;
			break;
			
			case 'field':
				if($pdo->query("UPDATE `configs__cashier` SET `field`='{$_POST['params']}' WHERE `code`='free-kassa'")):
					exit(json_encode([
						'alert' => 'success',
						'message' => 'Настройки успешно сохранены!'
					]));
				endif;
			break;
			
			case 'field_2':
				if($pdo->query("UPDATE `configs__cashier` SET `field_2`='{$_POST['params']}' WHERE `code`='free-kassa'")):
					exit(json_encode([
						'alert' => 'success',
						'message' => 'Настройки успешно сохранены!'
					]));
				endif;
			break;
		endswitch;
	endif;
	
	if(isset($_POST['js_main'])):
		if(!$usr->is_access("a")):
			exit(json_encode([
				'alert' => 'warning',
				'message' => 'Недостаточно прав!'
			]));
		endif;
	
		switch($_POST['type']):
			case 'title':
				if($pdo->query("UPDATE `configs` SET `title`='{$_POST['params']}' WHERE 1")):
					exit(json_encode([
						'alert' => 'success',
						'message' => 'Настройки успешно сохранены!'
					]));
				endif;
			break;
			
			case 'description':
				if($pdo->query("UPDATE `configs` SET `description`='{$_POST['params']}' WHERE 1")):
					exit(json_encode([
						'alert' => 'success',
						'message' => 'Настройки успешно сохранены!'
					]));
				endif;
			break;
			
			case 'keywords':
				if($pdo->query("UPDATE `configs` SET `keywords`='{$_POST['params']}' WHERE 1")):
					exit(json_encode([
						'alert' => 'success',
						'message' => 'Настройки успешно сохранены!'
					]));
				endif;
			break;
		endswitch;
	endif;