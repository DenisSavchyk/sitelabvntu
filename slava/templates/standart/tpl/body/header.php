<body class="sidebar-mini text-sm" style="height: auto;" cz-shortcut-listen="true">
  <div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-dark navbar-<?php echo $colour;?>">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="<?php echo $url;?>" class="nav-link">Главная</a>
        </li>
      </ul>


      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-bell"></i>
            <span class="badge badge-<?php echo $colour;?> navbar-badge">2</span>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <span class="dropdown-item dropdown-header">У вас 2 уведомления!</span>
            <div class="dropdown-divider"></div>
            <a href="<?php echo $url;?>rules" class="dropdown-item">
              <i class="fas fa-book mr-2"></i> Ознакомьтесь с правилами!
              <span class="float-right text-muted text-sm">3 мин</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="<?php echo $url;?>" class="dropdown-item">
              <i class="fas fa-shopping-cart mr-2"></i> Скидки <?php echo $discount;?> на всё!
              <span class="float-right text-muted text-sm">12 часов</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item dropdown-footer">Закрыть</a>
          </div>
        </li>
    </ul>
  </nav>