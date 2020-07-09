<?php
    $need_id = $_POST['id'];
    $need_date = date('Y-m-d H:i:s', $_POST['date']);

    $query = 
    "SELECT pupil.pupil_id, M.markA, M.markB, M.markC, M.total, names.name, names.surname, names.img_src 
    FROM pupil 
    LEFT JOIN (SELECT * FROM mark WHERE mark.date = '$need_date') AS M ON pupil.pupil_id = M.pupil_id 
    JOIN names ON pupil.pupil_id = names.id WHERE pupil.course_id = $need_id";
    $result = mysqli_query($connect, $query) or die("Ошибка запроса");
    $limit = mysqli_num_rows($result);
    for($i = 0; $i < $limit; $i++){
        $row = mysqli_fetch_row($result);
        ?>
            <form class="card" method="POST">
               <img src="<?php echo $row[7]?>" class="center-image">
               <div class="card-text">
                    <?php echo $row[5], ' ', $row[6]?>
                    <br>
                   A: 
                   <input type="radio" name="A" value="1" <?php if($row[1] == 1) echo 'checked'?>> 1
                   <input type="radio" name="A" value="2" <?php if($row[1] == 2) echo 'checked'?>> 2
                   <input type="radio" name="A" value="3" <?php if($row[1] == 3) echo 'checked'?>> 3
                   <input type="radio" name="A" value="4" <?php if($row[1] == 4) echo 'checked'?>> 4
                   <input type="radio" name="A" value="5" <?php if($row[1] == 5) echo 'checked'?>> 5
                   <br>
                   B: 
                   <input type="radio" name="B" value="1" <?php if($row[2] == 1) echo 'checked'?>> 1
                   <input type="radio" name="B" value="2" <?php if($row[2] == 2) echo 'checked'?>> 2
                   <input type="radio" name="B" value="3" <?php if($row[2] == 3) echo 'checked'?>> 3
                   <input type="radio" name="B" value="4" <?php if($row[2] == 4) echo 'checked'?>> 4
                   <input type="radio" name="B" value="5" <?php if($row[2] == 5) echo 'checked'?>> 5
                   <br>
                   C: 
                   <input type="radio" name="C" value="1" <?php if($row[3] == 1) echo 'checked'?>> 1
                   <input type="radio" name="C" value="2" <?php if($row[3] == 2) echo 'checked'?>> 2
                   <input type="radio" name="C" value="3" <?php if($row[3] == 3) echo 'checked'?>> 3
                   <input type="radio" name="C" value="4" <?php if($row[3] == 4) echo 'checked'?>> 4
                   <input type="radio" name="C" value="5" <?php if($row[3] == 5) echo 'checked'?>> 5
                   <br>
               </div>

               <input type="hidden" name="MARK" value="SAVE">
               <input type="hidden" name="TIMETABLE" value="MARK">
               <input type="hidden" name="RUN" value="TIMETABLE">
               <input type="hidden" name="date" value="<?php echo $need_date?>">
               <input type="hidden" name="course_id" value="<?php echo $need_id?>">
               <input type="hidden" name="pupil_id" value="<?php echo $row[0]?>">
               <button class="card-button">Сохранить</button>
            </form>        
        <?php
    }
?>

