<?php

set_include_path(get_include_path().PATH_SEPARATOR."php/".PATH_SEPARATOR."controllers/");
spl_autoload_extensions("_class.php");
spl_autoload_register();
session_start();
$id = $_POST["id"];
$vid = $_SESSION["id"];
$a1["is_read"] = 1;
$a2["user_from_id"] = $vid;
$a2["project_id"] = $id;
$a3[0] = "<>";
$a3[1] = "=";
$query = new Query();
$query->_Update("user_messages", $a1, $a2, $a3);
$arr1[0] = "id";
$arr1[1] = "problem";
$arr1[2] = "is_read";
$arr1[7] = "is_done";
$arr1[3] = "from_admin";
$arr1[4] = "user_from_id";
$arr1[5] = "time_sent";
$arr1[6] = "file_name";
$arr2["project_id"] =$id;
$arr3[0] = "name";
$arr3[1] = "hash_name";
$arr3[2] = "user_id";
$arr3[3] = "kagent_id";
$arr3[4] = "category_id";
$arr4["id"] = $id;
$themename = $query->_Select("project", $arr3, $arr4);
$result = $query->_Select("user_messages", $arr1, $arr2, true);
$arr5[0] = "name";
$arr6["id"] = $themename[0]["kagent_id"];
$kagent = $query->_Select("k_agents", $arr5, $arr6);
$arr7[0] = "description";
$arr8["id"] = $themename[0]["category_id"];
$cat = $query->_Select('ticket_categories', $arr7, $arr8);
$ph[0] = "phone_number";
$phh["id"] = $themename[0]["user_id"];

$num = $query->_Select("users", $ph, $phh);
$number = $num[0]["phone_number"];

if((strlen($number) > 2) and ($_SESSION["isAdmin"] == 1)){
        $retu["call"] = '<a style="margin: 10px;" class="btn btn-cta-primary" href="skype:'.$number.'?call">Позвонить</a>';
}
else{
    $retu["call"] = '';
}


