<?php
session_start();

if (!class_exists('Connection')) {
    include('../includes/connectionFunctions.php');
} else {
    $db = $_SESSION['db'];
}

error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'export.php';

$firstName = $db->query("SELECT firstName FROM TRAN_USERS WHERE login = :login", array(array(":login",$_SESSION["login"])));
$lastName = $db->query("SELECT lastName FROM TRAN_USERS WHERE login = :login", array(array(":login",$_SESSION["login"])));

$nom_client = $firstName[0]['firstName'] . ' ' . $lastName[0]['lastName'];

if (isset($_POST['export_type'])) {
    $jsonData = $_POST["dataToExport"];
    $rows = json_decode($jsonData, true);
    $data = [];
    $context = $_POST['context'] ?? null;
    $exportType = $_POST['export_type'];
    if ($exportType == 'xls') {
        switch ($context) {
            case 'poListAccount':
                // les en-têtes et les données à exporter.
                $headers = ['SIREN', 'Raison Sociale', 'Nombre de transactions', 'Solde', 'Devise'];
                
                foreach ($rows as $row) {
                    $baseInfo = [
                        'siren' => $row['siren'],
                        'companyName' => $row['companyName'],
                        'nbTransactions' => $row['nbTransactions'],
                        'montant' => $row['montant'],
                        'currency' => $row['currency']
                    ];

                     
                    $data[] = $baseInfo;
                }
                
                $filters = ['siren', 'companyName'];
                $valueFilters = $_POST;
                // Appel à la fonction d'exportation
                exportToXlsx('export_poListAccount.xlsx', $headers, $data, 'LISTE DES COMPTES CLIENTS', $filters, $valueFilters);
                break;

            case 'clientListRemises':
                $headers = ['N° Remise','Nombre de transactions', 'Date', 'Montant Total', 'Devise'];

                

                foreach ($rows as $row) {
                    $dateObjet = new DateTime($row['dateRemittance']);

                    $dateFormatee = $dateObjet->format('d/m/Y');
                    
                    $baseInfo = [
                        'remittanceNumber' => $row['remittanceNumber'],
                        'nbTransactions' => $row['nbTransactions'],
                        'dateRemittance' => $dateFormatee,
                        'montantTotal' => $row['montantTotal'],
                        'currency' => $row['currency'],
                        'currency' => $row['currency']
                    ];

                     
                    $data[] = $baseInfo;
                }
                
                $filters = ['amount', 'remittanceNumber', 'beforeDate', 'afterDate'];
                $valueFilters = $_POST;
                
                exportToXlsx('export_clientListRemises.xlsx', $headers, $data, 'LISTE DES REMISES DU CLIENT ' . strtoupper($nom_client),  $filters, $valueFilters);
                break;

            case 'poRemises':
                $headers = ['N° SIREN', 'Raison sociale', 'N° Remise','Date', 'Nombre de transactions','Montant Total', 'Devise'];
                
                foreach ($rows as $row) {
                    $dateObjet = new DateTime($row['dateRemittance']);

                    $dateFormatee = $dateObjet->format('d/m/Y');
                    $baseInfo = [
                        'siren' => $row['siren'],
                        'companyName' => $row['companyName'],
                        'remittanceNumber' => $row['remittanceNumber'],
                        'dateRemittance' => $dateFormatee,
                        'nbTransactions' => $row['nbTransactions'],
                        'montantTotal' => $row['montantTotal'],
                        'currency' => $row['currency']
                    ];

                     
                    $data[] = $baseInfo;
                }

                $filters = ['siren', 'companyName', 'remittanceNumber', 'beforeDate', 'afterDate'];
                $valueFilters = $_POST;
                exportToXlsx('export_clientListRemises.xlsx', $headers, $data, 'LISTE DES REMISES DE TOUS LES CLIENTS', $filters, $valueFilters);
                break;
            
            case 'clientUnpaids':
                $headers = ['Date', 'N° Carte bancaire', 'Réseau', 'Numéro de dossier impayé', 'Montant', 'Devise','Raison de l\'impayé'];
                
                foreach ($rows as $row) {
                    $dateObjet = new DateTime($row['dateTransac']);

                    $dateFormatee = $dateObjet->format('d/m/Y');
                    $baseInfo = [
                        'dateTransac' => $dateFormatee,
                        'creditCardNumber' => '************' . mb_substr($row['creditCardNumber'], 12),
                        'network' => $row['network'],
                        'unpaidFileNumber' => $row['unpaidFileNumber'],
                        'amount' => '-' . $row['amount'],
                        'currency' => $row['currency'],
                        'unpaidName' => $row['unpaidName']
                    ];

                        
                    $data[] = $baseInfo;
                }

                $filters = ['beforeDate', 'afterDate', 'label', 'idUnpaid'];
                $valueFilters = $_POST;
                exportToXlsx('export_clientUnpaids.xlsx', $headers, $data, 'LISTE DES IMPAYÉS DU CLIENT ' . strtoupper($nom_client), $filters, $valueFilters);
                break;
            
            case 'poUnpaids':
                $headers = ['Siren', 'Raison sociale', 'Montant', 'Devise'];
                
                foreach ($rows as $row) {
                    $baseInfo = [
                        'siren' => $row['siren'],
                        'companyName' => $row['companyName'],
                        'totalUnpaids' => $row['totalUnpaids'],
                        'currency' => $row['currency']
                    ];

                        
                    $data[] = $baseInfo;
                }

                $filters = ['siren', 'companyName', 'numDossier', 'label','beforeDate', 'afterDate'];
                $valueFilters = $_POST;
                exportToXlsx('export_poUnpaids.xlsx', $headers, $data, 'PO LISTE DES IMPAYÉS', $filters, $valueFilters);
                break;
            
            case 'poRemisesDetails':
                $headers = ['N° de Remise', 'Date', 'N° de carte bancaire', 'Réseau', 'N° d\'autorisation', 'Montant', 'Devise'];

                foreach ($rows as $row) {
                    $dateObjet = new DateTime($row['dateTransac']);

                    $dateFormatee = $dateObjet->format('d/m/Y');
                    $baseInfo = [
                        'remittanceNumber' => $row['remittanceNumber'],
                        'dateTransac' => $dateFormatee,
                        'creditCardNumber' => '************' . mb_substr($row['creditCardNumber'], 12),
                        'network' => $row['network'],
                        'numAutorisation' => $row['numAutorisation'],
                        'amount' => $row['sign'] . $row['amount'],
                        'currency' => $row['currency']
                    ];

                        
                    $data[] = $baseInfo;
                }

                exportToXlsx('export_poRemisesDetails.xlsx', $headers, $data, 'DETAILS DE LA REMISE ' . $_POST['remittanceNumber'], NULL, NULL);
                break;
            
            case 'clientRemisesDetails':
                $headers = ['N° de Remise', 'Date', 'N° de carte bancaire', 'Réseau', 'N° d\'autorisation', 'Montant', 'Devise'];
                

                foreach ($rows as $row) {
                    $dateObjet = new DateTime($row['dateTransac']);

                    $dateFormatee = $dateObjet->format('d/m/Y');
                    $baseInfo = [
                        'remittanceNumber' => $row['remittanceNumber'],
                        'dateTransac' => $dateFormatee,
                        'creditCardNumber' => '************' . mb_substr($row['creditCardNumber'], 12),
                        'network' => $row['network'],
                        'numAutorisation' => $row['numAutorisation'],
                        'amount' => $row['sign'] . $row['amount'],
                        'currency' => $row['currency']
                    ];

                        
                    $data[] = $baseInfo;
                }

                exportToXlsx('export_clientRemisesDetails.xlsx', $headers, $data, 'DETAILS DE LA REMISE ' . $_POST['remittanceNumber'], NULL, NULL);
                break;
            
        }   
    }
    
}
    

