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
    $row = mysqli_fetch_row($result);
?>
<form class="card" method="POST">
   <img src="<?php echo $img_src?>" class="center-image">
   <div class="card-text">
        <?php echo $row[5], ' ', $row[6]?>
        <br>
       A: <?php echo $row[1]?>
       <br>
       B: <?php echo $row[2]?>
       <br>
       C: <?php echo $row[3]?>
       <br>
   </div>
</form>        
