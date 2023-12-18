<?php
/* 
####################################### WARNINGS ########################################
#  Tableau de configuration contenant les détails de la connexion à la base de données  #
#          /!\ Mettez des '' pour vos variables comme il y a actuellement /!\           #
#       Oubliez pas de renommer le fichier en config.php avant de lancer le site        #
#########################################################################################
*/

$config = [
    'database' => [
        'host' => ' ',        // Hôte de la base de données
        'db' => ' ',       // Nom de la base de données
        'login' => ' ',       // Nom d'utilisateur de la base de données
        'password' => ' ',        // Mot de passe de la base de données
    ],

    // Tableau de configuration pour les paramètres de PHPMailer
    'PHPMailer' => [
        'mailadress' => ' ',  // Adresse e-mail pour l'envoi d'e-mails
        'mailpassword' => ' ',      // Mot de passe de l'application du compte e-mail
    ],

    // Tableau de configuration pour la clé secrète
    'secret-key' => [
        'secret-key' => ' ',  // Clé secrète pour des fins cryptographiques
    ],
];

?>