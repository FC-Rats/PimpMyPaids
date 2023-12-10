<?php
    session_start();
    $response = [];
    if (!class_exists('Connection')) {
        include('connectionFunctions.php');
    }

    $query = "SELECT
                    DATE_FORMAT(dateTransac, '%m') AS mois,
                    AVG(CASE WHEN T.sign = '+' THEN T.amount ELSE -T.amount END) AS moyenneTransactions
                FROM
                    TRAN_TRANSACTIONS T
                WHERE
                    siren = :siren
                AND
                    dateTransac >= CURDATE() - INTERVAL 12 MONTH
                GROUP BY
                    mois
                ORDER BY
                    mois";

    $graphBalanceMerchant = $db->query($query, array(array(":siren", $_SESSION["siren"])));
    
    $graphBalance = [];
    $first = (int)$graphBalanceMerchant[0]['mois'];
    for ($i = $first; $i <= $first + 11; $i++) {
        $month = str_pad(($i - 1) % 12 + 1, 2, '0', STR_PAD_LEFT);
        $graphBalance[$month] = 0;
    }
    
    foreach ($graphBalanceMerchant as $result) {
        $graphBalance[$result['mois']] = $result['moyenneTransactions'];
    }
    
    $previousValue = 0;
    foreach ($graphBalance as &$value) {
        if ($value === 0) {
            $value = $previousValue;
        }
        $previousValue = $value;
    }

    $response["GraphBalance"] = $graphBalance;
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
?>