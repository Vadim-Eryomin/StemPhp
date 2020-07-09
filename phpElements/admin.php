<div class="card-container">

<?php 
    if($_POST['ADMIN'] === 'NULL'){
        ?>
            <div class="card" style="height: 50px"><div class="card-text">Выберите раздел в меню слева</div></div>
        <?php
    }
    else if($_POST['ADMIN'] === 'ACCOUNT'){
        if(!isset($_POST['ACTION'])){
            require ('account/show.php');
        }
        else{
            if($_POST['ACTION'] === 'EDIT'){
                require ('account/edit.php');
            }
            else if($_POST['ACTION'] === 'PREPARE CREATE'){
                require ('account/creationForm.php');
            }
            else if($_POST['ACTION'] === 'SAVE'){
                require ('account/save.php');
            }
            else if($_POST['ACTION'] === 'CREATE'){
                require ('account/create.php');
            }
        }
    }
    else if($_POST['ADMIN'] === 'SHOP'){

    }
    else if($_POST['ADMIN'] === 'TIMETABLE'){
        if(!isset($_POST['ACTION'])){
            require ('timetable/show.php');
        }
        else{
            if($_POST['ACTION'] === 'EDIT'){
                require ('timetable/edit.php');
            }
            else if($_POST['ACTION'] === 'PREPARE CREATE'){
                require ('timetable/creationForm.php');
            }
            else if($_POST['ACTION'] === 'SAVE'){
                require ('timetable/save.php');
            }
            else if($_POST['ACTION'] === 'CREATE'){
                require ('timetable/create.php');
            }
        }
    }
?>

</div>