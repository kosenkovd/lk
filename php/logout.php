<?php
setcookie("id","",time()-3600,"/");
setcookie("isAdmin", "",time()-3600,"/");
setcookie("fio", "",time()-3600,"/");
setcookie("login", "",time()-3600,"/");
session_start();

UNSET($_SESSION['id']);
UNSET($_SESSION['isAdmin']);
UNSET($_SESSION['status']);
UNSET($_SESSION['fio']);
UNSET($_SESSION['login']);

#echo $_SESSION['id'].', '.$_COOKIE["id"].$_COOKIE["isAdmin"];
header('Location: / ');
echo "<script language='Javascript'> window.location.href='http://perfect-crm.ru/index';  </script> ";
?>