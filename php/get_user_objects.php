<?php

set_include_path(get_include_path().PATH_SEPARATOR."php/".PATH_SEPARATOR."controllers/");
spl_autoload_extensions("_class.php");
spl_autoload_register();

$val= '';
		$query = new Query();
		$arr1[0] = "id";
		$arr1[1] = "name";
		$arr2["user_id"] = htmlspecialchars($_POST['user_id']);
		$arr2["is_archived"] = 0;
		$result = $query->_Select("objects", $arr1, $arr2);
		for ($i = 0; $i < count($result); $i++) {
			$val .= '<li id="objct'.$result[$i]["id"].'"><a onclick="newRenderer.getObjectData('.$result[$i]["id"].')">'.$result[$i]["name"].'</a></li>';
		}
$val.='<li><a onclick="openNewObjectModal('.$arr2["user_id"].')"><i class="fas fa-plus"></i> Новый объект</a></li>';
$json['opened'] = $val;
echo json_encode($json);

?>