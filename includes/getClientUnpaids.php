<?php

if (!class_exists('Connection')) {
    include('connectionFunctions.php');
}

switch ($_SESSION["profil"]) {
    case 'Merchant':
        $dataClient = "SELECT 
        (SELECT SUM(CASE WHEN T.sign = '+' THEN T.amount ELSE -T.amount END) FROM TRAN_TRANSACTIONS T JOIN TRAN_CUSTOMER_ACCOUNT C ON T.siren = C.siren JOIN TRAN_UNPAIDS U ON T.idTransac = U.idTransac WHERE T.siren = :siren) AS sumImpayes,
        (SELECT currency FROM TRAN_CUSTOMER_ACCOUNT WHERE siren = :siren) AS currency;";
        $conditions = array(array(":siren", $_SESSION["siren"]));
        $datas = $db->query($dataClient, $conditions);
        break;
}

?>