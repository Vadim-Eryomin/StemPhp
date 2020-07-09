<?php 
    global $id; $id = hexdec($_COOKIE['id']) ^ 11111111;
    $query = 
    "SELECT names.name, names.surname, names.img_src, 
    roles.admin, roles.teacher
    FROM (SELECT * FROM usr WHERE id='$id') as P 
    JOIN names on P.id = names.id 
    JOIN roles on P.id = roles.id";
    
    $response = mysqli_query($connect, $query) or die("Ошибка получения cookie данных");
    $row = mysqli_fetch_row($response);
    
    global $name; 
    $name = $row[0];
    global $surname; 
    $surname = $row[1];
    global $img_src; 
    $img_src = $row[2];
    global $admin; 
    $admin = $row[3];
    global $teacher; 
    $teacher = $row[4];
?>