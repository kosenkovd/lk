<?php

set_include_path(get_include_path().PATH_SEPARATOR."php/".PATH_SEPARATOR."controllers/");
spl_autoload_extensions("_class.php");
spl_autoload_register();
session_start();

$user_id = $_SESSION['id'];
$scanset_id = htmlspecialchars($_POST['id']);

$query = new Query();

$arr1[0] = 'id';
$arr1[1] = 'sum';
$arr1[2] = 'commentary';
$arr1[3] = 'scans';
$arr1[4] = 'time_sent';

$arr2["scans_id"] = $scanset_id;

$scans = $query->_Select("scan_docs", $arr1, $arr2, true);

foreach($scans as $scan){
    $download_link = '<a class="btn btn-cta-primary" href="/public_html/ticket_files/'.$user_id.'/'.$scan["scans"].'" target="_blank">Скачать</a>';
    $return["data"] .= '
    <tr class="no-display scans-of-'.$scanset_id.'">
      <td>'.$scan["time_sent"].'</td>
      <td>'.$download_link.'</td>
      <td>'.$scan["sum"].' Kč</td>
      <td>'.$scan["commentary"].'</td>
    </tr>
    ';
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