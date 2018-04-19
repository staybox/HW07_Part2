<?php
include_once ("header.php");
?>

    <div class="container">
    <h1>Запретная зона, доступ только авторизированному пользователю</h1>
      <h2>Информация выводится из базы данных</h2>
      <table class="table table-bordered">
        <tr>
          <th>Пользователь(логин)</th>
          <th>Имя</th>
          <th>возраст</th>
          <th>описание</th>
          <th>Фотография</th>
          <th>Действия</th>
        </tr>
          <? foreach ($users as $key=>$value): ?>
        <tr>
          <td><?=$value['LOGIN'];?></td>
          <td><?=$value['NAME'];?></td>
          <td><?=$value['AGE'];?></td>
          <td><?=$value['DESCRIPTION'];?></td>
          <td><img src="<?=$value['PHOTO'];?>" alt=""></td>
          <td>
              <a href="/edit?edit_user_id=<?=$value['USER_ID'];?>">Редактировать пользователя</a><br>
              <a href="?remove_user_id=<?=$value['USER_ID'];?>">Удалить пользователя</a>
          </td>
        </tr>
          <? endforeach; ?>
      </table>
    </div><!-- /.container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="../../public/js/main.js"></script>
    <script src="../../public/js/bootstrap.min.js"></script>

  </body>
</html>
