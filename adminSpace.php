<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Espace Product Owner</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="icon" href="assets/img/logo.ico">
    <!-- Nos pages CSS -->
    <link rel="stylesheet" type="text/css" media="screen" href="assets/css/style.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="assets/css/header.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="assets/css/adminSpace.css" />
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
    <?php //include('../includes/usefulFunctions.php'); 
    ?>

    <div class="container espace-admin-section">
        <div class="row container-cols-espace-admin ">
            <div class="col-xl-6 col-12 d-flex flex-column justify-content-center align-items-center pt-4">
                    <div class="pb-5">
                        <h2>Content de vous revoir parmi nous,</h2>
                        <h1>Administrateur</h1>
                    </div>

                    <div class="rounded p-2 p-md-5 bg-grey adminnews">
                        <h4 class="text-center">Dernières requetes du Product Owner</h4>


                    <div class="accordion accordion-flush py-3 mb-3" id="accordionFlushExample">
                        <div class="accordion-item my-3">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed rounded compte ajout" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                    <span class="col-3 col-md-3">AJOUTER</span>
                                    <span class="col-1">-</span>
                                    <span class="col-6 col-md-6">RAISON SOCIALE</span>
                                </button>
                            </h2>
                            <div id="flush-collapseOne" class="accordion-collapse collapse">
                                <div class="accordion-body">
                                    <div class="infos d-flex flex-wrap pb-2">
                                        <span class="col-12">Raison Sociale : RS</span>
                                        <span class="col-12">Num Siren : 0125412265542415</span>
                                        <span class="col-12">Devise : EUR</span>
                                        <span class="col-12">Login : RS</span>
                                        <span class="col-12">Email : lololabest@gmail.com</span>
                                        <span class="col-12">Commentaire : blablablal zjiorhazuiezhadi zerad a </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item my-3">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed rounded compte delete" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                    <span class="col-3 col-md-3">SUPPRIMER</span>
                                    <span class="col-1">-</span>
                                    <span class="col-6 col-md-6">RAISON SOCIALE</span>
                                </button>
                            </h2>
                            <div id="flush-collapseTwo" class="accordion-collapse collapse">
                                <div class="accordion-body">
                                    <div class="infos d-flex flex-wrap pb-2">
                                        <span class="col-12">Raison Sociale : MACDONALD VEGAN</span>
                                        <span class="col-12">Login : LoloLaBosse</span>
                                        <span class="col-12">Commentaire : Bilbobjzag biobiu ahjeg zduazi </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item my-3">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed compte rounded ajout" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse3" aria-expanded="false" aria-controls="flush-collapse3">
                                    <span class="col-3 col-md-3">AJOUTER</span>
                                    <span class="col-1">-</span>
                                    <span class="col-6 col-md-6">RAISON SOCIALE</span>
                                </button>
                            </h2>
                            <div id="flush-collapse3" class="accordion-collapse collapse">
                                <div class="accordion-body">
                                    <div class="infos d-flex flex-wrap pb-2">
                                    <span class="col-12">Raison Sociale : RS</span>
                                        <span class="col-12">Num Siren : 0125412265542415</span>
                                        <span class="col-12">Devise : EUR</span>
                                        <span class="col-12">Login : RS</span>
                                        <span class="col-12">Email : lololabest@gmail.com</span>
                                        <span class="col-12">Commentaire : blablablal zjiorhazuiezhadi zerad a </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="col-xl-6 col-12 d-flex flex-column align-items-center pt-4 mb-5">
                <div id="formulaire" class="formulaire rounded mt-5">
                    <div class="intro-form">
                        <h3 class="align-items-center d-flex justify-content-center pb-2">Formulaire d'ajout de client</h3>
                    </div>

                    <form id="ajout-form" class="mx-auto my-5" action="../includes/addMerchant.php" method="POST">
                        <div class="form-floating mb-3 text-dark">
                            <input type="text" class="form-control" id="login" name="login" placeholder=" " required>
                            <label for="login">Identifiant</label>
                        </div>
                        <div class="form-floating mb-3 text-dark">
                            <input type="text" class="form-control" id="siren" name="siren" placeholder=" " required>
                            <label for="siren">SIREN</label>
                        </div>
                        <div class="form-floating mb-3 text-dark">
                            <input type="text" class="form-control" id="companyName" name="companyName" placeholder=" " required>
                            <label for="companyName">Raison Sociale</label>
                        </div>
                        <div class="form-floating mb-3 text-dark">
                            <input type="email" class="form-control" id="email" name="email" placeholder=" " required>
                            <label for="email">Email</label>
                        </div>
                        <div class="form-floating mb-3 text-dark">
                            <input type="text" class="form-control" id="currency" name="currency" placeholder=" " required>
                            <label for="currency">Devise</label>
                        </div>
                        <div class="form-floating mb-3 text-dark">
                            <textarea class="form-control" id="password" name="password" placeholder=" "></textarea>
                            <label for="comment">Mot de Passe</label>
                        </div>
                        <div class="text-center col-12 d-flex flex-column align-items-center justify-content-center">
                            <input id="submit-task-button" class="btn btn-dark text-uppercase d-flex justify-content-center px-3 py-3 px-md-5" type="submit" value="Ajouter">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <?php include('./footer.php'); ?>
    <!-- JQuery -->
    <script src="assets/js/jquery-3.7.1.min.js"></script>
    <!-- Bootstrap -->
    <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>