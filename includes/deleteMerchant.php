<?php
session_start();
if (!class_exists('Connection')) {
    include('connectionFunctions.php');
}
$response = [];
include('../mailer/mailer.php');
switch ($_SESSION["profil"]) {
    case 'PO':
        if (!empty($_POST['login']) && !empty($_POST['companyName'])) {
            $delete = "INSERT INTO TRAN_REQUEST_PO (login, companyName, comment, type, statement) VALUES (:login, :companyName, :comment, :type, :statement)";
            $comment = !empty($_POST['comment']) ? $_POST['comment'] : "";
            $conditions = array(array(':login', $_POST['login']), array(':companyName', $_POST['companyName']), array(':comment', $comment), array(':type', '1'), array(':statement', 'A exécuter'));
            $queryDelete = $db->query($delete, $conditions);

            $response["DeleteMerchant"] = $queryDelete;
            echo json_encode($response);

            break;
        }
    case 'Admin':
        if (!empty($_POST['login'])) {
            $suppMerchant = "UPDATE TRAN_USERS SET state=0 WHERE login = :login";
            $conditions = array(array(':login', $_POST['login']));
            $query1 = $db->query($suppMerchant, $conditions);

            $selectUser = "SELECT idUser FROM TRAN_USERS WHERE login = :login";
            $conditions2 = array(array(':login', $_POST['login']));
            $query2 = $db->query($selectUser, $conditions2);

            $selectID = "SELECT idRequest, type FROM TRAN_REQUEST_PO WHERE login = :login ORDER BY idRequest ASC LIMIT 1";
            $conditions3 = array(array(':login', $_POST['login']));
            $query3 = $db->query($selectID, $conditions3);

            $updateRPO = "UPDATE TRAN_REQUEST_PO SET statement=:statement WHERE login = :login";
            $conditions4 = array(array(':statement', 'En attente de confirmation'), array(':login', $_POST['login']));
            $query4 = $db->query($updateRPO, $conditions4);

            $message = "Veuillez confirmer la suppresion du compte du client ".$_POST['login']." en cliquant sur le lien suivant : " . generateTokenForConfirmation($query2[0]['idUser'], $query3[0]['idRequest'], $query3[0]['type']);
            $objet = "Confirmation de suppression du compte client : ".$_POST['login'];
            $queryMailPO = $db->query("SELECT email FROM TRAN_USERS WHERE profil = :profil", array(array(':profil', 'PO')));
            envoi_mail($queryMailPO[0]["email"], $db, $objet, $message);

            $response["DeleteMerchant"] = $query4;
            echo json_encode($response);

            break;
        }
}
