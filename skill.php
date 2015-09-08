<?php
    //описание страницы для поисковых роботов
    $title = "This is SKILL page of our RPG Game";
    $keywords = "";
    $content = "";
    $description = "";

    //подключаем header.php, куда через переменные вставляем наши СЕО-данные:
    include('header.php');
    include('connect.php');

   // $query = "SELECT mapping.skill_id, mapping.exp_id, mapping.exp_value, ".
    $query = "SELECT mapping.skill_id, mapping.exp_id, mapping.exp_value, ".
             "experience.exp_name AS xp_name, mapping.exp_value AS xp_val, skills.skill_name AS skill_name, skills.skill_picture AS skill_picture ".
             "FROM mapping ".
             "INNER JOIN experience  USING (exp_id) ".
             "INNER JOIN skills USING (skill_id) ".
            //"WHERE mapping.user_id = '" . $_SESSION['user_id']. "'";
             "WHERE mapping.user_id = '". $_SESSION['user_id'] ."' AND mapping.skill_id='". $_GET['skill_id']."'";

    $data = mysqli_query($dbc,$query);

    $xp = array();

    while ($row = mysqli_fetch_array($data)) {
        $skill_name = $row['skill_name']; // нужно, чтобы выводил guitar, а не rythm
        $skill_picture = $row['skill_picture'];
        $xp[$row['xp_name']] = $row['xp_val'];
        $skill_name = $row['skill_name'];
    }

    $sum_xp = 0;
    foreach ($xp as $xp_name => $val) {
        $sum_xp += $val;
    }

$skill_level = 2+log(($sum_xp/100), 2);

/* ------- ПОЛУЧАЕМ ДАННЫЕ ДЛЯ ОТОБРАЖЕНИЯ ЗАДАНИЙ И РАСЧЕТА ВЫПОЛНЕННЫХ ЗАДАЧ -----*/

    $query2 = "SELECT tasks.task_id AS task_id, tasks.task_desciption AS task_desciption, tasks.task_status AS task_status, tasks.task_date AS task_date, tasks.exp_id AS exp_id, ".
            " mapping.skill_id AS skill_id".
            " FROM tasks, mapping  WHERE tasks.user_id='". $_SESSION['user_id'] ."' AND tasks.exp_id=mapping.exp_id  AND mapping.skill_id='".$_GET['skill_id']."' ".
            " ORDER BY task_status AND task_date DESC ";

    $data2 = mysqli_query($dbc, $query2);
    $num_task = mysqli_num_rows($data2);

$taskToShow='';
$num_task_completed = 0;

while ($row2 = mysqli_fetch_array($data2)) {
    if ($row2['task_status']) { // если статут = 1 (значит комплит) мы его не отображаем - мы его считаем
        $taskToShow=  $taskToShow. "<p class='task-complete'><i class='glyphicon glyphicon glyphicon-ok'></i>". $row2['task_desciption']." <span class='pull-right'>". $row2['task_date']. "</span></p>";
        $num_task_completed += count($row2['task_status']);
    } else {
        $taskToShow= $taskToShow. "<p><i class='glyphicon glyphicon-exclamation-sign'></i><input type='checkbox' name='task-point[]' value=".$row2['task_id'].">".
     " <label>". $row2['task_desciption']."</label>".
     " <span class='pull-right'>". $row2['task_date']."</span></p>";
    }
}

?>


