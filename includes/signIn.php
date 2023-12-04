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
    if (isset($_POST["login"]) && isset($_POST["password"])) {
        $login = $_POST["login"];
        $password = $_POST["password"];

        // On récupère les informations en fonction de l'identifiant
        $connectionVerif = $db->query("SELECT idUser, login, password, profil FROM TRAN_USERS WHERE login = :login", array(array(":login", $login)));
        print_r($connectionVerif);
        echo count($connectionVerif);
        //On vérifie si on obtient UN résultat (si l'identifiant est correct)
        if (count($connectionVerif) == 1) {
            
            //On vérifie si le mot de passe est correct
            if (password_verify($password, $connectionVerif[0]['password'])) {
                $_SESSION["login"] = $connectionVerif[0]['login'];
                $_SESSION["id"] = $connectionVerif[0]['idUser'];
                $_SESSION["profil"] = $connectionVerif[0]['profil'];
                header("Location: ../index.php?p=my-space");
                exit();

            //Si le mot de passe est incorrect on renvoie l'erreur et on diminue les essais restants
            } else if (!password_verify($password, $connectionVerif[0]['password'] || $connectionVerif[0]['login'] != $login)) {
                $_SESSION["try"] -= 1;
                $error = "Mot de passe incorrect. Il vous reste " . $_SESSION["try"] . " essai" . $_SESSION["try"] <= 1 ? "s." : ".";
                header("Location: ../index.php?p=1");
                exit();
            }
        
        //Si l'identifiant est incorrect on renvoie l'erreur et on diminue les essais restants
        } else {
            $_SESSION["try"] -= 1;
            $error = "Identifiant incorrect. Il vous reste " . $_SESSION["try"] . " essai" . $_SESSION["try"] <= 1 ? "s." : ".";
            header("Location: ../index.php?p=5");
            exit();
        }
    }
}
