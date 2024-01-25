<?PHP
	require($_SERVER['DOCUMENT_ROOT'] . '/application/fast_connect.php');
	
	if(empty($_POST['phpaction'])):
		exit('[Ошибка инициализации]');
	endif;
	
	if($_POST['token'] != $_SESSION['token']):
		exit('[Ошибка токена]');
	endif;

	if(!is_auth()):
		exit('[Сначала авторизуйтесь]');
	endif;

	if($_POST['delete_product']):
		if(!$usr->is_access("a")):
			exit(json_encode([
				'alert' => 'error',
				'message' => 'Недостаточно прав!'
			]));
		endif;

		$pdo->query("DELETE FROM `product` WHERE `id`='$_POST['index']'");
		$pdo->query("DELETE FROM `product__images` WHERE `id_product`='$_POST['index']'");

		exit(json_encode([
			'alert' => 'success',
			'message' => 'Товар удалён!'
		]));
	endif;