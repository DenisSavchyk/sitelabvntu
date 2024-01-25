<?php

if (!defined("BLOCK")) {
    exit("\r\n        <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" /> \r\n        <html>\r\n            <head>\r\n                <title>404 Not Found</title>\r\n            </head>\r\n            <body>\r\n                <h1>Not Found</h1>\r\n                <p>The requested URL was not found on this server.</p>\r\n            </body>\r\n        </html>");
}
if (!empty($_POST["site"])) {
    $db->m_query("UPDATE `" . DBcfg::$dbopt["db_prefix"] . "_settings` SET `site_name` = '" . $db->m_escape(trim($_POST["site_name"])) . "' WHERE `id` = '1' LIMIT 1");
    $msg = alert_mess("Название сайта изменено!") . "<meta http-equiv='refresh' content='1; url=http://" . $_SERVER[HTTP_HOST] . $_SERVER[REQUEST_URI] . "' >";
}
if (!empty($_POST["owner"])) {
    $db->m_query("UPDATE `" . DBcfg::$dbopt["db_prefix"] . "_settings` SET `sozdatel` = '" . $db->m_escape(trim($_POST["vk_owner"])) . "' WHERE `id` = '1' LIMIT 1");
    $msg = alert_mess("ВК создателя изменено!") . "<meta http-equiv='refresh' content='1; url=http://" . $_SERVER[HTTP_HOST] . $_SERVER[REQUEST_URI] . "' >";
}
if (!empty($_POST["group"])) {
    $db->m_query("UPDATE `" . DBcfg::$dbopt["db_prefix"] . "_settings` SET `gruppa` = '" . $db->m_escape(trim($_POST["vk_group"])) . "' WHERE `id` = '1' LIMIT 1");
    $msg = alert_mess("Группа ВК изменена!") . "<meta http-equiv='refresh' content='1; url=http://" . $_SERVER[HTTP_HOST] . $_SERVER[REQUEST_URI] . "' >";
}
if (!empty($_POST["email"])) {
    $db->m_query("UPDATE `" . DBcfg::$dbopt["db_prefix"] . "_settings` SET `email` = '" . $db->m_escape(trim($_POST["email_owner"])) . "' WHERE `id` = '1' LIMIT 1");
    $msg = alert_mess("Почта изменена!") . "<meta http-equiv='refresh' content='1; url=http://" . $_SERVER[HTTP_HOST] . $_SERVER[REQUEST_URI] . "' >";
}
if (!empty($_POST["discount"])) {
    $db->m_query("UPDATE `" . DBcfg::$dbopt["db_prefix"] . "_settings` SET `discount` = '" . $db->m_escape(trim($_POST["discount_value"])) . "' WHERE `id` = '1' LIMIT 1");
    $msg = alert_mess("Скидка на услуги изменена!") . "<meta http-equiv='refresh' content='1; url=http://" . $_SERVER[HTTP_HOST] . $_SERVER[REQUEST_URI] . "' >";
}
if (!empty($_POST["page"])) {
    $db->m_query("UPDATE `" . DBcfg::$dbopt["db_prefix"] . "_settings` SET `num_page` = '" . $db->m_escape(trim($_POST["num_page"])) . "' WHERE `id` = '1' LIMIT 1");
    $msg = alert_mess("К-ло на страницу изменено!") . "<meta http-equiv='refresh' content='1; url=http://" . $_SERVER[HTTP_HOST] . $_SERVER[REQUEST_URI] . "' >";
}
if (!empty($_POST["colour"])) {
    $db->m_query("UPDATE `" . DBcfg::$dbopt["db_prefix"] . "_settings` SET `colour` = '" . $db->m_escape(trim($_POST["colour_site"])) . "' WHERE `id` = '1' LIMIT 1");
    $msg = alert_mess("Цвет сайта изменен!") . "<meta http-equiv='refresh' content='1; url=http://" . $_SERVER[HTTP_HOST] . $_SERVER[REQUEST_URI] . "' >";
}
if (!empty($_POST["avatar"])) {
    $db->m_query("UPDATE `" . DBcfg::$dbopt["db_prefix"] . "_settings` SET `avatar` = '" . $db->m_escape(trim($_POST["avatar_site"])) . "' WHERE `id` = '1' LIMIT 1");
    $msg = alert_mess("Аватар покупателя изменен!") . "<meta http-equiv='refresh' content='1; url=http://" . $_SERVER[HTTP_HOST] . $_SERVER[REQUEST_URI] . "' >";
}
if (!empty($_POST["free_on"])) {
    if (trim($_POST["free_on"]) == "Включить Free-Kassa") {
        $_POST["free_on"] = 1;
        $fv = "включена";
    } else {
        $_POST["free_on"] = 0;
        $fv = "выключена";
    }
    $db->m_query("UPDATE `" . DBcfg::$dbopt["db_prefix"] . "_settings` SET `free_on` = '" . $db->m_escape(trim($_POST["free_on"])) . "' WHERE `id` = '1' LIMIT 1");
    $msg = alert_mess("Free-Kassa " . $fv . "!") . "<meta http-equiv='refresh' content='1; url=http://" . $_SERVER[HTTP_HOST] . $_SERVER[REQUEST_URI] . "' >";
}
if (!empty($_POST["flogin"])) {
    $db->m_query("UPDATE `" . DBcfg::$dbopt["db_prefix"] . "_settings` SET `free_login` = '" . $db->m_escape(trim($_POST["free_login"])) . "' WHERE `id` = '1' LIMIT 1");
    $msg = alert_mess("ID магазина изменен!") . "<meta http-equiv='refresh' content='1; url=http://" . $_SERVER[HTTP_HOST] . $_SERVER[REQUEST_URI] . "' >";
}
if (!empty($_POST["fpass1"])) {
    $db->m_query("UPDATE `" . DBcfg::$dbopt["db_prefix"] . "_settings` SET `free_pass1` = '" . $db->m_escape(trim($_POST["free_pass1"])) . "' WHERE `id` = '1' LIMIT 1");
    $msg = alert_mess("Секретный ключ 1 изменен!") . "<meta http-equiv='refresh' content='1; url=http://" . $_SERVER[HTTP_HOST] . $_SERVER[REQUEST_URI] . "' >";
}
if (!empty($_POST["fpass2"])) {
    $db->m_query("UPDATE `" . DBcfg::$dbopt["db_prefix"] . "_settings` SET `free_pass2` = '" . $db->m_escape(trim($_POST["free_pass2"])) . "' WHERE `id` = '1' LIMIT 1");
    $msg = alert_mess("Секретный ключ 2 изменен!") . "<meta http-equiv='refresh' content='1; url=http://" . $_SERVER[HTTP_HOST] . $_SERVER[REQUEST_URI] . "' >";
}
if (!empty($_POST["lp_on"])) {
    if (trim($_POST["lp_on"]) == "Включить LiqPay") {
        $_POST["lp_on"] = 1;
        $fv = "включен";
    } else {
        $_POST["lp_on"] = 0;
        $fv = "выключен";
    }
    $db->m_query("UPDATE `" . DBcfg::$dbopt["db_prefix"] . "_settings` SET `lp_on` = '" . $db->m_escape(trim($_POST["lp_on"])) . "' WHERE `id` = '1' LIMIT 1");
    $msg = alert_mess("LiqPay " . $fv . "!") . "<meta http-equiv='refresh' content='1; url=http://" . $_SERVER[HTTP_HOST] . $_SERVER[REQUEST_URI] . "' >";
}
if (!empty($_POST["pbkey"])) {
    $db->m_query("UPDATE `" . DBcfg::$dbopt["db_prefix"] . "_settings` SET `lp_pbkey` = '" . $db->m_escape(trim($_POST["lp_pbkey"])) . "' WHERE `id` = '1' LIMIT 1");
    $msg = alert_mess("Публичный ключ изменен!") . "<meta http-equiv='refresh' content='1; url=http://" . $_SERVER[HTTP_HOST] . $_SERVER[REQUEST_URI] . "' >";
}
if (!empty($_POST["prkey"])) {
    $db->m_query("UPDATE `" . DBcfg::$dbopt["db_prefix"] . "_settings` SET `lp_prkey` = '" . $db->m_escape(trim($_POST["lp_prkey"])) . "' WHERE `id` = '1' LIMIT 1");
    $msg = alert_mess("Приватный ключ изменен!") . "<meta http-equiv='refresh' content='1; url=http://" . $_SERVER[HTTP_HOST] . $_SERVER[REQUEST_URI] . "' >";
}
if (!empty($_POST["uni_on"])) {
    if (trim($_POST["uni_on"]) == "Включить UnitPay") {
        $_POST["uni_on"] = 1;
        $fv = "включена";
    } else {
        $_POST["uni_on"] = 0;
        $fv = "выключена";
    }
    $db->m_query("UPDATE `" . DBcfg::$dbopt["db_prefix"] . "_settings` SET `uni_on` = '" . $db->m_escape(trim($_POST["uni_on"])) . "' WHERE `id` = '1' LIMIT 1");
    $msg = alert_mess("UnitPay " . $fv . "!") . "<meta http-equiv='refresh' content='1; url=http://" . $_SERVER[HTTP_HOST] . $_SERVER[REQUEST_URI] . "' >";
}
if (!empty($_POST["purse"])) {
    $db->m_query("UPDATE `" . DBcfg::$dbopt["db_prefix"] . "_settings` SET `uni_purse` = '" . $db->m_escape(trim($_POST["uni_purse"])) . "' WHERE `id` = '1' LIMIT 1");
    $msg = alert_mess("Публичный ключ изменен!") . "<meta http-equiv='refresh' content='1; url=http://" . $_SERVER[HTTP_HOST] . $_SERVER[REQUEST_URI] . "' >";
}
if (!empty($_POST["uni_secret"])) {
    $db->m_query("UPDATE `" . DBcfg::$dbopt["db_prefix"] . "_settings` SET `uni_secret_key` = '" . $db->m_escape(trim($_POST["uni_secret_key"])) . "' WHERE `id` = '1' LIMIT 1");
    $msg = alert_mess("Приватный ключ изменен!") . "<meta http-equiv='refresh' content='1; url=http://" . $_SERVER[HTTP_HOST] . $_SERVER[REQUEST_URI] . "' >";
}
if (!empty($_POST["robo_on"])) {
    if (trim($_POST["robo_on"]) == "Включить RoboKassa") {
        $_POST["robo_on"] = 1;
        $fv = "включена";
    } else {
        $_POST["robo_on"] = 0;
        $fv = "выключена";
    }
    $db->m_query("UPDATE `" . DBcfg::$dbopt["db_prefix"] . "_settings` SET `robo_on` = '" . $db->m_escape(trim($_POST["robo_on"])) . "' WHERE `id` = '1' LIMIT 1");
    $msg = alert_mess("RoboKassa " . $fv . "!") . "<meta http-equiv='refresh' content='1; url=http://" . $_SERVER[HTTP_HOST] . $_SERVER[REQUEST_URI] . "' >";
}
if (!empty($_POST["rlogin"])) {
    $db->m_query("UPDATE `" . DBcfg::$dbopt["db_prefix"] . "_settings` SET `robo_login` = '" . $db->m_escape(trim($_POST["robo_login"])) . "' WHERE `id` = '1' LIMIT 1");
    $msg = alert_mess("ID магазина изменен!") . "<meta http-equiv='refresh' content='1; url=http://" . $_SERVER[HTTP_HOST] . $_SERVER[REQUEST_URI] . "' >";
}
if (!empty($_POST["rpass1"])) {
    $db->m_query("UPDATE `" . DBcfg::$dbopt["db_prefix"] . "_settings` SET `robo_pass1` = '" . $db->m_escape(trim($_POST["robo_pass1"])) . "' WHERE `id` = '1' LIMIT 1");
    $msg = alert_mess("Секретный ключ 1 изменен!") . "<meta http-equiv='refresh' content='1; url=http://" . $_SERVER[HTTP_HOST] . $_SERVER[REQUEST_URI] . "' >";
}
if (!empty($_POST["rpass2"])) {
    $db->m_query("UPDATE `" . DBcfg::$dbopt["db_prefix"] . "_settings` SET `robo_pass2` = '" . $db->m_escape(trim($_POST["robo_pass2"])) . "' WHERE `id` = '1' LIMIT 1");
    $msg = alert_mess("Секретный ключ 2 изменен!") . "<meta http-equiv='refresh' content='1; url=http://" . $_SERVER[HTTP_HOST] . $_SERVER[REQUEST_URI] . "' >";
}
if (!empty($_POST["wmr_on"])) {
    if (trim($_POST["wmr_on"]) == "Включить WebMoney") {
        $_POST["wmr_on"] = 1;
        $fv = "включен";
    } else {
        $_POST["wmr_on"] = 0;
        $fv = "выключен";
    }
    $db->m_query("UPDATE `" . DBcfg::$dbopt["db_prefix"] . "_settings` SET `wmr_on` = '" . $db->m_escape(trim($_POST["wmr_on"])) . "' WHERE `id` = '1' LIMIT 1");
    $msg = alert_mess("WebMoney " . $fv . "!") . "<meta http-equiv='refresh' content='1; url=http://" . $_SERVER[HTTP_HOST] . $_SERVER[REQUEST_URI] . "' >";
}
if (!empty($_POST["wmpurse"])) {
    $db->m_query("UPDATE `" . DBcfg::$dbopt["db_prefix"] . "_settings` SET `wmr_purse` = '" . $db->m_escape(trim($_POST["wm_purse"])) . "' WHERE `id` = '1' LIMIT 1");
    $msg = alert_mess("Публичный ключ изменен!") . "<meta http-equiv='refresh' content='1; url=http://" . $_SERVER[HTTP_HOST] . $_SERVER[REQUEST_URI] . "' >";
}
if (!empty($_POST["wmr_secret"])) {
    $db->m_query("UPDATE `" . DBcfg::$dbopt["db_prefix"] . "_settings` SET `wmr_secret_key` = '" . $db->m_escape(trim($_POST["wmr_secret_key"])) . "' WHERE `id` = '1' LIMIT 1");
    $msg = alert_mess("Приватный ключ изменен!") . "<meta http-equiv='refresh' content='1; url=http://" . $_SERVER[HTTP_HOST] . $_SERVER[REQUEST_URI] . "' >";
}
if (!empty($_POST["discount_on"])) {
    if (trim($_POST["discount_on"]) == "Включить Скидку") {
        $_POST["discount_on"] = 1;
        $fv = "включена";
    } else {
        $_POST["discount_on"] = 0;
        $fv = "выключена";
    }
    $db->m_query("UPDATE `" . DBcfg::$dbopt["db_prefix"] . "_settings` SET `discount_on` = '" . $db->m_escape(trim($_POST["discount_on"])) . "' WHERE `id` = '1' LIMIT 1");
    $msg = alert_mess("Скидка " . $fv . "!") . "<meta http-equiv='refresh' content='1; url=http://" . $_SERVER[HTTP_HOST] . $_SERVER[REQUEST_URI] . "' >";
}
if (!empty($_POST["discount"])) {
    $db->m_query("UPDATE `" . DBcfg::$dbopt["db_prefix"] . "_settings` SET `discount` = '" . $db->m_escape(trim($_POST["discount_value"])) . "' WHERE `id` = '1' LIMIT 1");
    $msg = alert_mess("Скидка на услуги изменена!") . "<meta http-equiv='refresh' content='1; url=http://" . $_SERVER[HTTP_HOST] . $_SERVER[REQUEST_URI] . "' >";
}
if ($discount_on == 1) {
    $c6 = "danger";
    $v6 = "Выключить";
} else {
    $c6 = "success";
    $v6 = "Включить";
}
if ($free_on == 1) {
    $c = "danger";
    $v = "Выключить";
} else {
    $c = "success";
    $v = "Включить";
}
if ($lp_on == 1) {
    $c2 = "danger";
    $v2 = "Выключить";
} else {
    $c2 = "success";
    $v2 = "Включить";
}
if ($uni_on == 1) {
    $c3 = "danger";
    $v3 = "Выключить";
} else {
    $c3 = "success";
    $v3 = "Включить";
}
if ($robo_on == 1) {
    $c4 = "danger";
    $v4 = "Выключить";
} else {
    $c4 = "success";
    $v4 = "Включить";
}
if ($wmr_on == 1) {
    $c5 = "danger";
    $v5 = "Выключить";
} else {
    $c5 = "success";
    $v5 = "Включить";
}
echo "\r\n<div class=\"col-md-6\">\r\n<div class=\"box box-primary\">\r\n<div class=\"box-header\">\r\n<i class=\"fa fa-list\"></i>\r\n<h3 class=\"box-title\">Основные настройки</h3>\r\n</div>\r\n<div class=\"box-body\">\r\n<form role=\"form\" method=\"POST\" autocomplete=\"off\">\r\n    <label>Название сайта:</label>\r\n    <div class=\"input-group input-group-sm\">\r\n        <input type=\"text\" value=\"" . $site_name . "\" name=\"site_name\" class=\"form-control\">\r\n        <span class=\"input-group-btn\">\r\n            <input class=\"btn btn-primary\" name=\"site\" type=\"submit\" value=\"Изменить\" />\r\n        </span>\r\n    </div>\r\n</form>\r\n<br>\r\n<form role=\"form\" method=\"POST\" autocomplete=\"off\">\r\n    <label>ВК создателя (с https):</label>\r\n    <div class=\"input-group input-group-sm\">\r\n        <input type=\"text\" value=\"" . $sozdatel . "\" name=\"vk_owner\" class=\"form-control\">\r\n        <span class=\"input-group-btn\">\r\n            <input class=\"btn btn-primary\" name=\"owner\" type=\"submit\" value=\"Изменить\" />\r\n        </span>\r\n    </div>\r\n</form>\r\n<br>\r\n<form role=\"form\" method=\"POST\" autocomplete=\"off\">\r\n    <label>ID группы вк (только цифры):</label>\r\n    <div class=\"input-group input-group-sm\">\r\n        <input type=\"text\" value=\"" . $gruppa . "\" name=\"vk_group\" class=\"form-control\">\r\n        <span class=\"input-group-btn\">\r\n            <input class=\"btn btn-primary\" name=\"group\" type=\"submit\" value=\"Изменить\" />\r\n        </span>\r\n    </div>\r\n</form>\r\n<br>\r\n<form role=\"form\" method=\"POST\" autocomplete=\"off\">\r\n    <label>Email создателя:</label>\r\n    <div class=\"input-group input-group-sm\">\r\n        <input type=\"text\" value=\"" . $email . "\" name=\"email_owner\" class=\"form-control\">\r\n        <span class=\"input-group-btn\">\r\n            <input class=\"btn btn-primary\" name=\"email\" type=\"submit\" value=\"Изменить\" />\r\n        </span>\r\n    </div>\r\n</form>\r\n<br>\r\n<form role=\"form\" method=\"POST\" autocomplete=\"off\">\r\n  <input class=\"btn btn-" . $c6 . "\" name=\"discount_on\" value=\"" . $v6 . " Скидку\" type=\"submit\">\r\n</form>\r\n<form role=\"form\" method=\"POST\" autocomplete=\"off\">\r\n    <label>Скидка на услуги:</label>\r\n    <div class=\"input-group input-group-sm\">\r\n        <input type=\"text\" value=\"" . $discount . "\" name=\"discount_value\" class=\"form-control\">\r\n        <span class=\"input-group-btn\">\r\n            <input class=\"btn btn-primary\" name=\"discount\" type=\"submit\" value=\"Изменить\" />\r\n        </span>\r\n    </div>\r\n</form>\r\n<br>\r\n<form role=\"form\" method=\"POST\" autocomplete=\"off\">\r\n  <label>Кол-во покупателей на 1 страницу:</label>\r\n    <div class=\"input-group input-group-sm\">\r\n        <input type=\"text\" value=\"" . $num_page . "\" name=\"num_page\" class=\"form-control\">\r\n        <span class=\"input-group-btn\">\r\n            <input class=\"btn btn-primary\" name=\"page\" type=\"submit\" value=\"Изменить\" />\r\n        </span>\r\n    </div>\r\n</form>\r\n<br>\r\n<form role=\"form\" method=\"POST\" autocomplete=\"off\">\r\n  <label>Цвет всего сайта:</label>\r\n    <div class=\"input-group input-group-sm\">\r\n        <input type=\"text\" value=\"" . $colour . "\" name=\"colour_site\" class=\"form-control\">\r\n        <span class=\"input-group-btn\">\r\n            <input class=\"btn btn-primary\" name=\"colour\" type=\"submit\" value=\"Изменить\" />\r\n        </span>\r\n    </div>\r\n</form>\r\n<br>\r\n<form role=\"form\" method=\"POST\" autocomplete=\"off\">\r\n  <label>Аватар пользователя:</label>\r\n    <div class=\"input-group input-group-sm\">\r\n        <input type=\"text\" value=\"" . $avatar . "\" name=\"avatar_site\" class=\"form-control\">\r\n        <span class=\"input-group-btn\">\r\n            <input class=\"btn btn-primary\" name=\"avatar\" type=\"submit\" value=\"Изменить\" />\r\n        </span>\r\n    </div>\r\n</form>\r\n<br>\r\n<label>Крон(не трогать):</label>\r\n<div class=\"input-group input-group-sm\">\r\n<input disabled type=\"text\" value=\"" . $cron . "\" name=\"cron_value\" class=\"form-control\">\r\n  <span class=\"input-group-btn\">\r\n    <button disabled class=\"btn btn-primary\" type=\"submit\">Изменить</button>\r\n  </span>\r\n</div>\r\n\r\n</div></div>\r\n\r\n    </div>\r\n    \r\n\r\n\r\n    <div class=\"col-md-6\">\r\n    <div class=\"box box-primary\">\r\n<div class=\"box-header\">\r\n<i class=\"fa fa-list\"></i>\r\n<h3 class=\"box-title\">Настройки оплаты</h3>\r\n</div>\r\n<div class=\"box-body\">\r\n\r\n<label>Настройки Free-Kassa:</label>\r\n<form role=\"form\" method=\"POST\" autocomplete=\"off\">\r\n  <input class=\"btn btn-" . $c . "\" name=\"free_on\" value=\"" . $v . " Free-Kassa\" type=\"submit\">\r\n</form>\r\n<br>\r\n<form role=\"form\" method=\"POST\" autocomplete=\"off\">\r\n  <label>ID магазина:</label>\r\n    <div class=\"input-group input-group-sm\">\r\n        <input type=\"text\" value=\"" . $free_login . "\" name=\"free_login\" class=\"form-control\">\r\n        <span class=\"input-group-btn\">\r\n            <input class=\"btn btn-primary\" name=\"flogin\" type=\"submit\" value=\"Изменить\" />\r\n        </span>\r\n    </div>\r\n</form>\r\n<form role=\"form\" method=\"POST\" autocomplete=\"off\">\r\n  <label>Секретный ключ 1:</label>\r\n    <div class=\"input-group input-group-sm\">\r\n        <input type=\"text\" value=\"" . $free_pass1 . "\" name=\"free_pass1\" class=\"form-control\">\r\n        <span class=\"input-group-btn\">\r\n            <input class=\"btn btn-primary\" name=\"fpass1\" type=\"submit\" value=\"Изменить\" />\r\n        </span>\r\n    </div>\r\n</form>\r\n<form role=\"form\" method=\"POST\" autocomplete=\"off\">\r\n  <label>Секретный ключ 2:</label>\r\n    <div class=\"input-group input-group-sm\">\r\n        <input type=\"text\" value=\"" . $free_pass2 . "\" name=\"free_pass2\" class=\"form-control\">\r\n        <span class=\"input-group-btn\">\r\n            <input class=\"btn btn-primary\" name=\"fpass2\" type=\"submit\" value=\"Изменить\" />\r\n        </span>\r\n    </div>\r\n</form>\r\n<hr>\r\n<label>Настройки LiqPay:</label>\r\n<form role=\"form\" method=\"POST\" autocomplete=\"off\">\r\n  <input class=\"btn btn-" . $c2 . "\" name=\"lp_on\" value=\"" . $v2 . " LiqPay\" type=\"submit\">\r\n</form>\r\n<br>\r\n<form role=\"form\" method=\"POST\" autocomplete=\"off\">\r\n  <label>Публичный ключ:</label>\r\n    <div class=\"input-group input-group-sm\">\r\n        <input type=\"text\" value=\"" . $lp_pbkey . "\" name=\"lp_pbkey\" class=\"form-control\">\r\n        <span class=\"input-group-btn\">\r\n            <input class=\"btn btn-primary\" name=\"pbkey\" type=\"submit\" value=\"Изменить\" />\r\n        </span>\r\n    </div>\r\n</form>\r\n<form role=\"form\" method=\"POST\" autocomplete=\"off\">\r\n  <label>Приватный ключ:</label>\r\n    <div class=\"input-group input-group-sm\">\r\n        <input type=\"text\" value=\"" . $lp_prkey . "\" name=\"lp_prkey\" class=\"form-control\">\r\n        <span class=\"input-group-btn\">\r\n            <input class=\"btn btn-primary\" name=\"prkey\" type=\"submit\" value=\"Изменить\" />\r\n        </span>\r\n    </div>\r\n</form>\r\n<hr>\r\n<label>Настройки UnitPay:</label>\r\n<form role=\"form\" method=\"POST\" autocomplete=\"off\">\r\n  <input disabled class=\"btn btn-" . $c3 . "\" name=\"uni_on\" value=\"" . $v3 . " UnitPay\" type=\"submit\">\r\n</form>\r\n<br>\r\n<form role=\"form\" method=\"POST\" autocomplete=\"off\">\r\n  <label>Публичный ключ:</label>\r\n    <div class=\"input-group input-group-sm\">\r\n        <input disabled type=\"text\" value=\"" . $uni_purse . "\" name=\"uni_purse\" class=\"form-control\">\r\n        <span class=\"input-group-btn\">\r\n            <input disabled class=\"btn btn-primary\" name=\"purse\" type=\"submit\" value=\"Изменить\" />\r\n        </span>\r\n    </div>\r\n</form>\r\n<form role=\"form\" method=\"POST\" autocomplete=\"off\">\r\n  <label>Приватный ключ:</label>\r\n    <div class=\"input-group input-group-sm\">\r\n        <input disabled type=\"text\" value=\"" . $uni_secret_key . "\" name=\"uni_secret_key\" class=\"form-control\">\r\n        <span class=\"input-group-btn\">\r\n            <input disabled class=\"btn btn-primary\" name=\"uni_secret\" type=\"submit\" value=\"Изменить\" />\r\n        </span>\r\n    </div>\r\n</form>\r\n<hr>\r\n<label>Настройки RoboKassa:</label>\r\n<form role=\"form\" method=\"POST\" autocomplete=\"off\">\r\n  <input disabled class=\"btn btn-" . $c4 . "\" name=\"robo_on\" value=\"" . $v4 . " RoboKassa\" type=\"submit\">\r\n</form>\r\n<br>\r\n<form role=\"form\" method=\"POST\" autocomplete=\"off\">\r\n  <label>ID магазина:</label>\r\n    <div class=\"input-group input-group-sm\">\r\n        <input disabled type=\"text\" value=\"" . $robo_login . "\" name=\"robo_login\" class=\"form-control\">\r\n        <span class=\"input-group-btn\">\r\n            <input disabled class=\"btn btn-primary\" name=\"rlogin\" type=\"submit\" value=\"Изменить\" />\r\n        </span>\r\n    </div>\r\n</form>\r\n<form role=\"form\" method=\"POST\" autocomplete=\"off\">\r\n  <label>Секретный ключ 1:</label>\r\n    <div class=\"input-group input-group-sm\">\r\n        <input disabled type=\"text\" value=\"" . $robo_pass1 . "\" name=\"robo_pass1\" class=\"form-control\">\r\n        <span class=\"input-group-btn\">\r\n            <input disabled class=\"btn btn-primary\" name=\"rpass1\" type=\"submit\" value=\"Изменить\" />\r\n        </span>\r\n    </div>\r\n</form>\r\n<form role=\"form\" method=\"POST\" autocomplete=\"off\">\r\n  <label>Секретный ключ 2:</label>\r\n    <div class=\"input-group input-group-sm\">\r\n        <input disabled type=\"text\" value=\"" . $robo_pass2 . "\" name=\"robo_pass2\" class=\"form-control\">\r\n        <span class=\"input-group-btn\">\r\n            <input disabled class=\"btn btn-primary\" name=\"rpass2\" type=\"submit\" value=\"Изменить\" />\r\n        </span>\r\n    </div>\r\n</form>\r\n<hr>\r\n<label>Настройки WebMoney:</label>\r\n<form role=\"form\" method=\"POST\" autocomplete=\"off\">\r\n  <input disabled class=\"btn btn-" . $c5 . "\" name=\"wmr_on\" value=\"" . $v5 . " WebMoney\" type=\"submit\">\r\n</form>\r\n<br>\r\n<form role=\"form\" method=\"POST\" autocomplete=\"off\">\r\n  <label>Публичный ключ:</label>\r\n    <div class=\"input-group input-group-sm\">\r\n        <input disabled type=\"text\" value=\"" . $purse . "\" name=\"wm_purse\" class=\"form-control\">\r\n        <span class=\"input-group-btn\">\r\n            <input disabled class=\"btn btn-primary\" name=\"wmpurse\" type=\"submit\" value=\"Изменить\" />\r\n        </span>\r\n    </div>\r\n</form>\r\n<form role=\"form\" method=\"POST\" autocomplete=\"off\">\r\n  <label>Приватный ключ:</label>\r\n    <div class=\"input-group input-group-sm\">\r\n        <input disabled type=\"text\" value=\"" . $secret_key . "\" name=\"wmr_secret_key\" class=\"form-control\">\r\n        <span class=\"input-group-btn\">\r\n            <input disabled class=\"btn btn-primary\" name=\"wmr_secret\" type=\"submit\" value=\"Изменить\" />\r\n        </span>\r\n    </div>\r\n</form>\r\n</div></div>\r\n\r\n    </div>";
if (isset($msg)) {
    echo $msg;
}
echo "<div id=\"mess\" class=\"jGrowl bottom-right\">\r\n  <div class=\"jGrowl-notification\"></div>\r\n</div>";
function alert_mess($mess)
{
    return "\r\n\t\t\t<script type='text/javascript'>\r\n\t\t\t\t\$(document).ready(function(){\r\n\t\t\t\t\t\$('#mess').jGrowl('<center><strong>" . $mess . "</strong></center>', { life: 5000 });\r\n\t\t\t\t});\r\n\t\t\t</script>";
}

?>