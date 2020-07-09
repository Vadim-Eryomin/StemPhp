<?php
    $query = 
    "SELECT usr.id, names.name, names.surname
    FROM usr 
    JOIN roles ON roles.id = usr.id
    JOIN names ON names.id = usr.id
    WHERE roles.teacher = 1";
    $all_teachers = mysqli_query($connect, $query) or die('Ошибка запроса учителей');

    $query = 
    "SELECT usr.id, names.name, names.surname
    FROM usr 
    JOIN roles ON roles.id = usr.id
    JOIN names ON names.id = usr.id
    WHERE roles.teacher != 1 AND roles.admin != 1";
    $other_children = mysqli_query($connect, $query) or die('Ошибка запроса остальных 1');

?>

<form class="card" method="POST">
    <img src="image/just.png" class="center-image">
    <div class="card-text">
        Name: <input type="text" value="" name="name"><br><br>
        First Date: <input type="date" value="" name="date"><br><br>
        First Time: <input type="time" value="" name="time"><br><br>
        Image: <input type="text" value="" name="img_src"><br><br>
        Teacher:
        <select name="teacher">
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
            $limit = isset($other_children) ? mysqli_num_rows($other_children) : 0;
            for($i = 0; $i < $limit; $i++){
                $pupil = mysqli_fetch_row($other_children);
                ?>
                    <input type="checkbox" name="pupil[]" id="<?php echo $pupil[0]?>" value="<?php echo $pupil[0]?>"> <label for="<?php echo $pupil[0]?>"><?php echo $pupil[1], ' ', $pupil[2] ?></label> <br> 
                <?php
            }
        ?>
    </div>

    <input type="hidden" name="ACTION" value="CREATE">
    <input type="hidden" name="ADMIN" value="TIMETABLE">
    <input type="hidden" name="RUN" value="ADMIN">
    <button class="card-button" style="width: 90px">Создать</button>
</form>