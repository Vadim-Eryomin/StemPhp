<?php 
    $host = 'localhost';
    $database = 'diary';
    $user = 'root';
    $password = '1234';

    $connect = mysqli_connect($host, $user, $password, $database) or die('Ошибка подключения к БД');
    mysqli_set_charset($connect, 'utf8') or die('Ошибка замены чарсета');
?>