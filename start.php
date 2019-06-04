<?php
mb_internal_encoding("UTF-8");
//error_reporting(0);
set_include_path(get_include_path().PATH_SEPARATOR."php/".PATH_SEPARATOR."controllers/");
spl_autoload_extensions("_class.php");
spl_autoload_register();

define("DIR_TMPL", "tpl/");
define("MAIN_LAYOUT", "main");
define("FORM_LAYOUT", "form");
define("SERVICE_LAYOUT", "services");

?>