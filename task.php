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

   <!-- <ul class="nav nav-tabs">
      <li role="presentation"><a href="profile.php">Профиль</a></li>
      <li role="presentation" class="active"><a href="task.php">Задачи</a></li>
      <li role="presentation"><a href="editprofile.php">Редактировать профиль</a></li>
    </ul> -->

    <div class="content container-fluid">

        <div class="task-control-panel">
            <div class="task spoiler-trigger" data-toggle="collapse"><img src="img/add_task.png" ><br/> <span>Добавить</span> </div>
            <div class="task" ><img src="img/delete-task.png" onclick="delete1();"><br/> <span>Удалить</span> </div>
            <div class="task" type="submit" name="task-complete" onclick="completeTask();"><img src="img/complete-task.png"><br/> <span>Завершить</span> </div>


<!--ФОРМА ДОБАВЛЕНИЯ ЗАДАНИЯ -->
        </div>
            <div class="panel-collapse collapse out">
                 <div class="panel-body">
                     <h2>Добавить новую задачу</h2>

                    <form name="add-task" method="post" action="">
                        <label for="task-description">Опишите задание (Максимум 140 символов)</label><br/>
                        <textarea name="task-description" value="" maxlength="140"></textarea> <br>

                        <label name="task-difficult">выбрать сложность (от 1 до 3)</label>
                            <select name="task-difficult">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                            </select><br>
                        <label name="task-importance">выбрать срочность (от 1 до 3)</label>
                            <select name="task-importance">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                            </select><br>

                        <label name="task-skill">Какой навык вы этим прокачаете</label>
                            <select name="task-skill">

                                <?php
                                    $queryGetSkills = "SELECT mapping.skill_id AS skill_id, skills.skill_name AS skill_name ".
                                        " FROM mapping, skills ".
                                        " WHERE user_id ='1' AND mapping.skill_id = skills.skill_id ".
                                        "GROUP BY skills.skill_name";
                                    $dataSkills = mysqli_query($dbc, $queryGetSkills);

                                    while ($skillRow = mysqli_fetch_array($dataSkills)) {
                                        echo " <option value='". $skillRow[skill_id]."'> ".$skillRow[skill_name]."</option>";
                                    }

                                ?>
                            </select><br>

                        <button type="submit" name="add-task">Добавить задание</button>

                    </form>
                 </div>
            </div>


<?php

if (isset ($_POST['add-task'])) {

    $task_description = $_POST['task-description'];
    $task_difficult = $_POST['task-difficult'];
    $task_importance = $_POST['task-importance'];
    $task_skill = $_POST['task-skill'];

    if(empty($task_description) || $task_description == ""  || $task_description == NULL ) { /*проверяем есть ли у нас текст задания*/
        echo "вы не ввели текст задания";
    } else {
        echo $task_description;
    }

$query = "INSERT INTO tasks( task_desciption, task_status, task_importance, task_difficult, exp_id, user_id )".
"VALUES ('$task_description',  '0',  '$task_importance',  '$task_difficult',  '$task_skill',  '1')";
/*"SELECT task_desciption, task_status, task_importance, task_difficult, exp_id, user_id
" FROM tasks";
 WHERE NOT EXISTS(SELECT 1 FROM tasks WHERE task_desciption = :task_desciption)";*/
//echo  $query;
//  "VALUES (NULL, $task_description,$task_importance,$task_difficult,$task_skill, '" . $_SESSION['user_id'] . "')";

    mysqli_query($dbc, $query);

}


// $query2 = "SELECT * FROM 'tasks' WHERE user_id='". $_SESSION['user_id'] ."'";
$query2 = "SELECT * FROM tasks WHERE user_id='1' ORDER BY task_date DESC ";

$data2 = mysqli_query($dbc, $query2);
$num_task = mysqli_num_rows($data2);

?>

       <ul class="task-panel">
           <p>У Вас <?php echo  $num_task; ?> задач:</p>

		   <form name="form-name" id="form-name" action="" method="post">
<?php
    while ($row2 = mysqli_fetch_array($data2)) {
        if ($row2['task_status']) {
            echo "<li class='task-complete'><input type='checkbox' name='task-point[]' value=".$row2['task_id'].">".
                 " <label>". $row2['task_desciption']."</label>".
                " <span class='pull-right'>". $row2['task_date']. "<i class='glyphicon glyphicon glyphicon-ok'></i></span></li>";
        } else {
            echo "<li><input type='checkbox' name='task-point[]' value=".$row2['task_id'].">".
                " <label>". $row2['task_desciption']."</label>".
                " <span class='pull-right'>". $row2['task_date']."<i class='glyphicon glyphicon-exclamation-sign'></i></span></li>";
        }
    }
?>
               <input type='hidden' value='0' name='operation'/>
           </form>


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

        $aTasks = $_POST['task-point'];
        $N = count($aTasks);
        echo "Вы выбрали " . $N . " значений";

            for ($i = 0; $i < $N; $i++) {
                echo $aTasks[$i]." задание отмечено </br>";
                if ($_POST['operation'] == 'DELETE') {
                    $queryTask = "DELETE FROM tasks  WHERE task_id=".$aTasks[$i];
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
           <li><input type="checkbox"> <label>blablabla</label> <span class="pull-right">date <i class="glyphicon glyphicon-exclamation-sign"></i></span></li>

    </div>

        <div class="col-md-10"><img src="img/ornament.png"></div>
    </div> <!-- END OF WHITE CONTAINER -->

</div> <!--END OF CLASS=COnTAINER-->

<?php
    require_once('footer.php');
?>