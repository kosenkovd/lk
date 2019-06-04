<?php

set_include_path(get_include_path().PATH_SEPARATOR."php/".PATH_SEPARATOR."controllers/");
spl_autoload_extensions("_class.php");
spl_autoload_register();

$folders = $_POST["folders"];

$query = new Query();

foreach($folders as $folder) {
    $arr1["user_order"] = $folder["order"];
    $arr2["id"] = $folder["id"];
    $val = $query->_Update("scans", $arr1, $arr2);
}

echo true;
?>