<?php
/*

define("BLOCK", true);
require_once "../../../core/core.php";
$action = abs((int) $_POST["action"]);
$hash = md5(sha1($_SERVER["HTTP_HOST"] . "r2jshjh7"));
$server = "https://api.texymcs.ru/get/";
if ($action === 1) {
    $query = $db->m_query("SELECT * FROM `" . DBcfg::$dbopt["db_prefix"] . "_updates` WHERE `id`=1");
    $row = $db->f_arr($query);
    if (_obfuscated_0D191D0D05391432180D283E36370B1B32050A06355B01_($server . "version/" . $_SERVER["HTTP_HOST"] . "/" . $hash)) {
        $version = unserialize(file_get_contents($server . "version/" . $_SERVER["HTTP_HOST"] . "/" . $hash));
        $count = count($version);
        if ($version["error"]) {
            $current_version = "<b class=\"text-danger\">" . $row["version"] . "</b> (Сервер не доступен)";
            exit(json_encode(array("msg" => $current_version)));
        }
        if ($row["version"] == $version[$count - 1]["name"]) {
            $current_version = "<b class=\"text-primary\">" . $row["version"] . "</b> (Используется актуальная версия)";
            $ver = $row["version"];
        } else {
            for ($i = 0; $i < $count; $i++) {
                if ($row["version"] == $version[$i]["name"]) {
                    $current_version = $version[$i + 1]["name"];
                    break;
                }
            }
            if (empty($current_version)) {
                $current_version = "<b class=\"text-warning\">" . $row["version"] . "</b> (Используется бета версия)";
                $ver = $row["version"];
            } else {
                $ver = $current_version;
                $current_version = "<b class='text-danger'>" . $row["version"] . "</b> (Доступно обновление <b class=version data-id=" . $current_version . ">" . $current_version . "</b>: <a class='c-p' onclick='get_update();'>получить</a>)";
            }
        }
    } else {
        $ver = $row["version"];
        $current_version = $row["version"] . " (Сервер не доступен)";
    }
    if ($row["version"] != $ver) {
        $current_version = json_encode(array("version" => $ver, "msg" => $current_version));
    } else {
        $current_version = json_encode(array("msg" => $current_version));
    }
    exit($current_version);
}
if ($action === 2 && !empty($_POST["version"])) {
    if (_obfuscated_0D191D0D05391432180D283E36370B1B32050A06355B01_($server . "description/" . $_SERVER["HTTP_HOST"] . "/" . trim($_POST["version"]))) {
        $desc = unserialize(file_get_contents($server . "description/" . $_SERVER["HTTP_HOST"] . "/" . trim($_POST["version"])));
        if ($desc["error"]) {
            exit;
        }
        $desc_update = json_encode(array("desc" => htmlspecialchars_decode($desc["desc"])));
    }
    exit($desc_update);
}
if ($action === 3) {
    $query = $db->m_query("SELECT * FROM `" . DBcfg::$dbopt["db_prefix"] . "_updates` WHERE `id`=1");
    $row = $db->f_arr($query);
    if (_obfuscated_0D191D0D05391432180D283E36370B1B32050A06355B01_($server . "version/" . $_SERVER["HTTP_HOST"] . "/" . $hash)) {
        $version = unserialize(file_get_contents($server . "version/" . $_SERVER["HTTP_HOST"] . "/" . $hash));
        $count = count($version);
        if ($version["error"]) {
            exit(json_encode(array("status" => "2", "message" => $version["error"])));
        }
        if ($row["version"] == $version[$count - 1]["name"]) {
            exit(json_encode(array("status" => "2", "message" => "Используется актуальная версия.")));
        }
        ignore_user_abort(1);
        set_time_limit(0);
        for ($i = 0; $i < $count; $i++) {
            if ($row["version"] == $version[$i]["name"]) {
                $current_version = $version[$i + 1]["name"];
                break;
            }
        }
        if (empty($current_version)) {
            exit(json_encode(array("status" => "2", "message" => "Используется бета версия.")));
        }
        $res = unserialize(file_get_contents($server . "download/" . $_SERVER["HTTP_HOST"] . "/" . $current_version));
        if ($res["error"]) {
            exit(json_encode(array("status" => "3", "message" => $res["error"])));
        }
        $dir = dirname(dirname(dirname(__DIR__)));
        $folder = "/updates/";
        if (!is_dir($dir . $folder)) {
            mkdir($dir . $folder, 511);
        }
        $file_name = substr($res["link"], strrpos($res["link"], "/") + 1);
        if (file_put_contents($dir . $folder . $file_name, file_get_contents($res["link"]))) {
            $zip = new ZipArchive();
            $res2 = $zip->open($dir . $folder . $file_name);
            if ($res2 === true) {
                $zip->extractTo($dir);
                $zip->close();
                if (is_file($dir . $folder . "db.sql")) {
                    $file_sql = file_get_contents($dir . $folder . "db.sql");
                    $db->m_query($file_sql);
                    unlink($dir . $folder . "db.sql");
                }
                unlink($dir . $folder . $file_name);
                rmdir($dir . $folder);
                file_get_contents($server . "update/" . $_SERVER["HTTP_HOST"] . "/" . $current_version);
                $db->m_query("UPDATE `bp_updates` SET `version`='" . $current_version . "' WHERE `id`=1");
                exit(json_encode(array("status" => "1", "message" => "Успешное обновление.")));
            }
            exit(json_encode(array("status" => "2", "message" => "Ошибка обновления.")));
        }
        exit(json_encode(array("status" => "2", "message" => "Ошибка скачивания.")));
    }
    exit(json_encode(array("status" => "2", "message" => "Главный сервер не доступен!")));
}
function _obfuscated_0D191D0D05391432180D283E36370B1B32050A06355B01_($file, $timeOut = NULL)
{
    if (!is_null($timeOut)) {
        $default = stream_context_get_options(stream_context_get_default());
        stream_context_set_default(array("http" => array("timeout" => $timeOut)));
    }
    $headers = @get_headers($file, true);
    if (!empty($headers) && is_array($headers) && strpos($headers[0], "200")) {
        $result = true;
    } else {
        $result = false;
    }
    if (isset($default)) {
        stream_context_set_default($default);
    }
    return $result;
}
*/
?>