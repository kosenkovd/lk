<?php

set_include_path(get_include_path().PATH_SEPARATOR."php/".PATH_SEPARATOR."controllers/");
spl_autoload_extensions("_class.php");
spl_autoload_register();

$query = new Query();
$arr1["text"] = nl2br(htmlspecialchars($_POST["text"]));
$arr1["datecreate"] = substr(htmlspecialchars($_POST["date"]), 0, 12);
$arr2["id"] = (int)$_POST['id'];
$query->_Update("news", $arr1, $arr2);
echo true;
?>