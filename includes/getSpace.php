<?php

if (!class_exists('Connection')) {
    include('connectionFunctions.php');
}

switch ($_SESSION["profil"]) {
    case 'Merchant':
        $names = $db->query('SELECT firstName, lastName FROM TRAN_USERS WHERE idUser = :idUser', array(array(':idUser', $_SESSION['id'])));
        $allDataClient = "SELECT 
        (SELECT SUM(CASE WHEN T.sign = '+' THEN T.amount ELSE -T.amount END) FROM TRAN_TRANSACTIONS T WHERE T.siren = :siren) AS totalAmount,
        (SELECT SUM(CASE WHEN T.sign = '+' THEN T.amount ELSE -T.amount END) FROM TRAN_TRANSACTIONS T JOIN TRAN_CUSTOMER_ACCOUNT C ON T.siren = C.siren JOIN TRAN_REMITTANCES R ON T.remittanceNumber = R.remittanceNumbeR WHERE T.remittanceNumber IS NOT NULL AND T.siren = :siren) AS sumRemises,
        (SELECT SUM(CASE WHEN T.sign = '+' THEN T.amount ELSE -T.amount END) FROM TRAN_TRANSACTIONS T JOIN TRAN_CUSTOMER_ACCOUNT C ON T.siren = C.siren JOIN TRAN_UNPAIDS U ON T.idTransac = U.idTransac WHERE T.siren = :siren) AS sumImpayes,
        (SELECT currency FROM TRAN_CUSTOMER_ACCOUNT WHERE siren = :siren) AS currency;";        
        $conditions = array(array(":siren", $_SESSION["siren"]));
        $datas = $db->query($allDataClient, $conditions);
        break;
    case 'PO':
        $names = $db->query('SELECT firstName, lastName FROM TRAN_USERS WHERE idUser = :idUser', array(array(':idUser', $_SESSION['id'])));
        $lastTr = $db->query('SELECT t.dateTransac, t.idTransac, t.sign, t.amount, c.currency FROM TRAN_TRANSACTIONS t JOIN TRAN_CUSTOMER_ACCOUNT c ON t.siren=c.siren ORDER BY t.dateTransac DESC, t.idTransac DESC LIMIT 3');
        break;
    case 'Admin':
        $lastRequest = "SELECT * FROM TRAN_REQUEST_PO ORDER BY idRequest DESC";
        $requests = $db->query($lastRequest);
        break;
}
?>