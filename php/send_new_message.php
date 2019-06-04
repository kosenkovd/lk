<?php

session_start();

set_include_path(get_include_path().PATH_SEPARATOR."php/".PATH_SEPARATOR."controllers/");
spl_autoload_extensions("_class.php");
spl_autoload_register();

$file_list = $_POST['file'];
$screen = $_POST['screen'];
$file_list = substr($file_list,0,-2);
$from_admin = $_SESSION['isAdmin'];
$user_from_id = $_SESSION["id"];
session_write_close();
$project_id = htmlspecialchars($_POST['project_id']);
if($_POST['screen']!=''){
    $data = 'data:image/png;base64,'.$_POST["screen"];
	    $data = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $data));
	    $nn = time().'.png';
	            $uploaddir = '../ticket_files/'.$nn;
	    file_put_contents($uploaddir, $data);
if(strlen($file_list) >0){
    $file_list .= ", ".$nn;
}
else{
    $file_list = $nn;
}
}

$query = new Query();
$params["problem"] = nl2br(htmlspecialchars($_POST["problem"]));
$params["from_admin"] = $from_admin;
$params["project_id"] = $project_id;
$params["user_from_id"] = $user_from_id;
$params["time_sent"] = time();
$params["subject"] = "-";
$params["file_name"] = $file_list;
$query->_Insert("user_messages", $params);

$select[0] = "name";
$select[1] = "user_id";
$select[2] = "hash_name";
$select[3] = "kagent_id";
$where["id"] = $project_id;
$theme = $query->_Select("project", $select, $where);
$newsel[0] = "id";
$newwh["project_id"] = $project_id;
$idp = $query->_Select("user_messages", $newsel, $newwh, true);


$ret = '';

