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
    case 'change-password':
        include_once("");
    case 'my-space':
        switch ($_SESSION["type"]) {
            case 'PO':
                include_once("");
            case 'Admin':
                include_once("");
            case 'Merchant':
                include_once("");
        }
    case 'list-remise':
        switch ($_SESSION["type"]) {
            case 'PO':
                include_once("");
            case 'Merchant':
                include_once("");
        }
    case 'list-impayés':
        switch ($_SESSION["type"]) {
            case 'PO':
                include_once("");
            case 'Merchant':
                include_once("");
        }
    case 'list-compte':
        if ($_SESSION["type"] == 'PO')
            include_once("");
    case 'list-user':
        if ($_SESSION["type"] == 'Admin')
            include_once("");
}
?>