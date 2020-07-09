<!DOCTYPE html>
<html>

<head>
  <title>Главная</title>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans&display=swap" rel="stylesheet">
  <script src="https://vk.com/js/api/openapi.js?168" type="text/javascript"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
  <link href="css/other.css" rel="stylesheet">
  <link href="css/index-page.css" rel="stylesheet">
  <link href="css/card.css" rel="stylesheet">
  <link href="css/vk-cards.css" rel="stylesheet">
  <meta charset="utf-8">
</head>

<body>
  <div class="container">
    <header class="header">
      <img src='image/noroot.png'>
    </header>

    <aside class="sidebar" id="side">
      <?php if(!isset($_POST['RUN']) || $_POST['RUN'] !== 'ADMIN') { ?>
        <form method='POST'>
        <input type='hidden' value='PROFILE' name='RUN'>
        <button type='submit' class="button">Профиль</button>
      </form>
      <form method='POST'>
        <input type='hidden' value='SHOP' name='RUN'>
        <button type='submit' class="button">Магазин</button>
      </form>
      <form method='POST'>
        <input type='hidden' value='TIMETABLE' name='RUN'>
        <button type='submit' class="button">Расписание</button>
      </form>
      <form method='POST'>
        <input type='hidden' value='NEWS' name='RUN'>
        <button type='submit' class="button">Новости</button>
      </form>
      <form method='POST'>
        <input type='hidden' value='ADMIN' name='RUN'>
        <input type='hidden' value='NULL' name='ADMIN'>
        <button type='submit' class="button">Админка</button>
      </form>
      <?php }
        else{ 
          if($_POST['RUN'] === 'ADMIN'){
            if($_POST['ADMIN'] === 'NULL'){
                ?>
                  <form method='POST'>
                    <input type='hidden'>
                    <button type='submit' class="button">Назад</button>
                  </form>
                  <form method='POST'>
                    <input type='hidden' value='ADMIN' name='RUN'>
                    <input type='hidden' value='ACCOUNT' name='ADMIN'>
                    <button type='submit' class="button">Аккаунты</button>
                  </form>
                  <form method='POST'>
                    <input type='hidden' value='ADMIN' name='RUN'>
                    <input type='hidden' value='TIMETABLE' name='ADMIN'>
                    <button type='submit' class="button">Курсы</button>
                  </form>
                  <form method='POST'>
                    <input type='hidden' value='ADMIN' name='RUN'>
                    <input type='hidden' value='SHOP' name='ADMIN'>
                    <button type='submit' class="button">Магазин</button>
                  </form>
                  <form method='POST'>
                    <input type='hidden' value='ADMIN' name='RUN'>
                    <input type='hidden' value='BASKET' name='ADMIN'>
                    <button type='submit' class="button">Заказы</button>
                  </form>
                <?php
            }
            else if(!isset($_POST['ACTION'])){
              ?>
                  <form method='POST'>
                    <input type='hidden' value='ADMIN' name='RUN'>
                    <input type='hidden' value='NULL' name='ADMIN'>
                    <button type='submit' class="button">Назад</button>
                  </form>
              <?php
            }
            else{
              ?>
                  <form method='POST'>
                    <input type='hidden' value='ADMIN' name='RUN'>
                    <input type='hidden' value='<?php echo $_POST['ADMIN']?>' name='ADMIN'>
                    <button type='submit' class="button">Назад</button>
                  </form>
              <?php
            }

          }
      ?>

      
      <?php }?>
    </aside>
    <div class="content">
		<?php 
			include ("phpElements/content.php");
		?>
    </div>
    <footer class="footer">
      <span>Наш телефон: x-(xxx)-xxx-xx-xx</span>
      <span>ООО "ЦОИ Стем". Все права защищены</span>
    </footer>
  </div>
  
</body>

</html>