<?php
/**
 * Created by PhpStorm.
 * User: Инесса
 * Date: 12.05.2015
 * Time: 4:16
 */
// длаем запрос в базу
// получаем все поднавыки и их значения WHERE skill = skill and USER_id = USER_id
// делаем push() в массив $xp

// создаем ассоциативный массив с поднавыками (experience, XP)
// для навыка например игра на гитаре

$xp1 = array('перебор' => 38,
            'игра боем' => 64,
            'знание аккордов' => 28);

// выводим значения элементов массива
// для навыка игра на гитаре
$sum_xp = 0; // обнуляем счетчик, чтобы избавиться от Notice: Undefined variable: sum_xp in E:\xampp\htdocs\rpg\logic.php on line 21
foreach ($xp1 as $skill_name => $val ) {
    echo "$skill_name = ". $val." <br>";
    $sum_xp += $val;
}

echo "Набрано очков навыка ". $sum_xp ."</br>";

// расчитываем уровень текущего навыка и выводим его
$skill_level = floor(2 + log(($sum_xp/100), 2));
echo "Ваш текущий уровень навыка ". $skill_level."</br>";


/* ---- ПРОБУЕМ ВЫВЕСТИ ОБЩИЙ УРОВЕНЬ ПОЛЬЗОВАТЕЛЯ --- */


// длаем запрос в базу
// получаем все поднавыки и их значения для всех скиллов  WHERE USER_id = USER_id
// делаем push() в массив $xp2
/*
$xp2 = array(    'перебор' => 38,
                'игра боем' => 64,
                'знание аккордов' => 28,
    'PhP' => 38,
            'Js' => 64,
            'jQuery' => 28);

$sum_xp = 0; // обнуляем счетчик, чтобы избавиться от Notice: Undefined variable: sum_xp in E:\xampp\htdocs\rpg\logic.php on line 21
foreach ($xp2 as $skill_name => $val ) {
    echo "$skill_name = ". $val." <br>";
    $sum_xp += $val;
}
echo "----------------------------------</br>";
echo "Набрано очков ВСЕГО: ". $sum_xp ."</br>";

// расчитываем уровень текущего навыка и выводим его
$user_level = floor(2 + log(($sum_xp/100), 2));
echo "Ваш текущий уровень: ". $user_level."</br>";*/