<?php

set_include_path(get_include_path().PATH_SEPARATOR."php/".PATH_SEPARATOR."controllers/");
spl_autoload_extensions("_class.php");
spl_autoload_register();

$query = new Query();
$arr1["category_id"] = htmlspecialchars($_POST["category_id"]);
$arr2["id"] = htmlspecialchars($_POST["id"]);
$result = $query->_Update("project", $arr1, $arr2);
echo true;
?>