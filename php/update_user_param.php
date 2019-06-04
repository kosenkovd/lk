<?php
session_start();
if(!$_SESSION["isAdmin"]) {
    $user_id = $_SESSION["id"];
} else {
    $user_id = (int)$_POST["user_id"];
}
session_write_close();

set_include_path(get_include_path().PATH_SEPARATOR."php/".PATH_SEPARATOR."controllers/");
spl_autoload_extensions("_class.php");
spl_autoload_register();



function _mail ($from, $to, $subj, $what)
{
mail($to, $subj, $what, 
"From: $from
Reply-To: $from
Content-Type: text/plain; charset=utf-8
Content-Transfer-Encoding: 8bit"
);
}

$field = $_POST["field"];
$value = $_POST["value"];

if(strcmp($field, 'password') == 0) {
    $value = password_hash($value, PASSWORD_BCRYPT);
    $field = 'password_hash';
}

$query = new Query();

$arr2["id"] = $user_id;

if(strcmp($field, 'name') == 0 || strcmp($field, 'surname') == 0) {
	$arr3[0] = 'name';
	$arr3[1] = 'surname';
	$old = $query->_Select('users', $arr3, $arr2);
	if(strcmp($field, 'name') == 0) {
		$arr1["fio"] = $old[0]["surname"].' '.$value;
	} else {
		$arr1["fio"] = $value.' '.$old[0]["name"];
	}
} 
$arr1[$field] = $value;	

$val = $query->_Update("users", $arr1, $arr2);

echo $user_id;
?>.