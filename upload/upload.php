<?php
$uploaddir = '../ticket_files/';
for($i = 0; $i < count($_FILES['uploads']['name']); $i++)
{
    $uploadfile = $uploaddir.basename($_FILES['uploads']['name'][$i]);
move_uploaded_file($_FILES['uploads']['tmp_name'][$i], $uploadfile);
}
?>