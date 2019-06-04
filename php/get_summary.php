<?php

set_include_path(get_include_path().PATH_SEPARATOR."php/".PATH_SEPARATOR."controllers/");
spl_autoload_extensions("_class.php");
spl_autoload_register();
session_start();

$months = ['', 'Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'];

$user_id = $_SESSION["id"];

$query = new Query();

$new[0] = "datecreate";
$new[1] = "text";

$newp["user_id"] = $user_id;

$news = $query->_Select("news", $new, $newp, true);

$return["data"] = "<h2>Новости по Вашим объектам</h2>";
if(count($news) > 0){
    foreach($news as $newss){
        $return["data"] .= '<p><strong>'.$newss["datecreate"].'</strong><br/>'.$newss["text"].'</p>';
    }    
} else {
    $return["data"] .= '<p>Новостей пока нет</p>';
}


$objectg[0] = "id";
$objectg[1] = "name";
$objectpar["user_id"] = $user_id;
$objectpar["is_archived"] = 0;

$objects = $query->_Select("objects", $objectg, $objectpar);

foreach($objects as $object){
    $return["data"] .= '<h2>Объект '.$object["name"].'</h2>';
    
    $arr3[0] = "id";
    $arr3[1] = "name";
    $arr4["is_arend"] = 1;
    $arr4["object_id"] = $object["id"];
    
    $folders = $query->_Select("scans", $arr3, $arr4);
    
    $return["data"] .= '<h3>Арендаторы</h3>
    <div id="user-file-system-'.$object["id"].'" class="user-file-system">';
    foreach($folders as $folder) {
        $return["data"] .= '
        <div class="file-item">
            <a class="file-link" onclick="openUserFolder('.$folder["id"].', '.$object["id"].')">
                <span style="font-size: 45px;"><i class="fas fa-folder"/></span>
                <br/>
                <span>'.$folder["name"].'</span>
            </a>
        </div>';
    }
    $return["data"] .= '
    </div>';
    
    $arr1[0] = 'month';
    $arr1[1] = 'year';
    $arr1[2] = 'id';
    $arr1[3] = 'name';
    
    $arr2["object_id"] = $object["id"];
    $arr2["is_arend"] = 0;
    $arr2["type"] = 0;
    
    $scans = $query->_Select("scans", $arr1, $arr2, true);

    foreach($scans as $scan){
        $return["data"] .= '<p>'.$scan['name'].'';
        $fil[0] = "scans";
        $filp["scans_id"] = $scan["id"];
        
        $files = $query->_Select("scan_docs", $fil, $filp);
        foreach($files as $file){
            $filename = $file["scans"];
            $fileextension = array_pop(explode('.', $filename));
            $return["data"] .= ' <a href="public_html/ticket_files/'.$user_id.'/'.$filename.'" target="_blank">.'.$fileextension.'</a>';
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