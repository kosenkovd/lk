<?php

set_include_path(get_include_path().PATH_SEPARATOR."php/".PATH_SEPARATOR."controllers/");
spl_autoload_extensions("_class.php");
spl_autoload_register();

$query = new Query();
$arr2["id"] = htmlspecialchars($_POST["id"]);

$arr4["kagent_id"] = $arr2["id"];
$arr3[0] = "login";
$arr3[1] = "password_hash";
$arr3[2] = "fio";
$arr3[3] = "is_admin";
$arr3[4] = "email";
$arr3[5] = "kagent_id";
$arr3[6] = "id";
$arr3[7] = "allow_stream";
$arr3[8] = "cat_moder";
$arr3[9] = "phone_number";
$arr3[10] = "kagent_moder";
$users_to_delete = $query->_Select("users", $arr3, $arr4);
for($i = 0; $i < count($users_to_delete); $i++) {
    $query->_Insert("inactive_users", $users_to_delete[$i]);
}
$query->_Delete("users", $arr4);

$arr1[0] = "type_id";
$arr1[1] = "otvManager_emplid";
$arr1[2] = "kamid";
$arr1[3] = "marketingid";
$arr1[4] = "name";
$arr1[5] = "description";
$arr1[6] = "id";
$arr1[7] = "address";
$arr1[8] = "tel";
$arr1[9] = "www";
$arr1[10] = "datecreate";
$arr1[11] = "email";
$result = $query->_Select("k_agents", $arr1, $arr2);
$query->_Insert("inactive_k_agents", $result[0]);
$query->_Delete("k_agents", $arr2);
$val = true;

echo json_encode($users_to_delete[0]);
?>