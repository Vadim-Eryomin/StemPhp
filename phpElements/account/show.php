<?php 
    $query = "SELECT id, name, surname, img_src FROM names";

    $result = mysqli_query($connect, $query);
    $rows = mysqli_num_rows($result);

    for($i = 0; $i < $rows; $i++){
        $row = mysqli_fetch_row($result);
        ?>

        <form class="card" method="POST">
            <img src="<?php echo $row[3] ?>" class="center-image">
            <div class="card-text">
                <?php echo $row[1], ' ', $row[2] ?>
            </div>
            <input type="hidden" name="id" value="<?php echo $row[0] ?>">
            <input type="hidden" name="ACTION" value="EDIT">
            <input type="hidden" name="ADMIN" value="ACCOUNT">
            <input type="hidden" name="RUN" value="ADMIN">
            <button class="card-button">Изменить</button>
        </form>

        <?php
    }       
?>

<form class="card" method="POST">
    <input type="hidden" name="ACTION" value="PREPARE CREATE">
    <input type="hidden" name="ADMIN" value="ACCOUNT">
    <input type="hidden" name="RUN" value="ADMIN">
    <button class="card-button" style="width: 100%; height: 100%; margin: auto; border: none">Добавить</button>
</form>