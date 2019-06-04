<?php

set_include_path(get_include_path().PATH_SEPARATOR."php/".PATH_SEPARATOR."controllers/");
spl_autoload_extensions("_class.php");
spl_autoload_register();

$object_id = (int) $_POST["object_id"];
$type = $_POST["type"];
$folder_id = (int) $_POST["folder_id"];
$user_id = (int) $_POST["user_id"];

$query = new Query();

$filearr[0] = "scans";
$file2delarr["scans_id"] = $folder_id;

$files2delete = $query->_Select("scan_docs", $filearr, $file2delarr);

if(count($files2delete) > 0) {
    foreach($files2delete as $file2delete) {
        unlink("../ticket_files/".$user_id."/".$file2delete["scans"]);
    }    
    $query->_Delete("scan_docs", $file2delarr);
}

$fol2del["id"] = $folder_id;
$query->_Delete("scans", $fol2del);

$arr1[0] = 'name';
$arr1[1] = 'id';

$arr2["object_id"] = $object_id;
$arr2["type"] = $type;

$scans = $query->_Select("scans", $arr1, $arr2, true);

if(count($scans) > 0){
    for($i = 0; $i < count($scans); $i++) {
        $return["folders"][$i]['folderId'] = $scans[$i]["id"];
        $return["folders"][$i]['folderName'] = $scans[$i]["name"];
    }
} else {
    $return["folders"] = false;
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