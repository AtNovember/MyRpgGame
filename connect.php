<?php
/**
 * Created by PhpStorm.
 * User: Инесса
 * Date: 28.04.2015
 * Time: 3:27
 */

 // для localhost
define ('DB_HOST', 'localhost');
define ('DB_USER', 'root');
define ('DB_PASS', '');
define ('DB_NAME', 'rpg');



$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);


