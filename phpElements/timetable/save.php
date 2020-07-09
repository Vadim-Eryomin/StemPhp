<form method="POST" id="form">
    <input type="hidden" name="ADMIN" value="TIMETABLE">
    <input type="hidden" name="RUN" value="ADMIN">
</form>
<?php 
    $course_id = strip_tags($_POST['id']);
    $name = strip_tags($_POST['name']);
    $date = strip_tags($_POST['date']);
    $time = strip_tags($_POST['time']);
    $img_src = strip_tags($_POST['img_src']);
    $teacher = strip_tags($_POST['teacher']);

    if(isset($_POST['pupil']))
        $pupils = $_POST['pupil'];
    else
        $pupils = NULL;

    echo $date .' '.  $time;
    $first_date = date('Y-m-d H:i', (strtotime($date . ' ' . $time)));
    echo $first_date;

    $query = 
    "UPDATE course
    SET teacherId = $teacher, name = '$name', first_date = '$first_date', img_src = '$img_src'
    WHERE id = $course_id";
    
    mysqli_query($connect, $query) or die('Ошибка запроса курса');

    $query = "DELETE FROM pupil WHERE course_id = $course_id";
    mysqli_query($connect, $query) or die('Ошибка запроса удаления');


    $query = "INSERT INTO pupil
    VALUES";

    $limit = is_null($pupils) ? 0 : sizeof($pupils);
    if($limit != 0){
        for($i = 0; $i < $limit; $i++) {
            $pupil_id = $pupils[$i];
            $query .= "(null, $pupil_id, $course_id)";
            if($i + 1 != $limit) $query .= ',';
        }
        mysqli_query($connect, $query) or die('Ошибка запроса сохранения');
    }
    
?>

<script>
    document.getElementById('form').submit();
</script>