<?php

session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

include('connectionFunction.php');

$token = $_POST['token'];
$password = password_hash($_POST["password"], PASSWORD_DEFAULT);

$getId = $db->query("SELECT id FROM Users WHERE tokenR = :token;", array(array(":token", $token)));
$updatePassword = $db->query("UPDATE Users SET password = ? , tokenR = ? WHERE id = ?;", array(array(":password", $password), array(":token", NULL), array(":id", $getId["id"])));
header("Location: ../index.php?p=login");

?>