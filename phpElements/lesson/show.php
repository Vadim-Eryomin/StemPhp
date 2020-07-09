<?php 
    if($GLOBALS['admin'] === 1){
        $query = 
        "SELECT course.id, names.name, names.surname, course.name,
        course.first_date, course.img_src, names.img_src
        FROM course
        JOIN names ON names.id = course.teacherId";
    }
    else if($GLOBALS['teacher'] == 1){
        $query = 
        "SELECT course.id, names.name, names.surname, course.name,
        course.first_date, course.img_src, names.img_src
        FROM course
        JOIN names ON names.id = course.teacherId
        WHERE course.teacherId = $id";
    }
    else{
        $query = 
        "SELECT course.id, names.name, names.surname, course.name,
         course.first_date, course.img_src, names.img_src
        FROM course
        JOIN names ON names.id = course.teacherId
        JOIN pupil ON pupil.course_id = course.id
        WHERE pupil.pupil_id = $id";
    }
    $courses = mysqli_query($connect, $query) or die("Ошибка запроса");
    $limit = mysqli_num_rows($courses);

    for($i = 0; $i < $limit; $i++){
        $row = mysqli_fetch_row($courses);

        $next_date = strtotime($row[4]);
        $time = time();

        while($time > $next_date) $next_date += 604800;
        $next_date = date('H:i:s d-M-Y', $next_date);
    ?>
    <form class="card" method="POST">
        <div class="card-inner">
            <img src="<?php echo $row[5] ?>" class="center-image">
            <div class="card-text">
                <b><?php echo $row[3] ?></b><br>
                Ведет: <?php echo $row[1], ' ', $row[2] ?><br>
                Следующее занятие: <?php echo $next_date ?>
            </div>
            <button class="card-button" style="width: 100px">Смотреть</button>        
        </div>
        <input type="hidden" name="id" value="<?php echo $row[0] ?>">
        <input type="hidden" name="date" value="<?php echo strtotime($next_date) ?>">
        <input type="hidden" name="RUN" value="TIMETABLE">
        <input type="hidden" name="TIMETABLE" value="SHOW">
    </form>
    <?php
    }
?>