<div class="container">

   <!-- <ul class="nav nav-tabs">
      <li role="presentation" class="active"><a href="#">Профиль</a></li>
        <li role="presentation"><a href="task.php">Задачи</a></li>
      <li role="presentation"><a href="editprofile.php">Редактировать профиль</a></li>
    </ul>-->

    <div class="content container-fluid">
        <div class="col-md-4">
            <h2 class="skill-name"><?php echo $skill_name; ?> </h2>
           <!-- <div class="skill" style="background-image: url('img/skills/<?php //echo $skill_picture; ?>')">-->
            <img class="skill" src="img/skills/<?php echo $skill_picture; ?>">


                <!--<img class="user-skill-number" src="img/level.jpg">-->

            <!--</div>-->
            <p class="user-skill-number"><?php echo "Ваш текущий уровень: ". floor($skill_level); ?></p>

            <?php  echo "<div id='progressbar' class='ui-progressbar'>".$k = ($skill_level - floor($skill_level))*100 ."<div id='progress-label' class='progress-label'>".$skill_name." = ". $val ."</div></div>"; ?>

            <div class="user-progress">

                <p>Набрано опыта <span class=" pull-right"><?php echo $sum_xp; ?></span></p>
                <p>Выполнено задач <span class=" pull-right"><?php echo $num_task_completed; ?></span></p>

            </div>


        </div>

        <div class="col-md-8"> <!-- RIGHT SIDE -->
            <div class="user-experience" id="vertical-carousel">
                <i class="glyphicon glyphicon-triangle-top" id="up"></i>


                <?php foreach ($xp as $skill_name => $val) {

                            echo $skill_name ." = ". $val;
                           // echo "<i class='glyphicon glyphicon-plus pull-right' id='xp-plus'> </i> ";
                            echo "<div id='progressbar' class='ui-progressbar'>".$k = ($val % 100) ."<div id=\"progress-label\" class=\"progress-label\">". $skill_name ." = ". $val ."</div></div>";

                } ?>

                <i class="glyphicon glyphicon-triangle-bottom" id="down"></i>
            </div>

            <div class="user-feed">
                <button onclick="completeTask();">Завершить отмеченные</button>
                <h3>Последние задачи: </h3>
                    <form action="" method="post" name="form-name" id="form-name">
                        <?php echo $taskToShow; ?>
                        <input type='hidden' id='operation' name='operation' value='0'>
                    </form>
            </div>


<script>
    function completeTask() {
         alert("wanna complete?");
         document.getElementById('form-name').operation.value='COMPLETE';
         document.getElementById('form-name').submit();
    }

    function delete1() {
         alert("delete tasks");
         document.getElementById('form-name').operation.value='DELETE';
         document.getElementById('form-name').submit();
    }
</script>


<?php

if (isset($_POST['task-point'])) {

   // echo $_POST['task-point'];
    $aTasks = $_POST['task-point'];
    $N = count($aTasks);
    echo "Вы выбрали " . $N . " значений<br/>";

     for ($i = 0; $i < $N; $i++) {
         echo " задание #". $aTasks[$i]." отмечено </br>";
         if ($_POST['operation'] == 'DELETE') {
             $queryTask = "DELETE FROM tasks WHERE task_id=".$aTasks[$i];
        } else if ($_POST['operation'] == 'COMPLETE') {

             $taskScore = taskScore($aTasks[$i],$dbc);
             $queryTask = "UPDATE tasks SET task_status=1 WHERE task_id=". $aTasks[$i];
        }
         mysqli_query($dbc, $queryTask);
    }
} else {
    echo " OH, NO!! You didn`t choose any task! ";
}


function taskScore ($task,$dbc) {

$queryScore = "SELECT tasks.task_importance AS task_importance, tasks.task_difficult AS task_difficult, mapping.exp_value AS exp_value, tasks.exp_id AS exp_id ".
 "FROM tasks, mapping ".
 "WHERE tasks.task_id=".$task." AND tasks.exp_id = mapping.exp_id";

$data = mysqli_query($dbc, $queryScore);

 while ($row = mysqli_fetch_array($data)) {
     $score = $row['exp_value'];
     $score += $row['task_importance'] * $row['task_difficult'] * 5;
     $exp_id=$row['exp_id'];
 }
$queryScore2 = "UPDATE mapping SET exp_value=".$score." WHERE mapping.exp_id=". $exp_id;
mysqli_query($dbc, $queryScore2);
echo "<br/>функция возвращает $score<br/>";
return $score;
}


function IsChecked($chkName, $value) {
if (!empty($_POST[$chkName])) {
 foreach ($_POST[$chkName] as $chkVal) {
     if ($chkVal == $value) {
         return true;
     }
 }
}
return false;
}

?>


        </div> <!-- END OF RIGHT SIDE -->
       <!-- <div class="col-md-10"><img src="img/ornament.png"></div>-->
    </div> <!-- END OF WHITE CONTAINER -->

</div> <!--END OF CLASS=CONTAINER-->

<?php
    require_once('footer.php');
?>