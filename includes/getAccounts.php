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

            $query = "SELECT 
                        c.siren,
                        c.companyName,
                        COUNT(t.idTransac) AS nbTransactions,
                        SUM(CASE WHEN t.sign = '+' THEN t.amount ELSE -t.amount END) AS montant,
                        c.currency
                    FROM TRAN_CUSTOMER_ACCOUNT c
                    LEFT JOIN TRAN_TRANSACTIONS t ON c.siren = t.siren";

            foreach ($conditions as $values) {
                $query .= (strpos($query, "WHERE") === false) ? " WHERE {$values[2]} = {$values[0]}" : " AND {$values[2]} = {$values[0]}";
            }
            
            if (!empty($_POST['date'])) {
                $conditions[] = array(":date", $_POST['date']);
                $query .= " AND dateTransac < :date";
            }

            $query .= " GROUP BY c.siren";            
            
            if (!empty($_POST['sortAccount'])) {
                $sortOption = ($_POST['sortAccount'] === 'siren') ? 'siren' : 'montant';
                $query .= " ORDER BY {$sortOption} ASC";
            }

            $accountInfo = $db->query($query, $conditions);
            
            $response["ListAccounts"] = $accountInfo;
            echo json_encode($response);
            break;

        case 'Admin':
            $sql = "SELECT c.siren, c.companyName, u.email, u.login, c.currency
                        FROM TRAN_USERS u
                        INNER JOIN TRAN_CUSTOMER_ACCOUNT c ON u.idUser = c.idUser";
            $accountAdmin = $db->query($sql);

            $response["ListAccounts"] = $accountAdmin;
            echo json_encode($response);
            break;
    }
?>