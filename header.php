<?php
/**
 * Created by PhpStorm.
 * User: Инесса
 * Date: 03.05.2015
 * Time: 3:07
 */
             require_once('sessionstart.php');
			 require_once ('function.php');
?>

<!DOCTYPE html>
<html>
<head lang="ru">
    <meta charset="UTF-8">
    <title><?php //echo $title; ?></title>

    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="slick/slick.css">
    <link rel="stylesheet" href="slick/slick-theme.css">

    <script src="js/jquery-1.11.2.js"></script>
    <script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>

    <script src="js/bootstrap.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <script src="slick/slick.js"></script>
    <script src="js/script.js"></script>
</head>
<body>
    <div class="page-header">
        <H2>Logo</H2>

        <?php
            //require('connect.php');

            require_once('navmenu.php');

        ?>
    </div>