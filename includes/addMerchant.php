<?php
    session_start();
    if (!class_exists('Connection')) {
        include('connectionFunctions.php');
    }
    $response = [];
    
    switch ($_SESSION["profil"]) {
        case 'PO':
            $add = 'INSERT INTO TRAN_REQUEST_PO VALUES (:siren, :login, :companyName, :currency, :email, :comment)';
            if (!isset(($_POST['comment']))) {
                $comment = "";
            } else {
                $comment = $_POST['comment'];
            }
            $conditions = array(array(':siren', $_POST['siren']), array(':login', $_POST['login']), array(':companyName', $_POST['companyName']), array(':currency', $_POST['currency']), array(':email', $_POST['email']), array(':comment', $comment));
            $queryAdd = $db->query($add, $conditions);
            
            $response["AddMerchant"] = $queryAdd;
            echo json_encode($response);

            break;
        case 'Admin':
            $addUser = "INSERT INTO TRAN_USERS (login, password, profil, lastName, firstName, email) VALUES (':login', ':password', ':profil', ':lastName', ':firstName', ':email')";
            $conditions1 = array(array(':login', $_POST['login']), array(':password', password_hash($_POST['password'], PASSWORD_DEFAULT)), array(':profil', 'Merchant'), array(':email', $_POST['email']));
            $query1 = $db->query($addUser, $conditions1);

            $addAccount = "INSERT INTO TRAN_CUSTOMER_ACCOUNT (siren, companyName, currency, idUser) VALUES (':siren', ':companyName', ':currency', :id)";
            $conditions2 = array(array(':siren', $_POST['siren']), array(':companyName', $_POST['companyName']), array(':currency', $_POST['currency']), array(':id', "LAST_INSERT_ID()"));
            $query2 = $db->query($addAccount, $conditions2);
            
            $suppRPO = "DELETE FROM TRAN_REQUEST_PO WHERE siren = :siren";
            $conditions3 = array(array(':siren', $_POST['siren']));
            $query3 = $db->query($suppRPO, $conditions3);
            break;
    }
?>
