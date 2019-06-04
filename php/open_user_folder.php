<?php

set_include_path(get_include_path().PATH_SEPARATOR."php/".PATH_SEPARATOR."controllers/");
spl_autoload_extensions("_class.php");
spl_autoload_register();
session_start();
$user_id = $_SESSION["id"];
session_write_close();

$query = new Query();

$scans_id = (int) $_POST["id"];
$object_id = (int) $_POST["object_id"];

$arr3[0] = "scans";
$arr4["scans_id"] = $scans_id;

$scans = $query->_Select("scan_docs", $arr3, $arr4);

$return["data"] = '
    <div class="file-item">
        <a class="file-link" onclick="getUserFolders('.$object_id.')">
            <span style="font-size: 45px;"><i class="fas fa-angle-left"></i></span>
            <br/>
            <span>Назад</span>
        </a>
    </div>';

foreach($scans as $scan) {
    $return["data"] .= '
    <div class="file-item">
        <a class="file-link" href="public_html/ticket_files/'.$user_id.'/'.$scan["scans"].'" target="_blank">
            <span style="font-size: 45px;"><i class="fas fa-file"/></span>
            <br/>
            <span>'.$scan["scans"].'</span>
        </a>
    </div>';
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