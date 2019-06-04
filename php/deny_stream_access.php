<?php

set_include_path(get_include_path().PATH_SEPARATOR."php/".PATH_SEPARATOR."controllers/");
spl_autoload_extensions("_class.php");
spl_autoload_register();

		$query = new Query();
		$arr1["allow_stream"] = 0;
		$arr2["id"] = (int)$_POST["id"];
    $query->_Update("users", $arr1, $arr2);
?>