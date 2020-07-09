<form method="POST" id="form">
    <input type="hidden" name="id" value="NEW">
    <input type="hidden" name="ADMIN" value="ACCOUNT">
    <input type="hidden" name="RUN" value="ADMIN">
</form>

<?php 
    echo 'im here';
    $name = strip_tags($_POST['name']);
    $login = strip_tags($_POST['login']);
    $password = strip_tags($_POST['password']);
    $surname = strip_tags($_POST['surname']);
    $image_src = strip_tags($_POST['img_src']);

    echo $name, ' ', $surname, ' ', $login, ' ', $password, ' ', $image_src;
    
    if(isset($_POST['admin'])) $admin = 1;
    else $admin = 0;

    if(isset($_POST['teacher'])) $teacher = 1;
    else $teacher = 0;

    $query = "INSERT INTO usr VALUES(null, '$login', '$password')";
    mysqli_query($connect, $query) or die('Ошибка запроса usr');

    $query = "SELECT id FROM usr WHERE login='$login' AND password='$password'";
    
    $need_id_result = mysqli_query($connect, $query);
    echo mysqli_error($connect);

    $row = mysqli_fetch_row($need_id_result);
    $need_id = $row[0];

    $query = "INSERT INTO names VALUES($need_id, '$name', '$surname', '$image_src')";
    mysqli_query($connect, $query) or die('Ошибка запроса names');

    $query = "INSERT INTO coins VALUES($need_id, 0)";
    mysqli_query($connect, $query) or die('Ошибка запроса coins');

    $query = "INSERT INTO roles VALUES($need_id, $admin, $teacher)";
    mysqli_query($connect, $query) or die('Ошибка запроса roles');

    

?>
<script>
    document.getElementById('form').submit();
</script>