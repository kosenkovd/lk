<?php

set_include_path(get_include_path().PATH_SEPARATOR."php/".PATH_SEPARATOR."controllers/");
spl_autoload_extensions("_class.php");
spl_autoload_register();

function Randomize($length = 8){
	$chars = 'abdefhiknrstyzABDEFGHKNQRSTYZ23456789';
  $numChars = strlen($chars);
  $string = '';
  for ($i = 0; $i < $length; $i++) {
    $string .= substr($chars, rand(1, $numChars) - 1, 1);
  }
  return $string;
}

function _mail ($from, $to, $subj, $what)
{
mail($to, $subj, $what, 
"From: $from
Reply-To: $from
Content-Type: text/plain; charset=utf-8
Content-Transfer-Encoding: 8bit"
);
}

$newPass = Randomize(6);
$login = htmlspecialchars($_POST["login"]);


$query = new Query();

$subject = "Изменение пароля учетной записи Perfect-CRM";
$message = "Ваш пароль был изменен.

Новый пароль: ".$newPass."

С уважением,
команда Mediasoft.";

_mail ('support@perfect-crm.ru', $login, $subject, $message);

$arr1["password_hash"] = password_hash($newPass, PASSWORD_BCRYPT);
$arr2["email"] = $login;
$query->_Update("users", $arr1, $arr2);

session_start();
$_SESSION['status'] = 4;
echo '<script language=\'Javascript\'>
document.location.href = "http://perfect-crm.ru/login";
</script>';

?>