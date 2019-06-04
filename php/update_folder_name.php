<?php

set_include_path(get_include_path().PATH_SEPARATOR."php/".PATH_SEPARATOR."controllers/");
spl_autoload_extensions("_class.php");
spl_autoload_register();

$folder_id = $_POST["folder_id"];
$value = $_POST["value"];

$arr1["name"] = $value;
$arr2["id"] = $folder_id;

$query = new Query();
$val = $query->_Update("scans", $arr1, $arr2);

echo $val;
?>