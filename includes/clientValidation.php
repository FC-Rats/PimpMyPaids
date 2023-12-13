<?php

session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

if (!class_exists('Connection')) {
    include('connectionFunctions.php');
}

if ($_GET['token']) {
    $token = $_GET['token'];
    $getId = $db->query("SELECT idUser FROM TRAN_USERS WHERE tokenR = :token;", array(array(":token", $token)));
    $conditions = [
        [":tokenR", $token]
    ];
    $DoesTokenExist = $db->query($getId, $conditions);

    if (!empty($DoesTokenExist)) {
        // Update client status code to 1
        $updateQuery = "UPDATE TRAN_USERS SET state = 1 , tokenR = null WHERE idClient = :idClient"; //mettre le token a null pour ne pas pouvoir réutiliser le lien
        $updateConditions = [
            [":idClient", $getId[0]['idUser']]
        ];
        $db->query($updateQuery, $updateConditions);
        echo "Le compte du client a bien été activé";
    } else {
        // si le token n'existe pas dans la base de données
        header("Location: ../index.php?p=login");
        exit;
    }
} else {
    // si le lien n'a pas été cliqué
    header("Location: ../index.php?p=login");
    exit;
}
?>