<?php

set_include_path(get_include_path().PATH_SEPARATOR."php/".PATH_SEPARATOR."controllers/");
spl_autoload_extensions("_class.php");
spl_autoload_register();

$name = htmlspecialchars($_POST["name"]);
$id = (int) $_POST["id"];

$arr1["name"] = $name;
$arr2["id"] = $id;

$query = new Query();
$val = $query->_Update("objects", $arr1, $arr2);

echo true;
?>