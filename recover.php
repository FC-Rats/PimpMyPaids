<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Connexion</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel="icon" href="assets/img/logo.ico">
    <link rel="stylesheet" type="text/css" media="screen" href="assets/css/style.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="assets/css/connexion.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="assets/css/footer.css" />
    <!-- FontAwesome -->
    <link href="assets/fonts/fontawesome/css/fontawesome.min.css" rel="stylesheet" />
    <link href="assets/fonts/fontawesome/css/brands.min.css" rel="stylesheet" />
    <link href="assets/fonts/fontawesome/css/solid.min.css" rel="stylesheet" />
    <!-- Bootstrap -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
</head>

<body>
    <div class="container-fluid login-section">
        <div class="row container-cols-login">
            <div class="col-lg-8 col-12 text-center d-flex flex-column justify-content-center align-items-center p-5">
                <img class="p-2 img-fluid w-45" src="assets/img/logo.png" alt="Logo Pimp My Paids" title="Logo Pimp My Paids" />
                <p class="fs-4 p-0 p-md-5">Besoin d'un coup de pouce financier ? Réinitialisez votre mot de passe et reprenez le contrôle de vos finances en un clin d'œil !</p>
                <img class="p-2 img-fluid" src="assets/img/forgot-password.svg" alt="J'ai oublié mon mot de passe" title="J'ai oublié mon mot de passe" />
            </div>
            <div class="col-lg-4 col-12 d-flex flex-column justify-content-center p-5 col-login">
                <form action="recover-password.php" method="post">
                    <h2 class="text-center fs-1 pb-5">Mot de passe oublié</h2>
                    <p class="text-center text-dark fs-5 pb-3">Pour renouveler votre mot de passe, veuillez indiquer votre adresse mail ci-dessous.</p>
                    <div class="form-floating mb-3 text-dark">
                        <input type="email" class="form-control" id="mail" name="mail" placeholder=" " pattern=".+@globex\.com" required>
                        <label for="mail">Adresse mail<span class="required"> *</span></label>
                    </div>
                    <p class="form-label mandatory text-shadow">* champs obligatoires</p>
                    <!-- doit etre sous la forme -->
                    <div class="text-center d-flex flex-column justify-content-center">
                        <span id="erreur"></span>
                        <div class="d-flex justify-content-center align-items-center mb-5">
                            <button type="submit" id="submit-recover-button" class="btn text-dark border-0 text-uppercase d-flex align-items-center px-3 py-3 px-md-5">
                                <span class="fs-5 fw-semibold">Envoyer</span>
                            </button>
                            <a href="login.php" class="ps-5 btn btn-link text-dark mx-3 text-decoration-none fs-4 fw-semibold">Annuler</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Bootstrap -->
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script type="module" src="assets/js/material-dynamic-colors.min.js"></script>

</body>

</html>