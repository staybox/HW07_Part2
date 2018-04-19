<?php
include_once ("header.php");
?>

<div class="container">

    <div class="form-container">
        <form enctype="multipart/form-data" class="form-horizontal" action="" method="post">
            <input type="hidden" value="<?=$user["USER_ID"]; ?>" name="user_id">
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Логин</label>
                <div class="col-sm-10">
                    <input type="text" name="login" class="form-control" id="inputEmail3" placeholder="Логин" value="<?= $user['LOGIN'];?>">
                </div>
            </div>
            <div class="form-group">
                <label for="Email_Parse" class="col-sm-2 control-label">Email</label>
                <div class="col-sm-10">
                    <input type="text" name="Email_Parse" class="form-control" id="Email_Parse" placeholder="Email" value="<?= $user['EMAIL'];?>">
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">Пароль</label>
                <div class="col-sm-10">
                    <input type="password" name="password" class="form-control" id="inputPassword3" placeholder="Пароль">
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword4" class="col-sm-2 control-label">Пароль (Повтор)</label>
                <div class="col-sm-10">
                    <input type="password" name="confirm_password" class="form-control" id="inputPassword4" placeholder="Пароль">
                </div>
            </div>
            <div class="form-group">
                <label for="inputName" class="col-sm-2 control-label">Имя</label>
                <div class="col-sm-10">
                    <input type="text" name="name" class="form-control" id="inputname" placeholder="Имя" value="<?= $user['NAME'];?>">
                </div>
            </div>
            <div class="form-group">
                <label for="inputAge" class="col-sm-2 control-label">Возраст</label>
                <div class="col-sm-10">
                    <input type="text" name="age" class="form-control" id="inputAge" placeholder="Возраст" value="<?= $user['AGE'];?>">
                </div>
            </div>
            <div class="form-group">
                <label for="inputDescription" class="col-sm-2 control-label">Описание</label>
                <div class="col-sm-10">
                    <input type="text" name="desc" class="form-control" id="inputDescription" placeholder="Описание" value="<?= $user['DESCRIPTION'];?>">
                </div>
            </div>
            <div class="form-group">
                <label for="inputDescription" class="col-sm-2 control-label">Загрузка файла</label>
                <div class="col-sm-10">
                    <input name="userfile" type="file" />
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-default">Добавить пользователя</button>
                    <br><br>
                    Зарегистрированы? <a href="/">Авторизируйтесь</a>
                </div>
            </div>
        </form>
    </div>

</div><!-- /.container -->


</div><!-- /.container -->
<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="../../public/js/main.js"></script>
<script src="../../public/js/bootstrap.min.js"></script>

</body>
</html>
