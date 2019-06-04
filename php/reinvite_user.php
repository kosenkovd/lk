<?php

set_include_path(get_include_path().PATH_SEPARATOR."php/".PATH_SEPARATOR."controllers/");
spl_autoload_extensions("_class.php");
spl_autoload_register();

$query = new Query();
$arr2["id"] = htmlspecialchars($_POST["id"]);
$password = $_POST["password"];
$isNotArchieved = $query->_getCount("users", $arr2);
if($isNotArchieved[0]["COUNT(*)"] == 1){
    remindPass($arr2, $password);
}
else{
    reinvite($arr2, $password);
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
    $arr1[8] = "is_notificated";
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
    $array1["is_notificated"] = $result[0]["is_notificated"];
    $query->_Insert("users", $array1);
    $to = $result[0]["email"];
    $subj = "Приглашение в систему поддержки пользователей Медиасофт";
    $what = "Уважаемый(ая), ".$result[0]["fio"]."! Добро пожаловать в систему поддержки пользователей от Медиасофт.
    
    Ваш логин: ".$result[0]["login"]."
    Ваш пароль: ".htmlspecialchars($_POST["password"])."
    
    Для перехода на сайт воспользуйтесь ссылкой: http://perfect-crm.ru/
    
    С уважением,
    команда Медиасофт";
    $email = new Email();
    if($result[0]["is_notificated"]){
        $email->sendMail($result[0]["email"], $subj, $what);
        $val = '<p style="margin-top: 30px;">Пользователь успешно приглашен!</p>';
    } else {
        $val = '<p style="margin-top: 30px;">Пользователь успешно перенесен из архива!</p>';
    }
    echo $val;
}

function remindPass($id, $pass){
    global $query;
    $arr1[0] = "login";
    $arr1[1] = "fio";
    $arr1[2] = "email";
    $arr1[3] = "is_notificated";
    $result = $query->_Select("users", $arr1, $id);
    $array1["password_hash"] = password_hash($pass, PASSWORD_BCRYPT);
    $query->_Update("users", $array1, $id);
    $to = $result[0]["email"];
    $subj = "Приглашение в систему поддержки пользователей Медиасофт";
    $what = "Уважаемый(ая), ".$result[0]["fio"]."! Напоминаем Вам логин и пароль в систему поддержки пользователей от Медиасофт.
    
    Ваш логин: ".$result[0]["login"]."
    Ваш пароль: ".htmlspecialchars($_POST["password"])."
    
    Для перехода на сайт воспользуйтесь ссылкой: http://perfect-crm.ru/
    
    С уважением,
    команда Медиасофт";
    $email = new Email();
    if($result[0]["is_notificated"]){
        $email->sendMail($result[0]["email"], $subj, $what);
        $val = '<p style="margin-top: 30px;">Данные успешно напомнены!</p>';
    } else {
        $val = '<p style="margin-top: 30px;">Данные успешно изменены!</p>';
    }
    
    echo $val;
}
?>