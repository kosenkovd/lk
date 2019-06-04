<?php

set_include_path(get_include_path().PATH_SEPARATOR."php/".PATH_SEPARATOR."controllers/");
spl_autoload_extensions("_class.php");
spl_autoload_register();

		$query = new Query();
		$arr1[0] = "id";
		$arr1[1] = "tel";
		$arr1[2] = "www";
		$arr1[3] = "name";
		$arr2["id"] = (int)$_POST["id"];
		$result = $query->_Select("k_agents", $arr1, $arr2);
		$val = array();
		$val["id"] = $result[0]["id"];
		$val["tel"] = $result[0]["tel"];
		$val["www"] = $result[0]["www"];
		$val["name"] = $result[0]["name"];
echo json_encode($val);

?>