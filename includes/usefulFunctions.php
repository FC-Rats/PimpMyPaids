<?php
/*
- - - FONCTIONS UTILES A LA CONNEXION AU SITE - - -
*/
session_start();

function getNames() {
    return $db->query('SELECT firstName, lastName FROM TRAN_USERS WHERE idUser = : idUser', array(array(':idUser', $_SESSION['id'])));
}

function getEspaceData() {
    switch ($_SESSION["profil"]) {
        case 'PO':
            $lastTr = "SELECT * FROM TRANSACTIONS ORDER BY dateTransac DESC LIMIT 3";
            return $db->query($lastTr);
        case 'Admin':
            $lastRequest = "SELECT * FROM REQUEST_PO ORDER BY idRequest DESC";
            return $db->query($lastRequest, $conditions);
        case 'Merchant':
            $allDataClient = "SELECT 
            (SELECT SUM(CASE WHEN T.sign = '+' THEN T.amount ELSE -T.amount END) FROM TRAN_TRANSACTIONS T) AS totalAmount,
            (SELECT SUM(CASE WHEN T.sign = '+' THEN T.amount ELSE -T.amount END) AS somme_transactions_avec_remise FROM TRAN_TRANSACTIONS T JOIN TRAN_CUSTOMER_ACCOUNTS C ON T.siren = C.siren JOIN TRAN_REMITTANCES R ON T.remittanceNumber = R.remittanceNumbeR WHERE T.remittanceNumber IS NOT NULL AND siren = :siren;) AS sumRemises,
            (SELECT SUM(CASE WHEN T.sign = '+' THEN T.amount ELSE -T.amount END) AS somme_transactions_avec_impaye FROM TRAN_TRANSACTIONS T JOIN TRAN_CUSTOMER_ACCOUNTS C ON T.siren = C.siren JOIN TRAN_UNPAIDS U ON T.idTransaction = U.idTransaction WHERE siren = :siren;) AS sumImpayes,
            (totalAmount - sumRemises + sumImpayes) AS tresorerie";
            $conditions = array(array(":siren", $_SESSION["siren"]));
            return $db->query($allDataClient, $conditions);
    }
}
?>