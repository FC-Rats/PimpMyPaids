<?php
session_start();
$_SESSION["type"] = "";

//include "/includes/connexionFunction.php";

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
        switch ($_SESSION["type"]) {
            case 'PO':
                include_once("poSpace.php");
                break;
            case 'Admin':
                include_once("");
                break;
            case 'Merchant':
                include_once("clientSpace.php");
                break;
        }
    case 'list-remise':
        switch ($_SESSION["type"]) {
            case 'PO':
                include_once("");
                break;
            case 'Merchant':
                include_once("");
                break;
        }
    case 'list-impayés':
        switch ($_SESSION["type"]) {
            case 'PO':
                include_once("");
                break;
            case 'Merchant':
                include_once("");
                break;
        }
    case 'list-compte':
        if ($_SESSION["type"] == 'PO')
            include_once("");
        break;
    case 'list-user':
        if ($_SESSION["type"] == 'Admin')
            include_once("");
        break;
    default:
        include_once("login.php");
        break;
}
