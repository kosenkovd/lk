<?php
$userid = $_COOKIE["id"];
$isAdmin = $_COOKIE["isAdmin"];
set_include_path(get_include_path().PATH_SEPARATOR."php/".PATH_SEPARATOR."controllers/");
spl_autoload_extensions("_class.php");
spl_autoload_register();
session_start();
$userid = $_SESSION["id"];
$userfio = $_SESSION['fio'];
$useremail = $_SESSION['login'];
$isAdmin = $_SESSION["isAdmin"];
session_write_close();
$adminmail = "support@mediasoft.su";
#$adminmail = "wdenkosw@gmail.com";
$id = $_POST["id"];
if(isset($id)){
$arr1["is_closed"] = 0;
$arr2["id"] =$id;
$query = new Query();
$email = new Email();
$array1[0] = "name";
$array1[1] = "hash_name";
$array1[2] = "kagent_id";
$array1[3] = "user_id";
$result = $query->_Select("project", $array1, $arr2);
$query->_Update("project", $arr1, $arr2);
$user[0] = "email";
if($isAdmin == 0){
    $useridar["id"] =$userid;
}
else{
    $user[1] = "fio";
    $user[2] = "email";
    $useridar["id"] = $result[0]["user_id"];
}
$info = $query->_Select("users", $user, $useridar);
if($isAdmin != 0){
	$subject = "Повторное открытие темы ".$result[0]["name"];
	$what = "Здравствуйте, ".$info[0]["fio"]."! Обращение по теме ".$result[0]["name"].' номер '.$result[0]["hash_name"].' было повторно открыто.
	
С уважением,
команда Mediasoft';
    $tolog = 'Открытие тикета от '.$_SERVER['REMOTE_ADDR'].', клиент '.$_SERVER['HTTP_USER_AGENT'].' в '.date('l jS \of F Y h:i:s A').'. Пользователь: '.$info[0]["fio"].', тикет: '.$result[0]["hash_name"].'
';
    file_put_contents('logs/helplog.txt',$tolog, FILE_APPEND);
    
	$email->sendMail($info[0]["email"], $subject, $what);
}
else{
	$kagentid["id"] = $result[0]["kagent_id"];
	$kagent[0] = "name";
	$kag = $query->_Select("k_agents", $kagent, $kagentid);
	$subject = "Открытие темы ".$result[0]["name"];
	$what = $kag[0]["name"].", ".$userfio." вновь открыл обращение по вопросу ".$result[0]["name"].' номер '.$result[0]["hash_name"];
    $tolog = 'Открытие тикета от '.$_SERVER['REMOTE_ADDR'].', клиент '.$_SERVER['HTTP_USER_AGENT'].' в '.date('l jS \of F Y h:i:s A').'. Пользователь: '.$userfio.', тикет: '.$result[0]["hash_name"].'
';
    file_put_contents('logs/helplog.txt',$tolog, FILE_APPEND);
	$email->sendMail($adminmail, $subject, $what);
}

$mail1["user_from_id"] = $userid;
$mail1["subject"] = '-';
if($isAdmin > 0){
    $mail1["problem"] = "Администратор вновь открыл тикет";
}
else{
    $mail1["problem"] = "Пользователь вновь открыл тикет";
}
$mail1["file_name"] = '';
$mail1["is_read"] = 0;
$mail1["is_done"] = 0;
$mail1["project_id"] = $id;
$mail1["from_admin"] = $isAdmin;
$mail1["time_sent"] = time();
$query->_Insert("user_messages", $mail1);

echo true;
}
else{
    echo false;
}
?>