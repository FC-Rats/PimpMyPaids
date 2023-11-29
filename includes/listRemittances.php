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
                        c.companyName AS raisonSociale, 
                        r.remittanceNumber AS NRemise, 
                        r.dateRemittance AS date, 
                        COUNT(t.idTransaction) AS nbTransactions, 
                        SUM(CASE WHEN t.sign = '+' THEN t.amount ELSE -t.amount END) AS montantTotal,
                        c.currency,
                    FROM TRAN_CUSTOMER_ACCOUNTS c
                    LEFT JOIN TRAN_TRANSACTIONS t ON c.siren = t.siren
                    INNER JOIN TRAN_REMITTANCES r ON r.remittanceNumber = t.remittanceNumber";

            foreach ($conditions as $values) {
                $query1 .= "AND {$values[2]} = {$values[0]} ";
            }

            if (!empty($_POST['beforeDate'])) {
                $conditions[] = array(":beforeDate", $_POST['beforeDate']);
                $query1 .= "AND dateRemittance < :beforeDate";
            }
            
            if (!empty($_POST['afterDate'])) {
                $conditions[] = array(":afterDate", $_POST['afterDate']);
                $query1 .= "AND dateRemittance > :afterDate";
            }

            $remittances = $db->query($query1);

            $query2 = "SELECT 
                        r.remittanceNumber,
                        t.dateTransac,
                        t.network,
                        t.creditCardNumber,
                        t.amount,
                        t.sign,
                        t.currency
                    FROM TRAN_CUSTOMER_ACCOUNTS c
                    LEFT JOIN TRAN_TRANSACTIONS t ON c.siren = t.siren
                    INNER JOIN TRAN_REMITTANCES r ON r.remittanceNumber = t.remittanceNumber";

            foreach ($conditions as $values) {
                $query2 .= "AND {$values[2]} = {$values[0]} ";
            }

            if (!empty($_POST['beforeDate'])) {
                $query2 .= "AND dateRemittance < :beforeDate";
            }
            
            if (!empty($_POST['afterDate'])) {
                $query2 .= "AND dateRemittance > :afterDate";
            }

            $remittancesDetails = $db->query($query2);

        case 'Merchant':
            $sql = "SELECT 
                        r.dateRemittance AS date, 
                        t.creditCardNumber AS NCarte, 
                        t.numAutorisation AS NAuthor, 
                        t.amount AS montant,
                        c.currency
                    FROM REMITTANCES r
                    LEFT JOIN TRANSACTIONS t ON r.remittanceNumber = t.remittanceNumber
                    LEFT JOIN CUSTOMER_ACCOUNTS c ON r.siren = c.siren
                    WHERE c.siren = :siren
                    GROUP BY r.remittanceNumber
                    ORDER BY r.dateRemittance DESC";
            $conditions = array(array(":siren", $_SESSION["siren"]));
            return $db->query($sql, $conditions);
    }
?>