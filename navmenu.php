<!--<nav class="navbar navbar-inverse">-->
<nav class="navbar navbar-inverse">
  <div class="container">

      <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">Skill-Quest</a>
          </div>

      <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">

<?php
/**
 * Created by PhpStorm.
 * User: Инесса
 * Date: 03.05.2015
 * Time: 3:04
 */

        //дальше проверяем, есть ли у нас зачение сессии
        //(основаня проверка проходит в sessionstart.php)
        // если да - генерируем меню с авторизацией

        if (isset($_SESSION['email'])) {


            echo "<li><a href='index.php'>Главная </a></li>";
            echo "<li><a href='skill.php?skill_id=1'>Навыки</a></li>";
            echo "<li><a href='task.php'>Квесты </a></li>";
            echo "<li><a href='about.php'>Об Игре</a></li>";

            echo "<li class='dropdown'><a href='profile.php' class='dropdown-toggle' data-toggle='dropdown' ".
                " role='button' aria-haspopup='true' aria-expanded='false'>" . $_SESSION['email'] . " <span class='caret'></span></a>";
            echo "<ul class='dropdown-menu'>";
                echo "<li><a href='profile.php'>Ваш профиль </a></li>";
                echo "<li><a href='editprofile.php'>Редакировать профиль </a></li>";
                echo "<li role='separator' class='divider'></li> ";
                echo "<li><a href='logout.php'>Выйти из аккаунта </a></li>";
            echo "</ul></li>";


        } else {
            echo "<li><a href='index.php'>Главная</a></li>";
            echo "<li><a href='login.php'>Вход в приложение</a></li>";
            echo "<li><a href='singup.php'>Создание учетной записи</a></li>";
            echo "<li><a href='about.php'>Об Игре</a></li>";
        }

?>



                </ul>


      </div>
    </nav>

