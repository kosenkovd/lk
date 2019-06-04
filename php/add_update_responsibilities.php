<?php
set_include_path(get_include_path().PATH_SEPARATOR."php/".PATH_SEPARATOR."controllers/");
spl_autoload_extensions("_class.php");
spl_autoload_register();
$query = new Query();
$arr2["id"] = $_POST['id'];
$arr1[0] = 'cat_moder';
$arr1[1] = 'kagent_moder';
$result = $query->_Select("users", $arr1, $arr2);
$cat_modd = explode(",", $result[0]["cat_moder"]);
$kag_modd = explode(",", $result[0]["kagent_moder"]);
$array1[0] = "id";
$array1[1] = "description";
$array1[2] = "is_active";
$cats = $query->_SelectInRange('ticket_categories', $array1, $result[0]["cat_moder"]);
for($i = 0; $i < count($cats); $i++){
    $val["cat_moder"] .= '<p>'.$cats[$i]["description"].'<input type="checkbox" value="'.$cats[$i]["id"].'" id="category'.$i.'" name="category'.$i.'"';
    if(in_array($cats[$i]["id"], $cat_modd)){
        $val["cat_moder"] .= ' checked />';
    }
    else{
        $val["cat_moder"] .= '/>';
    }
    if($cats[$i]["is_active"]){
        $val["cat_moder"] .= '</p>';
    }
    else{
        $val["cat_moder"] .= '(неактивен) </p>';
    }
}
$val["cat_moder"] .= '<input type="text" value="'.count($cats).'" style="display: none;" id="category_count" name="category_count" />';
$array2[0] = "id";
$array2[1] = "name";
$kags = $query->_SelectInRange('k_agents', $array2, $result[0]['kagent_moder']);
for($i = 0; $i < count($kags); $i++){
    $val["kagent_moder"] .= '<p>'.$kags[$i]["name"].'<input type="checkbox" value="'.$kags[$i]["id"].'" id="kagent'.$i.'" name="kagent'.$i.'"';
    if(in_array($kags[$i]["id"], $kag_modd)){
        $val["kagent_moder"] .= ' checked />';
    }
    else{
        $val["kagent_moder"] .= '/>';
    }
}
$val["kagent_moder"] .= '<input type="text" value="'.count($kags).'" style="display: none;" id="kagent_count" name="kagent_count" />';


echo json_encode($val);
?>