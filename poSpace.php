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
    <?php include('./includes/getSpace.php');?>

    <div class="conteuneur container espace-po-section">
        <div class="row container-cols-espace-po">
            <div class="col-xl-6 col-12 d-flex flex-column justify-content-center align-items-center pt-4">
                <div>
                    <div class="pb-5">
                        <h2>Content de vous revoir parmi nous,</h2>
                        <h1><span id="clientName"><?php echo $names[0]['lastName']; ?></span> <span id="clientFirstName"><?php echo $names[0]['firstName']; ?></span></h1>
                    </div>

                    <div class="rounded p-2 p-md-5 bg-grey news">
                        <h4 class="text-center">Dernières actions sur l'application</h4>
                        <?php

                        for ($i = 0; $i < 3; $i++) {
                            $dateTransac = date('d/m/Y', strtotime($lastTr[$i]['dateTransac']));

                            echo '<div class="act rounded p-1 p-md-3 bg-dark fs-6 d-flex flex-row flex-wrap align-items-center justify-content-center text-center text-light">';
                            echo '<div class="col-6 col-md-2 mb-2"><span>' . $dateTransac . '</span></div>';
                            echo '<div class="col-6 col-md-3 mb-2"><span>N°' . $lastTr[$i]['idTransac'] . '</span></div>';
                            if ($lastTr[$i]['sign'] == "-") {
                                echo '<div class="col-6 col-md-3 mb-2 negative"><span class="fw-bold">' . $lastTr[$i]['sign'] . ' ' . number_format($lastTr[$i]['amount'], 2, ',', ' ') . '&nbsp;&nbsp;&nbsp;'.$lastTr[$i]['currency'].'</span></div>';
                                echo '<div class="col-2 d-none d-md-block mb-2"><i class="fa-solid fa-people-pulling fa-beat fa-xl" style="color: #ffffff;"></i></div>';
                            } else {
                                echo '<div class="col-6 col-md-3 mb-2"><span class="fw-bold">' . $lastTr[$i]['sign'] . ' ' . number_format($lastTr[$i]['amount'], 2, ',', ' ') . '&nbsp;&nbsp;&nbsp;'.$lastTr[$i]['currency'].'</span></div>';
                                echo '<div class="col-2 d-none d-md-block mb-2"><i class="fa-solid fa-piggy-bank fa-xl fa-bounce"></i></div>';
                            }
                            echo '</div>';
                        }
                        ?>
                    </div>

                    <div class="align-items-center justify-content-center text-center pt-5 d-none d-sm-block">
                        <img class="p-2 img-fluid" src="assets/img/profile.svg" alt="Profil de compte" title="Profil de compte" />
                    </div>
                </div>
            </div>

            <div class="col-xl-6 col-12 d-flex flex-column align-items-center pt-4">
                <div id="formulaire" class="formulaire rounded mt-5">
                    <div class="intro-form">
                        <h3 class="align-items-center d-flex justify-content-center pb-2">Demande à l'admin</h3>
                        <div class="choice">
                            <button id="ajout-btn" class="active col-6">Ajouter</button>
                            <button id="suppression-btn" class="col-6">Supprimer</button>
                        </div>
                    </div>

                    <form id="ajout-form" class="mx-auto my-5" onsubmit="return false">
                        <div class="form-floating mb-3 text-dark">
                            <input type="text" class="form-control" id="login" name="login" placeholder=" " required>
                            <label for="login">Identifiant</label>
                        </div>
                        <div class="form-floating mb-3 text-dark">
                            <input type="text" class="form-control" id="siren" name="siren" placeholder=" " required>
                            <label for="siren">Siren</label>
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
                            <textarea class="form-control" id="comment" name="comment" placeholder=" "></textarea>
                            <label for="comment">Commentaire</label>
                        </div>
                        <div class="text-center col-12 d-flex flex-column align-items-center justify-content-center">
                            <input id="addRequestPo" class="btn btn-dark text-uppercase d-flex justify-content-center px-3 py-3 px-md-5" type="button" value="Ajouter">
                        </div>
                    </form>

                    <form id="suppression-form" class="mx-auto my-5" onsubmit="return false">
                        <div class="form-floating mb-3 text-dark">
                            <input type="text" class="form-control" id="companyName" name="companyName" placeholder=" " required>
                            <label for="companyName">Raison Sociale</label>
                        </div>
                        <div class="form-floating mb-3 text-dark">
                            <input type="text" class="form-control" id="login" name="login" placeholder=" " required>
                            <label for="login">Identifiant</label>
                        </div>
                        <div class="form-floating mb-3 text-dark">
                            <textarea class="form-control" id="comment" name="comment" placeholder=" "></textarea>
                            <label for="comment">Commentaire</label>
                        </div>

                        <div class="text-center col-12 d-flex flex-column align-items-center justify-content-center">
                            <input id="deleteRequestPo" class="btn btn-dark text-uppercase d-flex align-items-center px-3 py-3 px-md-5" type="button" value="Supprimer">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Modal confirmation -->
        <div class="modal fade" id="modalAddMerchant" aria-hidden="true" aria-labelledby="modalAddMerchantLabel" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="modalAddMerchantLabel">Demande d'ajout de client</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Votre demande d'ajout de client au prêt de l'administrateur a bien été prise en compte.
                    </div>
                    <div class="modal-footer">
                        <small class="fst-italic">PimpMyPaids</small>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modalDeleteMerchant" aria-hidden="true" aria-labelledby="modalDeleteMerchantLabel" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="modalDeleteMerchantLabel">Demande de suppresion de client</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Votre demande de suppresion de client au prêt de l'administrateur a bien été prise en compte.
                    </div>
                    <div class="modal-footer">
                        <small class="fst-italic">PimpMyPaids</small>
                    </div>
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
    <!-- JS -->
    <script src="assets/js/poSpace.js"></script>
</body>

</html>