<form method="POST" id="form">
    <input type="hidden" name="ADMIN" value="ACCOUNT">
    <input type="hidden" name="RUN" value="ADMIN">
</form>
<?php 
    $name = strip_tags($_POST['name']);
    $surname = strip_tags($_POST['surname']);
    $need_id = strip_tags($_POST['id']);
    $image_src = strip_tags($_POST['img_src']);

    if(isset($_POST['admin'])) $admin = 1;
    else $admin = 0;

    if(isset($_POST['teacher']))  $teacher = 1;
    else $teacher = 0;

    $query = "UPDATE roles SET admin = $admin, teacher = $teacher WHERE id = $need_id";
    mysqli_query($connect, $query) or die('Ошибка запроса');

    $query = "UPDATE names SET name = '$name', surname = '$surname', img_src = '$image_src' WHERE id = $need_id";
    mysqli_query($connect, $query) or die('Ошибка запроса');
    
?>

<script>
    document.getElementById('form').submit();
</script>