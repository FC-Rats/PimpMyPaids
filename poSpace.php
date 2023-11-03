<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Espace Product Owner</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="icon" href="assets/img/logo.ico">
    <!-- Nos pages CSS -->
    <link rel="stylesheet" type="text/css" media="screen" href="assets/css/style.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="assets/css/header.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="assets/css/poSpace.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="assets/css/footer.css" />
    <!-- FontAwesome -->
    <link href="assets/fonts/fontawesome/css/fontawesome.min.css" rel="stylesheet" />
    <link href="assets/fonts/fontawesome/css/brands.min.css" rel="stylesheet" />
    <link href="assets/fonts/fontawesome/css/solid.min.css" rel="stylesheet" />
    <!-- Bootstrap -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
</head>

<body>
    <script src="assets/js/highcharts.js"></script>
    <script src="assets/js/exporting.js"></script>
    <script src="assets/js/export-data.js"></script>
    <script src="assets/js/accessibility.js"></script>
    <?php include('./header.php'); ?>

    <div class="container espace-po-section">
        <div class="row container-cols-espace-po">
            <div class="col-lg-6 col-12 d-flex flex-column justify-content-center align-items-center pt-4">
                <div>
                    <div class="pb-5">
                        <h2>Content de vous revoir parmi nous,</h2>
                        <h1>NOM Prénom</h1>
                    </div>

                    <div class="rounded p-5 bg-grey news">
                        <div class="act rounded p-3 bg-dark fs-5 d-flex align-items-center justify-content-center text-center col-12 text-light">
                            <span id="date" class="col-3">14/02/2023</span>
                            <span id="numerocarte" class="col-3">N°123456789</span>
                            <span class="fw-bold col-3" id="solde">-10000,00 $</span>
                            <span class="col-1" id="type">Impayé</span>
                            <i class="fa-solid fa-piggy-bank fa-xl fa-bounce col-3"></i>
                        </div>
                        <div class="act rounded p-3 bg-dark fs-5 d-flex align-items-center justify-content-center text-center col-12 text-light">
                            <span id="date" class="col-3">14/02/2023</span>
                            <span id="numerocarte" class="col-3">N°123456789</span>
                            <span class="fw-bold col-3" id="solde">-10000,00 $</span>
                            <span class="col-1" id="type">Impayé</span>
                            <i class="fa-solid fa-piggy-bank fa-xl fa-bounce col-3"></i>
                        </div>
                        <div class="act rounded p-3 bg-dark fs-5 d-flex align-items-center justify-content-center text-center col-12 text-light">
                            <span id="date" class="col-3">14/02/2023</span>
                            <span id="numerocarte" class="col-3">N°123456789</span>
                            <span class="fw-bold col-3" id="solde">-10000,00 $</span>
                            <span class="col-1" id="type">Impayé</span>
                            <i class="fa-solid fa-piggy-bank fa-xl fa-bounce col-3"></i>
                        </div>
                    </div>

                    <div class="align-items-center justify-content-center text-center pt-5 d-none d-sm-block">
                        <img class="p-2 img-fluid" src="assets/img/profile.svg" alt="Profil de compte" title="Profil de compte" />
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-12 d-flex flex-column align-items-center pt-4">
                <div id="formulaire" class="formulaire rounded mt-5">
                    <div class="intro-form">
                        <h3 class="align-items-center d-flex justify-content-center">Demande à l'admin</h3>
                        <div class="choice">
                            <button id="ajout-btn" class="active">Ajouter</button>
                            <button id="suppression-btn">Supprimer</button>
                        </div>
                    </div>

                    <form id="ajout-form">
                        <div class="form-floating mb-3 text-dark">
                            <input type="text" class="form-control" id="username" name="username" placeholder=" " required>
                            <label for="username">SIREN</label>
                        </div>
                        <div class="form-floating mb-3 text-dark">
                            <input type="text" class="form-control" id="RaisonSociale" name="RaisonSociale" placeholder=" " required>
                            <label for="username">Raison Sociale</label>
                        </div>
                        <div class="form-floating mb-3 text-dark">
                            <input type="text" class="form-control" id="username" name="username" placeholder=" " required>
                            <label for="username">Email</label>
                        </div>
                        <div class="form-floating mb-3 text-dark">
                            <input type="text" class="form-control" id="username" name="username" placeholder=" " required>
                            <label for="username">Devise</label>
                        </div>
                        <div class="form-floating mb-3 text-dark">
                            <input type="textarea" class="form-control" id="Commentaire" name="Commentaire" placeholder=" ">
                            <label for="username">Commentaire</label>
                        </div>

                        <div class="">
                            <input id="submit-task-button" class="btn btn-dark text-uppercase d-flex justify-content-center px-3 py-3 px-md-5" type="submit" value="Ajouter">
                        </div>
                    </form>

                    <form id="suppression-form">
                        <div class="form-floating mb-3 text-dark">
                            <input type="text" class="form-control" id="RaisonSociale" name="RaisonSociale" placeholder=" " required>
                            <label for="username">Raison Sociale</label>
                        </div>
                        <div class="form-floating mb-3 text-dark">
                            <input type="text" class="form-control" id="username" name="username" placeholder=" " required>
                            <label for="username">Identifiant</label>
                        </div>
                        <div class="form-floating mb-3 text-dark">
                            <input type="textarea" class="form-control" id="Commentaire" name="Commentaire" placeholder=" ">
                            <label for="username">Commentaire</label>
                        </div>

                        <input id="submit-task-button" class="btn btn-dark text-uppercase d-flex align-items-center px-3 py-3 px-md-5" type="submit" value="Supprimer">
                    </form>
                </div>
            </div>
        </div>
    </div>



    <?php include('./footer.php'); ?>
    <script src="assets/js/formPo.js"></script>
    <!-- JQuery -->
    <script src="assets/js/jquery-3.7.1.min.js"></script>
    <!-- Bootstrap -->
    <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>