if (isset($_POST['export_type'])) {
    $jsonData = $_POST["dataToExport"];
    $rows = json_decode($jsonData, true);
    $data = [];
    $context = $_POST['context'] ?? null;
    $exportType = $_POST['export_type'];
    if ($exportType == 'csv') {
        switch ($context) {
            case 'poListAccount' :
                // les en-têtes et les données à exporter.
                $headers = ['SIREN', 'Raison Sociale', 'Nombre de transactions', 'Solde', 'Devise'];
                
                foreach ($rows as $row) {
                    $baseInfo = [
                        'siren' => $row['siren'],
                        'companyName' => $row['companyName'],
                        'nbTransactions' => $row['nbTransactions'],
                        'montant' => $row['montant'],
                        'currency' => $row['currency']
                    ];

                     
                    $data[] = $baseInfo;
                }
                
                $filters = ['siren', 'companyName'];
                $valueFilters = $_POST;
                // Appel à la fonction d'exportation
                exportToCsv('export_poListAccount.csv', $headers, $data, 'LISTE DES COMPTES CLIENTS', $filters, $valueFilters);
                break;

            case 'clientListRemises':
                $headers = ['N° Remise', 'Date', 'Nombre de transactions', 'Montant Total', 'Devise'];

                foreach ($rows as $row) {
                    $dateObjet = new DateTime($row['dateRemittance']);

                    $dateFormatee = $dateObjet->format('d/m/Y');
                    $baseInfo = [
                        'remittanceNumber' => $row['remittanceNumber'],
                        'nbTransactions' => $row['nbTransactions'],
                        'dateRemittance' => $dateFormatee,
                        'montantTotal' => $row['montantTotal'],
                        'currency' => $row['currency'],
                        'currency' => $row['currency']
                    ];

                     
                    $data[] = $baseInfo;
                }
                
                $filters = ['amount', 'remittanceNumber', 'beforeDate', 'afterDate'];
                $valueFilters = $_POST;

                exportToCsv('export_clientListRemises.csv', $headers, $data, 'LISTE DES REMISES DU CLIENT ' . strtoupper($nom_client), $filters, $valueFilters);
                break;
            
            case 'poRemises':
                $headers = ['Numéro de SIREN', 'Raison sociale', 'Numéro de Remise','Date', 'Nombre de transactions','Montant Total', 'Devise'];
                $data = [];
                foreach ($rows as $row) {
                    $dateObjet = new DateTime($row['dateRemittance']);

                    $dateFormatee = $dateObjet->format('d/m/Y');
                    $baseInfo = [
                        'siren' => $row['siren'],
                        'companyName' => $row['companyName'],
                        'remittanceNumber' => $row['remittanceNumber'],
                        'dateRemittance' => $dateFormatee,
                        'nbTransactions' => $row['nbTransactions'],
                        'montantTotal' => $row['montantTotal'],
                        'currency' => $row['currency']
                    ];

                     
                    $data[] = $baseInfo;
                }
                
                $filters = ['siren', 'companyName', 'remittanceNumber', 'beforeDate', 'afterDate'];
                $valueFilters = $_POST;
                exportToCsv('export_clientListRemises.csv', $headers, $data, 'LISTE DES REMISES DE TOUS LES CLIENTS', $filters, $valueFilters);
                break;

            case 'clientUnpaids':
                $headers = ['Date', 'N° Carte bancaire', 'Réseau', 'Numéro de dossier impayé', 'Montant', 'Devise','Raison de l\'impayé'];
                
                foreach ($rows as $row) {
                    $dateObjet = new DateTime($row['dateTransac']);

                    $dateFormatee = $dateObjet->format('d/m/Y');
                    $baseInfo = [
                        'dateTransac' => $dateFormatee,
                        'creditCardNumber' => '************' . mb_substr($row['creditCardNumber'], 12),
                        'network' => $row['network'],
                        'unpaidFileNumber' => $row['unpaidFileNumber'],
                        'amount' => '-' . $row['amount'],
                        'currency' => $row['currency'],
                        'unpaidName' => $row['unpaidName']
                    ];

                        
                    $data[] = $baseInfo;
                }

                $filters = ['beforeDate', 'afterDate', 'label', 'idUnpaid'];
                $valueFilters = $_POST;
                exportToCsv('export_clientUnpaids.csv', $headers, $data, 'LISTE DES IMPAYÉS DU CLIENT ' . strtoupper($nom_client), $filters, $valueFilters);
                break;

            case 'poUnpaids':
                $headers = ['Siren', 'Raison sociale', 'Montant', 'Devise'];
                
                foreach ($rows as $row) {
                    $baseInfo = [
                        'siren' => $row['siren'],
                        'companyName' => $row['companyName'],
                        'totalUnpaids' => $row['totalUnpaids'],
                        'currency' => $row['currency']
                    ];

                        
                    $data[] = $baseInfo;
                }

                $filters = ['siren', 'companyName','beforeDate', 'numDossier', 'label','afterDate'];
                $valueFilters = $_POST;
                exportToCsv('export_poUnpaids.csv', $headers, $data, 'PO LISTE DES IMPAYÉS', $filters, $valueFilters);
                break;
            
            case 'poRemisesDetails':
                $headers = ['N° de Remise', 'Date', 'N° de carte bancaire', 'Réseau', 'N° d\'autorisation', 'Montant', 'Devise'];
                
                foreach ($rows as $row) {
                    $dateObjet = new DateTime($row['dateTransac']);

                    $dateFormatee = $dateObjet->format('d/m/Y');
                    $baseInfo = [
                        'remittanceNumber' => $row['remittanceNumber'],
                        'dateTransac' => $dateFormatee,
                        'creditCardNumber' => '************' . mb_substr($row['creditCardNumber'], 12),
                        'network' => $row['network'],
                        'numAutorisation' => $row['numAutorisation'],
                        'amount' => $row['sign'] . $row['amount'],
                        'currency' => $row['currency']
                    ];

                        
                    $data[] = $baseInfo;
                }

                exportToCsv('export_poRemisesDetails.csv', $headers, $data, 'DETAILS DE LA REMISE ' . $_POST['remittanceNumber'], NULL, NULL);
                break;
            
            case 'clientRemisesDetails':
                $headers = ['N° de Remise', 'Date', 'N° de carte bancaire', 'Réseau', 'N° d\'autorisation', 'Montant', 'Devise'];
                
                foreach ($rows as $row) {
                    $dateObjet = new DateTime($row['dateTransac']);

                    $dateFormatee = $dateObjet->format('d/m/Y');
                    $baseInfo = [
                        'remittanceNumber' => $row['remittanceNumber'],
                        'dateTransac' => $dateFormatee,
                        'creditCardNumber' => '************' . mb_substr($row['creditCardNumber'], 12),
                        'network' => $row['network'],
                        'numAutorisation' => $row['numAutorisation'],
                        'amount' => $row['sign'] . $row['amount'],
                        'currency' => $row['currency']
                    ];

                        
                    $data[] = $baseInfo;
                }

                exportToCsv('export_clientRemisesDetails.csv', $headers, $data, 'DETAILS DE LA REMISE ' . $_POST['remittanceNumber'], NULL, NULL);
                break;
        }
    }
}

