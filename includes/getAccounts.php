<?php
$response = [];
if (!class_exists('Connection')) {
    include('connectionFunctions.php');
    $_SESSION['db'] = $db;
}
$db = $_SESSION['db'];

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
                        SUM(CASE WHEN t.sign = '+' THEN t.amount ELSE -t.amount END) AS montant
                    FROM TRAN_CUSTOMER_ACCOUNT c
                    LEFT JOIN TRAN_TRANSACTIONS t ON c.siren = t.siren";

            foreach ($conditions as $values) {
                $query .= "AND {$values[2]} = {$values[0]} ";
            }
            
            if (!empty($_POST['date'])) {
                $conditions[] = array(":date", $_POST['date']);
                $query .= "AND dateTransac < :date";
            }

            $orderBy = "";
            if (!empty($_POST['sortAccount'])) {
                $sortOption = ($_POST['sortAccount'] === 'siren') ? 'siren' : 'montant';
                $orderBy = "ORDER BY {$sortOption} ASC";
            }

            $query .= "GROUP BY c.siren";
            $query .= $orderBy;

            $accountInfo = $db->query($query, $conditions);
            $response["ListAccounts"] = $accountInfo;
            echo json_encode($response);

        case 'Admin':
            $sql = "SELECT u.email, u.login, c.currency
                        FROM TRAN_USERS u
                        INNER JOIN TRAN_CUSTOMER_ACCOUNT c ON u.idUser = c.idUser";
            $accountAdmin = $db->query($sql);
    }
?>