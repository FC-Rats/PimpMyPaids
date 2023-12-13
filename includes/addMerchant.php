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
            $add = "INSERT INTO TRAN_REQUEST_PO (siren, login, companyName, currency, firstName, lastName, email, comment, type) VALUES (:siren, :login, :companyName, :currency, :firstName, :lastName, :email, :comment, :type)";
            $comment = !empty($_POST['comment']) ? $_POST['comment'] : "";
            $conditions = array(array(':siren', $_POST['siren']), array(':login', $_POST['login']), array(':companyName', $_POST['companyName']), array(':currency', $_POST['currency']), array(':firstName', $_POST['firstName']), array(':lastName', $_POST['lastName']), array(':email', $_POST['email']), array(':comment', $comment), array(':type', '0'));
            $queryAdd = $db->query($add, $conditions);

            $response["AddMerchant"] = $queryAdd;
            echo json_encode($response);

            break;
        }
    case 'Admin':
        if (!empty($_POST['login']) && !empty($_POST['password']) && !empty($_POST['lastName']) && !empty($_POST['firstName']) && !empty($_POST['email']) && !empty($_POST['siren']) && !empty($_POST['companyName']) && !empty($_POST['currency'])) {
            $addUser = "INSERT INTO TRAN_USERS (login, password, profil, lastName, firstName, email) VALUES (:login, :password, :profil, :lastName, :firstName, :email)";
            $conditions1 = array(array(':login', $_POST['login']), array(':password', password_hash($_POST['password'], PASSWORD_DEFAULT)), array(':profil', 'Merchant'), array(':lastName', $_POST['lastName']), array(':firstName', $_POST['firstName']), array(':email', $_POST['email']));
            $query1 = $db->query($addUser, $conditions1);

            $addAccount = "INSERT INTO TRAN_CUSTOMER_ACCOUNT (siren, companyName, currency, idUser) VALUES (:siren, :companyName, :currency, :id)";
            $conditions2 = array(array(':siren', $_POST['siren']), array(':companyName', $_POST['companyName']), array(':currency', $_POST['currency']), array(':id', "LAST_INSERT_ID()"));
            $query2 = $db->query($addAccount, $conditions2);

            $suppRPO = "DELETE FROM TRAN_REQUEST_PO WHERE siren = :siren";
            $conditions3 = array(array(':siren', $_POST['siren']));
            $query3 = $db->query($suppRPO, $conditions3);

            // trouver le mail du PO
            $mailPO = "SELECT email FROM TRAN_USERS WHERE profil = 'PO'";
            $message = "Veuillez confirmer le compte du client ".$_POST['login']." en cliquant sur le lien suivant : " . generateTokenLinkForValidationClient($_POST['email'],$conn);
            $objet = "Confirmation du compte client";
            $queryMailPO = $db->query($mailPO);
            envoi_mail($queryMailPO[0]["email"], $conn, $objet, $message);

            $response["AddMerchant"] = $query3;
            echo json_encode($response);

            break;
        }
}
