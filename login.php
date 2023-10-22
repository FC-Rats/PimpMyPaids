<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Login</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel="stylesheet" type="text/css" media="screen" href="assets/css/style.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="assets/css/connexion.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="assets/css/footer.css" />
    <!-- FontAwesome -->
    <link href="assets/fonts/fontawesome/css/fontawesome.min.css" rel="stylesheet" />
    <link href="assets/fonts/fontawesome/css/brands.min.css" rel="stylesheet" />
    <link href="assets/fonts/fontawesome/css/solid.min.css" rel="stylesheet" />
    <!-- Bootstrap -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Beer CSS -->
    <!-- <link href="assets/css/beer.min.css" rel="stylesheet" /> -->
</head>

<body>
    <div class="container-fluid login-section">
        <div class="row container-cols-login">
            <div class="col-lg-8 col-12 text-center d-flex flex-column justify-content-center p-5">
                <h1 class="titleFont py-2 pb-5 fs-2">Pimp My Paids</h1>
                <p class="fs-4 p-0 p-md-5">Découvrez un monde où la gestion de vos finances devient une aventure de luxe, où chaque transaction est une étape vers une vie financière pimpante !</p>
                <img class="p-2" src="assets/img/coffre-fort.svg" alt="Image de coffre-fort" class="img-fluid" title="Image de coffre-fort"/>
            </div>
            <div class="col-lg-4 col-12 d-flex flex-column justify-content-center p-5 col-login">
                <form action="account-connection.php" method="post">
                    <h2 class="text-center fs-1 pb-5">Bienvenue</h2>
                    <div class="form-floating mb-3 text-dark">
                        <input type="text" class="form-control" id="username" name="username" placeholder=" " required>
                        <label for="username">Identifiant<span class="required"> *</span></label>
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
                    <div class="form-check mb-3 mb-md-2">
                        <input class="form-check-input stay-connected-checkbox" type="checkbox" value="0" id="stayConnected" required>
                        <label class="form-check-label label-stay-connected" for="stayConnected">
                            Rester connecté
                        </label>
                    </div>
                    <div class="text-center d-flex flex-column justify-content-center">
                        <span id="erreur"></span>
                        <div class="mx-auto mb-5">
                            <button type="submit" id="submit-button" class="btn btn-dark text-uppercase d-flex align-items-center px-3 py-3 px-md-5">
                                <i class="fa-solid fa-lock"></i>
                                <span class="ms-2 fs-5">Connexion</span>
                            </button>
                        </div>
                        <a class="text-light" id="lien-mpd-oublie" href="recover.php">Mot de passe oublié ?</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="assets/js/password-toggle.js"></script>
    <script src="assets/js/stay-connected-checkbox.js"></script>
    <!-- Bootstrap -->
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <!-- Beer CSS -->
    <!-- <script type="module" src="assets/js/beer.min.js"></script> -->
    <script type="module" src="assets/js/material-dynamic-colors.min.js"></script>

</body>

</html>