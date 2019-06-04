<?php

set_include_path(get_include_path().PATH_SEPARATOR."php/".PATH_SEPARATOR."controllers/");
spl_autoload_extensions("_class.php");
spl_autoload_register();


	$query = new Query();
	$arr1[0] = "id";
	$arr1[1] = "fio";
	$arr2["kagent_id"] = (int)$_POST["id"];
	$arr3[0] = "name";
	$arr4["id"] = $arr2["kagent_id"];
	$kagname = $query->_Select("k_agents", $arr3, $arr4);
	$result = $query->_Select("users", $arr1, $arr2, true);
	$result1 = $query->_Select("inactive_users", $arr1, $arr2);
$val= '<ul class="nav">
    <li class="nav-item"><h2><strong>'.$kagname[0]["name"].'</strong></h2></li>
	<li class="nav-item"><p style="margin-left: 30px;">Клик на пользователе для доступа в подменю:</p></li>';
		for ($i = 0; $i < count($result); $i++) {
				$val.='<li class="fio nav-item" id="user'.$result[$i]["id"].'" onclick="openSubMenu('.$result[$i]["id"].', 0)"> <a><i id="gobackbutton'.$result[$i]["id"].'" style="display: none;" class="gobackbutton fa fa-angle-left"></i> '.$result[$i]["fio"].'</a></li><li class="fio usermenu nav-item" id="usermenu'.$result[$i]["id"].'"></li>';
			}
		for ($i = 0; $i < count($result1); $i++) {
		    $val.='<li class="fio nav-item" id="user'.$result1[$i]["id"].'" onclick="openSubMenu('.$result1[$i]["id"].', 1)"><a>Неактивен: '.$result1[$i]["fio"].'</a></li><li class="fio nav-item" id="usermenu'.$result1[$i]["id"].'"></li>';   
		}
$val.='</ul>';

echo $val;

?>