$arr1[0] = "email";
$arr1[1] = "fio";
$arr2["id"] = $user_from_id;
$result = $query->_Select("users", $arr1, $arr2);
if(strlen($params["file_name"])>0){
    $files = explode(', ', $params["file_name"]);
}
else {
    $files = array();
} 
if($from_admin > 0){
    
    $thm = "Ответ на обращение ".$theme[0]["hash_name"];
    $msg = "На обращение ".$theme[0]["hash_name"].'
    
'.$theme[0]["name"].', получен ответ.

';
    $a1[0] = "email";
    $a1[1] = "is_notificated";
    $a2["id"] = $theme[0]["user_id"];
    $emailto = $query->_Select("users", $a1, $a2);
    $aa1[0] = "problem";
    $aa1[1] = "user_from_id";
    $aa1[2] = "time_sent";
    $aa2["project_id"] = $project_id;
    $chain = $query->_Select("user_messages", $aa1, $aa2, true);
    $chainusersids = array();
    $chainusersfios = array();
    for($o = 0; $o < count($chain); $o++){
        $searchfioelem = array_search($chain[$o]["user_from_id"], $chainusersids);
        if($searchfioelem === false){
            array_push($chainusersids, $chain[$o]["user_from_id"]);
            $searchfio[0] = "fio";
            $searchfioid["id"] = $chain[$o]["user_from_id"];
            $foundfio = $query->_Select("users", $searchfio, $searchfioid);
            array_push($chainusersfios, $foundfio[0]["fio"]);
            $thischainfio = $foundfio[0]["fio"];
        }
        else{
            $thischainfio = $chainusersfios[$searchfioelem];
        }
        $date = date('d.m.y   G:i', $chain[$o]["time_sent"]);
        $new = br2nl($chain[$o]["problem"]);
       
        $msg .= $new.'
        
        '.$thischainfio.' в '.$date.'
        
';
    }
    $msg .= "С уважением,
команда Медиасофт";
if($emailto[0]["is_notificated"]){
    $email = new Email();
    $email->sendMail($emailto[0]["email"], $thm, $msg);
}
    

	$probe = $params["problem"];
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
	
	$ret .= '<div class="message admin-message" id="'.$idp[0]["id"].'" is-read="0"><p>'.$probe.'</p>';
	if(count($files) > 0){
		    $ret .= '<p>Приложенный(е) файл(ы): </p><div class="files">';
		
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
		}
	$ret.='
	<p class="initials"><i class="fa fa-user-circle" aria-hidden="true"></i> '.$result[0]["fio"].' <span style="font-size: 12px;">'.date('d.m.y   G:i', $params["time_sent"]).'</span></p><span class="read">Не прочитано</span><i class="cross fa fa-times" onclick="deleteMessage('.$idp[0]["id"].')"></i></div>';
}
else{
    $kagsel[0] = "name";
    $kagwh["id"] = $theme[0]["kagent_id"];
    $ussel[0] ="fio";
    $uswh["id"] = $theme[0]["user_id"];
    
    $kagentname = $query->_Select("k_agents", $kagsel, $kagwh);
    $userfio = $query->_Select("users", $ussel, $uswh);
    
     $thm = $theme[0]["hash_name"].", ".$kagentname[0]["name"].", ".$userfio[0]["fio"];
    $msg = $userfio[0]["fio"].'
    

';
    $aa1[0] = "problem";
    $aa1[1] = "user_from_id";
    $aa1[2] = "time_sent";
    $aa2["project_id"] = $project_id;
    $chain = $query->_Select("user_messages", $aa1, $aa2, true);
    $chainusersids = array();
    $chainusersfios = array();
    for($o = 0; $o < count($chain); $o++){
        $searchfioelem = array_search($chain[$o]["user_from_id"], $chainusersids);
        if($searchfioelem === false){
            array_push($chainusersids, $chain[$o]["user_from_id"]);
            $searchfio[0] = "fio";
            $searchfioid["id"] = $chain[$o]["user_from_id"];
            $foundfio = $query->_Select("users", $searchfio, $searchfioid);
            array_push($chainusersfios, $foundfio[0]["fio"]);
            $thischainfio = $foundfio[0]["fio"];
        }
        else{
            $thischainfio = $chainusersfios[$searchfioelem];
        }
        $date = date('d.m.y   G:i', $chain[$o]["time_sent"]);
        $new = br2nl($chain[$o]["problem"]);
       
        $msg .= $new.'
        
        '.$thischainfio.' в '.$date.'
        
';
    }
    $msg .= "С уважением,
команда Медиасофт";
    $email = new Email();
       $email->sendMail('support@mediasoft.su', $thm, $msg);
 #   $email->sendMail('wdenkosw@gmail.com', $thm, $msg);
    
	$probe = $params["problem"];
	    $e = true;
	    $o = 0;
	    while($e){
	        $a = strpos($probe, 'http://', $o);
	    if($a === false){
	        $a = strpos($probe, 'https://');
	    }
	    if($a !== false){
	        $o = $a +2;
	        $b = $a-1;
	        $c = $a+5;
	        $part1 = substr($probe, 0, $b);
	        $e = strpos($probe, " ", $a);
	        if($e !== false){
	            $o = $e - $a;
	        $part2 = substr($probe, $a, $o);
	        $part3 = substr($probe, $e);
	        $probe = $part1.' <a href="'.$part2.'" target="_blank">'.$part2.'</a> '.$part3;
	        }
	        else{
	            $part2 = substr($probe, $a);
	            $probe = $part1.' <a href="'.$part2.'" target="_blank">'.$part2.'</a> ';
	        }
	    }
	    else{
	        $e = false;
	    }
	    }
	$ret .= '<div class="message" id="'.$idp[0]["id"].'" is-read="0"><p>'.$probe.'</p>';
	if(count($files) > 0){
		    $ret .= '<p>Приложенный(е) файл(ы): </p><div class="files">';
		
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
		}
	$ret .= '
	<p class="initials"><i class="fa fa-user-circle-o" aria-hidden="true"></i> '.$result[0]["fio"].' <span style="font-size: 12px;">'.date('d.m.y   G:i', $params["time_sent"]).'</span></p><span class="read">Не прочитано <i class="fa fa-square-o" aria-hidden="true"></i></span></div>';
}

echo $ret;

 function _mail ($from, $to, $subj, $what)
{
mail($to, $subj, $what, 
"From: $from
Reply-To: $from
Content-Type: text/plain; charset=utf-8
Content-Transfer-Encoding: 8bit"
);
}
function br2nl($str) {
return  preg_replace('/<br\\s*?\/??>/i', '', $str);
}
?>