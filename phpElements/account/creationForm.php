<form class="card" method="POST">
    <img src="image/just.png" class="center-image">
    <div class="card-text">
        Login: <input type="text" value="" name="login"><br><br>
        Password: <input type="text" value="" name="password"><br><br>
        Name: <input type="text" value="" name="name"><br><br>
        Surname: <input type="text" value="" name="surname"><br><br>
        Image: <input type="text" value="image/just.png" name="img_src"><br><br>
        <input type="checkbox" name="admin"> Админ <br>
        <input type="checkbox" name="teacher"> Учитель
    </div>
    <input type="hidden" name="ACTION" value="CREATE">
    <input type="hidden" name="ADMIN" value="ACCOUNT">
    <input type="hidden" name="RUN" value="ADMIN">
    <button class="card-button" style="width: 90px">Создать</button>
</form>