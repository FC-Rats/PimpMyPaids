<?php
/*
- - - FONCTIONS UTILES A LA CONNEXION AU SITE - - -
*/
session_start();

function getEspaceData() {
    switch ($_SESSION["profil"]) {
        case 'PO':
            $lastTr = "SELECT * FROM TRANSACTIONS ORDER BY dateTransac DESC LIMIT 3";
            return $db->query($lastTr);
        case 'Admin':
            $lastRequest = "SELECT * FROM REQUEST_PO ORDER BY idRequest DESC";
            return $db->query($lastRequest, $conditions);
        case 'Merchant':
            $allDataClient = "SELECT 
            (SELECT SUM(amount) FROM TRANSACTIONS) AS totalAmount,
            (SELECT SUM(amount) FROM TRANSACTIONS WHERE sign = '+' AND siren = :siren) AS sumRemises,
            (SELECT SUM(amount) FROM TRANSACTIONS WHERE sign = '-' AND siren = :siren) AS sumImpayes,
            (totalAmount - sumRemises + sumImpayes) AS tresorerie";
            $conditions = array(array(":siren", $_SESSION["siren"]));
            return $db->query($allDataClient, $conditions);
    }
}

function getCompte() {
    switch ($_SESSION["profil"]) {
        case 'PO':
            $sql = "SELECT 
                        c.siren, 
                        COUNT(t.idTransaction) AS nbTransactions, 
                        SUM(t.amount) AS montantTotal
                    FROM CUSTOMER_ACCOUNTS c
                    LEFT JOIN TRANSACTIONS t ON c.siren = t.siren
                    GROUP BY c.siren
                    ORDER BY c.siren";
            return $db->query($sql);
        case 'Admin':
            $sql = "SELECT u.email, u.login, c.currency
                        FROM USERS u
                        INNER JOIN CUSTOMER_ACCOUNTS c ON u.idUser = c.idUser";
            return $db->query($sql);
    }
}

function getRemises() {
    switch ($_SESSION["profil"]) {
        case 'PO':
            $sql = "SELECT 
                        c.siren, 
                        c.companyName AS raisonSociale, 
                        r.remittanceNumber AS NRemise, 
                        r.dateRemittance AS date, 
                        COUNT(t.idTransaction) AS nbTransactions, 
                        SUM(t.amount) AS montantTotal,
                        c.currency
                    FROM CUSTOMER_ACCOUNTS c
                    INNER JOIN REMITTANCES r ON c.siren = r.siren
                    LEFT JOIN TRANSACTIONS t ON r.remittanceNumber = t.remittanceNumber
                    GROUP BY c.siren, r.remittanceNumber
                    ORDER BY c.siren, r.dateRemittance DESC";
            return $db->query($sql);
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
}

function getImpayes() {
    switch ($_SESSION["profil"]) {
        case 'PO':
            //Liste des remises clients avec N°Siren | raison sociale | somme 
            return;
        case 'Merchant':
            // Liste de ses impayés avec date vente | date remise | N° carte | N° dossier | montant (devise) |  libellé impayé
    
            $conditions = array(":siren", $_SESSION["siren"]);
    
            // Conditions supplémentaires
            if (!empty($_POST['beforeDate'])) {
                $conditions[] = array(":beforeDate", $_POST['beforeDate'], "t.dateTransac");
            }
    
            if (!empty($_POST['afterDate'])) {
                $conditions[] = array(":afterDate", $_POST['afterDate'], "t.dateTransac");
            }
    
            if (!empty($_POST['motif'])) {
                $conditions[] = array(":motif", $_POST['motif'], "un.unpaidName");
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
            $query = "SELECT dateTransac, dateRemittance, creditCardNumber, unpaidFileNumber, amount, unpaidName
                      FROM TRANSACTIONS t
                      JOIN REMITTANCES r ON t.remittanceNumber = r.remittanceNumber
                      JOIN UNPAIDS u ON t.idTransaction = u.idTransaction
                      JOIN UNPAID_REASONS un ON u.idUnpaidReason = un.idUnpaidReason
                      WHERE t.siren = :siren ";
    
            // Ajout des conditions à la query
            foreach ($conditions as $values) {
                $query .= "AND {$values[2]} = {$values[0]} ";
            }
    
            // Add ORDER BY clause
            $query .= $orderBy;
    
            return $db->query($query, $conditions);
        }
}

function getDetailsRemise() {
    //Date vente | N°Carte | Montant
}

function getSommeImpayes() {
    //N°Siren | Raison sociale | Somme totale (Group by N°Siren)
}
?>