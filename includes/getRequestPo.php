<?php

if (!class_exists('Connection')) {
    include('connectionFunctions.php');
}

switch ($_SESSION["profil"]) {
    case 'Admin':
        $lastRequest = "SELECT * FROM TRAN_REQUEST_PO ORDER BY idRequest DESC";
        $requests = $db->query($lastRequest);

        break;
}
