<?php

set_include_path(get_include_path().PATH_SEPARATOR."php/".PATH_SEPARATOR."controllers/");
spl_autoload_extensions("_class.php");
spl_autoload_register();
session_start();

$object_id = (int) $_POST["object_id"];
$month = htmlspecialchars($_POST['month']);
$year = htmlspecialchars($_POST['year']);

if($month < 10){
    $month = '0'.$month;
}

$query = new Query();

$arr1[0] = 'name';
$arr1[1] = 'id';

$arr2["month"] = $month;
$arr2["year"] = $year;
$arr2["object_id"] = $object_id;
$arr2["type"] = 1;

$scans = $query->_Select("scans", $arr1, $arr2, false, 'user_order');

$last_month = 'asd';

foreach($scans as $scan){
    $return["data"] .= '<tbody>
        <tr id="scanset'.$scan["id"].'">
          <th scope="row" colspan="4"><h3><a onclick="getScansetById('.$scan["id"].')">'.$scan["name"].' <i class="fas fa-sort-down"></i></a></h3></th>
        </tr>
    </tbody>
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