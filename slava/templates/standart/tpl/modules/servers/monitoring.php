<?php

require_once "protocol.php";
echo "<script src=\"" . $url . "templates/standart/tpl/modules/servers/2.1.4.js\"></script>\r\n<script src=\"" . $url . "templates/standart/tpl/modules/servers/monitoring.js\"></script>\r\n<script type=\"text/javascript\">\$(function () {new ClipboardJS('.copy-clipboard');\$('body').on('click', '.copy-clipboard', function (e) {e.preventDefault();var that = \$(this);that.html('Скопировано!');setTimeout(function () {that.html(that.attr('data-text'));}, 1000);var that = \$(this);});});</script>\r\n";
if (!defined("BLOCK")) {
    exit(" <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" /> <html> <head> <title>404 Not Found</title> </head> <body> <h1>Not Found</h1> <p>The requested URL was not found on this server.</p> </body> </html>");
}
echo "<div class=\"card card-outline card-" . $colour . "\"><div class=\"card-body\"><div class=\"row\"><div class=\"col-md-12\"><div class=\"callout callout-info\"><h4><i class=\"fa fa-info\"></i> Инфо:</h4><p>Для открытия списка игроков сервера нажмите на онлайн.</a></p></div><div class=\"box-body table-responsive no-padding\"><table class=\"table table-bordered table-hover\"><thead style=\"color: #eeeeee; background-color: #4A4A4A;\"><tr><th width=\"1%\"><center><i class=\"fa fa-arrow-down\"></i></center></th><th><i class=\"fa fa-tasks\"></i> Сервер</th><th><center><i class=\"fa fa-user\"></i> Игроки:</center></th><th><center><i class=\"fa fa-map-marker\"></i> Карта:</center></th><th width=\"25%\"><center><i class=\"fa fa-location-arrow\"></i> IP:</center></th></tr></thead><tbody>";
$query = $db->m_query("SELECT * FROM `bp_servers` ORDER BY `id` ASC");
if (0 < $db->n_rows($query)) {
    $number = 0;
    while ($date = $db->f_arr($query)) {
        $number++;
		$data = serverInfo($date["address"]);
        if ($data["status"] == 1) {
            $status = "green";
            $map = $data["map"];
        } else {
            $status = "red";
            $map = "Сервер недоступен";
        }
        $r = floor($data["players"] / $data["maxplayers"] * 100);
        if ($r <= 30) {
            $colour = "danger";
        } else {
            if ($r <= 70) {
                $colour = "warning";
            } else {
                $colour = "success";
            }
        }
        $max += $data["maxplayers"];
        $on += $data["players"];
        $line = floor($on / $max * 100);
        if ($line <= 25) {
            $allcolour = "danger";
        } else {
            if ($line <= 70) {
                $allcolour = "warning";
            } else {
                $allcolour = "success";
            }
        }
        echo " <tr><td style=\"color: #eeeeee; background-color: #4A4A4A;\"><center><b>" . $number . "</b></center></td><td><h6><b class=\"badge bg-" . $status . "\">" . $data["hostname"] . "</b></h6></td><td><center><div class=\"progress\"><div data-toggle=\"modal\" data-target=\"#modal-players-" . $number . "\" class=\"progress-bar bg-" . $colour . "\" role=\"progressbar\" aria-valuenow=\"" . $r . "\" aria-valuemin=\"0\" aria-valuemax=\"100\" style=\"width:" . $r . "%;\"><center style=\"color: black;margin:auto;\"><b>" . $data["players"] . "/" . $data["maxplayers"] . "</b></center></div></div></center></td><td><center><h6><b class=\"badge bg-" . $status . "\">" . $map . "</b></h6></center></td><td><center><div class=\"input-group\"><input class=\"form-control\" style=\"cursor:pointer;\" type=\"text\" value=\"" . $date["address"] . "\" readonly=\"\" onclick=\"this.select()\"> <span class=\"input-group-append\"><a type=\"button\" style=\"color: white;\" class=\"btn btn-success btn-flat copy-clipboard\" data-clipboard-text=\"" . $date["address"] . "\" data-text=\"Копировать\">Копировать</a></span> </div></center></td></tr>";
    }
    echo "</tbody></table><h4>Общий Онлайн:</h4><center style=\"text-align: center;\"><div class=\"progress\" style=\"height:50px;\"><div class=\"progress-bar bg-" . $allcolour . "\" aria-valuemin=\"0\" aria-valuemax=\"100\" style=\"width:" . $line . "%;\"><center style=\"color: black;margin:auto; \"><b>" . $on . "/" . $max . "</b></center></div></div></center>";
} else {
    echo "<tr><td colspan=\"5\"><b>Список серверов пуст!</b></td></tr></tbody></table>";
}
echo "</div></div>";
$query2 = $db->m_query("SELECT * FROM `bp_servers` ORDER BY `id` ASC");
if (0 < $db->n_rows($query2)) {
    $i = 0;
    while ($date = $db->f_arr($query2)) {
        $i++;
			$ip = explode(':', $date["address"], 2);	
			$data = serverInfo($date["address"]);
			$players = lgsl_query_live($ip[0],$ip[1], 'p');
			if($players['p']) 
			{
				unset($score); unset($kills);
				foreach ($players['p'] AS $key => $kills) 
					$score[$key]  = $kills['frags'];
					
				array_multisort($score, SORT_DESC, $players['p']);
			}				
			$nowplayers = (!empty($players['p']) ? count($players['p']) : 0);
			$listplayers = ($nowplayers ? serialize($players['p']) : '');
			$inum = 1;
			$playerslist = unserialize($listplayers);
			echo "<div class=\"modal fade\" id=\"modal-players-" . $i . "\"><div class=\"modal-dialog modal-lg\"><div class=\"modal-content\"><div class=\"modal-header\"><h4 class=\"modal-title\">Список игроков</h4><button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button></div><div class=\"modal-body\"><div class=\"box-body table-responsive no-padding\"><table class=\"table table-bordered table-hover\"><thead style=\"color: #eeeeee; background-color: #4A4A4A;\"><tr><th width=\"1%\"><center><i class=\"fa fa-arrow-down\"></i></th><th> Ник</th><th> Счёт</th><th> Время игры</<i></th></tr></thead><tbody>";
        
			foreach($playerslist AS $key2 => $value) 
				{
					$value['time'] = date("H:i:s", $value['time']);
					$value['name'] = $key2;
					$value['num'] = $inum;
					$result['players'][] = $value;
					$inum++;
					echo "<td style=\"color: #eeeeee; background-color: #4A4A4A;\"><center><b>" . $value['num'] . "</b></td><td>" . $value['name'] . "</td><td>" . $value['frags'] . "</td><td>" . $value['time'] . "</td></tr>";
				}
			
			echo "</table></tbody></table></div></div><div class=\"modal-footer justify-content-between\"><button type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\">Закрыть</button></div></div></div></div>";
    }
}

?>