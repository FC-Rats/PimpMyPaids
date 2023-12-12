<?php

if (!class_exists('Connection')) {
    include('connectionFunctions.php');
}


switch ($_SESSION["profil"]) {
    case 'Merchant':
        $DataClient = "SELECT 
        (SELECT SUM(CASE WHEN T.sign = '+' THEN T.amount ELSE -T.amount END) FROM TRAN_TRANSACTIONS T JOIN TRAN_CUSTOMER_ACCOUNT C ON T.siren = C.siren JOIN TRAN_REMITTANCES R ON T.remittanceNumber = R.remittanceNumbeR WHERE T.remittanceNumber IS NOT NULL AND T.siren = :siren) AS sumRemises,
        (SELECT currency FROM TRAN_CUSTOMER_ACCOUNT WHERE siren = :siren) AS currency;";
        $conditions = array(array(":siren", $_SESSION["siren"]));
        $datas = $db->query($DataClient, $conditions);
        break;
}


?>