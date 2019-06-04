<?php
session_start();

set_include_path(get_include_path() . PATH_SEPARATOR . "php/" . PATH_SEPARATOR . "controllers/");
spl_autoload_extensions("_class.php");
spl_autoload_register();


function translit($s)
{
    $s = (string) $s; // преобразуем в строковое значение
    $s = mb_strtolower($s);
    $s = preg_replace("/\s+/", ' ', $s); // удаляем повторяющие пробелы
    $s = trim($s); // убираем пробелы в начале и конце строки
    $s = function_exists('mb_strtolower') ? mb_strtolower($s) : strtolower($s); // переводим строку в нижний регистр (иногда надо задать локаль)
    $s = strtr($s, array(
        'а' => 'a',
        'б' => 'b',
        'в' => 'v',
        'г' => 'g',
        'д' => 'd',
        'е' => 'e',
        'ё' => 'e',
        'ж' => 'j',
        'з' => 'z',
        'и' => 'i',
        'й' => 'y',
        'к' => 'k',
        'л' => 'l',
        'м' => 'm',
        'н' => 'n',
        'о' => 'o',
        'п' => 'p',
        'р' => 'r',
        'с' => 's',
        'т' => 't',
        'у' => 'u',
        'ф' => 'f',
        'х' => 'h',
        'ц' => 'c',
        'ч' => 'ch',
        'ш' => 'sh',
        'щ' => 'sch',
        'ы' => 'y',
        'э' => 'e',
        'ю' => 'yu',
        'я' => 'ya',
        'ъ' => '',
        'ь' => ''
    ));
    $s = str_replace(" ", "-", $s); // заменяем пробелы знаком минус
    return $s; // возвращаем результат
}

//Читаем сессию, смотрим, что нам прислали
$user_id = htmlspecialchars($_POST['user_id']);
$theme = htmlspecialchars($_POST['theme']);
if(isset($_POST['is_jkh']) && !empty($_POST['is_jkh'])){
    $is_jkh = 1;
} else {
    $is_jkh = 0;
}
$counter = 1;
$flag = true;
$scans = [];

while($flag){
    if(isset($_FILES['file'.$counter]['name']) && !empty($_FILES['file'.$counter]['name']) && isset($_POST['sum'.$counter]) && !empty($_POST['sum'.$counter])){
        $filename = translit($_FILES['file'.$counter]['name']);
        $filecounter = 1;
        while(file_exists('../ticket_files/'.$user_id.'/'.$filename)){
            $filenamearr = explode('.', $filename);
            if($filecounter > 1){
                $length = -2 - strlen((string) $filecounter);
                $filenamearr[0] = substr($filenamearr[0], 0, $length);
            }
            $filenamearr[0] = $filenamearr[0].'('.$filecounter.')';
            $filename = implode('.', $filenamearr);
            $filecounter++;
        }
        $scans[$counter-1]['scans'] = $filename;
        if(isset($_POST['problem'.$counter]) && !empty($_POST['problem'.$counter])){
            $scans[$counter-1]['commentary'] = htmlspecialchars($_POST['problem'.$counter]);
        } else {
            $scans[$counter-1]['commentary'] = '';
        }
        $scans[$counter-1]['sum'] = htmlspecialchars($_POST['sum'.$counter]);
        if(isset($_POST['is_income'.$counter]) && !empty($_POST['is_income'.$counter])){
            $scans[$counter-1]['is_income'] = 1;
        } else {
            $scans[$counter-1]['is_income'] = 0;
        }
        if(!file_exists('../ticket_files/'.$user_id)){
            mkdir('../ticket_files/'.$user_id);
        }
        move_uploaded_file ($_FILES['file'.$counter]['tmp_name'], '../ticket_files/'.$user_id.'/'.$filename);
    } else {
        $flag = false;
    }
    $counter++;
}

$query = new Query();

// Подготавливаем массив для нового набора отчетов
$date = time();

$scans_theme['user_id'] = $user_id;
$scans_theme['name'] = $theme;
$scans_theme["time_sent"] = $date;
$scans_theme["month"] = date('m');
$scans_theme["year"] = date('Y');
$scans_theme["is_jkh"] = $is_jkh;

$res = $query->_Insert("scans", $scans_theme);
session_start();
if(strlen($res)){
    echo $res;
    $_SESSION["status"] = 1;
    return;
}
$_SESSION["status"] = 0;
session_write_close();

$arr1[0] = "id";
$arr2["time_sent"] = $date;
$scans_theme_id = $query->_Select('scans', $arr1, $arr2);

// Закидываем полученные квитанции в базу
foreach($scans as $scan){
    $scan['scans_id'] = $scans_theme_id[0]["id"];
    $scan['time_sent'] = date('d.m.Y');
    $query->_Insert("scan_docs", $scan);
}

header("Location: /");
?>