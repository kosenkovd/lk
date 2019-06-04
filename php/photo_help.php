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
$gallery["user_id"] = htmlspecialchars($_POST['user_id']);
$gallery["files"] = '';
foreach ($_FILES["file"]["error"] as $key => $error) {
    if ($error == UPLOAD_ERR_OK) {
        $tmp_name = $_FILES["file"]["tmp_name"][$key];
        // basename() может спасти от атак на файловую систему;
        // может понадобиться дополнительная проверка/очистка имени файла
        $filename = translit(basename($_FILES["file"]["name"][$key]));
        $filecounter = 1;
        while(file_exists('../photo_reports/'.$gallery["user_id"].'/'.$filename)){
            $filenamearr = explode('.', $filename);
            if($filecounter > 1){
                $length = -2 - strlen((string) $filecounter);
                $filenamearr[0] = substr($filenamearr[0], 0, $length);
            }
            $filenamearr[0] = $filenamearr[0].'('.$filecounter.')';
            $filename = implode('.', $filenamearr);
            $filecounter++;
        }
        if(!file_exists('../photo_reports/'.$gallery["user_id"])){
            mkdir('../photo_reports/'.$gallery["user_id"]);
        }
        move_uploaded_file($tmp_name, '../photo_reports/'.$gallery["user_id"].'/'.$filename);
        $gallery["files"] .= $filename.',';
    }
}

$gallery["files"] = substr($gallery["files"], 0, -1);

$date = time();

$gallery["time_sent"] = $date;
$gallery["month"] = date('m');
$gallery["year"] = date('Y');

$query = new Query();

$res = $query->_Insert("photo_reports", $gallery);
session_start();
if(strlen($res)){
    echo $res;
    $_SESSION["status"] = 1;
    return;
}
$_SESSION["status"] = 0;
session_write_close();
header("Location: /");
?>