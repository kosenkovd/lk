<?php

set_include_path(get_include_path().PATH_SEPARATOR."php/".PATH_SEPARATOR."controllers/");
spl_autoload_extensions("_class.php");
spl_autoload_register();

$query = new Query();
$arr1["user_id"] = (int) $_POST["user_id"];
$arr1["object_id"] = (int) $_POST["object_id"];
$arr1["datecreate"] = date('d.m.Y');
$arr1["text"] = nl2br(htmlspecialchars($_POST["text"]));
$query->_Insert("news", $arr1);

$arr2[0] = "datecreate";
$arr2[1] = "text";
$arr2[2] = "id";
$arr3["object_id"] = $arr1["object_id"];

$result["news"] = $query->_Select("news", $arr2, $arr3, true);
echo json_encode($result);
?>