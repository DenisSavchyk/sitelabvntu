<?PHP
	class Users {
		private $pdo;
		
		public function __construct($pdo = null) {
			if(empty($pdo)) {
				return;
			}
			
			$this->pdo = $pdo;
		}
		
		public function login($login, $password) {
			if(empty($login) || $login == '') {
				return [
					'status' => false,
					'message' => 'Вы не указали логин'
				];
			}
			
			if(empty($password) || $password == '') {
				return [
					'status' => false,
					'message' => 'Вы не указали пароль'
				];
			}
			
			$sth = $this->pdo->query("SELECT * FROM `users` WHERE `login`='{$login}' and `password`='".md5($password)."'");
			if(!$sth->rowCount()) {
				return [
					'status' => false,
					'message' => 'Неверный логин или пароль'
				];
			}
			
			$sth->setFetchMode(PDO::FETCH_OBJ);
			$row = $sth->fetch();
			
			$cache = md5(date("YmdHis") . time());
			
			setcookie("id", $row->id, strtotime('+30 days'), '/');
			setcookie("cache", $cache, strtotime('+30 days'), '/');
			
			if($this->pdo->query("UPDATE `users` SET `cache`='{$cache}' WHERE `id`='{$row->id}'")) {
				return [
					'status' => true,
					'message' => 'Успешная авторизация'
				];
			}
			
			return [
				'status' => false,
				'message' => 'Ошибка инъекции SQL..'
			];
		}
		
		public function register($login, $password, $name) {
			if(empty($login) || $login == '') {
				return [
					'status' => false,
					'message' => 'Вы не указали логин'
				];
			}
			
			if(empty($password) || $password == '') {
				return [
					'status' => false,
					'message' => 'Вы не указали пароль'
				];
			}
			
			if(empty($name) || $name == '') {
				return [
					'status' => false,
					'message' => 'Вы не указали имя'
				];
			}
			
			$sth = $this->pdo->query("SELECT * FROM `users` WHERE `login`='{$login}'");
			if($sth->rowCount()) {
				return [
					'status' => false,
					'message' => 'Логин уже занят!'
				];
			}
			
			if($this->pdo->query("INSERT INTO `users`(`login`, `password`, `name`, `cache`) VALUES ('{$login}', '".md5($password)."', '{$name}', 'none')")) {
				if($this->login($login, $password)) {
					return [
						'status' => true,
						'message' => 'Успешная авторизация'
					];
				}
			}
			
			return [
				'status' => false,
				'message' => 'Ошибка инъекции SQL..'
			];
		}
		
		public function logout() {
			if(!isset($_COOKIE['id'])) {
				return [
					'status' => false,
					'message' => 'Вы не авторизованы!'
				];
			}
			
			unset($_COOKIE['id']);
			setcookie('id', '', time(), '/');
			
			unset($_COOKIE['cache']);
			setcookie('cache', '', time(), '/');
			
			return [
				'status' => true,
				'message' => 'Успех'
			];
		}
		
		public function id() {
			return $_COOKIE['id'];
		}
		
		public function get_user_data($id = null) {
			if(empty($id)) {
				$id = $this->id();
			}
			
			$sth = $this->pdo->query("SELECT * FROM `users` WHERE `id`='{$id}'");
			$sth->setFetchMode(PDO::FETCH_OBJ);
			
			return $sth->fetch();
		}
		
		public function set_user_balance($id, $count) {
			return $this->pdo->query("UPDATE `users` SET `balance`='{$count}' WHERE `id`='{$id}'");
		}
		
		public function is_access($level) {
			$sth = $this->pdo->query("SELECT * FROM `users__groups` WHERE `id`='{$this->get_user_data()->id_group}'");
			$sth->setFetchMode(PDO::FETCH_OBJ);
			$row = $sth->fetch();
			
			if(strripos($row->access, $level) === false) {
				return false;
			}
			
			return true;
		}
	}