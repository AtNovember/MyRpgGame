<?php
/**
 * Created by PhpStorm.
 * User: Инесса
 * Date: 29.04.2015
 * Time: 6:59
 */

    //описание страницы для поисковых роботов
    $title = "This is edit profile page of our RPG Game";
    $keywords = "";
    $content = "";
    $description = "";

    //подключаем header.php, куда через переменные вставляем наши СЕО-данные:
    require_once('connect.php');
    require_once('header.php');

//echo $_SESSION['user_id'];


?>

<div class="container">

    <!--<ul class="nav nav-tabs">
          <li role="presentation"><a href="profile.php">Профиль</a></li>
          <li role="presentation" ><a href="task.php">Задачи</a></li>
            <li role="presentation" class="active"><a href="editprofile.php">Редактировать профиль</a></li>
        </ul> -->

        <div class="content container-fluid">

            <!-- ПРОВЕРЯЕМ АВТОРИЗОВАН ЛИ ПОЛЬЗОВАТЕЛЬ -->
            <?php
                // проверяем, а вошел ли пользователь в приложение
                               if (!isset($_SESSION['user_id'])) {
                                    echo "<p class='login'>Пожалуйста, <a href='login.php'>войдите в приложение</a> чтобы получить доступ к этой странице</p>";
                                    //exit();
                                } else {

                                    // если пользователь не вошел

                                    // проверяем есть ли у пользователя записи в базе
                                }

            ?>
                <p class=login>Вы вошли в приложение как <?php echo $_SESSION['email']; ?>
                    <a href='logout.php'>НЕ!! Пойду-ка я отсюда нафиг!</a> </p>




                <h1>Редактирование профиля</h1>
                <h2>Личные данные: </h2>

                <form name="user-edit" action="" method="get">
                    <label>Логин </label><input name="login" value=""><br/>
                    <label>E-mail </label><input name="email"><br/>
                <!--    <label>Аватар</label><input><br/>
                    <label>Пол </label><input name="gender"><br/>
                    <label>Город </label><input name="city"><br/>-->

                    <button type="submit" name="user-edit">Нажать сюда</button>
                </form>

            <?php
            /*  $query = "SELECT user_id FROM users WHERE user_id=". $_SESSION['user_id'];
            $data = mysqli_query($dbc, $query);*/



            if (isset($_GET['user-edit'])) {
                    $login = $_GET['login'];
                    $email = $_GET['email'];
                    //  $gender = $_GET['gender'];
                    //  $city = $_GET['city'];

                    $query2 = "UPDATE users SET login='" . $login . "' WHERE user_id='" . $_SESSION['user_id'] ."'";
                    echo $query2;
                    mysqli_query($dbc, $query2);
            } else {
                /* если данных из формы нет */
            }
            ?>


            <h2>Навык (Что хотите развить)</h2>

                <p>Здесь Вам необходимо указать какой навык/скилл Вы хотите развить: Программирование, Рисование, Игра на гитаре и т.д.</p>
                <p>Можете выбрать уже готовые, или добавить свой: </p>

                <button>Chose</button><button>Add</button>

                <form name="skill-edit" id="skill-edit" method="post" action="">

                    <label name="task-skill">Какой навык вы этим прокачаете</label>

                    <select name="choose-skill">
                        <option value="none">Не выбрано</option>
                        <?php
                            $queryGetSkills = "SELECT * FROM skills ";
                            $dataSkills = mysqli_query($dbc, $queryGetSkills);

                            while ($skillRow = mysqli_fetch_array($dataSkills)) {
                                echo " <option value='". $skillRow[skill_id]."'> ".$skillRow[skill_name]."</option>";
                            }
                        ?>
                    </select><br>

                    <label>Добавить свой</label><input name="new-skill">

                    <h2>Какие умение хотите развить для освоения навыка</h2>

                    <p>Развитие навыка - достаточно объемная задача, для того, чтобы поднять скилл, вам нужно выделить какие-то конкретные задачи, поднавыки</p>
                    <p>Например для повышения навыка/скилла "Программирование" Вам нужно изучить конкретные языки (C/C++, JavaScript, Python и т.д.) и/или парадигмы программирования (ООП, Функциональное программирование, UML и т.д.)</p>

                    <label>Поднавык 1</label>
                        <select name="choose-exp">Не указано
                            <option value="none">Не указано</option>
                            <?php
                                $queryGetExp = "SELECT * FROM experience ";
                                $dataExp = mysqli_query($dbc, $queryGetExp);

                                while ($expRow = mysqli_fetch_array($dataExp)) {
                                    echo " <option value='". $expRow[exp_id]."'> ".$expRow[exp_name]."</option>";
                                }
                            ?>
                        </select><br>
                    <label>Добавить еще одно поле</label><input name="new-exp"><br>

                    <button type="submit" name="skill-edit1">Добавить навык </button>

                </form>

            <?php
			
                if (isset($_POST['skill-edit1'])) { //нужен нейм кнопки формы, а не самой формы!!
						
					if($_POST['choose-skill'] == 'none') {
						$skill = $_POST['new-skill'];
						$querySkill = "INSERT INTO `skills`(`skill_id`, `skill_name`) VALUES (null,'".$skill."')"; //
						echo $querySkill."<br/>";
						$dataSkill = mysqli_query($dbc, $querySkill);
						$skillId = mysqli_insert_id($dbc);
                    } else {
						//если выбрал из готовых скиллов
						$skillId = $_POST['choose-skill'];
						echo "id skill is " . $skillId . "</br>";
					}

                    if($_POST['choose-skill'] == 'none') {
						$skill = $_POST['new-skill'];
						$querySkill = "INSERT INTO `skills`(`skill_id`, `skill_name`) VALUES (null,'".$skill."')"; //
						echo $querySkill." Это техническая строка. Забыла убрать<br/>";
						$dataSkill = mysqli_query($dbc, $querySkill);
						$skillId = mysqli_insert_id($dbc);
                    } else {
						//если выбрал из готовых xp
						$skillId = $_POST['choose-skill'];
						echo "id skill is " . $skillId . "</br>";
					}

                    if ($_POST['choose-exp'] == 'none') {
						$exp = $_POST['new-exp'];
						$queryExp = "INSERT INTO `experience`(`exp_id`, `exp_name`) VALUES (null,'".$exp."')"; //
						echo $queryExp." - Это тоже техническая строка. Забыла убрать<br/>";
						$dataExp = mysqli_query($dbc, $queryExp);
						$expId = mysqli_insert_id($dbc);
                    } else {
						// если выбрал из готовых ХР
						$expId = $_POST['choose-exp'];
						echo "id exp is " . $expId . "</br>";
					}

					if ($expId == 0 || $skillId == 0) {
						echo "ERROR!! РРРР!! ВЛАД!!! ТАКОЙ СКИЛЛ УЖЕ ЕСТЬ В БАЗЕ - ИСПОЛЬЗУЙ СЕЛЕКТЫ ИЗ МЕНЮ!!"; // если такие штуки уже есть в базе (скили или экспа)
					} else {
					
						$skill = $_POST['choose-skill'];
						$exp = $_POST['choose-exp'];
						//INSERT INTO `mapping`(`user_id`, `skill_id`, `exp_id`, `exp_value`) VALUES ([value-1],[value-2],[value-3],[value-4])
						$query3 = "INSERT INTO `mapping`".
								"(`user_id`, `skill_id`, `exp_id`, `exp_value`) ".
							"VALUES ('".$_SESSION['user_id']."', '".$skillId."', '".$expId."', '0')"; //
						mysqli_query($dbc, $query3);
						echo "Не пугайся!! Это запрос в базу  <br/> ".$query3."<br/> в финальной версии его не будет <br/>";
					}	
                }

            ?>


            <div class="col-md-10"><img src="img/ornament.png"></div>
        </div>
</div>

<?php
    require_once('footer.php');
?>

