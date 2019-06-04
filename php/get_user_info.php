<?php

set_include_path(get_include_path().PATH_SEPARATOR."php/".PATH_SEPARATOR."controllers/");
spl_autoload_extensions("_class.php");
spl_autoload_register();

session_start();
if(!$_SESSION["isAdmin"]) {
    $user_id = $_SESSION["id"];
} else {
    $user_id = (int)$_POST["user_id"];
}
session_write_close();

$query = new Query();
$arr1[0] = "id";
$arr1[1] = "name";
$arr1[2] = "surname";
$arr1[4] = "passport";
$arr1[5] = "birthday";
$arr1[6] = "account";
$arr1[7] = "biometry";
$arr1[8] = "email";
$arr2["id"] = $user_id;

$result = $query->_Select("users", $arr1, $arr2);

echo json_encode($result[0]);

?>