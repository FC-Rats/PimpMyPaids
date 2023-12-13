<?php
session_start();
$response = [];
if (!class_exists('Connection')) {
    include('connectionFunctions.php');
}

switch ($_SESSION["profil"]) {
        case 'PO':

            $conditions = array();
            if (!empty($_POST['siren'])) {
                $conditions[] = array(":siren", $_POST['siren'], "c.siren");
            }
    
            if (!empty($_POST['companyName'])) {
                $conditions[] = array(":companyName", $_POST['companyName'], "c.companyName");
            }
    
            if (!empty($_POST['remittanceNumber'])) {
                $conditions[] = array(":remittanceNumber", $_POST['remittanceNumber'], "r.remittanceNumber");
            }

            $query1 = "SELECT 
                        MAX(t.siren) AS siren,
                        GROUP_CONCAT(DISTINCT c.companyName) AS companyName,
                        r.remittanceNumber,
                        r.dateRemittance, 
                        COUNT(t.idTransac) AS nbTransactions, 
                        SUM(CASE WHEN t.sign = '+' THEN t.amount ELSE -t.amount END) AS montantTotal,
                        GROUP_CONCAT(DISTINCT c.currency) AS currency
                    FROM TRAN_CUSTOMER_ACCOUNT c
                    LEFT JOIN TRAN_TRANSACTIONS t ON c.siren = t.siren
                    INNER JOIN TRAN_REMITTANCES r ON r.remittanceNumber = t.remittanceNumber";

            foreach ($conditions as $values) {
                $query1 .= strpos($query1, "WHERE") === false ? " WHERE {$values[2]} = {$values[0]}" : " AND {$values[2]} = {$values[0]}";
            }
            if (!empty($_POST['beforeDate'])) {
                $conditions[] = [":beforeDate", $beforeDate];
                $query1 .= strpos($query1, "WHERE") === false ? " WHERE dateTransac < :beforeDate" : " AND dateTransac < :beforeDate";
            }
    
            if (!empty($_POST['afterDate'])) {
                $conditions[] = [":afterDate", $afterDate];
                $query1 .= strpos($query1, "WHERE") === false ? " WHERE dateTransac > :afterDate" : " AND dateTransac > :afterDate";
            }

            $query1 .= " GROUP BY r.remittanceNumber;";

            $remittancesPO = $db->query($query1, $conditions);

            foreach ($remittancesPO as &$row) {
                $remittanceNumber = $row['remittanceNumber'];

                $query2 = "SELECT t.remittanceNumber, 
                                t.dateTransac, 
                                t.creditCardNumber, 
                                t.network, 
                                t.numAutorisation, 
                                t.sign, 
                                t.amount, 
                                c.currency 
                            FROM TRAN_TRANSACTIONS t 
                            LEFT JOIN TRAN_CUSTOMER_ACCOUNT c 
                            ON t.siren = c.siren 
                            WHERE t.remittanceNumber = :remittanceNumber";

                $details = $db->query($query2, array(array(":remittanceNumber", $remittanceNumber)));
                $row['details'] = $details;
            }

            $response["ListRemittances"] = $remittancesPO;
            echo json_encode($response);
            break;

        case 'Merchant':

            $conditions = array();
    
            if (!empty($_POST['remittanceNumber'])) {
                $conditions[] = array(":remittanceNumber",  $_POST['remittanceNumber'], "t.remittanceNumber");
            }

            $query1 = "SELECT 
                        r.remittanceNumber,
                        COUNT(t.idTransac) AS nbTransactions,
                        r.dateRemittance,
                        SUM(CASE WHEN t.sign = '+' THEN t.amount ELSE -t.amount END) AS montantTotal,
                        c.currency
                    FROM TRAN_REMITTANCES r
                    LEFT JOIN TRAN_TRANSACTIONS t ON r.remittanceNumber = t.remittanceNumber
                    LEFT JOIN TRAN_CUSTOMER_ACCOUNT c ON t.siren = c.siren
                    WHERE c.siren = :siren";
            
            foreach ($conditions as $values) {
                $query1 .= " AND {$values[2]} = {$values[0]}";
            }

            if (!empty($_POST['beforeDate'])) {
                $conditions[] = array(":beforeDate", $_POST['beforeDate']);
                $query1 .= " AND dateTransac < :beforeDate";
            }
    
            if (!empty($_POST['afterDate'])) {
                $conditions[] = array(":afterDate", $_POST['afterDate']);
                $query1 .= " AND dateTransac > :afterDate";
            }

            $query1 .= " GROUP BY r.remittanceNumber";

            if (!empty($_POST['amount'])) {
                $conditions[] = array(":amount", $_POST['amount']);
                $query1 .= " HAVING montantTotal = :amount";
            }

            $conditions[] = array(":siren", $_SESSION["siren"]);

            $remittancesMerchant = $db->query($query1, $conditions);
            
            foreach ($remittancesMerchant as &$row) {
                $remittanceNumber = $row['remittanceNumber'];

                $query2 = "SELECT t.remittanceNumber, 
                                t.dateTransac, 
                                t.creditCardNumber, 
                                t.network, 
                                t.numAutorisation, 
                                t.sign, 
                                t.amount, 
                                c.currency 
                            FROM TRAN_TRANSACTIONS t 
                            LEFT JOIN TRAN_CUSTOMER_ACCOUNT c 
                            ON t.siren = c.siren 
                            WHERE t.remittanceNumber = :remittanceNumber";

                $details = $db->query($query2, array(array(":remittanceNumber", $remittanceNumber)));
                $row['details'] = $details;
            }

            $response["ListRemittancesClient"] = $remittancesMerchant;
            echo json_encode($response);
            break;
    }
?>