<?php

session_start();
if (!class_exists('Connection')) {
    include('connectionFunctions.php');
    $_SESSION['db'] = $db;
}
$db = $_SESSION['db'];

error_reporting(E_ALL);
ini_set('display_errors', 1);

session_destroy();
header('Location: ../index.php');
?>