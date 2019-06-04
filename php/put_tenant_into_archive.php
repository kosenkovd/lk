<?php

set_include_path(get_include_path().PATH_SEPARATOR."php/".PATH_SEPARATOR."controllers/");
spl_autoload_extensions("_class.php");
spl_autoload_register();
session_start();

$scans_id = (int) $_POST["scans_id"];
$user_id = (int) $_POST["user_id"];
$object_id = (int) $_POST["object_id"];

$query = new Query();

$arr1[0] = 'id';
$arr2["scans_id"] = $scans_id;

$scans = $query->_Select("scan_docs", $arr1, $arr2, true);

$arr3[0] = "id";
$arr4["object_id"] = $object_id;
$arr4["is_arend"] = 1;
$arr4["id"] = $scans_id;
$arr5[0] = '=';
$arr5[1] = '=';
$arr5[2] = '<>';

$new_scans = $query->_SelectMoreOrLess('scans', $arr3, $arr4, $arr5);
$new_scans_id = $new_scans[0]["id"];

if(count($scans) > 0){
    foreach($scans as $scan) {
        $arr6["scans_id"] = $new_scans_id;
        $arr7["id"] = $scan["id"];
        $query->_Update("scan_docs", $arr6, $arr7);
    }
} 
$return["content"] = false;


$arr3[0] = "name";
$arr3[1] = "is_arend";
$arr4["id"] = $scans_id;

$folName = $query->_Select('scans', $arr3, $arr4);
$return["folderName"] = $folName[0]["name"];
if(strripos($folName[0]["name"], "Текущий арендатор") !== false) {
    $return["isArend"] = $folName[0]["is_arend"];
} else {
    $return["isArend"] = false;
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