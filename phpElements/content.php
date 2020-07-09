<?php
    if(isset($_COOKIE['id'])){
        if(isset($_POST['RUN'])){
            if($_POST['RUN'] === 'PROFILE'){
                require ("connect.php");
                require ("cookieData.php");
                require ("profile.php");
                mysqli_close($connect);
            }
            if($_POST['RUN'] === 'NEWS'){
                require ("vk.php");            
            }
            if($_POST['RUN'] === 'SHOP'){
                require ("connect.php");
                require ("cookieData.php");
                require ("buy.php");
                require ("shop.php");
                mysqli_close($connect);
            }
            if($_POST['RUN'] === 'ADMIN'){
                require ("connect.php");
                require ("cookieData.php");
                require ("admin.php");
                mysqli_close($connect);
            }
            if($_POST['RUN'] === 'TIMETABLE'){
                require ("connect.php");
                require ("cookieData.php");
                require ("timetable.php");
                mysqli_close($connect);
            }
        }        
    }
    else{
        if(isset($_POST['RUN']) && $_POST['RUN'] === "ENTER"){
            require ("connect.php");

            $login = htmlentities($_POST['login']);
            $password = htmlentities($_POST['password']);

            $query = 
            "SELECT P.id, names.name, names.surname, names.img_src 
            FROM (SELECT * FROM usr WHERE login = '$login' and password = '$password') as P 
            JOIN names on P.id = names.id ";
            
            $response = mysqli_query($connect, $query);
            if(mysqli_num_rows($response) > 0){
                $row = mysqli_fetch_row($response);
        
                $id = $row[0];
                $cookie = setcookie('id', dechex($id ^ 11111111), time() + 3600) or die("Ошибка создания cookie");
                
                $name = $row[1];
                $surname = $row[2];
                $img_src= $row[3];
            }
            else{
                require ("login.php");
            }
        }
        else{
            require ("login.php");
        }
        
    }
?>