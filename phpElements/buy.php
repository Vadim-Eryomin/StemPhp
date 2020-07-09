<?php
global $isBuy;
$isBuy = 0;
if(isset($_POST['productId'])){
    $id = hexdec($_COOKIE['id']) ^ 11111111;
    $productId = $_POST['productId'];

    $query =
    "SELECT coins.coin, products.cost, products.quantity 
    FROM coins 
    JOIN products on products.id = $productId 
    WHERE coins.id = $id";

    $result = mysqli_query($connect, $query) or die("Ошибка");
    $row = mysqli_fetch_row($result) or die("Ошибка");

    $coins = $row[0];
    $cost = $row[1];
    $quantity = $row[2];

    if($coins > $cost){
        if($quantity > 0){
            $query = 
            "UPDATE products
            SET quantity = quantity - 1
            WHERE id = $productId";

            mysqli_query($connect, $query) or die("Ошибка");

            $query = 
            "UPDATE coins
            SET coin = coin - $cost 
            WHERE id = $id";

            mysqli_query($connect, $query) or die("Ошибка");

            $query = 
            "INSERT INTO `uncon_basket`
            VALUES (null, $productId, $id)";

            mysqli_query($connect, $query) or die("Ошибка");
            
            ?>
            <div class="alert-success">
                OK! Confirm your purchase in the basket!
            </div>        
            <?php
            $isBuy = 1;
        }
        else{
        ?>
        <div class="alert-warning">
            There are not this product!
        </div>
        <?php
        }
    }
    else{
        ?>
        <div class="alert-warning">
            You have not got enough money!
        </div>
        <?php
    }
}
