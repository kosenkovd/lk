<?php
session_start();
set_include_path(get_include_path().PATH_SEPARATOR."php/".PATH_SEPARATOR."controllers/");
spl_autoload_extensions("_class.php");
spl_autoload_register();
$login=htmlspecialchars($_POST['login']);
$pass=htmlspecialchars($_POST['password']);
$arr1 = array();
$arr1[0]="id";
$arr1[1]="is_admin";
$arr1[2]="password_hash";
$arr1[3]="fio";
$arr1[4]="is_archived";
$arr2 = array();
$arr2["login"]=$login;
$arr3["email"] = $login;
$query = new Query();
$result = $query->_Select('users', $arr1, $arr2);
if(empty($result))
{
    $result = $query->_Select('users', $arr1, $arr3);
    if(empty($result)){
    	$_SESSION["status"]=3;
    	print "<script language='Javascript'>
    	window.history.back(); </script> "; 
    }
    else
    {
    	$id=$result[0]['id'];
    	$isAdmin=$result[0]['is_admin'];
    	$pw=$result[0]['password_hash'];
    	$fio=$result[0]['fio'];
    }
}
else
{
	$id=$result[0]['id'];
	$isAdmin=$result[0]['is_admin'];
	$pw=$result[0]['password_hash'];
	$fio=$result[0]['fio'];
}
if($result[0]['is_archived'] == 1) {
	$_SESSION['status'] = 5;
	print "<script language='Javascript'>
	window.history.back(); </script> "; 
} else {
	if(password_verify($pass, $pw))
	{
		$_SESSION['id']=$id;
		$_SESSION['isAdmin']=$isAdmin;
		$_SESSION['fio']=$fio;
		$_SESSION['login']=$login;
		$_SESSION['status']=2;
		if(($_POST["remember_me"] != "on") or ($_POST["remember_me"] != "checked"))
		{
			setcookie("id", $id, time()+604800, "/");
			setcookie("isAdmin", $isAdmin, time()+604800, "/");
			setcookie("fio", $fio, time()+604800, "/");
			setcookie("login", $login, time()+604800, "/");
		}
		header("Location: /");
	#	print "<script language='Javascript'><!-- 
	#window.location.href = 'http://perfectcrm.ru/mail';
	#//--></script>";  
	}
	else
	{
		$_SESSION['status']=3;
		print "<script language='Javascript'>
		window.history.back(); </script> "; 
	}
}

?>