if (isset($_POST['export_type'])) {
    $jsonData = $_POST["dataToExport"];
    $rows = json_decode($jsonData, true);
    $data = [];
    $context = $_POST['context'] ?? null;
    $exportType = $_POST['export_type'];
    if ($exportType == 'pdf') {
        switch ($context) {
            case 'poListAccount' :
                // les en-têtes et les données à exporter.
                $headers = ['SIREN', 'Raison Sociale', 'Nombre de transactions', 'Solde', 'Devise'];
                
                foreach ($rows as $row) {
                    $baseInfo = [
                        'siren' => $row['siren'],
                        'companyName' => $row['companyName'],
                        'nbTransactions' => $row['nbTransactions'],
                        'montant' => $row['montant'],
                        'currency' => $row['currency']
                    ];

                     
                    $data[] = $baseInfo;
                }
                
                $filters = ['siren', 'companyName'];
                $valueFilters = $_POST;
                // Appel à la fonction d'exportation
                exportToPdf('export_poListAccount.pdf', $headers, $data, 'LISTE DES COMPTES CLIENTS', $filters, $valueFilters);
                break;

            case 'clientListRemises':
                $headers = ['N° Remise', 'Date', 'Nombre de transactions', 'Montant Total', 'Devise'];

                foreach ($rows as $row) {
                    $dateObjet = new DateTime($row['dateRemittance']);

                    $dateFormatee = $dateObjet->format('d/m/Y');
                    $baseInfo = [
                        'remittanceNumber' => $row['remittanceNumber'],
                        'nbTransactions' => $row['nbTransactions'],
                        'dateRemittance' => $dateFormatee,
                        'montantTotal' => $row['montantTotal'],
                        'currency' => $row['currency'],
                        'currency' => $row['currency']
                    ];

                     
                    $data[] = $baseInfo;
                }
                
                $filters = ['amount', 'remittanceNumber', 'beforeDate', 'afterDate'];
                $valueFilters = $_POST;

                exportToPdf('export_clientListRemises.pdf', $headers, $data, 'LISTE DES REMISES DU CLIENT ' . strtoupper($nom_client), $filters, $valueFilters);
                break;
            
            case 'poRemises':
                $headers = ['Numéro de SIREN', 'Raison sociale', 'Numéro de Remise','Date', 'Nombre de transactions','Montant Total', 'Devise'];
                $data = [];
                foreach ($rows as $row) {
                    $dateObjet = new DateTime($row['dateRemittance']);

                    $dateFormatee = $dateObjet->format('d/m/Y');
                    $baseInfo = [
                        'siren' => $row['siren'],
                        'companyName' => $row['companyName'],
                        'remittanceNumber' => $row['remittanceNumber'],
                        'dateRemittance' => $dateFormatee,
                        'nbTransactions' => $row['nbTransactions'],
                        'montantTotal' => $row['montantTotal'],
                        'currency' => $row['currency']
                    ];

                     
                    $data[] = $baseInfo;
                }
                
                $filters = ['siren', 'companyName', 'remittanceNumber', 'beforeDate', 'afterDate'];
                $valueFilters = $_POST;
                exportToPdf('export_clientListRemises.pdf', $headers, $data, 'LISTE DES REMISES DE TOUS LES CLIENTS', $filters, $valueFilters);
                break;

            case 'clientUnpaids':
                $headers = ['Date', 'N° Carte bancaire', 'Réseau', 'Numéro de dossier impayé', 'Montant', 'Devise','Raison de l\'impayé'];
                
                foreach ($rows as $row) {
                    $dateObjet = new DateTime($row['dateTransac']);

                    $dateFormatee = $dateObjet->format('d/m/Y');
                    $baseInfo = [
                        'dateTransac' => $dateFormatee,
                        'creditCardNumber' => '************' . mb_substr($row['creditCardNumber'], 12),
                        'network' => $row['network'],
                        'unpaidFileNumber' => $row['unpaidFileNumber'],
                        'amount' => '-' . $row['amount'],
                        'currency' => $row['currency'],
                        'unpaidName' => $row['unpaidName']
                    ];

                        
                    $data[] = $baseInfo;
                }

                $filters = ['beforeDate', 'afterDate', 'label', 'idUnpaid'];
                $valueFilters = $_POST;
                exportToPdf('export_clientUnpaids.pdf', $headers, $data, 'LISTE DES IMPAYÉS DU CLIENT ' . strtoupper($nom_client), $filters, $valueFilters);
                break;

            case 'poUnpaids':
                $headers = ['Siren', 'Raison sociale', 'Montant', 'Devise'];
                
                foreach ($rows as $row) {
                    $baseInfo = [
                        'siren' => $row['siren'],
                        'companyName' => $row['companyName'],
                        'totalUnpaids' => $row['totalUnpaids'],
                        'currency' => $row['currency']
                    ];

                        
                    $data[] = $baseInfo;
                }
 
                $filters = ['siren', 'companyName', 'numDossier', 'label', 'beforeDate', 'afterDate'];
                $valueFilters = $_POST;
                exportToPdf('export_poUnpaids.pdf', $headers, $data, 'PO LISTE DES IMPAYÉS', $filters, $valueFilters);
                break;
            
            case 'poRemisesDetails':
                $headers = ['N° de Remise', 'Date', 'N° de carte bancaire', 'Réseau', 'N° d\'autorisation', 'Montant', 'Devise'];
                
                foreach ($rows as $row) {
                    $dateObjet = new DateTime($row['dateTransac']);

                    $dateFormatee = $dateObjet->format('d/m/Y');
                    $baseInfo = [
                        'remittanceNumber' => $row['remittanceNumber'],
                        'dateTransac' => $dateFormatee,
                        'creditCardNumber' => '************' . mb_substr($row['creditCardNumber'], 12),
                        'network' => $row['network'],
                        'numAutorisation' => $row['numAutorisation'],
                        'amount' => $row['sign'] . $row['amount'],
                        'currency' => $row['currency']
                    ];

                        
                    $data[] = $baseInfo;
                }

                exportToPdf('export_poRemisesDetails.pdf', $headers, $data, 'DETAILS DE LA REMISE ' . $_POST['remittanceNumber'], NULL, NULL);
                break;
            
            case 'clientRemisesDetails':
                $headers = ['N° de Remise', 'Date', 'N° de carte bancaire', 'Réseau', 'N° d\'autorisation', 'Montant', 'Devise'];
                
                foreach ($rows as $row) {
                    $dateObjet = new DateTime($row['dateTransac']);

                    $dateFormatee = $dateObjet->format('d/m/Y');
                    $baseInfo = [
                        'remittanceNumber' => $row['remittanceNumber'],
                        'dateTransac' => $dateFormatee,
                        'creditCardNumber' => '************' . mb_substr($row['creditCardNumber'], 12),
                        'network' => $row['network'],
                        'numAutorisation' => $row['numAutorisation'],
                        'amount' => $row['sign'] . $row['amount'],
                        'currency' => $row['currency']
                    ];

                        
                    $data[] = $baseInfo;
                }

                exportToPdf('export_clientRemisesDetails.pdf', $headers, $data, 'DETAILS DE LA REMISE ' . $_POST['remittanceNumber'], NULL, NULL);
                break;
        }
    }
}
?>