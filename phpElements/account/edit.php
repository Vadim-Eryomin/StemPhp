<?php 
    $need_id = $_POST['id'];
    $query = 
    "SELECT P.id, names.name, names.surname, names.img_src, roles.admin, roles.teacher, coins.coin
    FROM (SELECT * from usr WHERE id = $need_id) as P
    JOIN coins ON coins.id = P.id
    JOIN names ON names.id = P.id
    JOIN roles ON roles.id = P.id";

    $result = mysqli_query($connect, $query);
    $row = mysqli_fetch_row($result);

?>

<form class="card" method="POST">
    <img src="<?php echo $row[3] ?>" class="center-image">
    <div class="card-text">
        Name: <input type="text" value="<?php echo $row[1] ?>" name="name"><br><br>
        Surname: <input type="text" value="<?php echo $row[2] ?>" name="surname"><br><br>
        Image: <input type="text" value="<?php echo $row[3] ?>" name="img_src"><br><br>
        <input type="checkbox" name="admin" <?php if($row[4]==1) echo 'checked'; ?>> Админ <br>
        <input type="checkbox" name="teacher" <?php if($row[5]==1) echo 'checked'; ?>> Учитель
    </div>

    <input type="hidden" name="id" value="<?php echo $row[0] ?>">
    <input type="hidden" name="ACTION" value="SAVE">
    <input type="hidden" name="ADMIN" value="ACCOUNT">
    <input type="hidden" name="RUN" value="ADMIN">
    <button class="card-button">Изменить</button>
</form>