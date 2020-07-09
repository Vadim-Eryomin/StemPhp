<?php 
    $a = strip_tags($_POST['A']);
    $b = strip_tags($_POST['B']);
    $c = strip_tags($_POST['C']);
    $need_date = strip_tags($_POST['date']);
    $need_id = strip_tags($_POST['course_id']);
    $pupil_id = strip_tags($_POST['pupil_id']);

    $query = "SELECT * FROM mark WHERE course_id = $need_id AND date='$need_date'";
    $row = mysqli_query($connect, $query) or die('Ошибка запроса select');
    $total = ($a + $b + $c) / 3;
    if(mysqli_num_rows($row) > 0){
        $query = "UPDATE mark SET markA=$a, markB=$b, markC=$c, total=$total WHERE course_id = $need_id AND date='$need_date'";
        mysqli_query($connect, $query) or die('Ошибка запроса update');
    }
    else{

        $query = "INSERT INTO mark VALUES (null, $pupil_id, $need_id, '$need_date', $a, $b, $c, $total)";
        mysqli_query($connect, $query) or die('Ошибка запроса insert');
    }
    
    
?>
<form method="POST" id="form">
    <input type="hidden" name="TIMETABLE" value="SHOW">
    <input type="hidden" name="RUN" value="TIMETABLE">
    <input type="hidden" name="date" value="<?php echo strtotime($need_date)?>">
    <input type="hidden" name="id" value="<?php echo $need_id?>">
</form>
<script>
    document.getElementById('form').submit();
</script>