<?php
    $need_id = $_POST['id'];
    $need_date = date('Y-m-d H:i:s', $_POST['date']);
    

    $query = 
    "SELECT homework
    FROM homework 
    WHERE course_id = $need_id AND date = '$need_date'";
    $result = mysqli_query($connect, $query) or die("Ошибка запроса");        
    $homework = mysqli_num_rows($result) > 0 ? mysqli_fetch_row($result)[0] : 'Кажется, ничего нет!';

?>

<form class="card" method="POST">
    <img src="image/just.png" class="center-image">
    <div class="card-text">
        Домашняя работа:<br> <textarea name="homework"><?php echo $homework ?></textarea><br><br>
    </div>

    <input type="hidden" name="HOMEWORK" value="SAVE">
    <input type="hidden" name="TIMETABLE" value="HOMEWORK">
    <input type="hidden" name="RUN" value="TIMETABLE">
    <input type="hidden" name="date" value="<?php echo $need_date?>">
    <input type="hidden" name="id" value="<?php echo $need_id?>">
    <button class="card-button">Сохранить</button>
</form>