<?php
switch ($_SESSION["profil"]) {
        case 'PO':
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
                        c.siren, 
                        c.companyName,
                        r.remittanceNumber,
                        r.dateRemittance, 
                        COUNT(t.idTransac) AS nbTransactions, 
                        SUM(CASE WHEN t.sign = '+' THEN t.amount ELSE -t.amount END) AS montantTotal,
                        c.currency,
                    FROM TRAN_CUSTOMER_ACCOUNT c
                    LEFT JOIN TRAN_TRANSACTIONS t ON c.siren = t.siren
                    INNER JOIN TRAN_REMITTANCES r ON r.remittanceNumber = t.remittanceNumber";

            foreach ($conditions as $values) {
                if (strpos($query1, "WHERE") == false) {
                    $query1 .= "WHERE {$values[2]} = '{$values[0]}' ";
                } else {
                    $query1 .= "AND {$values[2]} = '{$values[0]}' ";
                }
            }
            if (!empty($_POST['beforeDate'])) {
                $conditions[] = array(":beforeDate", $_POST['beforeDate']);
                if (strpos($query1, "WHERE") == false) {
                    $query1 .= "WHERE dateTransac < :beforeDate";
                } else {
                    $query1 .= "AND dateTransac < :beforeDate";
                }
            }
    
            if (!empty($_POST['afterDate'])) {
                $conditions[] = array(":afterDate", $_POST['afterDate']);
                if (strpos($query1, "WHERE") == false) {
                    $query1 .= "WHERE dateTransac > :afterDate";
                } else {
                    $query1 .= "AND dateTransac > :afterDate";
                }
            }

            $remittancesPO = $db->query($query1, $conditions);

            $query2 = "SELECT 
                        r.remittanceNumber,
                        t.dateTransac,
                        t.network,
                        t.creditCardNumber,
                        t.amount,
                        t.sign,
                        t.currency
                    FROM TRAN_CUSTOMER_ACCOUNT c
                    LEFT JOIN TRAN_TRANSACTIONS t ON c.siren = t.siren
                    INNER JOIN TRAN_REMITTANCES r ON r.remittanceNumber = t.remittanceNumber";

            foreach ($conditions as $values) {
                if (strpos($query, "WHERE") == false) {
                    $query2 .= "WHERE {$values[2]} = '{$values[0]}' ";
                } else {
                    $query2 .= "AND {$values[2]} = '{$values[0]}' ";
                }
            }

            $remittancesDetailsPO = $db->query($query2, $conditions);

            $orderRemittancesDetailsPO= array();

            foreach ($remittancesDetailsPO as $row) {
                print_r($row);
                $remittanceNumber = $row['remittanceNumber'];
                
                if (!isset($orderRemittancesDetailsPO[$remittanceNumber])) {
                    $orderRemittancesDetailsPO[$remittanceNumber] = array();
                }
                
                $orderRemittancesDetailsPO[$remittanceNumber][] = $row;
            }

        case 'Merchant':

            $conditions = array(":siren", $_SESSION["siren"]);

            if (!empty($_POST['creditCardNumber'])) {
                $conditions[] = array(":creditCardNumber", $_POST['creditCardNumber'], "t.creditCardNumber");
            }
    
            if (!empty($_POST['amount'])) {
                $conditions[] = array(":amount", $_POST['amount'], "t.amount");
            }
    
            if (!empty($_POST['remittanceNumber'])) {
                $conditions[] = array(":remittanceNumber", $_POST['remittanceNumber'], "r.remittanceNumber");
            }

            $query1 = "SELECT 
                        COUNT(t.idTransac) AS nbTransactions,
                        r.dateRemittance,
                        t.creditCardNumber, 
                        t.numAutorisation, 
                        SUM(CASE WHEN t.sign = '+' THEN t.amount ELSE -t.amount END) AS montantTotal,
                        c.currency
                    FROM TRAN_REMITTANCES r
                    LEFT JOIN TRAN_TRANSACTIONS t ON r.remittanceNumber = t.remittanceNumber
                    LEFT JOIN TRAN_CUSTOMER_ACCOUNTS c ON r.siren = c.siren
                    WHERE c.siren = :siren";
            
            foreach ($conditions as $values) {
                $query1 .= "AND {$values[2]} = '{$values[0]}' ";
            }

            if (!empty($_POST['beforeDate'])) {
                $conditions[] = array(":beforeDate", $_POST['beforeDate']);
                $query1 .= "AND dateTransac < :beforeDate";
            }
    
            if (!empty($_POST['afterDate'])) {
                $conditions[] = array(":afterDate", $_POST['afterDate']);
                $query1 .= "AND dateTransac > :afterDate";
            }

            $query1 .= "GROUP BY r.remittanceNumber";

            $remittancesMerchant = $db->query($query1, $conditions);

            $query2 = "SELECT 
                        r.dateTransac,
                        t.creditCardNumber, 
                        t.network
                        t.numAutorisation, 
                        t.sign,
                        t.amount,
                        c.currency
                    FROM TRAN_REMITTANCES r
                    LEFT JOIN TRAN_TRANSACTIONS t ON r.remittanceNumber = t.remittanceNumber
                    LEFT JOIN TRAN_CUSTOMER_ACCOUNTS c ON r.siren = c.siren
                    WHERE c.siren = :siren";

            foreach ($conditions as $values) {
                $query2 .= "AND {$values[2]} = '{$values[0]}' ";
            }

            if (!empty($_POST['beforeDate'])) {
                $conditions[] = array(":beforeDate", $_POST['beforeDate']);
                $query2 .= "AND dateTransac < :beforeDate";
            }

            if (!empty($_POST['afterDate'])) {
                $conditions[] = array(":afterDate", $_POST['afterDate']);
                $query2 .= "AND dateTransac > :afterDate";
            }

            $remittancesDetailsMerchant = $db->query($query2, $conditions);

            $orderRemittancesDetailsMerchant= array();

            foreach ($remittancesDetailsMerchant as $row) {
                print_r($row);
                $remittanceNumber = $row['remittanceNumber'];
                
                if (!isset($orderRemittancesDetailsMerchant[$remittanceNumber])) {
                    $orderRemittancesDetailsMerchant[$remittanceNumber] = array();
                }
                
                $orderRemittancesDetailsMerchant[$remittanceNumber][] = $row;
            }
    }
?>