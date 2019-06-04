<?php

set_include_path(get_include_path().PATH_SEPARATOR."php/".PATH_SEPARATOR."controllers/");
spl_autoload_extensions("_class.php");
spl_autoload_register();

$email = $_POST["email"];

$params = array();
$params['email'] = $email;
$query = new Query();
$result = $query->_getCount('users', $params);
$json['result'] = $result[0]["COUNT(*)"];
echo json_encode($json);
?>