<div class="card-container">
<?php
    if(!isset($_POST['TIMETABLE'])){
        require ('lesson/show.php');
    }
    else if($_POST['TIMETABLE'] === 'SHOW'){
        require ('lesson/oneLesson.php');
    }
    else if($_POST['TIMETABLE'] === 'HOMEWORK'){
        if($_POST['HOMEWORK'] === 'EDIT'){
            require ('lesson/homeworkForm.php');
        }
        else if($_POST['HOMEWORK'] === 'SAVE'){
            require ('lesson/homeworkSave.php');
        }
    }
    else if($_POST['TIMETABLE'] === 'MARK'){
        if($_POST['MARK'] === 'EDIT'){
            require ('lesson/markForm.php');
        }
        else if($_POST['MARK'] === 'SAVE'){
            require ('lesson/markSave.php');
        }
        else if($_POST['MARK'] === 'SHOW'){
            require ('lesson/markShow.php');
        }
    }
?>
</div>
<script>
    $(document).ready(function(){
        let image = $('.center-image');
        let width = image.width();
        let height = image.height();
        if(height > width && height > 150)
            image.height(150);
        else if(width > 150){
            image.height("");
            image.width(150);
        }
    })
</script>