#  $ret = '<p class="themeName">'.$themename[0]["name"].'</p>';
$isad = $_SESSION['isAdmin'];
if($isad == 1){
    $retu["theme"] = '<p class="" style="margin-bottom: 0; padding-bottom: 5px; font-size: 22px; padding-left: 10px;">';
    $ara1[0] = "id";
    $ara1[1] = "description";
    $ara2["is_active"] = 1;
    $categs = $query->_Select("ticket_categories", $ara1, $ara2);
    $retu["theme"] .= '<span><select class="form-control" style="display:inline-block;" id="category_select" onchange="changeTicketCategory('.$id.')">';
    for($i = 0; $i < count($categs); $i++){
        $retu["theme"] .= '<option value="'.$categs[$i]['id'].'"';
        if(strcmp($categs[$i]['description'], $cat[0]["description"])==0){
            $retu["theme"] .= ' selected';
        }
        $retu["theme"] .='>'.$categs[$i]['description'].'</option>';
    }
    $retu["theme"] .= "</select></span>";
}
else{
    $retu["theme"] = '<p class="" style="margin-bottom: 0; padding-bottom: 5px; font-size: 22px; padding-left: 10px;">';
}
if($themename[0]["hash_name"] != 0){
    $retu["theme"] .= 'Тикет: <strong>'.$themename[0]["hash_name"].'</strong>, '.$kagent[0]["name"].', '.$themename[0]["name"].'</p>';
}
else{
    $retu["theme"] .= $kagent[0]["name"].', '.$themename[0]["name"].'. Категория: '.$cat[0]["description"].'</p>';
}
$ret = '<div id="scrollMessage">';
if(count($result) == 0){
	echo '<p class="error-message">По этой теме еще не было сообщений...</p>';
}
$fios = array();
for($i = 0; $i < count($result); $i++){
    
    if($_SESSION["isAdmin"] == 1){
        $just_finish = '<div class="done_menu">';
        if($result[$i]["is_done"] == 1){
            $just_finish .= "<p>Выполнить! <i class='fa fa-check-square-o' aria-hidden='true'></i></p>
            <a onclick='toggleDone(".$result[$i]["id"].", 0)'>Вернуть в рассмотрение</a></div><i class='cross fa fa-times' onclick='deleteMessage(".$result[$i]["id"].")'></i></div>";
        }
        else{
            $just_finish .= "<p>Вернуть в рассмотрение</p>
            <a onclick='toggleDone(".$result[$i]["id"].", 1)'>Выполнить! <i class='fa fa-check-square-o' aria-hidden='true'></i></a></div><i class='cross fa fa-times' onclick='deleteMessage(".$result[$i]["id"].")'></i></div>";
        }
        
    }
    else{
        $just_finish = '<div class="done_menu">';
        if($result[$i]["is_done"] == 1){
            $just_finish .= "<p>Выполнено! <i class='fa fa-check-square-o' aria-hidden='true'></i></p>
            <a onclick='toggleDone(".$result[$i]["id"].", 0)'>Вернуть в рассмотрение</a></div></div>";
        }
        else{
            $just_finish = "</div>";
        }
    }
    $probe = $result[$i]["problem"];
    $pro = $probe;
	    $e = true;
	    $count = 0;
	    $o = 0;
	    while($e){
	        $count++;
	        $a = strpos($probe, 'http://', $o);
	    if($a === false){
	        $a = strpos($probe, 'https://', $o);
	    }
	    if($a !== false){
	        $o = $a+8;
	        if($a == 0){
	            $b = $a;
	        }
	        else{
	            $b = $a-1;
	        }
	        $c = $a+5;
	        $part1 = substr($probe, 0, $b);
	        $f = strpos($probe, " ", $a);
	        $r = strpos($probe, "<br />", $a);
	        if($r !== false){
	            if($f>$r){
	                $f = $r;
	            }
	        }
	        if($f !== false){
	            $p = $f - $a;
	        $part2 = substr($probe, $a, $p);
	        $part3 = substr($probe, $f);
	        $pro = $part1.' <a href="'.$part2.'" target="_blank">'.$part2.'</a> '.$part3;
	        }
	        else{
	            $part2 = substr($probe, $a);
	            $pro = $part1.' <a href="'.$part2.'" target="_blank">'.$part2.'</a> ';
	        }
	    }
	    else{
	        $e = false;
	    }
	    if($count > 10){
	        break;
	    }
	    }
        $probe = $pro;
    	if(is_null($result[$i]["time_sent"])){
	        $date='';
	    }
	    else{
	    $date = date('d.m.y   G:i', $result[$i]["time_sent"]);
	    }
	    
	$user_id = $result[$i]["user_from_id"];
	if (!isset($fios[$user_id]))
	{
		$array1[0] = 'fio';
		$array2["id"] = $result[$i]["user_from_id"];
		$fio = $query->_Select("users", $array1, $array2);
		$fios[$user_id] = $fio[0]["fio"];
	}
	if(strlen($result[$i]["file_name"]) > 0){
	    $files = explode(', ', $result[$i]["file_name"]);
	}
	else
	{
	    $files = array();
	}
		if((int)$result[$i]["from_admin"] > 0)	
	{

	    
	    
		$ret .= '<div id="'.$result[$i]["id"].'" class="message admin-message" is-read="'.$result[$i]["is_read"].'"><p>'.$probe.'</p>';
		if(count($files) > 0){
		    $ret .= '<div class="files">';
		}
		foreach($files as $value){
		    $start = strrpos($value, '.') + 1;
            $ext = substr($value, $start);
            $filename='http://perfect-crm.ru/assets/images/extensions/'.$ext.'.png';
            $Headers = @get_headers($filename);
            if(strpos($Headers[0], '200')){
	        $ret .= '
	        <div><a target="_blank" href="http://perfect-crm.ru/ticket_files/'.$value.'"><img src="'.$filename.'"></a><a target="_blank" href="http://perfect-crm.ru/ticket_files/'.$value.'">'.$value.'</a></div>';
	    }
	    else{
	        $ret .= '
            <div><a target="_blank" href="http://perfect-crm.ru/ticket_files/'.$value.'"><img src="http://perfect-crm.ru/assets/images/extensions/lnk.png"></a><a target="_blank" href="http://perfect-crm.ru/ticket_files/'.$value.'">'.$value.'</a></div>';
	    }
		}
		if(count($files) > 0){
		    $ret .= '</div>';
		}
		$ret .= '
		<p class="initials"><i class="fa fa-user-circle" aria-hidden="true"></i> '.$fios[$user_id].' <span style="font-size: 12px;">'.$date.'</span></p>';
		if($result[$i]["is_read"] == 1){
		    $ret.="<span class='read'>Прочитано</span>";
		}
		else{
		    $ret.="<span class='read'>Не прочитано</span>";
		}
		if($_SESSION["isAdmin"] == 1){
		    $ret .="<i class='cross fa fa-times' onclick='deleteMessage(".$result[$i]["id"].")'></i></div>";
		}
		else{
		    $ret .="</div>";
		}
	}
	else
	{
		$ret .= '<div id="'.$result[$i]["id"].'" class="message" is-read="'.$result[$i]["is_read"].'"><p>'.$probe.'</p>';
		if(count($files) > 0){
		    $ret .= '<div class="files">';
		
		foreach($files as $value){
		    $isfile = 'http://perfect-crm.ru/ticket_files/'.$value;
		    $head = @get_headers($isfile);
		    if(strpos($head[0], '200')){
            $start = strpos($value, '.') + 1;
            $ext = substr($value, $start);
            if($ext == 'xlsx'){
                $ext = 'xls';
            }
            $filename='http://perfect-crm.ru/assets/images/extensions/'.$ext.'.png';
	        $Headers = @get_headers($filename);
            if(strpos($Headers[0], '200')){
	            $ret .= '
	        <div><a target="_blank" href="http://perfect-crm.ru/ticket_files/'.$value.'"><img src="'.$filename.'"></a><a target="_blank" href="http://perfect-crm.ru/ticket_files/'.$value.'">'.$value.'</a></div>';
	        }
	        else
	        {
	             $ret .= '
            <div><a target="_blank" href="http://perfect-crm.ru/ticket_files/'.$value.'"><img src="http://perfect-crm.ru/assets/images/extensions/lnk.png"></a><a target="_blank" href="http://perfect-crm.ru/ticket_files/'.$value.'">'.$value.'</a></div>';
	        }
	    }
		}
		}
		if(count($files) > 0){
		    $ret .= '</div>';
		}
		$ret .= '
		<p class="initials"><i class="fa fa-user-circle-o" aria-hidden="true"></i> '.$fios[$user_id].' <span style="font-size: 12px;">'.$date.'</span></p>';
	    if($result[$i]["is_read"] == 1){
		    $ret.="<span class='read'>Прочитано</span>";
		}
		else{
		    $ret.="<span class='read'>Не прочитано</span>";
		}
		if($result[$i]["is_done"] == 1){
		    $ret.="<span class='doned'>Выполнено! <i class='fa fa-check-square-o' aria-hidden='true'></i></span>";
		}
		else{
		    $ret.="<span class='doned'>В процессе ... </span>";
		}
		$ret .= $just_finish;
	}	
}

$retu["messages"] = $ret.'</div>';

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

$retu = safe_json_encode($retu);


echo $retu;
#echo json_last_error();
?>