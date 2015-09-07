<?php
/**
 * Created by PhpStorm.
 * User: Инесса
 * Date: 29.04.2015
 * Time: 2:28
 */

// здесь мы не подключаем ни хедеров, ни футеров, т.к. эта страница просто редиректит на главную
// после завершения сскрипта

//Если пользовтель вошел в приложение, удаление переменных сессии
session_start();
if (isset($_SESSION['user_id'])) {
    // обнуляем массив $_SESSION, чтобы пользователь вышел из приложения
    $_SESSION = array();

    // Удаление куки, в котором содержится идентификатор сессии
    // устанавливаем срок истечения срока действия в прошлом
    if (isset($_COOKIE[session_name()])) {
        setcookie(session_name(), '', time()- 3600);
    }
    // закрытие сессии
    session_destroy();
}

setcookie('user_id', '', time() - 3600);
setcookie('email', '', time() - 3600);

//переадресация на главную страницу
$home_url = "http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . "/index.php";
header("Location: " . $home_url);
?>
