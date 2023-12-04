<?php
session_start();

if (!isset($_SESSION["profil"])){
    $_SESSION["profil"] = "";
}

$p = isset($_GET['p']) ? $_GET['p'] : 'login';

switch ($p) {
    case 'login':
        include_once("login.php");
        break;
    case 'recover-password':
        include_once("recover.php");
        break;
    case 'change-password':
        include_once("change.php");
        break;
    case 'my-space':
        switch ($_SESSION["profil"]) {
            case 'PO':
                include_once("poSpace.php");
                break;
            case 'Admin':
                include_once("adminSpace.php");
                break;
            case 'Merchant':
                include_once("clientSpace.php");
                break;
        }break;
    case 'list-remise':
        switch ($_SESSION["profil"]) {
            case 'PO':
                include_once("poRemises.php");
                break;
            case 'Merchant':
                include_once("clientRemises.php");
                break;
        }break;
    case 'list-impayés':
        switch ($_SESSION["profil"]) {
            case 'PO':
                include_once("poUnpaids.php");
                break;
            case 'Merchant':
                include_once("clientUnpaids.php");
                break;
        }break;
    case 'list-compte':
        switch ($_SESSION["profil"]) {
            case 'PO':
                include_once("poListAccount.php");
                break;
            case 'Admin':
                include_once("adminListAccount.php");
                break;
        }break;
    case 'deconnexion':
        include("../includes/SignOut.php");
        break;
    default:
        include_once("login.php");
        break;
}
