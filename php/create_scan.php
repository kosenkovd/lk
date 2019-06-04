<?php

set_include_path(get_include_path().PATH_SEPARATOR."php/".PATH_SEPARATOR."controllers/");
spl_autoload_extensions("_class.php");
spl_autoload_register();
session_start();

$scans_id = htmlspecialchars($_POST["scans_id"]);
$commentary = htmlspecialchars($_POST["commentary"]);
$scans = htmlspecialchars($_POST["file"]);
$sum = htmlspecialchars($_POST["sum"]);
$user_id = htmlspecialchars($_POST["user_id"]);

$query = new Query();

$date = time();

$scan_doc["sum"] = $sum;
$scan_doc["commentary"] = $commentary;
$scan_doc["scans"] = $scans;
$scan_doc['time_sent'] = date('d.m.Y');
$scan_doc["scans_id"] = $scans_id;

$ok = $query->_Insert("scan_docs", $scan_doc);

$arr1[0] = 'scans';
$arr2["scans_id"] = $scans_id;

$scans = $query->_Select("scan_docs", $arr1, $arr2, true);

if(count($scans) > 0){
    for($i = 0; $i < count($scans); $i++) {
        $return["content"]["files"][$i]['fileHref'] = '/ticket_files/'.$user_id.'/'.$scans[$i]["scans"];
        $return["content"]["files"][$i]['fileName'] = $scans[$i]["scans"];
    }
} else {
    $return["content"] = false;
}

$arr3[0] = "name";
$arr4["id"] = $scans_id;

$folName = $query->_Select('scans', $arr3, $arr4);
$return["folderName"] = $folName[0]["name"];

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