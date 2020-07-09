<div class="card-container">
<?php 
    $query = 
    "SELECT course.id, names.name, names.surname, course.name, course.img_src, course.first_date, course.next_date
    FROM course
    JOIN names ON course.teacherId = names.id
    WHERE course.teacherId = $id";

    $result = mysqli_query($connect, $query);
    $rows = mysqli_num_rows($result);

    for($i = 0; $i < $rows; $i++){
        $row = mysqli_fetch_row($result);
        $first_date = $row[5];

        if(!isset($row[6]) or $row[6] == NULL) $next_date = strtotime($first_date);
        else $next_date = strtotime($row[6]);
        
        $time = time();
        while($time > $next_date) $next_date += 604800;
        $next_date = date('H:i:s d-M-Y', $next_date);
        ?>

        <form class="card" method="POST">
            <div class="card-inner">
                <img src="<?php echo $row[4] ?>" class="center-image">
                <div class="card-text">
                    <?php echo $row[3] ?><br>
                    Ведет: <?php echo $row[1], ' ', $row[2] ?><br>
                    Следующее занятие: <?php echo $next_date ?>
                </div>
                <input type="hidden" name="id" value="<?php echo $row[0] ?>">
                <input type="hidden" name="ACTION" value="EDIT">
                <input type="hidden" name="ADMIN" value="TIMETABLE">
                <input type="hidden" name="RUN" value="ADMIN">
                <button class="card-button">Изменить</button>
            </div>
        </form>

        <?php
    }       
?>

<form class="card" method="POST">
    <input type="hidden" name="ACTION" value="PREPARE CREATE">
    <input type="hidden" name="ADMIN" value="TIMETABLE">
    <input type="hidden" name="RUN" value="ADMIN">
    <button class="card-button" style="width: 100%; height: 422px; margin: auto; border: none">Добавить</button>
</form>
</div>
