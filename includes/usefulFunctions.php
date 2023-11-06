<?php
/*
- - - FONCTIONS UTILES A LA CONNEXION AU SITE - - -
*/
session_start();

function getEspaceData() {
    switch ($_SESSION["profil"]) {
        case 'PO':
            //Liste des 3 dernières transactions
            return;
        case 'Admin':
            //Liste des requêtes du PO
            return;
        case 'Merchant':
            //Solde total | Somme remises | Somme impayés | Graphique trésorerie (Group by N°Siren)
            return;
    }
}

function getCompte() {
    switch ($_SESSION["profil"]) {
        case 'PO':
            //Liste des clients avec nb transaction | montant total (order by N°Siren ou Montant) (Group by N°Siren)
            return;
        case 'Admin':
            //Liste des clients avec mail | login | devise
            return;
    }
}

function getRemises() {
    switch ($_SESSION["profil"]) {
        case 'PO':
            //Liste des remises clients avec N°Siren | raison sociale | N°remise | date | nbr transaction | montant total (devise) (Group by N°Siren)
            return;
        case 'Merchant':
            //Liste de ses remises avec date | N° carte | N° author | montant (devise) (Group by N°Siren)
            return;
    }
}

function getImpayes() {
    switch ($_SESSION["profil"]) {
        case 'PO':
            //Liste des remises clients avec N°Siren | raison sociale | date vente | date remise | Reseau | N° de carte | num dossier impayé | montant total (devise) (Group by N°Siren)
            return;
        case 'Merchant':
            //Liste de ses impayés avec date vente | date remise | N° carte | N° dossier | montant (devise) |  libellé impayé
            return;
    }
}

function getDetailsRemise() {
    //Date vente | N°Carte | Montant
}

function getSommeImpayes() {
    //N°Siren | Raison sociale | Somme totale (Group by N°Siren)
}
?>