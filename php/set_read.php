<?php



set_include_path(get_include_path().PATH_SEPARATOR."php/".PATH_SEPARATOR."controllers/");
spl_autoload_extensions("_class.php");
spl_autoload_register();

$project_id = (int)$_POST["project_id"];
session_start();
$vid = $_SESSION["id"];
$isad = $_SESSION['isAdmin'];
session_write_close();
$a1["is_read"] = 1;
$a2["user_from_id"] = $vid;
$a2["project_id"] = $project_id;
$a3[0] = "<>";
$a3[1] = "=";
$query = new Query();
$query->_Update("user_messages", $a1, $a2, $a3);

echo $isad;
?>