<?php
    if (!class_exists('Connection')) {
        include('connectionFunctions.php');
        $_SESSION['db'] = $db;
    }
    $db = $_SESSION['db'];
    
    $add = 'INSERT INTO TRAN_REQUEST_PO VALUES (:siren, :login, :companyName, :currency, :email, :comment)';
    if (!isset(($_POST['comment']))) {
        $comment = "";
    } else {
        $comment = $_POST['comment'];
    }
    $conditions = array(array(':siren', $_POST['siren']), array(':login', $_POST['login']), array(':companyName', $_POST['companyName']), array(':currency', $_POST['currency']), array(':email', $_POST['email']), array(':comment', $_POST['comment']));
    $queryAdd = $db->query($add, $conditions);
    header('Location: ../poSpace.php');
?>