<form method="POST" id="form">
    <input type="hidden" name="ADMIN" value="TIMETABLE">
    <input type="hidden" name="RUN" value="ADMIN">
</form>

<?php 
    $name = strip_tags($_POST['name']);
    $date = strip_tags($_POST['date']);
    $time = strip_tags($_POST['time']);
    $img_src = strip_tags($_POST['img_src']);
    $teacher = strip_tags($_POST['teacher']);

    if(isset($_POST['pupil']))
        $pupils = $_POST['pupil'];
    else
        $pupils = NULL;

    $first_date = date('Y-m-d H:i', (strtotime($date . ' ' . $time)));

    
    $query = "INSERT INTO course VALUES(null, $teacher, '$name', '$first_date', '$first_date', '$img_src')";
    echo $query;
    mysqli_query($connect, $query) or die('Ошибка запроса course');

    $query = "SELECT id FROM course WHERE teacherId='$teacher' AND name='$name' AND first_date = '$first_date' AND img_src='$img_src'";
    
    $need_id_result = mysqli_query($connect, $query);
    $row = mysqli_fetch_row($need_id_result);
    $need_id = $row[0];

    $limit = $pupils === NULL ? 0 : sizeof($pupils);
    for($i = 0; $i < $limit; $i++){
        $pupil_id = $pupils[$i];
        $query = "INSERT INTO pupil VALUES(null, $pupil_id, $need_id)";
        mysqli_query($connect, $query) or die('Ошибка запроса pupil');
    }   

?>
<script>
    document.getElementById('form').submit();
</script>