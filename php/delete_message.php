<?php

session_start();

set_include_path(get_include_path().PATH_SEPARATOR."php/".PATH_SEPARATOR."controllers/");
spl_autoload_extensions("_class.php");
spl_autoload_register();
$arr2[0] = "file_name";
$arr1["id"] = (int)$_POST["id"];
$query = new Query();
$result = $query->_Select("user_messages", $arr2, $arr1);
$query->_Delete("user_messages", $arr1);
if(strlen($result[0]["file_name"]) > 0){
	$files = explode(', ', $result[0]["file_name"]);
	foreach($files as $value){
        unlink("../ticket_files/".$value);
    }
}



echo true;
?>