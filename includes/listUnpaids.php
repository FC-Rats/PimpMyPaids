<?php
$response = [];
if (!class_exists('Connection')) {
    include('connectionFunctions.php');
    $_SESSION['db'] = $db;
}
$db = $_SESSION['db'];

switch ($_SESSION["profil"]) {
        case 'PO':
    
            // Conditions supplémentaires    
            if (!empty($_POST['siren'])) {
                $conditions[] = array(":siren", $_POST['siren'], "T.siren");
            }

            if (!empty($_POST['companyName'])) {
                $conditions[] = array(":companyName", $_POST['companyName'], "CA.companyName");
            }

            if (!empty($_POST['label'])) {
                $conditions[] = array(":label", $_POST['label'], "UR.unpaidName");
            }
    
            if (!empty($_POST['numDossier'])) {
                $conditions[] = array(":numDossier", $_POST['numDossier'], "UA.unpaidFileNumber");
            }
    
            // Construction de la query
            $query = "SELECT
                        CA.siren,
                        CA.companyName,
                        COUNT(UA.unpaidFileNumber) AS nombre_impayes,
                        SUM(CASE WHEN T.sign = '+' THEN T.amount ELSE -T.amount END) AS somme_impayes
                    FROM
                        TRAN_UNPAIDS UA
                    JOIN
                        TRAN_UNPAID_REASONS UR ON UA.idUnpaidReason = UR.idUnpaidReason
                    JOIN
                        TRAN_TRANSACTIONS T ON UA.idTransac = T.idTransac
                    JOIN
                        TRAN_CUSTOMER_ACCOUNT CA ON T.siren = CA.siren";
    
            // Ajout des conditions à la query
            foreach ($conditions as $values) {
                if (strpos($query, "WHERE") == false) {
                    $query .= "WHERE {$values[2]} = '{$values[0]}' ";
                } else {
                    $query .= "AND {$values[2]} = '{$values[0]}' ";
                }
            }

            if (!empty($_POST['beforeDate'])) {
                $conditions[] = array(":beforeDate", $_POST['beforeDate']);
                if (strpos($query, "WHERE") == false) {
                    $query .= "WHERE dateTransac < :beforeDate";
                } else {
                    $query .= "AND dateTransac < :beforeDate";
                }
            }
    
            if (!empty($_POST['afterDate'])) {
                $conditions[] = array(":afterDate", $_POST['afterDate']);
                if (strpos($query, "WHERE") == false) {
                    $query .= "WHERE dateTransac > :afterDate";
                } else {
                    $query .= "AND dateTransac > :afterDate";
                }
            }
    
            $unpaidPO = $db->query($query, $conditions);

            $query2 = "SELECT t.siren, t.dateTransac, r.dateRemittance, t.creditCardNumber, u.unpaidFileNumber, t.sign, t.amount, t.currency, un.unpaidName, t.network
            FROM TRAN_TRANSACTIONS t
            JOIN TRAN_REMITTANCES r ON t.remittanceNumber = r.remittanceNumber
            JOIN TRAN_UNPAIDS u ON t.idTransac = u.idTransac
            JOIN TRAN_UNPAID_REASONS un ON u.idUnpaidReason = un.idUnpaidReason";

            // Ajout des conditions à la query
            foreach ($conditions as $values) {
                if (strpos($query2, "WHERE") == false) {
                    $query2 .= "WHERE {$values[2]} = '{$values[0]}' ";
                } else {
                    $query2 .= "AND {$values[2]} = '{$values[0]}' ";
                }
            }

            $unpaidDetailPO = $db->query($query2, $conditions);

            $orderUnpaidDetailPO = array();

            foreach ($unpaidDetailPO as $row) {
                print_r($row);
                $siren = $row['siren'];
                
                if (!isset($orderUnpaidDetailPO[$siren])) {
                    $orderUnpaidDetailPO[$siren] = array();
                }
                
                $orderUnpaidDetailPO[$siren][] = $row;
            }

            $response["ListUnpaids"] = $unpaidPO;
            $response["ListUnpaidsDetails"] = $orderUnpaidDetailPO;
            echo json_encode($response);

        case 'Merchant':
            // Liste de ses impayés avec date vente | date remise | N° carte | N° dossier | montant (devise) |  libellé impayé
    
            $conditions = array(":siren", $_SESSION["siren"]);
    
            // Conditions supplémentaires    
            if (!empty($_POST['label'])) {
                $conditions[] = array(":label", $_POST['label'], "un.unpaidName");
            }
    
            if (!empty($_POST['numDossier'])) {
                $conditions[] = array(":numDossier", $_POST['numDossier'], "u.unpaidFileNumber");
            }
    
            // Construction du order by
            $orderBy = "";
            if (!empty($_POST['formSortClientUnpaids'])) {
                $sortOption = ($_POST['formSortClientUnpaids'] === 'az') ? 'ASC' : 'DESC';
                $orderBy = "ORDER BY dateTransac {$sortOption}";
            }
    
            // Construction de la query
            $query = "SELECT t.dateTransac, r.dateRemittance, t.creditCardNumber, u.unpaidFileNumber, t.sign, t.amount, un.unpaidName
                      FROM TRAN_TRANSACTIONS t
                      JOIN TRAN_REMITTANCES r ON t.remittanceNumber = r.remittanceNumber
                      JOIN TRAN_UNPAIDS u ON t.idTransac = u.idTransac
                      JOIN TRAN_UNPAID_REASONS un ON u.idUnpaidReason = un.idUnpaidReason
                      WHERE t.siren = :siren ";
    
            // Ajout des conditions à la query
            foreach ($conditions as $values) {
                $query .= "AND {$values[2]} = '{$values[0]}' ";
            }

            if (!empty($_POST['beforeDate'])) {
                $conditions[] = array(":beforeDate", $_POST['beforeDate']);
                $query .= "AND dateTransac < :beforeDate";
            }
    
            if (!empty($_POST['afterDate'])) {
                $conditions[] = array(":afterDate", $_POST['afterDate']);
                $query .= "AND dateTransac > :afterDate";
            }
    
            // Add ORDER BY clause
            $query .= $orderBy;
    
            $unpaidClient = $db->query($query, $conditions);
            $response["ListUnpaidsClient"] = $unpaidClient;
            echo json_encode($response);
        }
?>