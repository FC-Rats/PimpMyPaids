<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'export.php';

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
                    $baseInfo = [
                        'remittanceNumber' => $row['remittanceNumber'],
                        'nbTransactions' => $row['nbTransactions'],
                        'dateRemittance' => $row['dateRemittance'],
                        'montantTotal' => $row['montantTotal'],
                        'currency' => $row['currency'],
                        'currency' => $row['currency']
                    ];

                     
                    $data[] = $baseInfo;
                }
                
                $filters = ['amount', 'remittanceNumber', 'beforeDate', 'afterDate'];
                $valueFilters = $_POST;

                exportToXlsx('export_clientListRemises.xlsx', $headers, $data, 'LISTE DES REMISES CLIENT', $filters, $valueFilters);
                break;

            case 'poRemises':
                $headers = ['N° SIREN', 'Raison sociale', 'N° Remise','Date', 'Nombre de transactions','Montant Total', 'Devise'];
                
                foreach ($rows as $row) {
                    $baseInfo = [
                        'siren' => $row['siren'],
                        'companyName' => $row['companyName'],
                        'remittanceNumber' => $row['remittanceNumber'],
                        'dateRemittance' => $row['dateRemittance'],
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
                    $baseInfo = [
                        'dateTransac' => $row['dateTransac'],
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
                exportToXlsx('export_clientUnpaids.xlsx', $headers, $data, 'LISTE DES IMPAYÉS', $filters, $valueFilters);
                break;
            
            case 'poUnpaids':
                $headers = ['Siren', 'Raison sociale', 'Montant', 'Devise'];
                
                foreach ($rows as $row) {
                    $baseInfo = [
                        'siren' => $row['siren'],
                        'companyName' => 'companyName',
                        'totalUnpaids' => $row['totalUnpaids'],
                        'currency' => $row['currency']
                    ];

                        
                    $data[] = $baseInfo;
                }

                $filters = ['siren', 'companyName','beforeDate', 'afterDate'];
                $valueFilters = $_POST;
                exportToXlsx('export_poUnpaids.xlsx', $headers, $data, 'PO LISTE DES IMPAYÉS', $filters, $valueFilters);
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
                exportToCsv('export_poListAccount.xlsx', $headers, $data, 'LISTE DES COMPTES CLIENTS', $filters, $valueFilters);
                break;

            case 'clientListRemises':
                $headers = ['N° Remise', 'Date', 'Nombre de transactions', 'Montant Total', 'Devise'];

                foreach ($rows as $row) {
                    $baseInfo = [
                        'remittanceNumber' => $row['remittanceNumber'],
                        'nbTransactions' => $row['nbTransactions'],
                        'dateRemittance' => $row['dateRemittance'],
                        'montantTotal' => $row['montantTotal'],
                        'currency' => $row['currency'],
                        'currency' => $row['currency']
                    ];

                     
                    $data[] = $baseInfo;
                }
                
                $filters = ['amount', 'remittanceNumber', 'beforeDate', 'afterDate'];
                $valueFilters = $_POST;

                exportToCsv('export_clientListRemises.xlsx', $headers, $data, 'LISTE DES REMISES CLIENT', $filters, $valueFilters);
                break;
            
            case 'poRemises':
                $headers = ['Numéro de SIREN', 'Raison sociale', 'Numéro de Remise','Date', 'Nombre de transactions','Montant Total', 'Devise'];
                $data = [];
                foreach ($rows as $row) {
                    $baseInfo = [
                        'siren' => $row['siren'],
                        'companyName' => $row['companyName'],
                        'remittanceNumber' => $row['remittanceNumber'],
                        'dateRemittance' => $row['dateRemittance'],
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
                    $baseInfo = [
                        'dateTransac' => $row['dateTransac'],
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
                exportToCsv('export_clientUnpaids.csv', $headers, $data, 'LISTE DES IMPAYÉS', $filters, $valueFilters);
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

                $filters = ['siren', 'companyName','beforeDate', 'afterDate'];
                $valueFilters = $_POST;
                exportToCsv('export_poUnpaids.csv', $headers, $data, 'PO LISTE DES IMPAYÉS', $filters, $valueFilters);
                break;
        }
    }
}


?>