<?php
set_include_path(get_include_path().PATH_SEPARATOR."php/".PATH_SEPARATOR."controllers/");
spl_autoload_extensions("_class.php");
spl_autoload_register();
session_start();
if(!$_SESSION["isAdmin"]) {
    $user_id = $_SESSION["id"];
} else {
    $user_id = (int)$_GET["user_id"];
}
session_write_close();

if(!file_exists('../ticket_files/'.$user_id)){
    mkdir('../ticket_files/'.$user_id);
}
$uploaddir = '../ticket_files/'.$user_id.'/';
for($i = 0; $i < count($_FILES['uploads']['name']); $i++)
{
    $string = translit($_FILES['uploads']['name'][$i]);
    $string = basename($string);
    $string = newName($uploaddir, $string);
    $uploadfile = $uploaddir.$string;
move_uploaded_file($_FILES['uploads']['tmp_name'][$i], $uploadfile);
$time= substr(time(), -4);
$sata .= "file".$time;
$vata .= $string;
}

$arr1["biometry"] = $vata;
$arr2["id"] = $user_id;

$query = new Query();

$query->_Update("users", $arr1, $arr2);

function translit($s) {
  $s = (string) $s; // преобразуем в строковое значение
    $s = mb_strtolower($s);
  $s = preg_replace("/\s+/", ' ', $s); // удаляем повторяющие пробелы
  $s = trim($s); // убираем пробелы в начале и конце строки
  $s = function_exists('mb_strtolower') ? mb_strtolower($s) : strtolower($s); // переводим строку в нижний регистр (иногда надо задать локаль)
  $s = strtr($s, array('а'=>'a','б'=>'b','в'=>'v','г'=>'g','д'=>'d','е'=>'e','ё'=>'e','ж'=>'j','з'=>'z','и'=>'i','й'=>'y','к'=>'k','л'=>'l','м'=>'m','н'=>'n','о'=>'o','п'=>'p','р'=>'r','с'=>'s','т'=>'t','у'=>'u','ф'=>'f','х'=>'h','ц'=>'c','ч'=>'ch','ш'=>'sh','щ'=>'shch','ы'=>'y','э'=>'e','ю'=>'yu','я'=>'ya','ъ'=>'','ь'=>''));
  $s = str_replace(" ", "-", $s); // заменяем пробелы знаком минус
  return $s; // возвращаем результат
}

function newName($uploaddir, $filename){
    $filecounter = 1;
    while(file_exists($uploaddir.$filename)){
            $filenamearr = explode('.', $filename);
            if($filecounter > 1){
                $length = -2 - strlen((string) $filecounter);
                $filenamearr[0] = substr($filenamearr[0], 0, $length);
            }
            $filenamearr[0] = $filenamearr[0].'('.$filecounter.')';
            $filename = implode('.', $filenamearr);
            $filecounter++;
        }
    
    return $filename;
}
$ans["vata"] = $vata;
$ans["id"] = $user_id;
echo json_encode($ans);
?>