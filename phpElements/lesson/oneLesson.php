<?php 
$need_id = $_POST['id'];
$need_date = date('Y-m-d H:i:s', $_POST['date']);

$query = 
"SELECT course.id, names.name, names.surname, course.name,
course.first_date, course.img_src, names.img_src
FROM course
JOIN names ON names.id = course.teacherId
WHERE course.id = $need_id";
$result = mysqli_query($connect, $query) or die("Ошибка запроса");
$course = mysqli_fetch_row($result);

$query = 
"SELECT homework
FROM homework 
WHERE course_id = $need_id AND date = '$need_date'";
$result = mysqli_query($connect, $query) or die("Ошибка запроса");        
$homework = mysqli_num_rows($result) > 0 ? mysqli_fetch_row($result)[0] : 'Кажется, ничего нет!';

$query = 
"SELECT names.name, names.surname, names.img_src
FROM course
JOIN names ON course.teacherId = names.id
WHERE course.id = $need_id";
$result = mysqli_query($connect, $query) or die("Ошибка запроса");
$teacher_data = mysqli_fetch_row($result);
?>
<form class="card" method="POST">
    <div class="card-inner">
        <div class="card-title">
            Домашняя работа
        </div>
        <div class="card-text" style="grid-area: image">
            <?php echo $homework ?>
        </div>
        <?php if($admin == 1 || $teacher == 1){ ?>
            <input type="hidden" name="HOMEWORK" value="EDIT">
            <input type="hidden" name="RUN" value="TIMETABLE">
            <input type="hidden" name="TIMETABLE" value="HOMEWORK">
            <input type="hidden" name="id" value="<?php echo $course[0]?>">
            <input type="hidden" name="date" value="<?php echo $_POST['date']?>">
            <button class="card-button" style="width: 100px">Изменить</button>        
        <?php } ?>
    </div>
</form>
<form class="card" method="POST">
    <div class="card-inner">
        <div class="card-title">
            Учитель
        </div>
        <img src="<?php echo $teacher_data[2] ?>" class="center-image">
        <div class="card-text">
            <?php echo  $teacher_data[0], ' ', $teacher_data[1]?>
        </div>
    </div>
</form>
<form class="card" method="POST">
    <div class="card-inner">
        <div class="card-title">
            Оценки
        </div>
        <?php if($admin == 1 || $teacher == 1){?>
            <input type="hidden" name="id" value="<?php echo $course[0] ?>">
            <input type="hidden" name="RUN" value="TIMETABLE">
            <input type="hidden" name="TIMETABLE" value="MARK">
            <input type="hidden" name="MARK" value="EDIT">
            <input type="hidden" name="date" value="<?php echo $_POST['date']?>">
            <button class="card-button" style="width: 100px">Изменить</button>        
        <?php }
        else{?>
            <input type="hidden" name="id" value="<?php echo $course[0] ?>">
            <input type="hidden" name="RUN" value="TIMETABLE">
            <input type="hidden" name="TIMETABLE" value="MARK">
            <input type="hidden" name="MARK" value="SHOW">
            <input type="hidden" name="date" value="<?php echo $_POST['date']?>">
            <button class="card-button" style="width: 100px">Смотреть</button>
    <?php } ?>
    </div>
</form>