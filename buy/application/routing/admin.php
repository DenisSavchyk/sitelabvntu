<?PHP
	/*
		Страница центра
	*/
	Routing::route('/admin', function() {
		if(!is_auth() || !$GLOBALS['usr']->is_access("a")) {
			header("Location: /");
		}
		
		$GLOBALS['tpl']->run();
		$GLOBALS['tpl']->set('{content}', $GLOBALS['tpl']->get_file("admin/main"));
		$GLOBALS['tpl']->execute();
	});

	/*
		Работа с товарами
	*/
	Routing::route('/admin/product/(\w+)', function($page) {
		if(!is_auth() || !$GLOBALS['usr']->is_access("a")) {
			header("Location: /");
		}
		
		$GLOBALS['tpl']->run();
		$GLOBALS['tpl']->set('{content}', $GLOBALS['tpl']->get_file("admin/product/" . $page));
		$GLOBALS['tpl']->execute();
	});
	
	/*
		Различные страницы
	*/
	Routing::route('/admin/(\w+)', function($page) {
		if(!is_auth() || !$GLOBALS['usr']->is_access("a")) {
			header("Location: /");
		}
		
		$GLOBALS['tpl']->run();
		$GLOBALS['tpl']->set('{content}', $GLOBALS['tpl']->get_file("admin/" . $page));
		$GLOBALS['tpl']->execute();
	});