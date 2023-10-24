<?php

session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

include('../mailer/mailer.php');

if (isset($_POST['email'])) {
    $email = $_POST['email'];

    $objet = "Récuperation mot de passe";
    $message = " Cher client, 
    <br> Il semble que vous avez oublié votre mot de passe.  
    <br> Si ce n'est pas vous à l'origine de cette récupération de compte, ignorez ce mail. \n
    <br><br> Lien d'activation : " . generateTokenLink($email,$conn) . "
    <br><br> De la part de : projetgrenadeunesco@gmail.com";

    envoi_mail($email,$conn,$objet,$message);
    header("Location: ../index.php?p=login");
}