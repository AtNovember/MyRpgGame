<?php
/**
 * Created by PhpStorm.
 * User: Инесса
 * Date: 28.04.2015
 * Time: 3:27
 */
/* // для localhost
define ('DB_HOST', 'localhost');
define ('DB_USER', 'root');
define ('DB_PASS', '');
define ('DB_NAME', 'rpg');
*/


define ('DB_HOST', 'mysql.hostinger.ru');
define ('DB_USER', 'u850336151_usr');
define ('DB_PASS', 'GPE2mOULER');
define ('DB_NAME', 'u850336151_rpg');


$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);


