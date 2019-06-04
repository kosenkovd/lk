<?php
session_start();
$user_id = $_SESSION["id"];
session_write_close();

set_include_path(get_include_path().PATH_SEPARATOR."php/".PATH_SEPARATOR."controllers/");
spl_autoload_extensions("_class.php");
spl_autoload_register();



$field = $_POST["field"];
$value = $_POST["value"];

$arr1[$field] = $value;
$arr2["id"] = $user_id;

$query = new Query();
$val = $query->_Update("users", $arr1, $arr2);

echo $val;
?>