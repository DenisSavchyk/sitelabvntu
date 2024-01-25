<?PHP
	class Template {
		private $pdo, $conf;
		var $temp = "";
		
		public function __construct($pdo = null, $conf = null) {
			if(isset($pdo)) {
				$this->pdo = $pdo;
			}
			
			if(isset($conf)) {
				$this->conf = $conf;
			}
		}
		
		public function run() {
			$file = $_SERVER['DOCUMENT_ROOT'] . '/public/templates/' . $this->conf->template . '/template/sample.tpl';
			
			if(file_exists($file)) {
				$this->temp .= file_get_contents($file);
			}
			else {
				$this->temp .= "[Ошибка загрузки шаблона: {$file}]<br>";
			}
		}
		
		public function get_file($file = "index") {
			$file = $_SERVER['DOCUMENT_ROOT'] . '/public/templates/' . $this->conf->template . '/template/' . $file . '.tpl';
			
			if(file_exists($file)) {
				return file_get_contents($file);
			}
			
			echo "[Ошибка загрузки шаблона: {$file}]<br>";
		}
		
		public function get_menu($who, $active) {
			return str_replace($active, 'active', $this->get_file($who));
		}
		
		public function set($who, $to) {
			$this->temp = str_replace($who, $to, $this->temp);
		}
		
		public function execute() {
			global $usr;
			
			$this->set('{assets}', 'https://' . $_SERVER['SERVER_NAME'] . '/public/templates/' . $this->conf->template . '/assets/');
			$this->set('{site_name}', 'https://' . $_SERVER['SERVER_NAME'] . '/');
			$this->set('{cache}', $this->conf->cache);
			
			$this->set('{title}', '');
			$this->set('{og:title}', '');
			$this->set('{og:description}', '');
			$this->set('{og:meta}', '');
			
			$_SESSION['token'] = md5($_SERVER['DOCUMENT_ROOT'] . time());
			$this->set('{token}', $_SESSION['token']);
			
			eval("?>" . $this->temp . "<?");
		}
	}