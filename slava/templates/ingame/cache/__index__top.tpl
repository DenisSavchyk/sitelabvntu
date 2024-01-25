<div class="container-fluid wapper">
    <div class="content">
        <div class="header">
            <div class="container">
				<button class="menu-trigger btn btn-sm btn-light d-block d-lg-none collapsed" type="button" data-toggle="collapse" data-target="#hidden-menu"></button>
                <button class="reg-in btn btn-primary btn-sm d-none d-lg-block" data-toggle="modal" data-target="#registration">
                    <i class="far fa-user"></i>
                    Регистрация
                </button>
                <button class="auth-in btn btn-light btn-sm d-block d-lg-none" onclick="scrollToBox('.authorization');">
                    <i class="far fa-circle"></i>
                    Войти
                </button>

                <a class="logo" href="../">
                    <h1>
                        <?php echo $logo_name; ?>
                    </h1>
                </a>

				<ul>
	<?php for($i=0; $i < count($header_menu); $i++): ?>
	<li>
		<a href="<?php echo $header_menu[$i]['link']; ?>"><?php echo $header_menu[$i]['name']; ?></a>
	</li>
	<?php endfor; ?>
</ul>
            </div>
        </div>
        <div class="header-menu collapse d-none d-lg-block" id="hidden-menu">
            <div class="container">
                <ul class="collapsible-menu">
                    {menu}
                </ul>
            </div>
        </div>

        <div class="monitoring">
            <div class="container">
                <div class="info-line">
                    <span>Наши сервера</span>
                </div>
				<div class="monitoring-line owl-carousel" id="servers"></div>
				<script>get_servers2();</script>
            </div>
        </div>

		<!--
        <div id="authorization" class="modal fade">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title">Авторизация</h4>
                    </div>
                    <div class="modal-body">
                        <form id="user_login" class="authorization">
                            <input type="text" maxlength="30" class="form-control" id="user_loginn" placeholder="Логин">
                            <input type="password" maxlength="15" class="form-control" id="user_password" placeholder="Пароль">
                            <button type="submit" class="btn btn-primary btn-block">Войти</button>

                            <div id="result" class="disp-n">{conf_mess}</div>

                            <a href="../recovery" class="small">Забыли пароль?</a>
                            <a class="small ml-2" onclick="$('#authorization').modal('hide');" href="#" data-toggle="modal" data-target="#registration">Регистрация</a><br>

                            <?php if($auth_api->steam_api == 1): ?>
                                <a class="btn btn-outline-primary" href="" id="steam_link" title="Войти через Steam"><i class="m-icon icon-steam"></i></a>
                                <script>get_steam_auth_link();</script>
                            <?php endif; ?>
                            <?php if($auth_api->vk_api == 1): ?>
                                <a class="btn btn-outline-primary" href="" id="vk_link" title="Войти через Вконтакте"><i class="m-icon icon-vk"></i></a>
                                <script>get_vk_auth_link();</script>
                            <?php endif; ?>
                            <?php if($auth_api->fb_api == 1): ?>
                                <a class="btn btn-outline-primary" href="" id="fb_link" title="Войти через Facebook"><i class="m-icon icon-fb"></i></a>
                                <script>get_fb_auth_link();</script>
                            <?php endif; ?>
                        </form>
                        <script> send_form('#user_login', 'user_login();'); </script>
                    </div>
                </div>
            </div>
        </div>
		-->

        <div id="registration" class="modal fade">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title">Регистрация</h4>
                    </div>
                    <div class="modal-body">
                        <form id="user_registration" class="registration">
                            <input type="text" maxlength="30" class="form-control" id="reg_login" placeholder="Логин">
                            <input type="password" maxlength="15" class="form-control" id="reg_password" placeholder="Пароль">
                            <input type="password" maxlength="15" class="form-control" id="reg_password2" placeholder="Повторите пароль">
                            <input type="email" maxlength="255" class="form-control" id="reg_email" placeholder="E-mail <?php if($conf->conf_us == 1): ?>(Указывайте настоящий e-mail!)<?php endif; ?>">

                            <?php if($conf->privacy_policy == 1): ?>
                                <a class="privacy-policy" href="../processing-of-personal-data" target="_blank">Регистрируясь на данном сайте, Вы выражаете согласие на обработку персональных данных</a>
                            <?php endif; ?>

                            <?php if($conf->captcha != '2'): ?>
                                <div style="transform:scale(0.75);-webkit-transform:scale(0.75);transform-origin:0 0;-webkit-transform-origin:0 0;" data-theme="light" class="g-recaptcha clearfix" data-sitekey="<?php echo $conf->captcha; ?>"></div>
                                <script src='https://www.google.com/recaptcha/api.js?hl=ru'></script>
                            <?php endif; ?>

                            <div id="result2"></div>

                            <button type="submit" class="btn btn-primary btn-block mt-2">Зарегистрироваться</button>

                            <?php if($auth_api->vk_api == 1): ?>
                                <a class="btn btn-primary" onclick="$('#registration').modal('hide'); show_reg_modal('vk');" title="Зарегистрироваться через Вконтакте"><i class="m-icon icon-vk"></i></a>
                            <?php endif; ?>
                            <?php if($auth_api->steam_api == 1): ?>
                                <a class="btn btn-primary" onclick="$('#registration').modal('hide'); show_reg_modal('steam');" title="Зарегистрироваться через Steam"><i class="m-icon icon-steam"></i></a>
                            <?php endif; ?>
                            <?php if($auth_api->fb_api == 1): ?>
                                <a class="btn btn-primary" onclick="$('#registration').modal('hide'); show_reg_modal('fb');" title="Зарегистрироваться через Facebook"><i class="m-icon icon-fb"></i></a>
                            <?php endif; ?>
                        </form>
                        <script> send_form('#user_registration', 'registration();'); </script>
                    </div>
                </div>
            </div>
        </div>

        <div id="api_auth" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title">Регистрация</h4>
                    </div>
                    <div class="modal-body">
                        <p>Укажите, пожалуйста, свой e-mail.</p>

                        <input type="email" maxlength="255" class="form-control" id="api_email" placeholder="E-mail <?php if($conf->conf_us == 1): ?>(Требуется настоящий e-mail!)<?php endif; ?>">

                        <div id="result_api_reg"></div>
                        <button id="api_reg_btn" class="btn btn-primary btn-block mt-2" onclick="">Зарегистрироваться</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">