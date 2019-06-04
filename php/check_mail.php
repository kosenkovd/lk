<?php

set_include_path(get_include_path().PATH_SEPARATOR."php/".PATH_SEPARATOR."controllers/");
spl_autoload_extensions("_class.php");
spl_autoload_register();

$id = (int)$_POST["id"];
$project_id = (int)$_POST["project_id"];
$arr1[0] = "id";
$arr1[1] = "problem";
$arr1[2] = "is_read";
$arr1[3] = "from_admin";
$arr1[4] = "user_from_id";
$arr1[5] = "time_sent";
$arr1[6] = "file_name";
$arr2["id"] =$id;
$arr2["project_id"] =$project_id;
$arr3[0] = ">=";
$arr3[1] = "=";
$query = new Query();
$result = $query->_SelectMoreOrLess("user_messages", $arr1, $arr2, $arr3);
if(count($result) == 0){
	echo $ret;
}
$ret = $result[0]["is_read"];
$fios = array();
for($i = 1; $i < count($result); $i++){
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
	    if(is_null($result[$i]["time_sent"])){
	        $date='';
	    }
	    else{
	    $date = date('d.m.y   G:i', $result[$i]["time_sent"]);
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
	    
		$ret .= '<div id="'.$result[$i]["id"].'" class="message admin-message" is-read="'.$result[$i]["is_read"].'"><p>'.$probe.'</p>';
		if(count($files) > 0){
		    $ret .= '<p>Приложенный(е) файл(ы): </p><div class="files">';
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
		<p class="initials"><i class="fa fa-user-circle" aria-hidden="true"></i> '.$fios[$user_id].' <span style="font-size: 12px;">'.$date.'</span></p><span class="read">Не прочитано <i class="fa fa-square-o" aria-hidden="true"></i></span></div>';
	}
	else
	{
	    if(is_null($result[$i]["time_sent"])){
	        $date='';
	    }
	    else{
	    $date = date('d.m.y   G:i', $result[$i]["time_sent"]);
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
	    
		$ret .= '<div id="'.$result[$i]["id"].'" class="message" is-read="'.$result[$i]["is_read"].'"><p>'.$probe.'</p>';
		if(count($files) > 0){
		    $ret .= '<p>Приложенный(е) файл(ы): </p><div class="files">';
		
		foreach($files as $value){
		    $isfile = 'http://perfect-crm.ru/ticket_files/'.$value;
		    $head = @get_headers($isfile);
		    if(strpos($head[0], '200')){
            $start = strrpos($value, '.') + 1;
            $ext = substr($value, $start);
            $filename='/assets/images/extensions/'.$ext.'.png';
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
		<p class="initials"><i class="fa fa-user-circle-o" aria-hidden="true"></i> '.$fios[$user_id].' <span style="font-size: 12px;">'.$date.'</span></p><span class="read">Не прочитано <i class="fa fa-square-o" aria-hidden="true"></i></span></div>';
	}	
}

echo $ret;

?>