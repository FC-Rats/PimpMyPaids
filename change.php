<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Changement MDP</title>
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
    <div class="container-fluid login-section">
        <div class="row container-cols-login">
            <div class="col-lg-8 col-12 text-center d-flex flex-column justify-content-center align-items-center p-5">
                <img class="p-2 img-fluid img-max w-45" src="assets/img/logorect.png" alt="Logo Pimp My Paids" title="Logo Pimp My Paids" />
                <p class="fs-4 p-0 p-md-5">Renouvelez la sécurité de votre compte en quelques clics ! Changez votre mot de passe et protégez vos finances avec style.</p>
                <img class="p-2 img-fluid img-max " src="assets/img/authpassword.svg" alt="Je change mon mot de passe" title="Je change mon mot de passe" />
            </div>
            <div class="col-lg-4 col-12 d-flex flex-column justify-content-center p-5 col-login">
                <form action="includes/recoverPassword.php" method="post">
                    <h2 class="text-center fs-1 pb-5">Changement du mot de passe</h2>
                    <div class="row">
                        <div class="col-10 col-md-11 col-lg-10 col-xxl-11 mb-3 pe-1">
                            <div class="form-floating text-dark">
                                <input type="password" class="form-control" id="password" name="password" placeholder=" " required>
                                <label for="password" class="text-wrap">Nouveau mot de passe<span class="required"> *</span></label>
                            </div>
                        </div>
                        <div class="col-2 col-md-1 col-lg-2 col-xxl-1 d-flex align-items-center justify-content-center p-0 h-100 m-0 pe-3" id="col-eye">
                            <button type="button" class="btn btn-light rounded p-0" id="toggle-password">
                                <i class="fa-solid fa-eye"></i>
                            </button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-10 col-md-11 col-lg-10 col-xxl-11 mb-3 pe-1">
                            <div class="form-floating text-dark">
                                <input type="password" class="form-control" id="confirm-password" name="confirm-password" placeholder=" " required>
                                <label for="confirm-password" class="text-wrap">Confirmer le mot de passe<span class="required"> *</span></label>
                            </div>
                        </div>
                        <div class="col-2 col-md-1 col-lg-2 col-xxl-1 d-flex align-items-center justify-content-center p-0 h-100 m-0 pe-3" id="col-eye">
                            <button type="button" class="btn btn-light rounded p-0" id="toggle-confirm-password">
                                <i class="fa-solid fa-eye"></i>
                            </button>
                        </div>
                    </div>
                    <div id="password-conditions">
                        <ul>
                            <li id="length-condition"><span id="length-check"></span> Doit contenir au moins 12 caractères</li>
                            <li id="uppercase-condition"><span id="uppercase-check"></span> Doit contenir au moins une majuscule</li>
                            <li id="digit-condition"><span id="digit-check"></span> Doit contenir au moins un chiffre</li>
                            <li id="special-character-condition"><span id="special-character-check"></span> Doit contenir au moins un caractère spécial</li>
                            <li id="match-condition"><span id="match-check"></span> Les mots de passe doivent être identiques</li>
                        </ul>
                    </div>
                    <p class="form-label mandatory text-shadow">* champs obligatoires</p>
                    <!-- doit etre sous la forme -->
                    <div class="text-center d-flex flex-column justify-content-center">
                        <span id="erreur"></span>
                        <div class="d-flex justify-content-center align-items-center mb-5 mt-2">
                            <button type="submit" id="submit-button" class="btn text-dark border-0 text-uppercase d-flex align-items-center px-3 py-3 px-md-5">
                                <span class="fs-5 fw-semibold">Changer</span>
                            </button>
                            <a href="index.php?p=login" class="ps-4 ps-lg-2 ps-xl-4 btn btn-link text-dark mx-3 text-decoration-none fs-4 fw-semibold" title="Annuler">Annuler</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- JQuery -->
    <script src="assets/js/jquery-3.7.1.min.js"></script>
    <!-- Bootstrap -->
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/passwordCheck.js"></script>
    <script src="assets/js/passwordToggle.js"></script>
    <script type="module" src="assets/js/material-dynamic-colors.min.js"></script>

</body>

</html>