<?php
/**
 * Created by PhpStorm.
 * User: Инесса
 * Date: 17.05.2015
 * Time: 7:35
 */
    //описание страницы для поисковых роботов
    $title = "This is YOUR TASK page of our RPG Game";
    $keywords = "";
    $content = "";
    $description = "";

    //подключаем header.php, куда через переменные вставляем наши СЕО-данные:
    require_once('header.php');
    include('connect.php');


?>


<div class="container">

    <?php
        require_once('function.php');
		require_once('connect.php');

        //connect to database
        $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        if(isset($_POST['submit'])) {
            // получаем данные из формы
            $email = mysqli_real_escape_string($dbc, trim($_POST['email']));
            $pass1 = mysqli_real_escape_string($dbc, trim($_POST['pass1']));
            $pass2 = mysqli_real_escape_string($dbc, trim($_POST['pass2']));

            if (!empty($email) && !empty($pass1) && !empty($pass2) && ($pass1 == $pass2)) {
                // проверяем не занято ли имя пользователя и совпадают ли указанные пароли
                $query = "SELECT * FROM users WHERE email ='$email'";
                $data = mysqli_query($dbc, $query);
                if (mysqli_num_rows($data) == 0) {
                    // Если скрипт возвращает 0 строк, то имя, введенное пользователем не занято
                    // добавляем его в базу
                    $query = "INSERT INTO users (email, pass, join_date) VALUES ('$email', md5($pass1), NOW()) ";
                    mysqli_query($dbc, $query);

                    //!!! СДЕЛАТЬ ЭТОТ ВЫВОД (КОТОРЫЙ НИЖЕ) В МОДАЛЬНОМ ОКНЕ!!!

                    $string= "<p> Ваша учетная запись успешно создана. Вы можете войти в приложение и
                            <a href='editprofile.php'>отредактировать свой профиль</a>.</p>";

					echo $string;
							
					$log = logFile($query, $string);
                } else {
                    // Этот e-mail уже кто-то занял (
                    echo "<p>Учетная запись с мейлом " . $email ." уже существует</p>";
                    $email ="";
                }
            } else {
                // если пользователь поленился ввести данные
                echo "<p> Вы забыли ввести данные, либо почту, либо пароль </p>";
				
            }

        }
        mysqli_close($dbc);
		

    ?>


    <div class="form-group">
        <form method="post" action="">
            <div class="input-group">
                <span class="input-group-addon" id="basic-addon1">@mail</span>
                <input type="email" name="email" id="email" value="" placeholder="email@email.ru"><br/>
            </div>

            <div class="input-group">
                <span class="input-group-addon" id="basic-addon1">#pass</span>
                <input type="password" name="pass1" id="pass" value="" placeholder="your password"><br/>
            </div>
            <div class="input-group">
                <span class="input-group-addon" id="basic-addon1">#pass</span>
                <input type="password" name="pass2" id="pass2" value="" placeholder="repeat password"><br/>
            </div>

            <button type="submit" name="submit" class="btn btn-danger navbar-btn" value="Зарегистрироваться">Создать аккаунт</button>
            <!--<button type="reset" name="" class="btn btn-default navbar-btn" value="Cancel">Cancel</button>-->
        </form>
    </div>
</div> <!--END OF CLASS=COMTAINER-->

<div class="footer navbar-fixed-bottom">
  <div class="container">

   <!--   <ul class="nav nav-pills"> -->
          <!--<li class="disabled"><a href="#">Главная</a></li>-->
    <!--      <li><a href="index.php">Главная</a></li><li class="divider"></li>
          <li><a href="login.php">Войти</a></li><li class="divider"></li>
          <li><a href="singup.php">Регистрация</a></li><li class="divider"></li>
          <li><a href="#">point1</a></li><li class="divider"></li>
          <li><a href="#">point1</a></li><li class="divider"></li>
          <li><a href="#">point1</a></li><li class="divider"></li>


      </ul> -->


  </div>


</div>

<?php
    require_once('footer.php');
?>