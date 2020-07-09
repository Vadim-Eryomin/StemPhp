<?php 
    $homework = strip_tags($_POST['homework']);
    $need_date = strip_tags($_POST['date']);
    $need_id = strip_tags($_POST['id']);

    $query = "SELECT * FROM homework WHERE course_id = $need_id AND date='$need_date'";
    $row = mysqli_query($connect, $query) or die('Ошибка запроса select');
    if(mysqli_num_rows($row) > 0){
        $query = "UPDATE homework SET homework='$homework', date='$need_date' WHERE course_id = $need_id AND date='$need_date'";
        mysqli_query($connect, $query) or die('Ошибка запроса update');
    }
    else{
        $query = "INSERT INTO homework VALUES (null, $need_id, '$need_date', '$homework')";
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