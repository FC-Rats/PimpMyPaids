<?php
session_start();
$response = [];
if (!class_exists('Connection')) {
    include('connectionFunctions.php');
}

switch ($_SESSION["profil"]) {
        case 'PO':
    
            $conditions = array();
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
                            ca.siren,
                            ca.companyName,
                            ca.currency,
                            SUM(CASE WHEN t.sign = '+' THEN t.amount ELSE -t.amount END) AS totalUnpaids
                        FROM
                            TRAN_CUSTOMER_ACCOUNT ca
                        JOIN
                            TRAN_TRANSACTIONS t ON ca.siren = t.siren
                        JOIN
                            TRAN_UNPAIDS u ON t.idTransac = u.idTransac
                        GROUP BY
                            ca.siren;";
    
            // Ajout des conditions à la query
            foreach ($conditions as $values) {
                if (strpos($query, "WHERE") == false) {
                    $query .= " WHERE {$values[2]} = '{$values[0]}' ";
                } else {
                    $query .= " AND {$values[2]} = '{$values[0]}' ";
                }
            }

            if (!empty($_POST['beforeDate'])) {
                $conditions[] = array(":beforeDate", $_POST['beforeDate']);
                if (strpos($query, "WHERE") == false) {
                    $query .= " WHERE dateTransac < :beforeDate";
                } else {
                    $query .= " AND dateTransac < :beforeDate";
                }
            }
    
            if (!empty($_POST['afterDate'])) {
                $conditions[] = array(":afterDate", $_POST['afterDate']);
                if (strpos($query, "WHERE") == false) {
                    $query .= " WHERE dateTransac > :afterDate";
                } else {
                    $query .= " AND dateTransac > :afterDate";
                }
            }

            $unpaidPO = $db->query($query, $conditions);

            foreach ($unpaidPO as &$row) {
                $siren = $row['siren'];

                $query2 = "SELECT t.dateTransac, t.creditCardNumber, u.unpaidFileNumber, t.sign, t.amount, c.currency, un.unpaidName, t.network
                                FROM TRAN_TRANSACTIONS t
                                JOIN TRAN_CUSTOMER_ACCOUNT c ON t.siren = c.siren
                                JOIN TRAN_UNPAIDS u ON t.idTransac = u.idTransac
                                JOIN TRAN_UNPAID_REASONS un ON u.idUnpaidReason = un.idUnpaidReason
                                WHERE t.siren = :siren";

                $details = $db->query($query2, array(array(":siren", $siren)));
                $row['details'] = $details;
            }

            $response["ListUnpaids"] = $unpaidPO;
            echo json_encode($response);
            break;

        case 'Merchant':
            // Liste de ses impayés avec date vente | date remise | N° carte | N° dossier | montant (devise) |  libellé impayé
    
            $conditions = array();
    
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
                $orderBy = " ORDER BY dateTransac {$sortOption}";
            }
    
            // Construction de la query
            $query = "SELECT t.dateTransac, t.creditCardNumber, u.unpaidFileNumber, t.sign, t.amount, un.unpaidName
                      FROM TRAN_TRANSACTIONS t
                      JOIN TRAN_UNPAIDS u ON t.idTransac = u.idTransac
                      JOIN TRAN_UNPAID_REASONS un ON u.idUnpaidReason = un.idUnpaidReason
                      WHERE t.siren = :siren ";
    
            // Ajout des conditions à la query
            foreach ($conditions as $values) {
                $query .= " AND {$values[2]} = {$values[0]}";
            }

            if (!empty($_POST['beforeDate'])) {
                $conditions[] = array(":beforeDate", $_POST['beforeDate']);
                $query .= " AND dateTransac < :beforeDate";
            }
    
            if (!empty($_POST['afterDate'])) {
                $conditions[] = array(":afterDate", $_POST['afterDate']);
                $query .= " AND dateTransac > :afterDate";
            }
    
            // Add ORDER BY clause
            $query .= $orderBy;

            $conditions[] = array(":siren", $_SESSION["siren"]);
    
            $unpaidClient = $db->query($query, $conditions);
            $response["ListUnpaidsClient"] = $unpaidClient;
            echo json_encode($response);
            break;
}
?>