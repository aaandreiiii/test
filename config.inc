<?php
$mysql = new mysqli('localhost', 'root', '', 'db_shop');
$mysql->set_charset("utf8");
if ($mysql->connect_error)
    die('Ошибка соединения с БД (' . $mysql->connect_errno . ') ' . $mysql->connect_error);