<?php

/* Database connection settings */

$host = '192.168.8.6';
$user = 'root';
$paswword = '!!Break@@4444';
$dbname = 'asset';

$mysqli = new mysqli ($host, $user, $password, $dbname) or die($mysqli->error); 

?>