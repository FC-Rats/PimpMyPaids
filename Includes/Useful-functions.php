<?
/*
- - - FONCTIONS UTILES A LA CONNEXION AU SITE - - -
*/
session_start();

function login($login, $password) {
    global $db;

    if (!isset($_SESSION["try"]))
        $_SESSION["try"] = 3;

    if ((!isset($_POST['login'])) || (!isset($_POST['password']))) {
        return -1;
    } else if ($_SESSION["nbtry"] == 0) {
        return -1;
    } else {
        $connection = $db->query("SELECT * FROM UTILISATEUR WHERE login = :login", array(array(":login", $login)));

        if ($connection && $connection[0]->password == $password) {

            $_SESSION["id"] = $connection[0]->id;
            $_SESSION["login"] = $connection[0]->login;
            $_SESSION["nom"] = $connection[0]->nom;
            $_SESSION["prenom"] = $connection[0]->prenom;
            $_SESSION["profil"] = $connection[0]->profil;

            switch ($connection[0]->profil) {
                case 'PO':
                    include("");
                    break;
                case 'Admin':
                    include("");
                    break;
                case 'Client':
                    include("");
                    break;
            }
        } else if ($connection && $connection[0]->password != $password) {
            $_SESSION["try"] -= 1;
        } else {
            echo "Mot de passe ou login incorrect";
        }
    }
}
?>