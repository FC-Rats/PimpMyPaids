<?php
switch ($_SESSION["profil"]) {
        case 'PO':
            //Liste des remises clients avec N°Siren | raison sociale | somme 
            return;
        case 'Merchant':
            // Liste de ses impayés avec date vente | date remise | N° carte | N° dossier | montant (devise) |  libellé impayé
    
            $conditions = array(":siren", $_SESSION["siren"]);
    
            // Conditions supplémentaires    
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
            $query = "SELECT t.dateTransac, r.dateRemittance, t.creditCardNumber, u.unpaidFileNumber, t.amount, un.unpaidName
                      FROM TRAN_TRANSACTIONS t
                      JOIN TRAN_REMITTANCES r ON t.remittanceNumber = r.remittanceNumber
                      JOIN TRAN_UNPAIDS u ON t.idTransaction = u.idTransaction
                      JOIN TRAN_UNPAID_REASONS un ON u.idUnpaidReason = un.idUnpaidReason
                      WHERE t.siren = :siren ";
    
            // Ajout des conditions à la query
            foreach ($conditions as $values) {
                $query .= "AND {$values[2]} = {$values[0]} ";
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
    
            return $db->query($query, $conditions);
        }
?>