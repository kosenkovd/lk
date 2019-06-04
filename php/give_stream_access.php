<?php

set_include_path(get_include_path().PATH_SEPARATOR."php/".PATH_SEPARATOR."controllers/");
spl_autoload_extensions("_class.php");
spl_autoload_register();

		$query = new Query();
		$arr1["allow_stream"] = 1;
		$arr2["id"] = (int)$_POST["id"];
    $query->_Update("users", $arr1, $arr2);
    
    $time = htmlspecialchars($_POST["time"]);
    $arr3[0] = "email";
    $res = $query->_Select("users", $arr3, $arr2);
    $subject = "Приглашение на трансляцию";
    $text = "Вы приглашены на трансляцию по адресу http://perfect-crm.ru/stream в ".$time."
    
    С уважением,
    команда Медиасофт.";
    
    $email = new Email();
    $email->sendMail($res[0]["email"], $subject, $text);
?>