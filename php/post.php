<?php
// ----------------------------êîíôèãóðàöèÿ-------------------------- // 
session_start();
 $_SESSION['status']=0;
session_write_close();
header('Content-Type: text/html; charset=utf-8'); 
$adminemail="sher@mediasoft.su";  // e-mail àäìèíà 
#$adminemail="wdenkosw@gmail.com";
mb_internal_encoding("UTF-8");
 
$date=date("d.m.y"); // ÷èñëî.ìåñÿö.ãîä 
 
$time=date("H:i"); // ÷àñû:ìèíóòû:ñåêóíäû 
 
$backurl="http://perfect-crm.ru/index";  // Íà êàêóþ ñòðàíè÷êó ïåðåõîäèò ïîñëå îòïðàâêè ïèñüìà 
 
//---------------------------------------------------------------------- // 
 

 
// Ïðèíèìàåì äàííûå ñ ôîðìû 
 
$email=$_POST["contact"]; 
 
$name=$_POST["name"]; 

$question=$_POST["question"];   
 
$passed=$_POST["passed"];

if(strcmp($passed, "passed") === 0){
    
// Ïðîâåðÿåì âàëèäíîñòü e-mail 
$subject = "Новый запрос от $name";
$message = "$date в $time был подан запрос от $name: $question контакт - $email";
  
 
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
 

  // Âûâîäèì ñîîáùåíèå ïîëüçîâàòåëþ 

print "<script language='Javascript'><!-- 
if(window.history.length > 2){
window.history.go(-2);  }
else {window.history.back();}
//--></script>";  
    
}

exit; 
 
 
 
?>