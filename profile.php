<?php
    //описание страницы для поисковых роботов
    $title = "This is YOUR PROFILE page of our RPG Game";
    $keywords = "";
    $content = "";
    $description = "";

    //подключаем header.php, куда через переменные вставляем наши СЕО-данные:
    require_once('header.php');
    include('connect.php');

    $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

/*------- ПОЛУЧАЕМ ДАННЫЕ СКИЛЛОВ ДЛЯ ОТОБРАЖЕНИЯ УРОВНЯ, КАРТИНОК И НАЗВАНИЙ СКИЛЛОВ -------*/

     $query = "SELECT DISTINCT mapping.skill_id, mapping.exp_id, mapping.exp_value,  ".
           " skills.skill_id AS skill_id, skills.skill_name AS skill_name, skills.skill_picture, ".
		   " experience.exp_name AS xp_name, mapping.exp_value AS xp_val ".
           "FROM mapping, experience, skills ".
          // "INNER JOIN experience  USING (exp_id) ".
         //  "INNER JOIN skills USING (skill_id) ".
           "WHERE mapping.user_id = '1' and mapping.exp_id = experience.exp_id AND mapping.skill_id = skills.skill_id ".
		   "GROUP BY mapping.skill_id";

   $data = mysqli_query($dbc,$query);

   $xp = array();
    $skills = array();

   $img='';
   while ($row = mysqli_fetch_array($data)) {
       $skills[$row['skill_name']] = $row['skill_picture'];
       $xp[$row['xp_name']] = $row['xp_val'];
	 
	 //echo $row['skill_name'];
	 $img=$img."<div>".
					"<img href='#' src='img/skills/".$row['skill_picture']."'>".
                    "<a class='skill-name' href='/rpg/skill.php?skill_id=".$row['skill_id']."'>".$row['skill_name']."</a>".
            "</div>";
   }

   $sum_xp = 0;
   foreach ($xp as $xp_name => $val) {
       $sum_xp += $val;
   }
$skill_level = floor(2+log(($sum_xp/100), 2));

/* ------- ПОЛУЧАЕМ ДАННЫЕ ДЛЯ ОТОБРАЖЕНИЯ ЗАДАНИЙ И РАСЧЕТА ВЫПОЛНЕННЫХ ЗАДАЧ -----*/

    $query2 = "SELECT * FROM tasks WHERE user_id='1' ORDER BY task_status AND task_date DESC ";
    $data2 = mysqli_query($dbc, $query2);
    $num_task = mysqli_num_rows($data2);

$taskToShow ='';
$num_task_completed = 0;
while ($row2 = mysqli_fetch_array($data2)) {

    if ($row2['task_status']) {
        $taskToShow = $taskToShow . "<p class='task-complete'><i class='glyphicon glyphicon glyphicon-ok'></i>" . $row2['task_desciption'] . " <span class='pull-right'>" . $row2['task_date'] . "</span></p>";
        $num_task_completed += 1;
    } else {
        $taskToShow = $taskToShow . "<p class='task-complete'><i class='glyphicon glyphicon-exclamation-sign'></i>" . $row2['task_desciption'] . " <span class='pull-right'>" . $row2['task_date'] . "</span></p>";
    }
}
?>

<div class="container">

   <!-- <ul class="nav nav-tabs">
      <li role="presentation" class="active"><a href="profile.php">Профиль</a></li>
      <li role="presentation"><a href="task.php">Задачи</a></li>
        <li role="presentation"><a href="editprofile.php">Редактировать профиль</a></li>
    </ul>-->

    <div class="content container-fluid">
        <div class="col-md-4">
            <div class="user">
                <p class="nickname"><?php echo $_SESSION['email'];?> </p>
                <p class="user-skill-number"><?php echo "your level is ". $skill_level; ?></p>
                <!--<img class="user-skill-number" src="img/level.jpg">-->
            </div>
            <div class="user-progress">
                <p>Набрано опыта <span class="badge pull-right"><?php echo $sum_xp; ?></span></p>
                <p>Выполнено задач <span class="badge pull-right"><?php echo $num_task_completed; ?></span></p>
                <p>Потрачено времени, ч <span class="badge pull-right">25</span></p>
            </div>

        </div>

        <div class="col-md-8"> <!-- RIGHT SIDE -->

            <div class="slider center">
               <?php echo $img; ?>
            </div>



        <div class="user-feed">
            <h3>У Вас <a href="task.php"><?php echo  $num_task; ?> задач:</a></h3>
            <?php echo $taskToShow; ?>
        </div>
        </div> <!-- END OF RIGHT SIDE -->
        <div class="col-md-10"><img src="img/ornament.png"></div>
    </div> <!-- END OF WHITE CONTAINER -->

</div> <!--END OF CLASS=COnTAINER-->

<?php
    require_once('footer.php');
?>