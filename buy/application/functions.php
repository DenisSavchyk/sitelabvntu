<?PHP
	function get_full_category($pdo = null, $id = 0) {
		$product = get_product_data($pdo, $id);
		$category = get_category_data($pdo, $product->id_category);
		
		return get_optgroup_name($pdo, $category->id_optgroup) . ' - ' . $category->name;
	}
	
	function get_category_data($pdo = null, $id = 0) {
		if(empty($pdo)) {
			return false;
		}
		
		$sth = $pdo->query("SELECT * FROM `product__category` WHERE `id`='{$id}'");
		if(!$sth->rowCount()) {
			return 'Неизвестно';
		}
		
		$sth->setFetchMode(PDO::FETCH_OBJ);
		return $sth->fetch();
	}
	
	function get_category_name($pdo = null, $id = 0) {
		if(empty($pdo)) {
			return false;
		}
		
		$sth = $pdo->query("SELECT * FROM `product__category` WHERE `id`='{$id}'");
		if(!$sth->rowCount()) {
			return 'Неизвестно';
		}
		
		$sth->setFetchMode(PDO::FETCH_OBJ);
		return $sth->fetch()->name;
	}
	
	function get_optgroup_name($pdo = null, $id = 0) {
		if(empty($pdo)) {
			return false;
		}
		
		$sth = $pdo->query("SELECT * FROM `product__optgroup` WHERE `id`='{$id}'");
		if(!$sth->rowCount()) {
			return 'Неизвестно';
		}
		
		$sth->setFetchMode(PDO::FETCH_OBJ);
		return $sth->fetch()->name;
	}
	
	function get_price($price, $discount = null) {
		if(isset($discount) || $discount > 0) {
			$price = $price - ($price / 100 * $discount);
		}
		
		return $price;
	}
	
	function is_auth() {
		global $usr;
		
		if(isset($_COOKIE['id']) && $usr->get_user_data($_COOKIE['id'])->cache == $_COOKIE['cache']) {
			return true;
		}
		
		return false;
	}
	
	function get_product_data($pdo = null, $id = 0) {
		if(empty($pdo)) {
			return false;
		}
		
		$sth = $pdo->query("SELECT * FROM `product` WHERE `id`='{$id}'");
		$sth->setFetchMode(PDO::FETCH_OBJ);
		
		return $sth->fetch();
	}
	
	function product_buy($pdo = null, $id = 0, $address = null) {
		if(empty($pdo)) {
			return false;
		}
		
		global $usr;
		
		$balance = $usr->get_user_data()->balance;
		$product = get_product_data($pdo, $id);
		$price = get_price($product->price, $product->discount);
		
		if($balance >= $price):
			if($usr->set_user_balance($_COOKIE['id'], $balance - $price)):
				if(isset($address)):
					return $pdo->query("INSERT INTO `users__purchases`(`id_user`, `id_product`, `price`, `time_buy`, `address`, `hash`) VALUES ('{$usr->id()}', '{$id}', '{$price}', '".time()."', '{$address}', '".md5($address)."')");
				else:
					return $pdo->query("INSERT INTO `users__purchases`(`id_user`, `id_product`, `price`, `time_buy`) VALUES ('{$usr->id()}', '{$id}', '{$price}', '".time()."')");
				endif;
			endif;
		endif;
		
		return false;
	}
	
	function get_file_volume($type = "MB", $size = 0) {
		switch($type):
			case "KB":
				return $size * 1024; break;
			case "MB":
				return $size * 1048576; break;
			case "GB":
				return $size * 1073741824; break;
			case "TB":
				return $size * 1099511627776; break;
		endswitch;
		
		return 0;
	}
	
	function get_rand_name($name) {
		return (md5(date("YmdHis") . time() . $name) . '_' . $name);
	}
	
	function add_logs($message) {
		return file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/application/logs/' . date("Ymd"), '[' . date("d.m.Y в H:i:s") . '] ' . $message . '<br>', FILE_APPEND);
	}
	
	function get_product_last_id($pdo = null) {
		$sth = $pdo->query("SELECT * FROM `product` WHERE 1 ORDER BY `id` DESC LIMIT 1");
		$sth->setFetchMode(PDO::FETCH_OBJ);
		
		return $sth->fetch()->id;
	}
	
	function get_purchases_data($pdo = null, $id = 0, $hash = null) {
		if(isset($hash)):
			$sth = $pdo->query("SELECT * FROM `users__purchases` WHERE `hash`='{$hash}'");
		else:
			$sth = $pdo->query("SELECT * FROM `users__purchases` WHERE `id`='{$id}'");
		endif;
		
		if(!$sth->rowCount()):
			return false;
		endif;
		
		$sth->setFetchMode(PDO::FETCH_OBJ);
		
		return $sth->fetch();
	}
	
	function get_cashier_data($pdo = null, $code = null) {
		$sth = $pdo->query("SELECT * FROM `configs__cashier` WHERE `code`='{$code}'");
		$sth->setFetchMode(PDO::FETCH_OBJ);
		
		return $sth->fetch();
	}
	
	function get_events_data($pdo = null, $code = null, $id = null) {
		if(isset($code)):
			$sth = $pdo->query("SELECT * FROM `events__category` WHERE `code`='{$code}'");
		else:
			$sth = $pdo->query("SELECT * FROM `events__category` WHERE `id`='{$id}'");
		endif;
		
		$sth->setFetchMode(PDO::FETCH_OBJ);
		
		return $sth->fetch();
	}
	
	function send_user_events($pdo = null, $id_event = null, $id_user = null, $message = null) {
		return $pdo->query("INSERT INTO `events`(`id_user`, `id_event`, `message`, `time_event`) VALUES ('{$id_user}', '{$id_event}', '{$message}', '".time()."')");
	}
	
	function gen_link($pdo = null, $id_product = null) {
		$hash = md5(date("YmdHis") . $id_product . time());
		if(!$pdo->query("INSERT INTO `product__links`(`id_product`, `hash`) VALUES ('{$id_product}', '{$hash}')")):
			return false;
		endif;
		
		return $hash;
	}
	
	function down_link($pdo = null, $hash = null) {
		$sth = $pdo->query("SELECT * FROM `product__links` WHERE `hash`='{$hash}'");
		
		if(!$sth->rowCount()):
			return false;
		endif;
		
		$sth->setFetchMode(PDO::FETCH_OBJ);
		$product = get_product_data($pdo, $sth->fetch()->id_product);
		
		if(file_exists($_SERVER['DOCUMENT_ROOT'] . $product->resource)):
			header("Content-Disposition: attachment; filename=" . get_product_filename($pdo, $product->id) . ";");
			
			if($a = file_get_contents($_SERVER['DOCUMENT_ROOT'] . $product->resource)):
				echo $a;
				$pdo->query("DELETE FROM `product__links` WHERE `hash`='{$hash}'");
				return true;
			endif;
		endif;
		
		return false;
	}
	
	function get_product_filename($pdo = null, $id_product = null) {
		$product = get_product_data($pdo, $id_product);
		
		if(file_exists($_SERVER['DOCUMENT_ROOT'] . $product->resource)):
			return (
				md5(
					date("YmdHis") . $id_product
				)
				. '.'
				. pathinfo($_SERVER['DOCUMENT_ROOT']
				. $product->resource, PATHINFO_EXTENSION)
			);
		endif;
	}
	
	function is_version($version) {
		$remote_versions = curl_get_process([
			'website' => 'https://api.worksma.ru',
			'data' => json_encode([
				'secret' => 'php_estore',
				'type' => 'versions'
			])
		]);
		
		$remote_versions = json_decode(gzdecode(
			$remote_versions
		), true);
		
		$index = 0;
		
		for($i = 0; $i < sizeof($remote_versions); $i++):
			if($version == $remote_versions[$i]['version']):
				$index = $i;
				break;
			endif;
		endfor;
		
		if(isset($remote_versions[$index + 1]['version'])
		&& $remote_versions[$index]['version'] < $remote_versions[$index + 1]['version']):
			return [
				'status' => true,
				'versions' => $remote_versions,
				'pos_id' => $index
			];
		endif;
		
		return [
			'status' => false,
			'versions' => $remote_versions,
			'pos_id' => $index
		];
	}
	
	function get_news() {
		$news = curl_get_process([
			'website' => 'https://api.worksma.ru',
			'data' => json_encode([
				'secret' => 'php_estore',
				'type' => 'news'
			])
		]);
		
		return json_decode(gzdecode(
			$news
		), true);
	}
	
	function get_files($id_version) {
		$files = curl_get_process([
			'website' => 'https://api.worksma.ru',
			'data' => json_encode([
				'secret' => 'php_estore',
				'type' => 'files',
				'id_version' => $id_version
			])
		]);
		
		return json_decode(gzdecode(
			$files
		), true);
	}
	
	function curl_get_process($data = []) {
		$ch = curl_init($data['website']);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data['data']);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_HEADER, false);
		$result = curl_exec($ch);
		curl_close($ch);
		
		return $result;
	}
	
	function download_file($data = []) {
		/*
			temp - дирекция, в которую будет загружаться файл.
			url - ссылка на файл, который нужно загрузить.
			file - название файла с расширением.
		*/
		if(isset($data['temp'])) {
			if(!file_exists("{$_SERVER['DOCUMENT_ROOT']}/{$data['temp']}")) {
				mkdir("{$_SERVER['DOCUMENT_ROOT']}/{$data['temp']}");
			}
		}
		
		$cInit = curl_init($data['url']);
		$fOpen = fopen("{$_SERVER['DOCUMENT_ROOT']}/{$data['temp']}/{$data['file']}", "wb");
		curl_setopt($cInit, CURLOPT_FILE, $fOpen);
		curl_setopt($cInit, CURLOPT_HEADER, 0);
		curl_exec($cInit);
		curl_close($cInit);
		
		/*
			status - отправляется статус закрытия файла (сохранение).
			file - отправляется дирекция с конечным файлом.
		*/
		return ['status' => fclose($fOpen), 'file' => "{$_SERVER['DOCUMENT_ROOT']}/{$data['temp']}/{$data['file']}"];
	}
	
	function get_description($id_version) {
		$description = curl_get_process([
			'website' => 'https://api.worksma.ru',
			'data' => json_encode([
				'secret' => 'php_estore',
				'type' => 'description',
				'id_version' => $id_version
			])
		]);
		
		return json_decode(gzdecode(
			$description
		), true);
	}
	
	function is_binding_product($pdo = null, $id_product = null, $hash = null) {
		if(empty($pdo) || empty($id_product) || empty($hash)):
			return false;
		endif;
		
		$purchases = get_purchases_data($pdo, null, $hash);
		
		if(!$purchases):
			return false;
		endif;
		
		if($purchases->id_product == $id_product):
			return true;
		endif;
		
		return false;
	}