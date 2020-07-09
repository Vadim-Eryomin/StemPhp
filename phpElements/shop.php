<?php if(isset($isBuy)){?>
    <div class="card-container" style="heihgt: calc(100% - 70px)">
<?php } else { ?>
    <div class="card-container">
<?php } ?>
<?php
    $query = 
    "SELECT id, name, about, cost, img_src
     FROM products";

    $result = mysqli_query($connect, $query) or die("Ошибка запроса");
    $row_number = mysqli_num_rows($result);
    $row = mysqli_fetch_row($result);

    while($row_number-- > 0){
?>
    <form class="card" method="POST">
        <div class="card-inner">
            <div class="card-title"><?php echo $row[1] ?></div>
            <img src="<?php echo $row[4] ?>" class="center-image">
            <div class="card-text">
                <?php echo $row[2] ?>
            </div>
            <input type="hidden" name="productId" value="<?php echo $row[0] ?>">
            <input type="hidden" name="RUN" value="SHOP">
            <button class="card-button"><?php echo $row[3] ?>$</button>    
        </div>
    </form>
<?php
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