<?php

session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

if (!class_exists('Connection')) {
    include('connectionFunctions.php');
    $_SESSION['db'] = $db;
}
$db = $_SESSION['db'];

$token = $_POST['token'];
$password = password_hash($_POST["password"], PASSWORD_DEFAULT);
$confirm_password = password_hash($_POST["confirm-password"], PASSWORD_DEFAULT);

if ($password == $confirm_password) {
    $getId = $db->query("SELECT id FROM TRAN_Users WHERE tokenR = :token;", array(array(":token", $token)));
    $updatePassword = $db->query("UPDATE TRAN_Users SET password = :password , tokenR = :token WHERE id = :id;", array(array(":password", $password), array(":token", NULL), array(":id", $getId["id"])));
    header("Location: ../index.php?p=login");
}
?>