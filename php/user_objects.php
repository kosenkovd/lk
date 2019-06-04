<?php

set_include_path(get_include_path().PATH_SEPARATOR."php/".PATH_SEPARATOR."controllers/");
spl_autoload_extensions("_class.php");
spl_autoload_register();



session_start();
$val= '';
$query = new Query();
$isAdmin = $_SESSION["isAdmin"];
if($isAdmin == 2){
    $arr1[0] = "cat_moder";
    $id["id"] = $_SESSION["id"];
    session_write_close;
    $categories = $query->_Select("users", $arr1, $id);
    $arr1[0] = "id";
    $arr1[1] = "name";
    $arr1[2] = "user_id";
    $arr1[3] = "hash";
    $arr1[4] = "hash_name";
    $arr1[5] = "time_closed";
    $arr2["kagent_id"] = (int)$_POST["kAgent"];
    $arr2["is_closed"] = 0;
    $arr2["category_id"] = $categories[0]['cat_moder'];
    $result = $query->_SelectInRange("project", $arr1, $arr2, true,'hash_name');
}
else{
    session_write_close();
    $arr1[0] = "id";
    $arr1[1] = "name";
    $arr1[2] = "user_id";
    $arr1[3] = "hash";
    $arr1[5] = "hash_name";
    $arr1[4] = "time_closed";
    $arr2["kagent_id"] = (int)$_POST["kAgent"];
    $arr2["is_closed"] = 0;
    $result = $query->_Select("project", $arr1, $arr2, true,'hash');
}


for ($i = 0; $i < count($result); $i++) {
    if($result[$i]["hash_name"] == 0){
        $result[$i]["hash_name"] = '';
    }
    $a[0] = "COUNT(*)";
    $b["project_id"] = $result[$i]["id"];
    $b["is_read"] = 0;
    $b["from_admin"] = 0;
    if($isAdmin==0){
        $bb[0] = "=";
        $bb[1] = "=";
        $bb[2] = "=";
        $inf = $query->_SelectMoreOrLess("user_messages", $a, $b, $bb);
    }
    else{
        $inf = $query->_Select("user_messages", $a, $b);
    }
    $newMessages = $inf[0]["COUNT(*)"];
    $elapsedTime = "</br>".round((time() - $result[$i]["hash"])/60/60/24);
    if(substr($elapsedTime, 5) == 0){
        $elapsedTime = 'Сегодня';
    }
    else{
        if(substr($elapsedTime, 5)  > 30){
            $elapsedTime = "<br/>больше месяца";
        }
        else{
        if((substr($elapsedTime, 5) == 1) or (substr($elapsedTime, 5)  == 21)){
            $elapsedTime .= " день";
        }
        else{
            if((substr($elapsedTime, 5)  == 0) or ((substr($elapsedTime, 5)  > 4) and (substr($elapsedTime, 5)  < 21)) or ((substr($elapsedTime, 5)  > 24) and (substr($elapsedTime, 5)  < 31)))
            {
                $elapsedTime .= " дней";
            }
            else{
                $elapsedTime .= " дня";
            }
        }
        }
    }
	if(count($result)-$i == 1){
	    if($newMessages == 0){
	        $val .= '<li class="tabbing" id="prjct'.$result[$i]["id"].'" style="border-bottom: 1px solid #999999;"><a onclick="getProjectMail('.$result[$i]["id"].',1,0)">'.$result[$i]["hash_name"].' '.$result[$i]["name"].'  <i style="font-size: 14px; padding-left: 10px;">'.$elapsedTime.'</i></a></li>';
	    }
	    else{
	         $val .= '<li class="tabbing" id="prjct'.$result[$i]["id"].'" style="border-bottom: 1px solid #999999;"><a onclick="getProjectMail('.$result[$i]["id"].',1,0)"><strong>'.$result[$i]["hash_name"].' '.$result[$i]["name"].'</strong>  <i style="font-size: 14px; padding-left: 10px;">'.$elapsedTime.'</i></a></li>';   
	    }
	}
	else{
	    if($newMessages == 0){
	        $val .= '<li class="tabbing" id="prjct'.$result[$i]["id"].'"><a onclick="getProjectMail('.$result[$i]["id"].',1,0)">'.$result[$i]["hash_name"].' '.$result[$i]["name"].'  <i style="font-size: 14px; padding-left: 10px;">'.$elapsedTime.'</i></a></li>';
	    }
	    else{
	        $val .= '<li class="tabbing" id="prjct'.$result[$i]["id"].'"><a onclick="getProjectMail('.$result[$i]["id"].',1,0)"><strong>'.$result[$i]["hash_name"].' '.$result[$i]["name"].'</strong>  <i style="font-size: 14px; padding-left: 10px;">'.$elapsedTime.'</i></a></li>';
	    }
	}			
}
$val.='';
$json['opened'] = $val;
$value= '';
$arr2["is_closed"] = 1;
$currentId = 0;
$lastmesages = [];
if($isAdmin == 2){
    $res = $query->_SelectInRange("project", $arr1, $arr2, true, "time_closed");
}
else{
    $res = $query->_Select("project", $arr1, $arr2, true, "time_closed");
}
for($i = 0; $i< count($res); $i++){
    $msg[0] = 'time_sent';
    $prjct["project_id"] = $res[$i]["id"];
    $messages = $query->_Select("user_messages", $msg, $prjct, true);
    $lastmessages['thm'.$i] = $messages[0]['time_sent'];
}
arsort($lastmessages);
foreach ($lastmessages as $key => $val) {
    $i = substr($key, 3);
    if($res[$i]["hash_name"] == 0){
        $res[$i]["hash_name"] = '';
    }
    if($res[$i]["time_closed"] > 0){
        $time = "<br/>Закрыто ".date('d.m.y', $res[$i]["time_closed"]);
	    $value .= '<li class="tabbing" id="clsdprjct'.$res[$i]["id"].'"><a onclick="getProjectMail('.$res[$i]["id"].',1, 1)">'.$res[$i]["hash_name"].' '.$res[$i]["name"].' '.$time.'</a></li>';
    }
    else{
	$value .= '<li class="tabbing" id="clsdprjct'.$res[$i]["id"].'"><a onclick="getProjectMail('.$res[$i]["id"].',1, 1)">'.$res[$i]["hash_name"].' '.$res[$i]["name"].'</a></li>';
    }
}
$value .= '';
$json['closed'] = $value;
echo json_encode($json);
?>