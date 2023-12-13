<?php
session_start();
if (!class_exists('Connection')) {
    include('connectionFunctions.php');
}
$response = [];

    switch ($_SESSION["profil"]) {
        case 'PO':
            $delete = "INSERT INTO TRAN_REQUEST_PO (login, companyName, comment, type) VALUES (:login, :companyName, :comment, :type)";
            if (!isset(($_POST['comment']))) {
                $comment = "";
            } else {
                $comment = $_POST['comment'];
            }
            $conditions = array(array(':login', $_POST['login']), array(':companyName', $_POST['companyName']), array(':comment', $comment), array(':type', '1'));
            $queryDelete = $db->query($delete, $conditions);

            $response["DeleteMerchant"] = $queryDelete;
            echo json_encode($response);

            break;
        case 'Admin':
            $suppMerchant = "DELETE FROM TRAN_USERS WHERE login = :login";
            $conditions = array(array(':login', $_POST['login']));
            $query3 = $db->query($suppMerchant, $conditions);

            $response["DeleteMerchant"] = $query3;
            echo json_encode($response);

            break;
    }
?>
