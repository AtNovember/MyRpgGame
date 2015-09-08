<?php
    //описание страницы для поисковых роботов
    $title = "This login page of our RPG Game";
    $keywords = "";
    $content = "";
    $description = "";

    //подключаем header.php, куда через переменные вставляем наши СЕО-данные:
    require_once('header.php');
    require_once('connect.php');

    //обнуление сообщения об ошибке
    $error_msg = "";

    //проверяем не вошел ли еше пользователь
    //if (!isset($_COOKIE['user_id'])) {
    if (!isset($_SESSION['user_id'])) {

        //если все-таки не вошел - проверяем данные формы
        if (isset($_POST['submit'])) {
            //connect to database
            $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

            $user_email = mysqli_real_escape_string($dbc, trim($_POST['email']));
            $user_pass = mysqli_real_escape_string($dbc, trim($_POST['pass']));

            if (!empty($user_email) && !empty($user_pass)) {
                $query = "SELECT user_id, email FROM users WHERE email='$user_email' AND pass=md5('$user_pass')";
                $data = mysqli_query($dbc,$query);
                if (mysqli_num_rows($data) == 1) {
                    // если в базе найдено одно соответствие логина и совпадают пароли - формируем строку
                    $row = mysqli_fetch_array($data);

                    //записываем данные в куки
                    //setcookie('user_id', $row['user_id'], time() * (60*60*24*30));
                    //setcookie('email', $row['email'], time() * (60*60*24*30));

                    $_SESSION['user_id'] = $row['user_id'];
                    $_SESSION['email'] = $row['email'];

                    setcookie('user_id', $row['user_id'], time()+(60*60*24*30)); // устанавливаем срок действия 30 дней
                    setcookie('email', $row['email'], time()+(60*60*24*30)); // устанавливаем срок действия 30 дней

                    $home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/index.php';
                    header('Location: ' . $home_url);
                } else {
                    // Имя пользователя введены неверно, сообщение об ошибке
                    $error_msg = "Укажите правильное имя почты и пароль";
                }
            } else {
                // Имя пользоватея и пароль не введены, сообщение об ошибке
                $error_msg = "Введите почту и пароль";
            }
        }
    }  
	
	// посмотреть как сделать переадрисацию
?>

<div class="container">
    <div class="content">
        <?php
            // Если куки пустые, то вывести сообщение об ошибке
            if (empty($_COOKIE['user_id'])) {
                echo '<p class="error">' . $error_msg . '</p>';
        ?>

            <div class="form-group">
                <form method="post" action="">
                    <div class="input-group">
                        <span class="input-group-addon" id="basic-addon1">@mail</span>
                        <input type="email" name="email" id="email" value="<?php if (!empty($user_email)) echo $user_email; ?>"
                               placeholder="email@email.ru"><br/>
                    </div>

                    <div class="input-group">
                        <span class="input-group-addon" id="basic-addon1">#pass</span>
                        <input type="password" name="pass" id="pass" value="" placeholder="your password"><br/>
                    </div>

                    <button type="submit" name="submit" class="btn btn-danger navbar-btn" value="Зарегистрироваться">Войти </button>
                    <!--<button type="reset" name="" class="btn btn-default navbar-btn" value="Cancel">Cancel</button>-->
                </form>
            </div>
        <?php
            } else {
                // Подтверждение успешного входа в приложение
                // По-хорошему здесь нужен РЕДИРЕКТ НА СТРАНИЦУ profile.php
                echo ('<p class="login"> Вы вошли как ' . $_COOKIE['email']. '</p>');
            }
        ?>
    </div>
</div> <!--END OF CLASS=COMTAINER-->

<?php
    require_once('footer.php');
?>