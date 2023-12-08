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
    $response["GraphBalance"] = $graphBalanceMerchant;
    echo json_encode($response);
?>