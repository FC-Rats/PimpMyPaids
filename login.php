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
        <div class="row h-100">
            <div class="col-md-8 text-center d-flex flex-column justify-content-center p-5">
                <h1 class="titleFont py-2 pb-5 fs-5 fs-md-1">Pimp My Paids</h1>
                <p class="fs-4 fs-md-6 p-5">Découvrez un monde où la gestion de vos finances devient une aventure de luxe, où chaque transaction est une étape vers une vie financière pimpante !</p>
                <img class="p-2" src="assets/img/coffre-fort.svg" alt="Image de coffre-fort" class="img-fluid" />
            </div>
            <div class="col-md-4 text-center bg-dark d-flex flex-column justify-content-center p-5">
                <form action="account-connection.php" method="post">
                    <h2>Connexion</h2>
                    <div class="form-group">
                        <label for="username">Pseudo<span class="required"> *</span></label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Mot de passe<span class="required"> *</span></label>
                        <div class="password-input">
                            <input type="password" class="form-control" id="password" name="password" placeholder="Ex : MotDeP@sseCorr3cte" required>
                            <button type="button" id="toggle-password"><i class="fa-solid fa-eye"></i></button>
                        </div>
                    </div>
                    <span id="erreur"></span>
                    <button type="submit" class="btn btn-dark">Se connecter</button>
                    <br><a id="lien-mpd-oublie" href="recover.html">Mot de passe oublié ?</a>
                </form>
            </div>
        </div>
    </div>

    <script src="assets/js/password-check.js"></script>
    <script src="assets/js/password-toggle.js"></script>
    <!-- Bootstrap -->
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <!-- Beer CSS -->
    <script type="module" src="assets/js/beer.min.js"></script>
    <script type="module" src="assets/js/material-dynamic-colors.min.js"></script>

</body>

</html>