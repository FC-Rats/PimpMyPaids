<?php
    switch ($_SESSION["profil"]) {
        case 'PO':
            $query = "SELECT
                            UR.unpaidName AS motif_impaye,
                            COUNT(UA.unpaidFileNumber) AS nombre_impayes
                        FROM
                            TRAN_UNPAIDS UA
                        JOIN
                            TRAN_UNPAID_REASONS UR ON UA.idUnpaidReason = UR.idUnpaidReason
                        GROUP BY
                            UR.unpaidName";

            $graphUnpaidPO = $db->query($query);

        case 'Merchant':
            $query =  "SELECT
                            UR.unpaidName AS motif_impaye,
                            COUNT(UA.unpaidFileNumber) AS nombre_impayes
                        FROM
                            TRAN_UNPAIDS UA
                        JOIN
                            TRAN_UNPAID_REASONS UR ON UA.idUnpaidReason = UR.idUnpaidReason
                        JOIN
                            TRAN_TRANSACTIONS T ON UA.idTransac = T.idTransac
                        WHERE
                            T.siren = :siren
                        GROUP BY
                            UR.unpaidName";
            
            $graphUnpaidMerchant = $db->query($query, array(array(":siren", $_SESSION["siren"])));
    }
?>