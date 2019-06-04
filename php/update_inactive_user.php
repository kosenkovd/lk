<?php

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

function reinvite($id, $pass){
    $query = new Query();
    $arr1[0] = "login";
    $arr1[1] = "fio";
    $arr1[2] = "email";
    $arr1[3] = "is_admin";
    $arr1[4] = "phone_number";
    $arr1[5] = "kagent_id";
    $arr1[6] = "allow_stream";
    $arr1[7] = "cat_moder";
    $result = $query->_Select("inactive_users", $arr1, $id);
    $query->_Delete("inactive_users", $id);
    $array1["password_hash"] = password_hash($pass, PASSWORD_BCRYPT);
    $array1["login"] = $result[0]["login"];
    $array1["fio"] = $result[0]["fio"];
    $array1["email"] = $result[0]["email"];
    $array1["phone_number"] = $result[0]["phone_number"];
    $array1["is_admin"] = $result[0]["is_admin"];
    $array1["kagent_id"] = $result[0]["kagent_id"];
    $array1["id"] = $id["id"];
    $query->_Insert("users", $array1);
}

function Randomize($length = 8){
	$chars = 'abdefhiknrstyzABDEFGHKNQRSTYZ23456789';
  $numChars = strlen($chars);
  $string = '';
  for ($i = 0; $i < $length; $i++) {
    $string .= substr($chars, rand(1, $numChars) - 1, 1);
  }
  return $string;
}

$arr2["id"] = htmlspecialchars($_POST["id"]);
$array1[0] = "email";
$array1[1] = "fio";
$array1[2] = "login";
$array1[3] = "phone_number";
$array1[4] = "email";

$query = new Query();
$info = $query->_Select("inactive_users", $array1, $arr2);

$message = 'Здравствуйте, '.$info[0]["fio"].'!

Ваши данные были изменены:
';
$subject = 'Изменение данных для входа на сайт Perfect-CRM';
$flag = 0;
$send = true;
if($_POST["phone_number"] != '' and strcmp($_POST["phone_number"], $info[0]["phone_number"])!=0){
	$arr1['phone_number'] = htmlspecialchars($_POST["phone_number"]);
	$send = false;
}
if($_POST["login"] != '' and strcmp($_POST["login"], $info[0]["login"])!=0){
	$message .= 'новый логин: '.htmlspecialchars($_POST["login"]).'
	';
	$arr1["login"] = htmlspecialchars($_POST["login"]);
	$flag = 1;
}
if($_POST["password"] != ''){
    $password=$_POST["password"];
	$message .= 'новый пароль: '.htmlspecialchars($_POST["password"]).'
	';
	$arr1['password_hash'] = password_hash($_POST["password"], PASSWORD_BCRYPT);
}
else{
    $password = Randomize(10);
    $message .= 'новый пароль: '.$password.'
	';
	$arr1['password_hash'] = password_hash($password, PASSWORD_BCRYPT);
}
if($_POST["is_admin"] == 2){
    $arr1["cat_moder"] = htmlspecialchars($_POST["cat_moder"]);
    $arr1["kagent_moder"] = htmlspecialchars($_POST["kagent_moder"]);
    $send = false;
}
if($_POST['kontragent'] != ''){
    $arr1["kagent_id"] = $_POST["kontragent"];
}
if($_POST['fio'] != ''){
    $arr1["fio"] = $_POST["fio"];
}
$arr1["is_admin"] = $_POST["is_admin"];
$message .= '

С уважением,
команда Mediasoft.';
if($send){
    _mail ('support@perfect-crm.ru', $info[0]["email"], $subject, $message);
}
if(empty($arr1)){
	echo '<p style="margin-top: 30px;">Вы не ввели данных для изменения!</p>';
}
else{

$result = $query->_Update("inactive_users", $arr1, $arr2);

$val = '<p style="margin-top: 30px;">Данные пользователя успешно обновлены!</p>';
reinvite($arr2, $password);

echo $val;
}
?>