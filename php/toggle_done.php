<?php

session_start();

set_include_path(get_include_path().PATH_SEPARATOR."php/".PATH_SEPARATOR."controllers/");
spl_autoload_extensions("_class.php");
spl_autoload_register();

$id = $_POST["id"];
$state = $_POST["state"];
$a1["is_done"] = $state;
$a2["id"] = $id;
$a3[0] = "problem";
$a3[1] = "user_from_id";
$a3[2] = "project_id";
$query = new Query();
$result = $query->_Select("user_messages", $a3, $a2);
$a4["id"] = $result[0]["user_from_id"];
$a5[0] = "email";
$email = $query->_Select("users", $a5, $a4);
$a6[0] = "hash_name";
$a7["id"] = $result[0]["project_id"];
$ticket_num = $query->_Select("project", $a6, $a7);
$mail = new Email();
if($_SESSION["isAdmin"] == 1){
    if($state == 0){
        $mail->sendMail($email[0]["email"], "Обновление в тикете ".$ticket_num[0]["hash_name"], "Больше не выполнено ".br2nl($result[0]["problem"]));
    }
    else{
        $mail->sendMail($email[0]["email"], "Обновление в тикете ".$ticket_num[0]["hash_name"], "Выполнено ".br2nl($result[0]["problem"]));
    }
}

$query->_Update("user_messages", $a1, $a2);

function br2nl($str) {
return  preg_replace('/<br\\s*?\/??>/i', '', $str);
}

echo true;
?>