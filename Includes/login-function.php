<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    //On définit la variable de session "try" à 3 s'il est pas défini
    if (!isset($_SESSION["try"]))
        $_SESSION["try"] = 3;

    //On vérifie que les champs soient bien définis
    if (isset($_POST["username"]) && isset($_POST["mot_de_passe"])) {
        $login = $_POST["username"];
        $mot_de_passe = $_POST["mot_de_passe"];

        // On récupère les informations en fonction de l'identifiant
        $connectionVerif = $db->query("SELECT id_utilisateur, login, mot_de_passe, profil FROM Utilisateur WHERE login = :login", array(array(":login", $login)));

        //On vérifie si on obtient UN résultat (si l'identifiant est correct)
        if (count($connectionVerif) == 1) {

            //On vérifie si le mot de passe est correct
            if (password_verify($mot_de_passe, $connectionVerif[0]['mot_de_passe'])) {
                $_SESSION["login"] = $connectionVerif[0]['login'];
                $_SESSION["id"] = $connectionVerif[0]['id_utilisateur'];
                $_SESSION["profil"] = $connectionVerif[0]['profil'];
                header("Location: ../index.php?p=my-space");

            //Si le mot de passe est incorrect on renvoie l'erreur et on diminue les essais restants
            } else if (!password_verify($mot_de_passe, $connectionVerif[0]['mot_de_passe'] || $connectionVerif[0]['login'] != $login)) {
                $_SESSION["try"] -= 1;
                $error = "Mot de passe incorrect. Il vous reste " . $_SESSION["try"] . " essai" . $_SESSION["try"] <= 1 ? "s." : ".";
            }
        
        //Si l'identifiant est incorrect on renvoie l'erreur et on diminue les essais restants
        } else {
            $_SESSION["try"] -= 1;
            $error = "Identifiant incorrect. Il vous reste " . $_SESSION["try"] . " essai" . $_SESSION["try"] <= 1 ? "s." : ".";
        }
    }
}
