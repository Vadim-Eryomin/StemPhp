<?php
    $need_id = $_POST['id'];

    $query = 
    "SELECT id, name, first_date, img_src FROM course WHERE id = $need_id";
    $result = mysqli_query($connect, $query);
    $course = mysqli_fetch_row($result);
    $course_id = $course[0];

    $query = 
    "SELECT course.teacherId, names.name, names.surname
    FROM course
    JOIN names ON names.id = course.teacherId";
    $result = mysqli_query($connect, $query);
    $teacher = mysqli_fetch_row($result) or die('Ошибка запроса учителя');
    $teacher_id = $teacher[0];

    $query = 
    "SELECT usr.id, names.name, names.surname
    FROM usr 
    JOIN roles ON roles.id = usr.id
    JOIN names ON names.id = usr.id
    WHERE roles.teacher = 1 AND usr.id NOT IN ($teacher_id)";
    $all_teachers = mysqli_query($connect, $query) or die('Ошибка запроса остальных учителей');

    $query = 
    "SELECT pupil.pupil_id, usr.login, names.name, names.surname
    FROM pupil
    JOIN names ON pupil.pupil_id = names.id
    JOIN usr ON pupil.pupil_id = usr.id
    WHERE pupil.course_id = $course_id";
    $pupils = mysqli_query($connect, $query) or die('Ошибка запроса учеников');
    $ids = mysqli_query($connect, $query) or die('Ошибка запроса учеников');

    $pupil_ids = '';
    $limit = mysqli_num_rows($ids);
    if($limit != 0){
        for($i = 0; $i < $limit; $i++) $pupil_ids .= mysqli_fetch_row($ids)[0] . ($i + 1 == $limit ? '' : ', ');

        $query = 
        "SELECT usr.id, names.name, names.surname
        FROM usr 
        JOIN roles ON roles.id = usr.id
        JOIN names ON names.id = usr.id
        WHERE roles.teacher != 1 AND roles.admin != 1 AND usr.id NOT IN ($pupil_ids)";
        $other_children = mysqli_query($connect, $query) or die('Ошибка запроса остальных 1');
    }
    else{
        $query = 
        "SELECT usr.id, names.name, names.surname
        FROM usr 
        JOIN roles ON roles.id = usr.id
        JOIN names ON names.id = usr.id
        WHERE roles.teacher != 1 AND roles.admin != 1";
        $other_children = mysqli_query($connect, $query) or die('Ошибка запроса остальных 2');
    }
    

?>

<form class="card" method="POST">
    <img src="<?php echo $course[3] ?>" class="center-image">
    <div class="card-text">
        Name: <br><input type="text" value="<?php echo $course[1] ?>" name="name"><br><br>
        First Date: <br><input type="date" value="<?php echo date('Y-m-d', strtotime($course[2])) ?>" name="date"><br><br>
        Time: <br><input type="time" value="<?php echo date('H:i', strtotime($course[2])) ?>" name="time"><br><br>
        Image: <br><input type="text" value="<?php echo $course[3] ?>" name="img_src"><br><br>
        Teacher:<br>
        <select name="teacher">
            <option selected value="<?php echo $teacher[0] ?>"><?php echo $teacher[1], ' ', $teacher[2] ?></option>
            <?php 
                for($i = 0; $i < mysqli_num_rows($all_teachers); $i++){
                    $another_teacher = mysqli_fetch_row($all_teachers);
                    ?>
                        <option value="<?php echo $another_teacher[0] ?>"><?php echo $another_teacher[1], ' ', $another_teacher[2] ?></option>
                    <?php
                }
            ?>
        </select>
        <br><br>
        Pupils:<br>
        <?php 
            for($i = 0; $i < mysqli_num_rows($pupils); $i++){
                $pupil = mysqli_fetch_row($pupils);
                ?>
                    <input checked type="checkbox" name="pupil[]" id="<?php echo $pupil[0]?>" value="<?php echo $pupil[0]?>"> <label for="<?php echo $pupil[0]?>"><?php echo $pupil[2], ' ', $pupil[3] ?></label> <br> 
                <?php
            }
            $limit = isset($other_children) ? mysqli_num_rows($other_children) : 0;
            for($i = 0; $i < $limit; $i++){
                $pupil = mysqli_fetch_row($other_children);
                ?>
                    <input type="checkbox" name="pupil[]" id="<?php echo $pupil[0]?>" value="<?php echo $pupil[0]?>"> <label for="<?php echo $pupil[0]?>"><?php echo $pupil[1], ' ', $pupil[2] ?></label> <br> 
                <?php
            }
        ?>
    </div>

    <input type="hidden" name="id" value="<?php echo $course[0] ?>">
    <input type="hidden" name="ACTION" value="SAVE">
    <input type="hidden" name="ADMIN" value="TIMETABLE">
    <input type="hidden" name="RUN" value="ADMIN">
    <button class="card-button" >Изменить</button>
</form>