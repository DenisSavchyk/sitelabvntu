      <aside class="main-sidebar elevation-4 sidebar-dark-danger">
    <!-- Brand Logo -->
    <a style="text-align: center;" href="<?php echo $url;?>" class="brand-link navbar-<?php echo $colour;?>">
        <b> <span style="font-size:15px;" class="brand-text"><?php echo $site_name;?></span></b>
      </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 mb-3 d-flex">
        <div class="image">
        <img style="width: 3.1rem;" class="img-circle elevation-2" src="<?php echo $avatar;?>">
        </div>
        <div class="info">
        <b><a href="<?php echo $url;?>auth" class="d-block"><span style="color:#72C314">Вы:</span> Посетитель</a></b>
<a style="font-size:13px;" href="<?php echo $url;?>auth"><i class="fa fa-circle text-success"></i> Личный
кабинет</a>
        </div>
      </div>
      <style>
.sidebar-form, .nav-sidebar > .header {
  color: #4b646f;
    background: #222D32;
    overflow: hidden;
    text-overflow: clip;
    white-space: nowrap !important;
    padding: 10px 25px 10px 15px;
    font-size: 15px;
}
</style>
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column nav-flat" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
               <li class="header" style="font-size: 16px;">
<center>Навигация</center>
</li>
                  <li class="nav-item">
                    <a href="<?php echo $url;?>" class="nav-link active">
                      <i class="nav-icon fas fa-home  text-<?php echo $colour;?>"></i>
                      <p>
                        Главная
                      </p>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a href="<?php echo $url;?>list" class="nav-link">
                      <i class="nav-icon fas fa-users  text-<?php echo $colour;?>"></i>
                      <p>
                        Список покупателей
                        <?php require_once "templates/standart/tpl/body/log_u.php";?>
                      </p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?php echo $url;?>skins" class="nav-link">
                      <i class="nav-icon fas fa-male text-<?php echo $colour;?>"></i>
                      <span style="color:gold;text-shadow: 0 0 16px;">Купить скины</span>
                      <p>
                        <span class="right badge badge-success">New</span>
                      </p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?php echo $url;?>opisanie" class="nav-link">
                      <i class="nav-icon fa fa-diamond  text-<?php echo $colour;?>"></i>
                      <p>
                        Описание доната
                      </p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?php echo $url;?>monitoring" class="nav-link">
                      <i class="nav-icon fas fa-server  text-<?php echo $colour;?>"></i>
                      <p>
                        Мониторинг
                      </p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?php echo $url;?>donaters" class="nav-link">
                      <i class="nav-icon fas fa-users  text-<?php echo $colour;?>"></i>
                      <p>
                        Список донатеров
                        <?php require_once "templates/standart/tpl/body/log_d.php";?>
                      </p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?php echo $url;?>rules" class="nav-link">
                      <i class="nav-icon fas fa-book  text-<?php echo $colour;?>"></i>
                      <p>
                        Правила
                      </p>
                    </a>
                  </li>
                  <?php require_once "templates/standart/tpl/body/lkmenu.php";?>
                  <li class="header" style="font-size: 16px;">
<center>Группа VK</center>
</li>
                    <ul class="nav nav-treeview" style="display: block;">
                      <li class="nav-item">
                      
                        <center>
					<div id="vk_groups"></div>
				</center>
				<script type="text/javascript" src="//vk.com/js/api/openapi.js?152"></script>

				<script>VK.Widgets.Group("vk_groups", {mode: 0, width: "250", height: "250", color1: '#343A40', color2: '#4B646F', color3: '#4B646F'}, <?php echo $gruppa;?>);</script>
                      </li>
                    </ul>
                    <li class="header" style="font-size: 16px;">
<center>Контакты</center>
</li>
                  <li class="nav-item">
                    <a href="<?php echo $sozdatel;?>" class="nav-link">
                      <i class="nav-icon fa fa-vk text-<?php echo $colour;?>"></i>
                      <p>
                        Создатель проекта
                      </p>
                    </a>
                  </li>
                  <li class="header" style="font-size: 16px;">
<center>Виджеты</center>
</li>
                  <center style="padding-top: 10px; display: block;">
				<a href="https://www.free-kassa.ru/"><img border="0" src="https://www.free-kassa.ru/img/fk_btn/21.png"
						height="33"></a>
            </center>
                  </li>
                </ul>
              </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
    </aside>