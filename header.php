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
	
	<meta name='yandex-verification' content='558e793d4ff2be5d' />
	
	<!-- Yandex.Metrika counter -->
	<script type="text/javascript"> (function (d, w, c) { (w[c] = w[c] || []).push(function() { try { w.yaCounter31833291 = new Ya.Metrika({ id:31833291, clickmap:true, trackLinks:true, accurateTrackBounce:true, webvisor:true, trackHash:true }); } catch(e) { } }); var n = d.getElementsByTagName("script")[0], s = d.createElement("script"), f = function () { n.parentNode.insertBefore(s, n); }; s.type = "text/javascript"; s.async = true; s.src = "https://mc.yandex.ru/metrika/watch.js"; if (w.opera == "[object Opera]") { d.addEventListener("DOMContentLoaded", f, false); } else { f(); } })(document, window, "yandex_metrika_callbacks");</script><noscript><div><img src="https://mc.yandex.ru/watch/31833291" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
	<!-- /Yandex.Metrika counter -->
	
	

    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="slick/slick.css">
    <link rel="stylesheet" href="slick/slick-theme.css">

    <script src="js/jquery-1.11.2.js"></script>
    <script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>


</head>
<body>
    <div class="page-header">
       <!-- <H2>Logo</H2>-->

        <?php
            //require('connect.php');

            require_once('navmenu.php');

        ?>
    </div>