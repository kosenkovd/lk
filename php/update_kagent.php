<?php

set_include_path(get_include_path().PATH_SEPARATOR."php/".PATH_SEPARATOR."controllers/");
spl_autoload_extensions("_class.php");
spl_autoload_register();

$query = new Query();
if($_POST["name"] != ''){
	$arr1["name"] = htmlspecialchars($_POST["name"]);
}
if($_POST["tel"] != ''){
	$arr1['tel'] = htmlspecialchars($_POST["tel"]);
}
if($_POST["www"] != ''){
	$arr1["www"] = htmlspecialchars($_POST["www"]);
}
if(empty($arr1)){
	echo '<p style="margin-top: 30px;">Вы не ввели данных для изменения!</p>';
}
else{
$arr2["id"] = htmlspecialchars($_POST["id"]);
$result = $query->_Update("k_agents", $arr1, $arr2);

$val = '<p style="margin-top: 30px;">Данные контрагента успешно обновлены!</p>';

echo $val;
}
?>