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
	
	echo ( isset( $_COOKIE['id'] ) && isset( $_COOKIE['hash'] ) ) ? '
					' : '
					<li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-book text-'.$colour.'""></i>
              <p>
                Личный кабинет
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item has-treeview menu-open">
                <div class="nav-link">
                <form style="margin: 10px;color:white;" action="auth/login.php" method="POST">
<div class="form-group">
<label><i class="fa fa-server"></i> Сервер:</label>
'.$eng->serverlist2().'
</div>
<div class="form-group">
<label><i class="fa fa-male"></i> Ваш Ник:</label>
<input type="text" style="color: #0DBBFF" name="login" validate="required" required="" placeholder="Ваш Ник на Сервере" class="form-control">
</div>
<div class="form-group">
<label><i class="fa fa-lock"></i> Ваш Пароль:</label>
<input type="password" style="color: #0DBBFF" name="password" validate="required" required="" placeholder="Ваш пароль" class="form-control">
</div>
<button type="submit" class="btn btn-success btn-flat btn-block">Войти В Кабинет</button>
<br>
</form>
</div>
              </li>
            </ul>
          </li>'; ?>