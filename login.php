<?php 
    if (!isset($_SESSION)) {
        session_start();
    }
    if (!isset($_SESSION["try"])){
        $_SESSION["try"] = 3;
    }
    
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Connexion</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel="icon" href="assets/img/logo.ico">
    <link rel="stylesheet" type="text/css" media="screen" href="assets/css/style.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="assets/css/connection.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="assets/css/footer.css" />
    <!-- FontAwesome -->
    <link href="assets/fonts/fontawesome/css/fontawesome.min.css" rel="stylesheet" />
    <link href="assets/fonts/fontawesome/css/brands.min.css" rel="stylesheet" />
    <link href="assets/fonts/fontawesome/css/solid.min.css" rel="stylesheet" />
    <!-- Bootstrap -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
</head>

<body>
    <div class="conteuneur container-fluid login-section">
        <div class="row container-cols-login">
            <div class="col-lg-8 col-12 text-center d-flex flex-column justify-content-center align-items-center p-5">
                <img class="p-2 img-fluid img-max w-45" src="assets/img/logorect.png" alt="Logo Pimp My Paids" title="Logo Pimp My Paids" />
                <p class="fs-4 p-0 p-md-5">Découvrez un monde où la gestion de vos finances devient une aventure de luxe, où chaque transaction est une étape vers une vie financière pimpante !</p>
                <img class="p-2 img-fluid img-max" src="assets/img/safeDeposit.svg" alt="Image de coffre-fort" title="Image de coffre-fort" />
            </div>
            <div class="col-lg-4 col-12 d-flex flex-column justify-content-center p-5 col-login">
                <form action="./includes/signIn.php" method="post">
                    <h2 class="text-center fs-1 pb-5">Bienvenue</h2>
                
                    <div class="form-floating mb-3 text-dark">
                        <input type="text" class="form-control" id="login" name="login" placeholder=" " required>
                        <label for="login">Identifiant<span class="required"> *</span></label>
                    </div>
                    <div class="row">
                        <div class="col-10 col-md-11 col-lg-10 col-xxl-11 mb-3 pe-1">
                            <div class="form-floating text-dark">
                                <input type="password" class="form-control" id="password" name="password" placeholder=" " required>
                                <label for="password">Mot de passe<span class="required"> *</span></label>
                            </div>
                        </div>
                        <div class="col-2 col-md-1 col-lg-2 col-xxl-1 d-flex align-items-center justify-content-center p-0 h-100 m-0 pe-3" id="col-eye">
                            <button type="button" class="btn btn-light rounded p-0" id="toggle-password">
                                <i class="fa-solid fa-eye"></i>
                            </button>
                        </div>
                    </div>
                    <p class="form-label mandatory">* champs obligatoires</p>
                    <div class="text-center d-flex flex-column justify-content-center">
                        <span id="erreur"></span>
                        <div class="mx-auto mb-4 mt-3">
                            <button type="submit" id="submit-login-button" class="btn btn-dark text-uppercase d-flex align-items-center px-3 py-3 px-md-5">
                                <i class="fa-solid fa-lock"></i>
                                <span class="ms-2 fs-5">Connexion</span>
                            </button>
                        </div>
                        <a class="text-light" id="lien-mpd-oublie" href="index.php?p=recover-password" title="Mot de passe oublié ?">Mot de passe oublié ?</a>
                    </div>
                </form>
            </div>
        </div>
        <!--Toasts -->
        <div class="toast-container bottom-0 start-50 translate-middle-x pb-5">
            <div class="toast toastFirst fade w-auto" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body fs-5">
                        C'est la 1<sup>ere</sup> fois que vous ratez votre connexion... ATTENTION : C'est votre dernier essai !
                    </div>
                    <button type="button" class="btn-close me-2 m-auto w-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
        </div>
        <div class="toast-container bottom-0 start-50 translate-middle-x pb-5">
            <div class="toast toastAlert fade w-auto" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body fs-5">
                        C'est la 2<sup>e</sup> fois que vous ratez votre connexion... ATTENTION : C'est votre dernier essai !
                    </div>
                    <button type="button" class="btn-close me-2 m-auto w-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
        </div>
        <div class="toast-container bottom-0 start-50 translate-middle-x pb-5">
            <div class="toast toastQuit fade w-auto" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body fs-5">
                        Vous avez utilisé vos 3 tentatives de connexion... Vous ne pouvez plus vous connecter !
                    </div>
                    <button type="button" class="btn-close me-2 m-auto w-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        var nbAttemptsCo = <?php echo json_encode($_SESSION["try"]); ?>;
    </script>
    <!-- JQuery -->
    <script src="assets/js/jquery-3.7.1.min.js"></script>
    <!-- Bootstrap -->
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/passwordToggle.js"></script>
    <script src="assets/js/login.js"></script>
</body>

</html>