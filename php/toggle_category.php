<?php
session_start();

set_include_path(get_include_path().PATH_SEPARATOR."php/".PATH_SEPARATOR."controllers/");
spl_autoload_extensions("_class.php");
spl_autoload_register();

$id= intval(htmlspecialchars($_POST['id']));
$is_active = intval(htmlspecialchars($_POST["is_active"]));
$query = new Query();
$arr1["is_active"] = $is_active;
$arr2["id"] = $id;
$query->_Update("ticket_categories", $arr1, $arr2);
?>