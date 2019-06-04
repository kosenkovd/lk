<?php

set_include_path(get_include_path().PATH_SEPARATOR."php/".PATH_SEPARATOR."controllers/");
spl_autoload_extensions("_class.php");
spl_autoload_register();
session_start();

$object_id = htmlspecialchars($_POST["object_id"]);
$type = htmlspecialchars($_POST["type"]);
$name = htmlspecialchars($_POST["name"]);
$month = (int) $_POST["month"];
$year = (int) $_POST["year"];

$query = new Query();

$date = time();

$arr1["object_id"] = $object_id;
$arr1["name"] = $name;
$arr1["time_sent"] = $date;
if($month == 0) {
    $arr1["month"] = date('m');    
} else {
    if($month < 10) {
        $arr1["month"] = '0'.$month;    
    } else {
        $arr1["month"] = $month;
    }
}
if($year == 0) {
    $arr1["year"] = date('Y');
} else {
    $arr1["year"] = $year;
}
$arr1["type"] = $type;
if((strripos($name, 'Архив арендаторов') !== false or strripos($name, 'Текущий арендатор') !== false)) {
    $arr1["is_arend"] = 1;
}


$ok = $query->_Insert("scans", $arr1);

$arr2[0] = "id";
$arr2[1] = "name";
$arr3["object_id"] = $object_id;
$arr3["type"] = $type;

$scans = $query->_Select("scans", $arr2, $arr3, true);

for($i = 0; $i < count($scans); $i++) {
    $return["folders"][$i]['folderId'] = $scans[$i]["id"];
    $return["folders"][$i]['folderName'] = $scans[$i]["name"];
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