<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

if (!class_exists('Connection')) {
    include('connectionFunctions.php');
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    //On définit la variable de session "try" à 3 s'il est pas défini
    if (!isset($_SESSION["try"]))
        $_SESSION["try"] = 3;

    //On vérifie que les champs soient bien définis
    if (isset($_POST["login"]) && isset($_POST["password"]) && $_SESSION["try"] > 0) {
        $login = $_POST["login"];
        $password = $_POST["password"];

        // On récupère les informations en fonction de l'identifiant
        $connectionVerif = $db->query("SELECT idUser, login, password, profil, state FROM TRAN_USERS WHERE login = :login", array(array(":login", $login)));
        //On vérifie si on obtient UN résultat (si l'identifiant est correct)
        if (count($connectionVerif) == 1) {

            if ($connectionVerif[0]['state'] == 1) {
                //On vérifie si le mot de passe est correct
                if (password_verify($password, $connectionVerif[0]['password'])) {
                    $_SESSION["login"] = $connectionVerif[0]['login'];
                    $_SESSION["id"] = $connectionVerif[0]['idUser'];
                    $_SESSION["profil"] = $connectionVerif[0]['profil'];

                    if ($_SESSION["profil"] == 'Merchant'){
                        $siren = $db->query("SELECT siren FROM TRAN_CUSTOMER_ACCOUNT WHERE idUser = :idUser", array(array(":idUser",$_SESSION["id"])));
                        $_SESSION["siren"] = $siren[0]["siren"];
                    }
                    header("Location: ../index.php?p=my-space");
                    exit();

                //Si le mot de passe est incorrect on renvoie l'erreur et on diminue les essais restants
                } else if (!password_verify($password, $connectionVerif[0]['password'] || $connectionVerif[0]['login'] != $login)) {
                    $_SESSION["try"] -= 1;
                    header("Location: ../index.php?e=1");
                    exit();
                }

            } else {
                header("Location: ../index.php?e=2");
                exit();
            }
        
        //Si l'identifiant est incorrect on renvoie l'erreur et on diminue les essais restants
        } else {
            $_SESSION["try"] -= 1;
            header("Location: ../index.php?e=3");
            exit();
        }
    }
}
