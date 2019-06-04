<?php

set_include_path(get_include_path().PATH_SEPARATOR."php/".PATH_SEPARATOR."controllers/");
spl_autoload_extensions("_class.php");
spl_autoload_register();

$fio = $_POST["fio"];
$email = $_POST["email"];
if($fio=='' || $email==''){
    $val = 0;
}
else{
    $subj = "Запрос на тестовый доступ";
    $what = $fio." желает получить тестовый доступ
email: ".$email;
    $email = new Email();
    $adminemail="support@mediasoft.su";
    #$adminemail="wdenkosw@gmail.com";
    $email->sendMail($adminemail, $subj, $what);
    $val = 1;
}
echo $val;
?>