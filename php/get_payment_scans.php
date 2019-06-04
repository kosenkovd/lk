<?php

set_include_path(get_include_path().PATH_SEPARATOR."php/".PATH_SEPARATOR."controllers/");
spl_autoload_extensions("_class.php");
spl_autoload_register();
session_start();

$user_id = $_SESSION["id"];

$query = new Query();

$objectg[0] = "id";
$objectg[1] = "name";
$objectpar["user_id"] = $user_id;
$objectpar["is_archived"] = 0;

$objects = $query->_Select("objects", $objectg, $objectpar);

$return["data"] = '';
foreach($objects as $object){
    $arr1[0] = 'name';
    $arr1[1] = 'month';
    $arr1[2] = 'year';
    $arr1[3] = 'id';
    
    $arr2["object_id"] = $object["id"];
    $arr2["type"] = 1;
    $return["data"] .= '<h3>Объект '.$object["name"].'</h3>';
    $scans = $query->_Select("scans", $arr1, $arr2, false, 'user_order');
    
    $scanarr = [];
    $counter = 0;
    foreach($scans as $scan){
        $scanmonth = $scan['month'];
        $scanyear = $scan['year'];
        $scanarr[$scanyear][$scanmonth][$counter]["name"] = $scan["name"];
        $scanarr[$scanyear][$scanmonth][$counter]["id"] = $scan["id"];
        $counter++;    
    }
    $first_month = true;
    
    foreach($scanarr as $year => $yeararr) {
        foreach($yeararr as $month => $montharr) {
            $return["data"] .= '
            <h2 class="text-center"><a onclick="getScansOf('.$object["id"].', '.$month.', '.$year.')">'.$month.'.'.$year.' <i class="fas fa-sort-down"></i></a></h2>';
            if($first_month) {
                $return["data"] .= '
            <table class="table table-striped" id="table-'.$object["id"].'-'.$month.'-'.$year.'">';
            } else {
                $return["data"] .= '
            <table class="table table-striped no-display" empty="1" id="table-'.$object["id"].'-'.$month.'-'.$year.'">';
            }
            
            $return["data"] .= '
                <thead>
                    <tr>
                      <th scope="col">Дата</th>
                      <th scope="col">Скан чека</th>
                      <th scope="col">Сумма</th>
                      <th scope="col">Комментарий</th>
                    </tr>
                </thead>';
            
            foreach($montharr as $scan) {
                if($first_month) {
                    $return["data"] .= '
                        <tbody>
                            <tr id="scanset'.$scan["id"].'">
                              <th scope="row" colspan="4"><h3><a onclick="getScansetById('.$scan["id"].')">'.$scan["name"].' <i class="fas fa-sort-down"></i></a></h3></th>
                            </tr>
                        </tbody>';
                } else {
                    $return["data"] .= '
                        <tbody id="'.$month.'-'.$year.'"></tbody>';
                }
            }
            
            if($first_month) {
                $first_month = false;    
            }
            
            $return["data"] .= '</table>';
        }
    }
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