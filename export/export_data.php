<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'export.php';

if (isset($_POST['export_type']) && $_POST['export_type'] == 'xls') {
    if (isset($_POST['context'])) {
        switch ($_POST['context']) {
            case 'poListAccount':
                // les en-têtes et les données à exporter.
                $headers = ['SIREN', 'Raison Sociale', 'Nombre de transactions', 'Solde', 'Devise'];
                $data = [['123456789', 'McDo Champs', '5', '100', 'EUR'], ['234567890', 'HomePlus Central', '42', '1900', 'EUR'], ['876543219', 'QuickMart Town', '34', '-850', 'EUR'],['987654321', 'Leroy Merlin Noisy
                ', '11', '7146', 'EUR']];
        
                // Appel à la fonction d'exportation
                exportToXlsx('export_poListAccount.xlsx', $headers, $data, 'LISTE DES COMPTES CLIENTS');
                $response["Test"] = ["Test" => "Test"];
                echo json_encode($response);
                break;

            case 'clientListRemises':
                $headers = ['N° Remise', 'Date', 'Nombre de transactions', 'Montant Total', 'Devise'];
                $data = [['REM001', '18/11/2023','5', '100', 'EUR'], ['REM002', '19/11/2023', '5', '350', 'EUR']];

                exportToXlsx('export_clientListRemises.xlsx', $headers, $data, 'LISTE DES REMISES DU CLIENT : a_rajouter'); // a rajouter
                break;

            case 'poRemises':
                $headers = ['N° SIREN', 'Raison sociale', 'N° Remise','Date', 'Nombre de transactions','Montant Total', 'Devise'];
                $data = [['123456789', 'McDo Champs', 'REM001','18/11/2023','5', '100', 'EUR'], ['987654321', 'Leroy Merlin Noisy','REM002', '19/11/2023', '5', '350', 'EUR']];

                exportToXlsx('export_clientListRemises.xlsx', $headers, $data, 'LISTE DES REMISES DE TOUS LES CLIENTS'); // a rajouter
                break;
        }
        
    }
    
}

if (isset($_POST['export_type']) && $_POST['export_type'] == 'csv') {
    if (isset($_POST['context'])) {
        switch ($_POST['context']) {
            case 'poListAccount' :
                $headers = ['SIREN', 'Raison Sociale', 'Nombre de transactions', 'Solde', 'Devise'];
                $data = [['123456789', 'McDo Champs', '5', '100', 'EUR'], ['234567890', 'HomePlus Central', '42', '1900', 'EUR'], ['876543219', 'QuickMart Town', '34', '-850', 'EUR'],['987654321', 'Leroy Merlin Noisy
                ', '11', '7146', 'EUR']];

                exportToCsv('export_poListAccount.csv', $headers, $data, 'LISTE DES COMPTES CLIENTS');
                break;

            case 'clientListRemises':
                $headers = ['N° Remise', 'Date', 'Nombre de transactions', 'Montant Total', 'Devise'];
                $data = [['REM001', '18/11/2023','5', '100', 'EUR'], ['REM002', '19/11/2023', '5', '350', 'EUR']];

                exportToCsv('export_clientListRemises.csv', $headers, $data, 'LISTE DES REMISES DU LE CLIENT : a_rajouter'); // a rajouter
                break;
            
            case 'poRemises':
                $headers = ['Numéro de SIREN', 'Raison sociale', 'Numéro de Remise','Date', 'Nombre de transactions','Montant Total', 'Devise'];
                $data = [['123456789', 'McDo Champs', 'REM001','18/11/2023','5', '100', 'EUR'], ['987654321', 'Leroy Merlin Noisy','REM002', '19/11/2023', '5', '350', 'EUR']];

                exportToCsv('export_clientListRemises.csv', $headers, $data, 'LISTE DES REMISES DE TOUS LES CLIENTS'); // a rajouter
                break;
        }
    }
}

?>