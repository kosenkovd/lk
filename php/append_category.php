<?php
session_start();

set_include_path(get_include_path().PATH_SEPARATOR."php/".PATH_SEPARATOR."controllers/");
spl_autoload_extensions("_class.php");
spl_autoload_register();

$category_name=htmlspecialchars($_POST['category_name']);
$category_name=substr($category_name, 0, 255);
$category_name = trim($category_name);
if(strlen($category_name)>0){
    $query = new Query();
    $arr1["description"] = $category_name;
    $query->_Insert("ticket_categories", $arr1);
    $arr[0] = "id";
    $result1 = $query->_Select("ticket_categories", $arr, $arr1);
    echo '<li class="nav-item"><a>'.$category_name.' <input type="checkbox" class="" onchange="toggleCategory('.$result1[0]["id"].')" checked /></a></li>';
}
else{
    echo '<li class="nav-item">Была задана пустая строка, повторите запрос.</li>';
}
?>