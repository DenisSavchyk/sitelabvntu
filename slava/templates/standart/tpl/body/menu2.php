<aside class="main-sidebar elevation-4 sidebar-dark-danger">
    <!-- Brand Logo -->
    <a style="text-align: center;" href="<?php echo $url;?>" class="brand-link navbar-<?php echo $colour;?>">
        <b> <span style="font-size:15px;" class="brand-text"><?php echo $site_name;?></span></b>
      </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
        <img class="img-circle elevation-2" src="<?php echo $avatar;?>">
        </div>
        <div class="info">
        <a href="<?php echo $url;?>auth" class="d-block">Вы: Пользователь</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column nav-flat" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
               <li style="text-align: center;" class="nav-header">Навигация</li>
                  <li class="nav-item">
                    <a href="<?php echo $url;?>" class="nav-link active">
                      <i class="nav-icon fas fa-home"></i>
                      <p>
                        Главная
                      </p>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a href="<?php echo $url;?>list" class="nav-link">
                      <i class="nav-icon fas fa-users"></i>
                      <p>
                        Список покупателей
                        <?php require_once "../templates/standart/tpl/body/log_u.php";?>
                      </p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?php echo $url;?>opisanie" class="nav-link">
                      <i class="nav-icon fa fa-diamond"></i>
                      <p>
                        Описание доната
                      </p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?php echo $url;?>monitoring" class="nav-link">
                      <i class="nav-icon fas fa-server"></i>
                      <p>
                        Мониторинг
                      </p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?php echo $url;?>donaters" class="nav-link">
                      <i class="nav-icon fas fa-users"></i>
                      <p>
                        Список донатеров
                        <?php require_once "../templates/standart/tpl/body/log_d.php";?>
                      </p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?php echo $url;?>rules" class="nav-link">
                      <i class="nav-icon fas fa-book"></i>
                      <p>
                        Правила
                      </p>
                    </a>
                  </li>
                    <ul class="nav nav-treeview" style="display: block;">
                      <li class="nav-item">
                        <center>
					<div id="vk_groups"></div>
				</center>
				<script type="text/javascript" src="//vk.com/js/api/openapi.js?152"></script>

				<script>VK.Widgets.Group("vk_groups", {mode: 0, width: "225", height: "250", color1: '#222D32', color2: '#4B646F', color3: '#4B646F'}, <?php echo $gruppa;?>);</script>
                      </li>
                    </ul>
                    <li style="text-align: center;" class="nav-header">Контакты</li>
                  <li class="nav-item">
                    <a href="<?php echo $sozdatel;?>" class="nav-link">
                      <i class="nav-icon fa fa-vk"></i>
                      <p>
                        Создатель проекта
                      </p>
                    </a>
                  </li>
                  <li style="text-align: center;" class="nav-header">Виджеты</li>
                  <center style="padding-top: 10px; display: block;">
				<a href="https://www.free-kassa.ru/"><img border="0" src="https://www.free-kassa.ru/img/fk_btn/21.png"
						height="33"></a></center>
                  </li>
                </ul>
              </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
    </aside>