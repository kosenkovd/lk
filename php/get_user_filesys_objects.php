<?php

set_include_path(get_include_path().PATH_SEPARATOR."php/".PATH_SEPARATOR."controllers/");
spl_autoload_extensions("_class.php");
spl_autoload_register();
session_start();

$user_id = htmlspecialchars($_POST["user_id"]);

$query = new Query();

$arr1[0] = 'id';
$arr1[1] = "name";
$arr2["user_id"] = $user_id;
$arr2["is_archived"] = 0;

$scans = $query->_Select("objects", $arr1, $arr2, true);

if(count($scans) > 0){
    for($i = 0; $i < count($scans); $i++) {
        $return["objects"][$i]['objectId'] = $scans[$i]["id"];
        $return["objects"][$i]['objectName'] = $scans[$i]["name"];
    }
} else {
    $return["objects"] = false;
}

function safe_json_encode($value){
    if (version_compare(PHP_VERSION, '5.4.0') >= 0) {
        $encoded = json_encode($value, JSON_PRETTY_PRINT);
    } else {
        $encoded = json_encode($value);
    }
    switch (json_last_error()) {
        case JSON_ERROR_NONE:
            return $encoded;
        case JSON_ERROR_DEPTH:
            return 'Maximum stack depth exceeded'; // or trigger_error() or throw new Exception()
        case JSON_ERROR_STATE_MISMATCH:
            return 'Underflow or the modes mismatch'; // or trigger_error() or throw new Exception()
        case JSON_ERROR_CTRL_CHAR:
            return 'Unexpected control character found';
        case JSON_ERROR_SYNTAX:
            return 'Syntax error, malformed JSON'; // or trigger_error() or throw new Exception()
        case JSON_ERROR_UTF8:
            $clean = utf8ize($value);
            return safe_json_encode($clean);
        default:
            return 'Unknown error'; // or trigger_error() or throw new Exception()

    }
}

function utf8ize($mixed) {
    if (is_array($mixed)) {
        foreach ($mixed as $key => $value) {
            $mixed[$key] = utf8ize($value);
        }
    } else if (is_string ($mixed)) {
        return utf8_encode($mixed);
    }
    return $mixed;
}

$retu = safe_json_encode($return);


echo $retu;
#echo json_last_error();
?>