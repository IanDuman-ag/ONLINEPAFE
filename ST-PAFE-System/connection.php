<?php
define("DB_USER", 'phpmyadmin_user');
define("DB_PASSWORD", 'socieTree@12345');
define("DB_NAME", 'societree');
define("DB_HOST", 'localhost');

$con = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}
?>