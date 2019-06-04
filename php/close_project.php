<?php

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
#$adminmail= "wdenkosw@gmail.com";
$id = $_POST["id"];
if(isset($id)){
$arr1["is_closed"] = 1;
$arr1["time_closed"] = time();
$arr2["id"] =$id;
$query = new Query();
$email = new Email();

$array1[0] = "user_id";
$array1[1] = "name";
$array1[2] = "hash_name";
$result = $query->_Select("project", $array1, $arr2);
$query->_Update("project", $arr1, $arr2);
$user[0] = "fio";
$user[1] = "email";
if($isAdmin == 0){
   
	$useridar["id"] =$userid;
}
else{
    $user[2] = "fio";
    $useridar["id"] = $result[0]["user_id"];
}
$user[3] = "is_notified";
$info = $query->_Select("users", $user, $useridar);
if($isAdmin == 1){
	$subject = "Обращение ".$result[0]["hash_name"].' закрыто';
	$what = "Здравствуйте, ".$info[0]["fio"]."! Обращение ".$result[0]["hash_name"]." по теме ".$result[0]["name"].' закрыто. Если вопрос не решен, Вы можете открыть его вновь во вкладке "Закрытые вопросы".	
';
$aa1[0] = "problem";
$aa1[1] = "user_from_id";
$aa1[2] = "time_sent";
$aa2["project_id"] = $id;
$chain = $query->_Select("user_messages", $aa1, $aa2, true);
$chainusersids = array();
$chainusersfios = array();
for($o = 0; $o < count($chain); $o++){
    $searchfioelem = array_search($chain[$o]["user_from_id"], $chainusersids);
    if($searchfioelem === false){
        array_push($chainusersids, $chain[$o]["user_from_id"]);
        $searchfio[0] = "fio";
        $searchfioid["id"] = $chain[$o]["user_from_id"];
        $foundfio = $query->_Select("users", $searchfio, $searchfioid);
        array_push($chainusersfios, $foundfio[0]["fio"]);
        $thischainfio = $foundfio[0]["fio"];
    }
    else{
        $thischainfio = $chainusersfios[$searchfioelem];
    }
    $date = date('d.m.y   G:i', $chain[$o]["time_sent"]);
    $new = br2nl($chain[$o]["problem"]);
   
    $what .= $new.'
    
    '.$thischainfio.' в '.$date.'
    
';
}
$what.='
С уважением,
команда Mediasoft';
    $tolog = 'Закрытие тикета от '.$_SERVER['REMOTE_ADDR'].', клиент '.$_SERVER['HTTP_USER_AGENT'].' в '.date('l jS \of F Y h:i:s A').'. Пользователь: '.$info[0]["fio"].', тикет: '.$result[0]["hash_name"].'
';
    file_put_contents('logs/helplog.txt',$tolog, FILE_APPEND);
    if($info[0]["is_notified"]){
        $email->sendMail($info[0]["email"], $subject, $what);
    }
}
else{
    

#    $subject = "Обращение ".$result[0]["hash_name"].' закрыто';
#	$what = "Обращение ".$result[0]["hash_name"]." по теме ".$result[0]["name"].' закрыто пользователем.';
#	$email->sendMail($adminmail, $subject, $what);
}
$mail1["user_from_id"] = $userid;
$mail1["subject"] = '-';
if($isAdmin > 0){
    $mail1["problem"] = "Администратор закрыл тикет";
}
else{
    $mail1["problem"] = "Пользователь закрыл тикет";
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
function br2nl($str) {
return  preg_replace('/<br\\s*?\/??>/i', '', $str);
}

?>