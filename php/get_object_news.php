﻿<?php

set_include_path(get_include_path().PATH_SEPARATOR."php/".PATH_SEPARATOR."controllers/");
spl_autoload_extensions("_class.php");
spl_autoload_register();

$query = new Query();
$arr1[0] = "id";
$arr1[1] = "text";
$arr1[2] = "datecreate";
$arr2["object_id"] = (int)$_POST['object_id'];
$result["news"] = $query->_Select("news", $arr1, $arr2, true);
echo json_encode($result);
?>