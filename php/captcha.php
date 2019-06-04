<?php

set_include_path(get_include_path().PATH_SEPARATOR."php/".PATH_SEPARATOR."controllers/");
spl_autoload_extensions("_class.php");
spl_autoload_register();
require_once "recaptchalib.php";

$secret = "6Lf83RAUAAAAAAmt6teRVrRvAmv1uQrjb1ljbJQ3";
 
// пустой ответ
$response = null;
 
// проверка секретного ключа
$reCaptcha = new ReCaptcha($secret);

if ($_POST["response"]) {
$response = $reCaptcha->verifyResponse(
        $_SERVER["REMOTE_ADDR"],
        $_POST["response"]
    );
}
 if ($response != null && $response->success) {
        echo true;
      }
echo false;
?>