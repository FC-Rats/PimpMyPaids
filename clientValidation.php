<?php

session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

//include('./mailer/mailer.php');
if (!class_exists('Connection')) {
    include('./includes/connectionFunctions.php');
}

if ($_GET['token']) {
    $token = $_GET['token'];
    $getIdAndMail = $db->query("SELECT idUser, email FROM TRAN_USERS WHERE tokenR = :token;", array(array(":token", $token)));


    if (!empty($getIdAndMail)) {
        $idUser = $getIdAndMail[0]["idUser"];
        // Update client status code to 1
        $updateQuery = "UPDATE TRAN_USERS SET state = 1 , tokenR = null WHERE idUser = :idClient"; //mettre le token a null pour ne pas pouvoir réutiliser le lien
        $updateConditions = [
            [":idClient", $idUser]
        ];
        $db->query($updateQuery, $updateConditions);
        echo "Le compte du client a bien été activé";
        //envoi_mail($getIdAndMail[0]["email"], "Votre compte a été activé", "Votre compte a été activé, vous pouvez désormais vous connecter à votre espace client.");
        echo '<a href="./index.php?p=login"><button>Aller à la page de connexion</button></a>';
    } else {
        // si le token n'existe pas dans la base de données
        header("Location: ./index.php?p=login");
        exit;
    }
} else {
    // si le lien n'a pas été cliqué
    header("Location: ./index.php?p=login");
    exit;
}
?>