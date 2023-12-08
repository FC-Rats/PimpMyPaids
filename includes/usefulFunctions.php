<?php
/*
- - - FONCTIONS UTILES A LA CONNEXION AU SITE - - -
*/
session_start();

if (!class_exists('Connection')) {
    include('connectionFunctions.php');
}


function getEspaceData() {
    switch ($_SESSION["profil"]) {
        case 'PO':
            $lastTr = "SELECT * FROM TRAN_TRANSACTIONS ORDER BY dateTransac DESC LIMIT 3";
            return $db->query($lastTr);
        case 'Admin':
            $lastRequest = "SELECT * FROM TRAN_REQUEST_PO ORDER BY idRequest DESC";
            return $db->query($lastRequest, $conditions);
        case 'Merchant':
            $allDataClient = "SELECT 
            (SELECT SUM(CASE WHEN T.sign = '+' THEN T.amount ELSE -T.amount END) FROM TRAN_TRANSACTIONS T WHERE T.siren = :siren) AS totalAmount,
            (SELECT SUM(CASE WHEN T.sign = '+' THEN T.amount ELSE -T.amount END) FROM TRAN_TRANSACTIONS T JOIN TRAN_CUSTOMER_ACCOUNT C ON T.siren = C.siren JOIN TRAN_REMITTANCES R ON T.remittanceNumber = R.remittanceNumbeR WHERE T.remittanceNumber IS NOT NULL AND T.siren = :siren) AS sumRemises,
            (SELECT SUM(CASE WHEN T.sign = '+' THEN T.amount ELSE -T.amount END) FROM TRAN_TRANSACTIONS T JOIN TRAN_CUSTOMER_ACCOUNT C ON T.siren = C.siren JOIN TRAN_UNPAIDS U ON T.idTransaction = U.idTransaction WHERE T.siren = :siren) AS sumImpayes,
            ((SELECT SUM(CASE WHEN T.sign = '+' THEN T.amount ELSE -T.amount END) FROM TRAN_TRANSACTIONS T WHERE T.siren = :siren) - (SELECT SUM(CASE WHEN T.sign = '+' THEN T.amount ELSE -T.amount END) FROM TRAN_TRANSACTIONS T JOIN TRAN_CUSTOMER_ACCOUNT C ON T.siren = C.siren JOIN TRAN_REMITTANCES R ON T.remittanceNumber = R.remittanceNumbeR WHERE T.remittanceNumber IS NOT NULL AND T.siren = :siren) + (SELECT SUM(CASE WHEN T.sign = '+' THEN T.amount ELSE -T.amount END) FROM TRAN_TRANSACTIONS T JOIN TRAN_CUSTOMER_ACCOUNT C ON T.siren = C.siren JOIN TRAN_UNPAIDS U ON T.idTransaction = U.idTransaction WHERE T.siren = :siren)) AS tresorerie;";        
            $conditions = array(array(":siren", $_SESSION["siren"]));
            return $db->query($allDataClient, $conditions);
    }
}
?>


