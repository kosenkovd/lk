<? 
// ----------------------------êîíôèãóðàöèÿ-------------------------- // 

header('Content-Type: text/html; charset=utf-8'); 
$adminemail="sher@mediasoft.su";  // e-mail àäìèíà 
#$adminemail="wdenkosw@gmail.com";
mb_internal_encoding("UTF-8");
 
$date=date("d.m.y"); // ÷èñëî.ìåñÿö.ãîä 
 
$time=date("H:i"); // ÷àñû:ìèíóòû:ñåêóíäû 
 
$backurl="http://perfect-crm.ru/contact";  // Íà êàêóþ ñòðàíè÷êó ïåðåõîäèò ïîñëå îòïðàâêè ïèñüìà 
 
//---------------------------------------------------------------------- // 
 

 
// Ïðèíèìàåì äàííûå ñ ôîðìû 
 
$email=$_POST["email"]; 
 
$fio=$_POST["fio"];

$company=$_POST["company"];    

$phone=$_POST["phone"];

$problem = $_POST['problem'];

if(isset($email) and isset($fio) and isset($company) and isset($phone)){
    

 
$subject = "Запрос от $fio";

if(strlen($problem)>5){
    $message = "$date в $time был произведен запрос.

Описание процессов: $problem. 

$fio, $company, $phone, $email";
}
else{
    $message = "$date в $time был произведен запрос. $fio, $company, $phone, $email";
}

  
 
 // Îòïðàâëÿåì ïèñüìî àäìèíó  
 
 function _mail ($from, $to, $subj, $what)
{
mail($to, $subj, $what, 
"From: $from
Reply-To: $from
Content-Type: text/plain; charset=utf-8
Content-Transfer-Encoding: 8bit"
);
}

_mail ('support@perfect-crm.ru', $adminemail, $subject, $message); // Ñîõðàíÿåì â áàçó äàííûõ 
 // Ñîõðàíÿåì â áàçó äàííûõ 
 

  // Âûâîäèì ñîîáùåíèå ïîëüçîâàòåëþ 
echo 1;
 
}
else{
    echo 0;
}
?>