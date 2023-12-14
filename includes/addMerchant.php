<?php
session_start();
if (!class_exists('Connection')) {
    include('connectionFunctions.php');
}
$response = [];
include('../mailer/mailer.php');
switch ($_SESSION["profil"]) {
    case 'PO':
        if (!empty($_POST['siren']) && !empty($_POST['login']) && !empty($_POST['companyName']) && !empty($_POST['currency']) && !empty($_POST['firstName']) && !empty($_POST['lastName']) && !empty($_POST['email'])) {
            $add = "INSERT INTO TRAN_REQUEST_PO (siren, login, companyName, currency, firstName, lastName, email, comment, type, statement) VALUES (:siren, :login, :companyName, :currency, :firstName, :lastName, :email, :comment, :type, :statement)";
            $comment = !empty($_POST['comment']) ? $_POST['comment'] : "";
            $conditions = array(array(':siren', $_POST['siren']), array(':login', $_POST['login']), array(':companyName', $_POST['companyName']), array(':currency', $_POST['currency']), array(':firstName', $_POST['firstName']), array(':lastName', $_POST['lastName']), array(':email', $_POST['email']), array(':comment', $comment), array(':type', '0'), array(':statement', 'A exécuter'));
            $queryAdd = $db->query($add, $conditions);

            $response["AddMerchant"] = $queryAdd;
            echo json_encode($response);

            break;
        }
    case 'Admin':
        if (!empty($_POST['login']) && !empty($_POST['password']) && !empty($_POST['lastName']) && !empty($_POST['firstName']) && !empty($_POST['email']) && !empty($_POST['siren']) && !empty($_POST['companyName']) && !empty($_POST['currency'])) {
            $addUser = "INSERT INTO TRAN_USERS (login, password, profil, lastName, firstName, email) VALUES (:login, :password, :profil, :lastName, :firstName, :email)";
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $conditions1 = array(array(':login', $_POST['login']), array(':password', $password), array(':profil', 'Merchant'), array(':lastName', $_POST['lastName']), array(':firstName', $_POST['firstName']), array(':email', $_POST['email']));
            $query1 = $db->query($addUser, $conditions1);

            $lastId = $db->query("SELECT idUser FROM TRAN_USERS WHERE login = :login;", array(array(':login', $_POST['login'])));
            $idUser = $lastId[0]["idUser"];

            $addAccount = "INSERT INTO TRAN_CUSTOMER_ACCOUNT (siren, companyName, currency, idUser) VALUES (:siren, :companyName, :currency, :id)";
            $conditions2 = array(array(':siren', $_POST['siren']), array(':companyName', $_POST['companyName']), array(':currency', $_POST['currency']), array(':id', $idUser));
            $query2 = $db->query($addAccount, $conditions2);

            $selectID = "SELECT idRequest, type FROM TRAN_REQUEST_PO WHERE siren = :siren ORDER BY idRequest ASC LIMIT 1";
            $conditions3 = array(array(':siren', $_POST['siren']));
            $query3 = $db->query($selectID, $conditions3);

            $updateRPO = "UPDATE TRAN_REQUEST_PO SET statement=:statement WHERE siren = :siren";
            $conditions4 = array(array(':statement', 'En attente de confirmation'), array(':siren', $_POST['siren']));
            $query4 = $db->query($updateRPO, $conditions4);

            $message = "Veuillez confirmer la création du compte du client ".$_POST['login']." en cliquant sur le lien suivant : " . generateTokenForConfirmation($idUser, $query3[0]['idRequest'], $query3[0]['type']);
            $objet = "Confirmation de création du compte client : ".$_POST['login'];
            $queryMailPO = $db->query("SELECT email FROM TRAN_USERS WHERE profil = :profil", array(array(':profil', 'PO')));
            envoi_mail($queryMailPO[0]["email"], $db, $objet, $message);

            $response["AddMerchant"] = $query4;
            echo json_encode($response);

            break;
        }
}
