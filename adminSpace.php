<?php if (!isset($_SESSION)) {
    session_start();
} ?>
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
    <?php include('./includes/getRequestPo.php');
    ?>

    <div class="conteuneur container espace-admin-section">
        <div class="row container-cols-espace-admin ">
            <div class="col-xl-6 col-12 d-flex flex-column justify-content-center align-items-center pt-4">
                <div class="pb-5">
                    <h2>Content de vous revoir parmi nous,</h2>
                    <h1>Administrateur</h1>
                </div>

                <div class="rounded p-2 p-md-5 bg-grey adminnews">
                    <h4 class="text-center">Dernières requetes du Product Owner</h4>


                    <div class="accordion accordion-flush py-3 mb-3" id="accordionFlushExample">
                        <?php foreach ($requests as $index => $request) : ?>
                            <div class="accordion-item my-3">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed rounded compte <?= $request['type'] == 0 ? 'ajout' : 'delete' ?>" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse<?= $index ?>" aria-expanded="false" aria-controls="flush-collapse<?= $index ?>">
                                        <span class="col-5 col-md-3"><?= $request['type'] == 0 ? 'AJOUTER' : 'SUPPRIMER' ?></span>
                                        <span class="col-1">-</span>
                                        <span class="col-4 col-md-6"><?= $request['companyName'] ?></span>
                                    </button>
                                </h2>
                                <div id="flush-collapse<?= $index ?>" class="accordion-collapse collapse">
                                    <div class="accordion-body">
                                        <div class="infos d-flex flex-wrap pb-2">
                                            <span class="col-12">Raison Sociale : <?= $request['companyName'] ?></span>
                                            <span class="col-12">Login : <?= $request['login'] ?></span>
                                            <?php if ($request['type'] == 0) : ?>
                                                <span class="col-12">Num Siren : <?= $request['siren'] ?></span>
                                                <span class="col-12">Devise : <?= $request['currency'] ?></span>
                                                <span class="col-12">Email : <?= $request['email'] ?></span>
                                            <?php endif; ?>
                                            <span class="col-12">Commentaire : <?= $request['comment'] ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                </div>
            </div>

            <div class="col-xl-6 col-12 d-flex flex-column align-items-center pt-4 mb-5">
                <div id="formulaire" class="formulaire rounded mt-5">
                    <div class="intro-form">
                        <h3 class="align-items-center d-flex justify-content-center p-2">Formulaire d'ajout de client</h3>
                    </div>

                    <form id="ajout-form" class="mx-auto my-5" onsubmit="return false">
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
                            <input type="text" class="form-control" id="firstName" name="firstName" placeholder=" " required>
                            <label for="firstName">Prénom</label>
                        </div>
                        <div class="form-floating mb-3 text-dark">
                            <input type="text" class="form-control" id="lastName" name="lastName" placeholder=" " required>
                            <label for="lastName">Nom</label>
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
                            <input id="addMerchant" class="btn btn-dark text-uppercase d-flex justify-content-center px-3 py-3 px-md-5" type="button" value="Ajouter">
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
    <!-- JS -->
    <script src="assets/js/adminSpace.js"></script>
</body>

</html>