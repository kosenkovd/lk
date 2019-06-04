<?php

set_include_path(get_include_path().PATH_SEPARATOR."php/".PATH_SEPARATOR."controllers/");
spl_autoload_extensions("_class.php");
spl_autoload_register();
session_start();

$user_id = $_SESSION["id"];

$query = new Query();

$arr1[0] = name;
$arr1[1] = month;
$arr1[2] = year;
$arr1[3] = id;

$arr2["user_id"] = $user_id;
$arr2["is_jkh"] = 1;

$scans = $query->_Select("scans", $arr1, $arr2, true);

$last_month = 'asd';
$last_year = 1;

$return["data"] = '<table class="table table-striped">
    ';

$first_month = $scans[0]["month"];
$first_year = $scans[0]["year"];
foreach($scans as $scan){
    $to_get_scans = (!strcmp($first_month, $scan["month"]) && ($first_year == $scan["year"]));
    if(strcmp($last_month, $scan["month"]) != 0 || $last_year != $scan["year"]){
        $last_month = $scan["month"];
        $last_year = $scan["year"];
        $return["data"] .= '<thead id="'.$scan["month"].'-'.$scan["year"].'"';
        if(!$to_get_scans) {
            $return["data"] .= ' empty="1"';
        }
        $return["data"] .= '>
    <tr>
      <th scope="col" colspan="4"><h2><a onclick="getScansOf('.$scan["month"].','.$scan["year"].')">'.$scan["month"].'.'.$scan["year"].' <i class="fas fa-sort-down"></i></a></h2></th>
    </tr>
  </thead>
   ';
   if($to_get_scans){
       $return["data"] .= '<thead>
    <tr>
      <th scope="col">Дата</th>
      <th scope="col">Скан чека</th>
      <th scope="col">Сумма</th>
      <th scope="col">Комментарий</th>
    </tr>
  </thead>
  ';
   }
    }
    if($to_get_scans){
        $return["data"] .= '<tbody>
        <tr id="scanset'.$scan["id"].'">
          <th scope="row" colspan="4"><h3><a onclick="getScansetById('.$scan["id"].')">'.$scan["name"].' <i class="fas fa-sort-down"></i></a></h3></th>
        </tr>
    </tbody>
    ';
    } else{
        $return["data"] .= '<tbody id="'.$scan["month"].'-'.$scan["year"].'">
    </tbody>
    ';
    }
}

$return["data"] .='</table>';

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