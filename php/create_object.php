<?php
session_start();

set_include_path(get_include_path().PATH_SEPARATOR."php/".PATH_SEPARATOR."controllers/");
spl_autoload_extensions("_class.php");
spl_autoload_register();

$name = htmlspecialchars($_POST["object_name"]);
$name = substr($name, 0, 255);
$user_id = htmlspecialchars($_POST["user_id"]);
$datecreate = date('l jS \of F Y h:i:s A');


$query = new Query();
$arr1["name"] = $name;
$arr1["user_id"] = $user_id;
$arr1["datecreate"] = $datecreate;
$query->_Insert("objects", $arr1);

echo true;

?>