<?php
/**
 * Created by PhpStorm.
 * User: Инесса
 * Date: 03.05.2015
 * Time: 3:02
 */

session_start();

//Если переменные сессии не имеют значений
// присваиваем им значения, полученные из куки

if (!isset($_SESSION['user_id'])) {
    if (isset($_COOKIE['user_id']) && isset($_COOKIE['email'])) {
        $_SESSION['user_id'] = $_COOKIE['user_id'];
        $_SESSION['email'] = $_COOKIE['email'];
    }
} 

?>