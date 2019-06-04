<?php

set_include_path(get_include_path().PATH_SEPARATOR."php/".PATH_SEPARATOR."controllers/");
spl_autoload_extensions("_class.php");
spl_autoload_register();

session_start();
$user_id = $_SESSION["id"];
session_write_close();

$object_id = (int) $_POST["object_id"];

$query = new Query();
$arr1[0] = "email";
$arr2["id"] = $user_id;
$adminEmail = $query->_Select("users", $arr1, $arr2);

$arr3[0] = "name";
$arr4["id"] = $object_id;
$objectName = $query->_Select("objects", $arr3, $arr4);

$arr5[0] = "name";
$arr5[1] = "user_order";
$arr5[2] = "id";
$arr5[3] = "month";
$arr5[4] = "year";
$arr6["object_id"] = $object_id;
$arr6["type"] = 1;

$scans = $query->_Select("scans", $arr5, $arr6, false, "user_order");

if(count($scans) > 0) {
    $scansarr = [];
    $counter = 0;
    foreach($scans as $scan){
        $scanmonth = $scan['month'];
        $scanyear = $scan['year'];
        $scanarr[$scanyear][$scanmonth][$counter]["name"] = $scan["name"];
        $scanarr[$scanyear][$scanmonth][$counter]["id"] = $scan["id"];
        $scanarr[$scanyear][$scanmonth][$counter]["user_order"] = $scan["user_order"];
        $counter++;    
    }
    $result['test'] = $scanarr;

    $counter = 0;
    foreach($scanarr as $year => $yeararr){
        foreach($yeararr as $month => $montharr) {
            $result["userOrderDates"][$counter]["dateHeader"] = $month.'.'.$year;
            $result["userOrderDates"][$counter]["tableId"] = $month.'-'.$year;
            $subcounter = 0;
            foreach($montharr as $scan) {
                $result["userOrderDates"][$counter]["userOrder"][$subcounter]["name"] = $scan["name"];
                $result["userOrderDates"][$counter]["userOrder"][$subcounter]["id"] = $scan["id"];
                $result["userOrderDates"][$counter]["userOrder"][$subcounter]["user_order"] = $scan["user_order"];
                $subcounter++;
            }
            $counter++;
        }
    }        
} else {
    $result["userOrderDates"] = 0;
}

$result["email"] = $adminEmail[0]["email"];
$result["objectName"] = $objectName[0]["name"];
$result["objectId"] = $object_id;
$result["userOrder"] = $folders;

echo json_encode($result);

?>