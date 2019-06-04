<?php
set_include_path(get_include_path().PATH_SEPARATOR."php/".PATH_SEPARATOR."controllers/");
spl_autoload_extensions("_class.php");
spl_autoload_register();
$query = new Query();
$array1[0] = "id";
$array1[1] = "description";
$array1[2] = "is_active";
$options = $query->_Select("ticket_categories", $array1, array());
$list.="<h3>Подконтрольные категории: </h3>";
for($o = 0; $o < count($options); $o++){
	$list.='<p style="position: relative;"><input type="checkbox" name="category'.$o.'" value="'.$options[$o]["id"].'"/> '.$options[$o]["description"].'';
	if($options[$o]["is_active"] == 0){
	    $list.=' (неактивно)';
	}
	$list.='</p>';
}
$ara1[0] = "id";
$ara1[1] = "name";
$list.="<h3>Подконтрольные контрагенты: </h3>";
$options2 = $query->_Select("k_agents", $ara1, array());
for($o = 0; $o < count($options2); $o++){
	$list.='<p style="position: relative;"><input type="checkbox" name="kagent'.$o.'" value="'.$options2[$o]["id"].'"/> '.$options2[$o]["name"].' ';
	$list.='</p>';
}
$list.= '<input type="text" name="category_count" value="'.count($options).'" style="display: none;" />';
$list.= '<input type="text" name="kagents_count" value="'.count($options2).'" style="display: none;" />';
echo $list;
?>