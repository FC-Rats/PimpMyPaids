<?php

session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

if (!class_exists('Connection')) {
    include('connectionFunctions.php');
} else {
    $config = parse_ini_file('config.ini');
    $db = new Connection($config['host'],$config['db'],$config['login'],$config['password']);
}

$token = $_POST['token'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm-password'];
if ($password == $confirm_password) {
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $confirm_password = password_hash($_POST["confirm-password"], PASSWORD_DEFAULT);
    $getId = $db->query("SELECT idUser FROM TRAN_USERS WHERE tokenR = :token;", array(array(":token", $token)));
    $updatePassword = $db->query("UPDATE TRAN_USERS SET password = :password , tokenR = :token WHERE idUser = :idUser;", array(array(":password", $password), array(":token", 0), array(":idUser", $getId[0]["idUser"])));
    header("Location: ../index.php?p=login");
    exit;
} else {
    //code pour indiquer que les mdp ne correspondent pas ?
}
?>