<?php
session_start();

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

$emailAddr = "yourEmail";

$password=Randomize(8);
$password_hash=password_hash($password, PASSWORD_BCRYPT);
$name=htmlspecialchars($_POST['name']);
$name=substr($name, 0, 32);
$surname=htmlspecialchars($_POST['surname']);
$surname=substr($surname, 0, 32);
$fio = $surname.' '.$name;
$pasport=htmlspecialchars($_POST['pasport']);
$pasport=substr($pasport, 0, 40);
$account=htmlspecialchars($_POST['account']);
$account=substr($account, 0, 64);
$birthday=htmlspecialchars($_POST['birthday']);
$birthday=substr($birthday, 0, 12);
$email=htmlspecialchars($_POST['email']);
$email=substr($email, 0, 60);
$login = $email;
$kAgent_id=1;
$is_admin = (int)$_POST["isAdmin"];
$query = new Query();
$arr1["login"] = $login;
$arr1["password_hash"] = $password_hash;
$arr1["fio"] = $fio;
$arr1["is_admin"] = $is_admin;
$arr1["email"] = $email;
$arr1["kagent_id"] = $kAgent_id;
$arr1["name"] = $name;
$arr1["surname"] = $surname;
$arr1["passport"] = $passport;
$arr1["account"] = $account;
$arr1["birthday"] = $birthday;

$result = $query->_Insert("users", $arr1);
echo $result;

$subject = "Добро пожаловать на сайт lk.admireal.ru!";
$message = "Уважаемый(ая), ".$fio."! Добро пожаловать в личный кабинет клиентов AdmiReal.

Ваш логин: ".$login."
Ваш пароль: ".$password."

Для перехода на сайт воспользуйтесь ссылкой: http://lk.admireal.ru

С уважением,
команда AdmiReal";

_mail ($emailAddr, $email, $subject, $message); 

print "<script language='Javascript'>alert(\"Пользователь успешно зарегистрирован!\"); window.location.href='http://calc.wdenkosw.bget.ru'; </script> "; 

 function _mail ($from, $to, $subj, $what)
{
mail($to, $subj, $what, 
"From: $from
Reply-To: $from
Content-Type: text/plain; charset=utf-8
Content-Transfer-Encoding: 8bit"
);
}

?>