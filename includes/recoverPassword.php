<?php

session_start();
include("connectionFunctions.php");

error_reporting(E_ALL);
ini_set('display_errors', 1);

include('../mailer/mailer.php');

if (isset($_POST['mail'])) {
    // test si le mail existe dans la base de données
    $query = "SELECT * FROM TRAN_USERS WHERE email = :email";
    $conditions = [
        [":email", $_POST['mail']]
    ];
    $DoesMailExist = $db->query($query, $conditions);
    // si le formulaire a été rempli et que le mail existe dans la base de données
    if (!empty($DoesMailExist)) {
        $email = $_POST['mail'];
        $objet = "Récuperation mot de passe";
        $message = " Cher client, 
        <br> Il semble que vous avez oublié votre mot de passe.  
        <br> Si ce n'est pas vous à l'origine de cette récupération de compte, ignorez ce mail. \n
        <br><br> Lien d'activation : " . generateTokenLink($email,$conn) . "
        <br><br> De la part de : projet.saebut@gmail.com";

        envoi_mail($email,$conn,$objet,$message);
        header("Location: ../index.php?p=login");
    } else {
        // si le mail n'existe pas dans la base de données
        header("Location: ../index.php?p=login");
    }
} else {
    // si le formulaire n'a pas été rempli
    header("Location: ../index.php?p=login");
}