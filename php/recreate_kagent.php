<?php

set_include_path(get_include_path().PATH_SEPARATOR."php/".PATH_SEPARATOR."controllers/");
spl_autoload_extensions("_class.php");
spl_autoload_register();

$query = new Query();
$arr2["id"] = htmlspecialchars($_POST["id"]);
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
    $result = $query->_Select("inactive_k_agents", $arr1, $arr2);
    $query->_Insert("k_agents", $result[0]);
    $query->_Delete("inactive_k_agents", $arr2);
    $val = '<p style="margin-top: 30px;">Контрагент успешно возвращен из архива!</p>';


echo $val;
?>