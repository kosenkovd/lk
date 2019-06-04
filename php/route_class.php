<?php

class Route {

	public static function start() {
		session_start();
		@$id=$_SESSION['id'];
		@$isAdmin=$_SESSION['isAdmin'];
		@$cookid=$_COOKIE["id"];
		@$cookisAdmin = $_COOKIE["isAdmin"];
		if(@$cookid > 0){
		    $_SESSION["id"] = @$cookid;
		    $_SESSION["isAdmin"] = @$cookisAdmin;
		}
		if((@$isAdmin == 1 and @$id > 0) or (@$cookisAdmin == 1 and @$cookid > 0)) $controller_name = "Admin";
		elseif((@$isAdmin == 2 and @$id > 0) or (@$cookisAdmin == 2 and @$cookid > 0)) $controller_name = "Moder";
		elseif((@$id > 0) or (@$cookid > 0)) $controller_name = "Main";
		else $controller_name = "guest";
		$action_name = "index";

		//print "<script language='Javascript'>alert('".$id."asdk".$isAdmin."'); </script>";
		$uri = $_SERVER["REQUEST_URI"];
		$uri = substr($uri, 1);
		$is_get = strpos($uri, '?');
		if($is_get) {
		    $uri = substr($uri, 0, $is_get);
		}
		if ($uri) $action_name = $uri;
        
		$controller_name = $controller_name."controller";
		$action_name = "action".$action_name;
		

		$controller = new $controller_name();
		if(method_exists($controller, $action_name))
		 $controller->$action_name();
		else $controller->action404();
	}

}

?>